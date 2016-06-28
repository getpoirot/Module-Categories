<?php
return array(
    \Module\Categories\Module::CONF_KEY 
        => array(
            'mongo_client'  => \Module\MongoDriver\MongoDriverManagementFacade::CLIENT_DEFAULT,
            'db_collection' => 'categories',
        ),
);
