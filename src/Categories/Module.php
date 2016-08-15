<?php
namespace Module\Categories;

use Poirot\Application\ModuleManager\Interfaces\iModuleManager;
use Poirot\Ioc\Container;
use Poirot\Ioc\Container\BuildContainer;
use Poirot\Loader\Autoloader\LoaderAutoloadAggregate;
use Poirot\Loader\Autoloader\LoaderAutoloadNamespace;
use Poirot\Loader\Interfaces\iLoaderAutoload;
use Poirot\Std\Interfaces\Struct\iDataEntity;

use Poirot\Application\Interfaces\Sapi;
use Poirot\Application\Interfaces\Sapi\iSapiModule;

class Module implements iSapiModule
    , Sapi\Module\Feature\iFeatureModuleAutoload
    , Sapi\Module\Feature\iFeatureModuleInitModuleManager
    , Sapi\Module\Feature\iFeatureModuleMergeConfig
    , Sapi\Module\Feature\iFeatureModuleNestServices
{
    CONST CONF_KEY = 'module.categories';

    /**
     * Register class autoload on Autoload
     *
     * priority: 1000 B
     *
     * @param LoaderAutoloadAggregate $baseAutoloader
     *
     * @return iLoaderAutoload|array|\Traversable|void
     */
    function initAutoload(LoaderAutoloadAggregate $baseAutoloader)
    {
        #$nameSpaceLoader = \Poirot\Loader\Autoloader\LoaderAutoloadNamespace::class;
        $nameSpaceLoader = 'Poirot\Loader\Autoloader\LoaderAutoloadNamespace';
        /** @var LoaderAutoloadNamespace $nameSpaceLoader */
        $nameSpaceLoader = $baseAutoloader->by($nameSpaceLoader);
        $nameSpaceLoader->addResource(__NAMESPACE__, __DIR__);
        
    }

    /**
     * Initialize Module Manager
     *
     * priority: 1000 C
     *
     * @param iModuleManager $moduleManager
     *
     * @return void
     */
    function initModuleManager(iModuleManager $moduleManager)
    {
        if (!$moduleManager->hasLoaded('MongoDriver'))
            // MongoDriver Module Is Required.
            $moduleManager->loadModule('MongoDriver');
        
    }

    /**
     * Register config key/value
     *
     * priority: 1000 D
     *
     * - you may return an array or Traversable
     *   that would be merge with config current data
     *
     * @param iDataEntity $config
     *
     * @return array|\Traversable
     */
    function initConfig(iDataEntity $config)
    {
        return include __DIR__.'/../../config/module.conf.php';
    }

    /**
     * Get Nested Module Services
     *
     * priority not that serious
     *
     * @return array|BuildContainer|\Traversable
     */
    function getServices()
    {
        return include __DIR__.'/../../config/nest-services.conf.php';
    }
}
