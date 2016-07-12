<?php
return array(
    \Module\Categories\Module::CONF_KEY 
        => array(
            \Module\MongoDriver\Services\aServiceRepository::CONF_KEY => array(
                 'client' => \Module\MongoDriver\MongoDriverManagementFacade::CLIENT_DEFAULT,
                 'collection' => array(
                    'name'    => 'categories',
                    'indexes' => array()
                 )
            ),
        ),
);
