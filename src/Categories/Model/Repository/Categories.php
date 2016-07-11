<?php
namespace Module\Categories\Model\Repository;

use Module\Categories\Interfaces\iRepoCategories;
use Module\Categories\Model\Category;

use Module\MongoDriver\Model\Repository\aRepository;

class Categories extends aRepository
    implements iRepoCategories
{
    /**
     * Initialize Object
     *
     */
    protected function __init()
    {
        $this->setModelPersist(new Category);
    }


    /**
     * Adds new category
     *
     * @param array|\Traversable $data   DataStruct of category fields
     * @param Category           $parent The parent category instance
     *
     * @return Category Inserted category
     * @throws \Exception Data fields not fulfilled
     */
    function insert($data, Category $parent = null)
    {
        if (!(is_array($data) || $data instanceof \Traversable))
            throw new \InvalidArgumentException(sprintf(
                'Invalid Data Struct Provided. given: (%s).'
                , \Poirot\Std\flatten($data)
            ));

        if ($parent) {
            $leftId  = $parent->{Category::Right};
            $rightId = $leftId + 1;
        } else {
            /** @var Category $rootCat */
            $rootCat = $this->_query()->findOne([], ['sort' => [Category::Right => -1]]);
            $leftId  = 1;
            $rightId = (($rootCat) ? $rootCat->{Category::Right} : 1) + 1;
        }

        $this->_query()->updateMany(
            [ Category::Right => ['$gte' => $leftId] ]
            , [
                '$inc' => [ Category::Right => 2 ],
            ]
        );

        $this->_query()->updateMany(
            [ Category::Left => ['$gte' => $leftId] ]
            , [
                '$inc' => [ Category::Left => 2 ],
            ]
        );

        $newCategory = new Category($data);
        $newCategory->{Category::Parent} = $parent ? $parent->{Category::ID} : 0;
        $newCategory->{Category::Left}   = $leftId;
        $newCategory->{Category::Right}  = $rightId;

        if (!$newCategory->isFulfilled())
            throw new \Exception('Category Options not fullFilled.');

        $r = $this->_query()->insertOne($newCategory);
        $newCategory->{Category::ID} = $r->getInsertedId();

        return $newCategory;
    }

    /**
     * Delete category and all descendant
     *
     * @param Category $category The category instance
     *
     * @return int Deleted Count
     */
    function delete(Category $category)
    {
        $r = $this->_query()->deleteOne([
            Category::ID => $category->{Category::ID}
        ]);
        
        $this->_query()->updateMany(
            [ Category::Parent => $category->{Category::ID} ]
            , [ 
                '$set' => [ Category::Parent => $category->{Category::Parent}] 
            ]
        );

        $this->_query()->updateMany(
            [
                Category::Left  => ['$gte' => $category->{Category::Left}],
                Category::Right => ['$lte' => $category->{Category::Right}],
            ]
            , [
                '$inc'=> [Category::Left  => -1, Category::Right => -1],
            ]
        );


        $this->_query()->updateMany(
            [
                Category::Left => ['$gt' => $category->{Category::Right}],
            ]
            , [
                '$inc'=> [Category::Left => -2],
            ]
        );

        $this->_query()->updateMany(
            [
                Category::Right => ['$gt' => $category->{Category::Right}],
            ]
            , [
                '$inc'=> [Category::Right => -2]
            ]
        );


        return $r->getDeletedCount();
    }

    /**
     * Gets category by given id
     *
     * @param string $slugID
     *
     * @return Category
     * @throws \Exception
     */
    function findByID($slugID)
    {
        $r = $this->_query()->findOne([
            Category::ID  => $slugID,
        ]);

        if (!$r)
            throw new \RuntimeException(sprintf('Category with slug name (%s) not found.', $slugID));

        return $r;
    }

    /**
     * Gets list of parent categories of given category
     *
     * @param Category $category The category instance
     *
     * @return \Traversable[Category]
     */
    function getParents(Category $category)
    {
        $r = $this->_query()->find([
            Category::Left  => ['$lt' => $category->{Category::Left}],
            Category::Right => ['$gt' => $category->{Category::Right}],
        ], ['sort' => [Category::Left => 1]]);

        return $r;
    }

    /**
     * Gets category tree
     *
     * @param Category $root The root category
     *
     * … Array(1) …
     *   food Array(3) … ROOT
     *     food Object => Module\Categories\Model\Category DETAIL key with same name as root
     *     DESCENDANT
     *     fruit Array(3) …
     *     meat Array(3) … - Sorted
     *
     * @return array
     */
    function getTree(Category $root = null)
    {
        if ($root) {
            $r = $this->_query()->find([
                '$or' => [
                    [ Category::ID => $root->{Category::ID} ],
                    [
                        Category::Left  => ['$gt' => $root->{Category::Left}],
                        Category::Right => ['$lt' => $root->{Category::Right}],
                    ]
                ],
            ], ['sort' => [Category::Left => 1]]);
        } else {
            $r = $this->_query()->find([], ['sort' => [Category::Left => 1]]);
        }

        $tree  = [];
        $stack = [];
        foreach ($r as $c)
        {
            /** @var Category $c */
            while(1) {
                $sid = end($stack);
                if (!$sid || ($sid && $c->{Category::Right} < $sid->{Category::Right}))
                    break;

                array_pop($stack);
            }

            array_push($stack, $c);


            $p = &$tree;
            foreach ($stack as $s)
                $p = &$p[$s->{Category::ID}];

            $p[$c->{Category::ID}] = $c;
        }

        return $tree;
    }
}
