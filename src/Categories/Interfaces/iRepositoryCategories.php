<?php
namespace Module\Categories\Interfaces;

interface iRepositoryCategories
{
    /**
     * Gets category tree
     * 
     * @param null $root
     * 
     * @return mixed
     */
    function getTree($root = null);
}
