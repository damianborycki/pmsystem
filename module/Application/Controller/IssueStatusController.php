<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Model\Domain\IssueStatus;
use Application\Form\IssueStatusForm;

class IssueStatusController extends AbstractActionController{
  
    protected $_objectManager;
    
    protected function getObjectManager() {
    if (!$this->_objectManager) {
        $this->_objectManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
    }
        return $this->_objectManager;
    }
    
  
 
    public function addAction() 
            {
        
       $objectManager = $this
        ->getServiceLocator()
        ->get('Doctrine\ORM\EntityManager');   
       
    echo $_SERVER['REQUEST_METHOD'];
    $form = new IssueStatusForm();

     if ($this->getRequest()->isPost()) {
            $issue = new IssueStatus();
            $form->setInputFilter($issue->getInputFilter());
            $form->setData($this->getRequest()->getPost());

            if ($form->isValid()) {
                $data = $form->getData();
                print_r($data);
                               
                
                $issue->setName($data['name']);
                if (isset($data['IsClosed'])) 
                    { $issue->setIsClosed($data['IsClosed'][0]);                                        
                    }
                    
                 if (isset($data['IsDefault'])) 
                    { 
                         $issuelist = $objectManager
                        ->createQuery('SELECT u FROM Application\Model\Domain\IssueStatus u')
                        ->getResult();

                     foreach ($issuelist as $iss)
                     {
                          $iss->setIsDefault(false);                       
                          $this->getObjectManager()->merge($iss);
                     }  
                     $issue->setIsDefault($data['IsDefault'][0]);
                    }
                
                $this->getObjectManager()->persist($issue);                             
                $this->getObjectManager()->flush();         
                return $this->redirect()->toRoute('IssueStatus');
            }
      }

      $view = new ViewModel(array('form' => $form));
      $view->setTemplate('IssueStatus/add');
      return $view;
    }

 
  
    
   public function editAction()
  {
       
       $objectManager = $this
        ->getServiceLocator()
        ->get('Doctrine\ORM\EntityManager');  
       
       $id = (int) $this->params('id', null);
        if (null === $id) {
          return $this->redirect()->toRoute('IssueStatus');
        } 

      $issueedit = $objectManager->find('Application\Model\Domain\IssueStatus', $id); 
      
       $form = new IssueStatusForm(); 
      
        if ($this->getRequest()->isPost()) {
            
            $issue = new IssueStatus();
            $form->setInputFilter($issue->getInputFilter());
           $form->setData($this->getRequest()->getPost());
                         
            if ($form->isValid()) {
                $data = $form->getData();
                print_r($data);
                
                $issue->setName($data['name']);
                 if (isset($data['IsClosed'])) 
                    { 
                        $issue->setIsClosed($data['IsClosed'][0]);
                                          
                    }
                 if (isset($data['IsDefault'])) 
                    { 
                     $issuelist = $objectManager
                        ->createQuery('SELECT u FROM Application\Model\Domain\IssueStatus u')
                        ->getResult();

                     foreach ($issuelist as $iss)
                     {
                          $iss->setIsDefault(false);                       
                           $this->getObjectManager()->merge($iss);
                     }  
                     $issue->setIsDefault($data['IsDefault'][0]);
       
                    }
                    
                    // gdzie ten kod ktory wyciaga ci wszyskie rkordy
                    
                    
                $issue->setId($id);
            
                // !!!!!!
                $this->getObjectManager()->merge($issue);   
                // !!!!!
                
                $this->getObjectManager()->flush();        
                
                return $this->redirect()->toRoute('IssueStatus');
            }
      }

      $view = new ViewModel(array('issueedit' => $issueedit, 'form2' => $form));
      $view->setTemplate('IssueStatus/edit');
      return $view;
    }
    
       
       
   
    
  
    
   
   
    
  } 

    
    
   
