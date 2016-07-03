<?php
namespace Module\Categories\Interfaces;

use Module\Categories\Model\Category;

interface iRepoCategories
{
    /**
     * Adds new category
     *
     * @param array|\Traversable $data   DataStruct of category fields
     * @param Category           $parent The parent category instance
     *
     * @return Category Inserted category
     */
    function insert($data, Category $parent = null);

    /**
     * Delete category and all descendant
     *
     * @param Category $category The category instance
     *
     * @return int Deleted Count
     */
    function delete(Category $category);

    /**
     * Gets category by given id
     *
     * @param string $slugID
     *
     * @return Category
     * @throws \Exception
     */
    function findByID($slugID);

    /**
     * Gets list of parent categories of given category
     *
     * @param Category $category The category instance
     *
     * @return \Traversable[Category]
     */
    function getParents(Category $category);

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
    function getTree(Category $root = null);
}
