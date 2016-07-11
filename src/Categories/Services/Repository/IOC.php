<?php
namespace Module\Categories\Services\Repository;

use Module\Categories\Model\Repository\Categories;

/**
 * Usage:
 *   to ease access to IoC nested containers
 *   Module\Categories\Services\Repository\IOC::categories()
 * 
 * @method static Categories categories(array $options=null)
 * @see \Module\Categories\Services\ServiceRepositoryCategories
 */
class IOC extends \IOC
{ }
