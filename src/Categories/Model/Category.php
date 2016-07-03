<?php
namespace Module\Categories\Model;

use Module\MongoDriver\Model\aPersistable;

class Category extends aPersistable
{
    const ID     = '_id';
    const Title  = 'title';
    const Left   = '_left';
    const Right  = '_right';
    const Parent = '_parent';

    /** @var string @required */
    protected $title;


    /**
     * Set Category Name Title
     * @param string $title
     * @return $this
     */
    function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string
     */
    function getTitle()
    {
        return $this->title;
    }

    /**
     * Get Title Name Slugified
     * 
     * @return string
     */
    function getSlug()
    {
        return \Poirot\Std\slugify($this->getTitle());
    }
}
