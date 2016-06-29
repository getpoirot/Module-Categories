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
     * @param Category $category The category instance
     *
     * @return Category Inserted category
     */
    function add(Category $category)
    {
        // TODO: Implement add() method.
    }

    /**
     * Delete category and all descendant
     *
     * @param Category $category The category instance
     *
     * @return void
     */
    function delete(Category $category)
    {
        // TODO: Implement delete() method.
    }

    /**
     * Gets category by given id
     *
     * @param string $slugID
     *
     * @return Category|null
     */
    function findByID($slugID)
    {
        // TODO: Implement findByID() method.
    }

    /**
     * Gets list of parent categories of given category
     *
     * @param Category $category The category instance
     *
     * @return Category[]
     */
    function getParents(Category $category)
    {
        // TODO: Implement getParents() method.
    }

    /**
     * Gets category tree
     *
     * @param Category $root The root category
     *
     * @return Category[]
     */
    function getTree(Category $root = null)
    {
        // TODO: Implement getTree() method.
    }
}
