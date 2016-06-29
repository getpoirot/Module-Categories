<?php
namespace Module\Categories\Model;

use Module\MongoDriver\Model\aPersistable;

class Category extends aPersistable
{
    protected $properties = array(
        '_id'      => null,
        'title'    => null,
        'parent'   => 0,
        'left'     => null,
        'right'    => null,
    );
    
}
