<?php

namespace Application\View\Helper;

use Application\Model\Domain\Project;
use Zend\ServiceManager\ServiceLocatorInterface;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\View\Helper\AbstractHelper;


class CurrentProjectName extends AbstractHelper implements ServiceLocatorAwareInterface {

private $serviceLocator;
protected $_objectManager;

public function __invoke() {
  if($this->serviceLocator->getServiceLocator()->get('Application')->getMvcEvent()->getRouteMatch()->getParam('project')){
  		$projectId = $this->serviceLocator->getServiceLocator()->get('Application')->getMvcEvent()->getRouteMatch()->getParam('project');
  }else{
  if(isset($_COOKIE['ProjectId'])){
  	$projectId =  $_COOKIE['ProjectId'];
  }else{
  	$projectId = 0;
  }
  }
  $project = $this->getObjectManager()->getRepository('\Application\Model\Domain\Project')->find($projectId);
  return $project->getName();
 }

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

    protected function getObjectManager() {
        if (!$this->_objectManager) {
            $this->_objectManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        }

        return $this->_objectManager;
    }
}