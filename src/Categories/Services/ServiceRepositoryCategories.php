<?php
namespace Module\Categories\Services;

use Module\Categories\Model\Repository;

use Module\MongoDriver\Services\aServiceRepository;

/*
$categories = $services->fresh(
    '/module/categories/services/repository/categories'
    , ['mongo_collection' => 'trades.categories'] // override options
);
$r = $categories->getTree($categories->findByID('red'));
*/

class ServiceRepositoryCategories 
    extends aServiceRepository
{
    /** @var string Service Name */
    protected $name = 'categories';

    /**
     * Repository Class Name
     *   Module\Categories\Model\Repository\Categories
     *
     * @return string
     */
    function getRepoClassName()
    {
        return \Module\Categories\Model\Repository\Categories::class;
    }
}
