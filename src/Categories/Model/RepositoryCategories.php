<?php
namespace Module\Categories\Model;

use \MongoDB;

use Module\Categories\Interfaces\iRepositoryCategories;

class RepositoryCategories
    implements iRepositoryCategories
{
    /** @var MongoDB\Database */
    protected $gateway;
    /** @var string Categories Collection Name */
    protected $collection;

    /** @var MongoDB\Collection */
    protected $_q;
    
    /**
     * RepositoryCategories constructor.
     * 
     * @param MongoDB\Database $mongoDb
     * @param string           $collectionName
     */
    function __construct(MongoDB\Database $mongoDb, $collectionName)
    {
        $this->setGateway($mongoDb);
        $this->setDbCollection($collectionName);
    }

    /**
     * Gets category tree
     *
     * @param null $root
     *
     * @return mixed
     */
    function getTree($root = null)
    {
        // TODO Implement feature
        $r = $this->_query()->find();
        kd($r->toArray());
    }
    
    
    // Options:

    /**
     * Set Data Gateway
     *
     * @param MongoDB\Database $mongoClient
     *
     * @return $this
     */
    function setGateway(MongoDB\Database $mongoClient)
    {
        // reset _query collection
        $this->_q = null;
        
        $this->gateway = $mongoClient;
        return $this;
    }

    /**
     * Set Db Categories Collection Name
     * 
     * @param string $collectionName
     * 
     * @return $this
     */
    function setDbCollection($collectionName)
    {
        // reset _query collection
        $this->_q = null;
        
        $this->collection = $collectionName;
        return $this;
    }
    
    
    // ..

    /**
     * prepared mongo client with options
     * - select db collection
     */
    protected function _query()
    {
        if ($this->_q)
            return $this->_q;
        
        $this->_q = $this->gateway;
        return $this->_q->selectCollection($this->collection);
    }
}
