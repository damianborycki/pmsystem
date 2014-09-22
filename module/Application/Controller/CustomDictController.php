<?php
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Model\Domain\CustomDictionary;
use Application\Form\CustomDictForm;


class CustomDictController extends AbstractActionController
{

	protected $_objectManager;
    
    protected function getObjectManager() {
    	if (!$this->_objectManager) {
        	$this->_objectManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
    	}
        return $this->_objectManager;
    }

    public function indexAction() {	
		$objectManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
    
    	$issuelist = $objectManager->createQuery('SELECT u FROM Application\Model\Domain\CustomDictionary u')->getResult();
        
    	foreach ($issuelist as $iss) {
        	if($iss->getIsDefault(true)){                            
            	$iss->setIsDefault('<i class="fa fa-check"></i>');
            }
                          
            if($iss->getIsActive(true)){                           
                $iss->setIsActive('<i class="fa fa-check"></i>');
            }                         
        } 
                     
     	$view = new ViewModel(array('issuelist'=> $issuelist));
     	$view->setTemplate('CustomDict/index');
     	return $view;
    }
}