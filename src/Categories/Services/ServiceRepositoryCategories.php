<?php
namespace Module\Categories\Services;

use Module\Categories\Model\RepositoryCategories;

use Module\MongoDriver\MongoDriverManagementFacade;

use Poirot\Application\aSapi;
use Poirot\Ioc\Container\Service\aServiceContainer;
use Poirot\Std\Struct\DataEntity;

class ServiceRepositoryCategories 
    extends aServiceContainer
{
    /** @var string Service Name */
    protected $name = 'categories';
    
    /**
     * Create Service
     *
     * @return mixed
     */
    function newService()
    {
        $services    = $this->services();
        
        /** @var aSapi $config */
        $config       = $services->get('/sapi');
        $config       = $config->config();
        /** @var DataEntity $config */
        $config       = $config->get(\Module\Categories\Module::CONF_KEY, array());
        
        $mongoClient     = (isset($config['mongo_client'])) ? $config['mongo_client'] 
            : MongoDriverManagementFacade::CLIENT_DEFAULT; 
        
        $mongoCollection = (isset($config['db_collection'])) ? $config['db_collection']
            : 'categories';

        /** @var MongoDriverManagementFacade $mongoDriver */
        $mongoDriver   = $services->get('/modules/mongoDriver');
        $db            = $mongoDriver->query($mongoClient);
        $categoriesRepo = new RepositoryCategories($db, $mongoCollection);
        return $categoriesRepo;
    }
}
