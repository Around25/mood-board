<?php

namespace Application\Service;

use Exception;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\ServiceManager\ServiceLocatorAwareInterface;

abstract class AbstractService implements ServiceLocatorAwareInterface {

    const OBJECT_NOT_FOUND_EXCEPTION_TEXT = 'Object not found!';
    /**
     * @var \Zend\ServiceManager\ServiceLocatorInterface
     */
    protected $serviceLocator = null;

    /**
     * Set service locator
     *
     * @param ServiceLocatorInterface $serviceLocator
     */
    public function setServiceLocator(ServiceLocatorInterface $serviceLocator) {
        $this->serviceLocator = $serviceLocator;
    }

    /**
     * Get service locator
     *
     * @return ServiceLocatorInterface
     */
    public function getServiceLocator() {
        return $this->serviceLocator;
    }

    /**
     * @param string $service
     * @return object Service
     */
    public function getService($service)
    {
        return $this->getServiceLocator()->get($service);
    }

    /**
     * Throws exception if an object doesn't exist
     *  - else, returns object - used in operations, get object
     * @param $object
     * @return $object
     * @throws \Exception
     */
    public function checkObject($object)
    {
        if(!$object){
            throw new Exception(self::OBJECT_NOT_FOUND_EXCEPTION_TEXT);
        }

        return $object;
    }

    /**
     * @return \Doctrine\ORM\EntityManager
     */
    public function getEntityManager()
    {
        return $this->getServiceLocator()
            ->get('Doctrine\ORM\EntityManager');
    }

    /**
     * persists an entity
     *
     * @param $entity
     * @param bool $flush
     * @return bool
     */
    public function save($entity, $flush = true)
    {
        $this->getEntityManager()->persist($entity);
        if($flush){
            return $this->flush();
        }

        return true;
    }

    /**
     * removes an entity
     *
     * @param $entity
     * @param bool $flush
     * @return bool
     */
    public function remove($entity, $flush = true)
    {
        $this->getEntityManager()->remove($entity);
        if($flush){
            return $this->flush();
        }

        return true;
    }

    /**
     * flush entity manager
     *
     * @return bool
     */
    public function flush()
    {
        $this->getEntityManager()->flush();
        return true;
    }

    /**
     * @param string $name
     * @return \Doctrine\ORM\EntityRepository
     */
    public function getRepository($name) {

        return $this->getEntityManager()
            ->getRepository($name);
    }

    public function beginTransaction(){
        $this->getEntityManager()->beginTransaction();
    }

    public function commit(){
        $this->getEntityManager()->commit();
    }

    public function rollback(){
        $this->getEntityManager()->rollback();
    }
}