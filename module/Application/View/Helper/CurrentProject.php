<?php 

namespace Application\View\Helper;

use Zend\ServiceManager\ServiceLocatorInterface;
 
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\View\Helper\AbstractHelper;
 
class CurrentProject extends AbstractHelper implements ServiceLocatorAwareInterface {
 
private $serviceLocator;
 
 public function __invoke() {
 	if($this->serviceLocator->getServiceLocator()->get('Application')->getMvcEvent()->getRouteMatch()->getParam('project')){
   		$projectId = $this->serviceLocator->getServiceLocator()->get('Application')->getMvcEvent()->getRouteMatch()->getParam('project');
   		setcookie('ProjectId', $projectId, time()+(60*60*24*30), '/', '.pms.localhost');
	}else{
		if(isset($_COOKIE['ProjectId'])){
			$projectId =  $_COOKIE['ProjectId'];
		}else{
			$projectId =0;
		}
	}
   return $projectId;
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
}