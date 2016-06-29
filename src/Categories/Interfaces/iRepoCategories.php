<?php
namespace Module\Categories\Interfaces;

use Module\Categories\Model\Category;

interface iRepoCategories
{
    /**
     * Adds new category
     *
     * @param Category $category The category instance
     *
     * @return Category Inserted category
     */
    function add(Category $category);

    /**
     * Delete category and all descendant
     *
     * @param Category $category The category instance
     *
     * @return void
     */
    function delete(Category $category);

    /**
     * Gets category by given id
     *
     * @param string $slugID
     *
     * @return Category|null
     */
    function findByID($slugID);

    /**
     * Gets list of parent categories of given category
     *
     * @param Category $category The category instance
     *
     * @return Category[]
     */
    function getParents(Category $category);

    /**
     * Gets category tree
     * 
     * @param Category $root The root category
     * 
     * @return Category[]
     */
    function getTree(Category $root = null);
}
