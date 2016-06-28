<?php
/** @see \Poirot\Ioc\Container\BuildContainer */
return array(
    'nested' 
        => array(
            'repository' => array(
                'services' => array(
                    # Module\Categories\Services\ServiceRepositoryCategories::class,
                    '\Module\Categories\Services\ServiceRepositoryCategories',  // Categories repository
                ),
            ),
        ),
);
