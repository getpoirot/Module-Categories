<?php
return array(
    Module\MongoDriver\Module::CONF_KEY => array(
        \Module\Categories\Services\ServiceRepositoryCategories::CONF_KEY => array(
            'collections' => array(
                // query on which collection
                'categories' => array(
                    // which client to connect and query with
                    'client' => \Module\MongoDriver\MongoDriverManagementFacade::CLIENT_DEFAULT,
                    // ensure indexes
                    'indexes' => array( )
                ),
            ),
        ),
    ),
);
