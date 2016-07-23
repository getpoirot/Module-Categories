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
    const CONF_KEY = 'categories-repo';

    /** @var string Service Name */
    protected $name = 'categories';

    protected $default_collection = 'categories';

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

    /**
     * Get Key Of Merged Config To Retrieve Settings
     *  \Module\Categories\Module::CONF_KEY
     *
     * @return string
     */
    function getMergedConfKey()
    {
        return self::CONF_KEY;
    }
}
