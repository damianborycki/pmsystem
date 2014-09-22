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
		$objectManager = $this->getObjectManager();
    
    	$issuelist = $objectManager->createQuery('SELECT u FROM Application\Model\Domain\CustomDictionary u ORDER BY u.position ASC')->getResult();
        
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

    public function deleteAction() {
     	$objectManager = $this->getObjectManager();
    
  		$id = (int) $this->params('id', null);
    	if (null === $id) {
      		return $this->redirect()->toRoute('CustomDict');
    	}

    	$issuedelete = $objectManager->find('Application\Model\Domain\CustomDictionary', $id);
 
    	$objectManager->remove($issuedelete);
   		$objectManager->flush();
    
    	return $this->redirect()->toRoute('CustomDict');
   	}

    public function upAction() {
    	$objectManager = $this->getObjectManager();

    	$id = (int) $this->params('id', null);
        if (null === $id) {
        	return $this->redirect()->toRoute('CustomDict');
        } 

    	return $this->redirect()->toRoute('CustomDict');
    }

    public function downAction() {
    	$objectManager = $this->getObjectManager();

    	$id = (int) $this->params('id', null);
        if (null === $id) {
        	return $this->redirect()->toRoute('CustomDict');
        }



    	return $this->redirect()->toRoute('CustomDict');
    } 
}