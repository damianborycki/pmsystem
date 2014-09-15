<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Model\Domain\IssueCategory;
use Application\Form\IssueCategoryForm;
use Application\Model\Domain\IssuePriority;
use Application\Form\IssuePriorityForm;
use Application\Model\Domain\IssueActivity;
use Application\Form\IssueActivityForm;

class EnumerationController extends AbstractActionController{
  
    protected $_objectManager;
    
    protected function getObjectManager() {
    if (!$this->_objectManager) {
        $this->_objectManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
    }
        return $this->_objectManager;
    }
    
    public function indexAction() {
    $objectManager = $this
        ->getServiceLocator()
        ->get('Doctrine\ORM\EntityManager');
    
    $issuelist = $objectManager
                        ->createQuery('SELECT u FROM Application\Model\Domain\IssueCategory u')
                        ->getResult();
    
    
    //var_dump($issuelist);
    
    foreach ($issuelist as $iss)
                     {
                          if($iss->getIsDefault(true)){                            
                            $iss->setIsDefault('<i class="fa fa-check"></i>');
                          }
                          
                          if($iss->getIsActive(true)){                           
                            $iss->setIsActive('<i class="fa fa-check"></i>');
                          }                         
                     } 
                     
                     
     $issuepriority = $objectManager
                        ->createQuery('SELECT u FROM Application\Model\Domain\IssuePriority u')
                        ->getResult();
    
    
    //var_dump($issuelist);
    
    foreach ($issuepriority as $iss)
                     {
                          if($iss->getIsDefault(true)){                            
                            $iss->setIsDefault('<i class="fa fa-check"></i>');
                          }
                          
                          if($iss->getIsActive(true)){                           
                            $iss->setIsActive('<i class="fa fa-check"></i>');
                          }                         
                     } 
                     
     $issueactivity = $objectManager
                        ->createQuery('SELECT u FROM Application\Model\Domain\IssueActivity u')
                        ->getResult();
    
    
    //var_dump($issuelist);
    
    foreach ($issueactivity as $iss)
                     {
                          if($iss->getIsDefault(true)){                            
                            $iss->setIsDefault('<i class="fa fa-check"></i>');
                          }
                          
                          if($iss->getIsActive(true)){                           
                            $iss->setIsActive('<i class="fa fa-check"></i>');
                          }                         
                     } 
                     
                                
                     
     $view = new ViewModel(array('issuelist'=> $issuelist,'issuepriority'=>$issuepriority, 'issueactivity'=>$issueactivity ));
     $view->setTemplate('Enumeration/index');
     return $view;
}   
 
// category

  
    
    
  
    
   
   
    
  } 

    
    
   
