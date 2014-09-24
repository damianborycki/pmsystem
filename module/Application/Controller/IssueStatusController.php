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
    
    
     public function rebuild_positions(){
       $objectManager = $this
        ->getServiceLocator()
        ->get('Doctrine\ORM\EntityManager'); 
        $rebuild_positions = $objectManager
                        ->createQuery('SELECT u FROM Application\Model\Domain\IssueStatus u ORDER BY u.position ASC')
                        ->getResult();
     
     $i=1;
     foreach($rebuild_positions as $positions){

        $id = $positions->getId();
        $objectManager ->createQuery("UPDATE Application\Model\Domain\IssueStatus u SET u.position = $i  WHERE u.id=$id")
                            ->execute();    
        
             $i++;     
        }
   } 
    
    
     public function indexAction() {
    $objectManager = $this
        ->getServiceLocator()
        ->get('Doctrine\ORM\EntityManager');
    
     $issuelist = $objectManager
                        ->createQuery('SELECT u FROM Application\Model\Domain\IssueStatus u ORDER BY u.position ASC')
                        ->getResult();
        
    foreach ($issuelist as $iss)
                     {
                          if($iss->getIsDefault(true)){                            
                            $iss->setIsDefault('<i class="fa fa-check"></i>');
                          }
                          
                          if($iss->getIsClosed(true)){                           
                            $iss->setIsClosed('<i class="fa fa-check"></i>');
                          }   
                          
                          if($iss->getIsActive(true)){                           
                            $iss->setIsActive('<i class="fa fa-check"></i>');
                          } 
                     } 
                     
                                
                     
     $view = new ViewModel(array('issuelist'=> $issuelist));
     $view->setTemplate('IssueStatus/index');
     $this->rebuild_positions();
     return $view;
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
                $issue->setDescription($data['description']);
                if (isset($data['IsClosed'])) 
                    { $issue->setIsClosed($data['IsClosed'][0]);                                        
                    }
                if (isset($data['IsActive'])) 
                    { 
                     $issue->setIsActive($data['IsActive'][0]);                                                        
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
                    
                $query = $objectManager->createQuery('SELECT COUNT(u.id) FROM Application\Model\Domain\IssueStatus u');
                $count = $query->getSingleScalarResult();     
                $issue->setPosition($count+1);
                
                 if((isset($data['IsClosed'])) and (isset($data['IsActive']))){
                   
                    $ex = 'visible';
                    
                    $view = new ViewModel(array('form' => $form, 'ex' => $ex));
                    $view->setTemplate('IssueStatus/add');
                    return $view;
                }
                
                $this->getObjectManager()->persist($issue);                             
                $this->getObjectManager()->flush();     
                $this->rebuild_positions();
                return $this->redirect()->toRoute('IssueStatus');
            }
      }

      $ex = 'hidden';
      
      $view = new ViewModel(array('form' => $form, 'ex' => $ex));
      $view->setTemplate('IssueStatus/add');
      return $view;
    }


  public function deleteAction()
    {
     $objectManager = $this
        ->getServiceLocator()
        ->get('Doctrine\ORM\EntityManager');   
    
  $id = (int) $this->params('id', null);
    if (null === $id) {
      return $this->redirect()->toRoute('IssueStatus');
    }

    $issuedelete = $objectManager->find('Application\Model\Domain\IssueStatus', $id);
 
    $objectManager->remove($issuedelete);
    $objectManager->flush();
     $this->rebuild_positions();
    return $this->redirect()->toRoute('IssueStatus');
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
                 if (isset($data['IsActive'])) 
                    { 
                        $issue->setIsActive($data['IsActive'][0]);                                         
                    }
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
                    
                 if((isset($data['IsClosed'])) and (isset($data['IsActive']))){
                   
                    $ex = 'visible';
                    
                    $view = new ViewModel(array('issueedit' => $issueedit,'form2' => $form, 'ex' => $ex));
                    $view->setTemplate('IssueStatus/edit');
                    return $view;
                }    
                    
                $issue->setPosition($data['position']);    
                $issue->setDescription($data['description']);
                $issue->setId($id);
              
                
                $this->getObjectManager()->merge($issue);   
                
                
                $this->getObjectManager()->flush();        
                $this->rebuild_positions();
                return $this->redirect()->toRoute('IssueStatus');
            }
      }

      $ex = 'hidden';
      
      $view = new ViewModel(array('issueedit' => $issueedit, 'form2' => $form, 'ex'=>$ex));
      $view->setTemplate('IssueStatus/edit');
      return $view;
    }
    
    public function downAction()  {
     $objectManager = $this
        ->getServiceLocator()
        ->get('Doctrine\ORM\EntityManager');   
    
  $id = (int) $this->params('id', null);
    if (null === $id) {
      return $this->redirect()->toRoute('IssueStatus');
    }

    $issueposition = $objectManager->find('Application\Model\Domain\IssueStatus', $id);  
        $getposition = $issueposition->getPosition();
     
     $objectManager ->createQuery("UPDATE Application\Model\Domain\IssueStatus u SET u.position = $getposition  WHERE u.position=$getposition+1")
                            ->execute();              
     $objectManager ->createQuery("UPDATE Application\Model\Domain\IssueStatus u SET u.position = $getposition+1  WHERE u.id=$id")
                            ->execute();   
     $this->rebuild_positions();
     return $this->redirect()->toRoute('IssueStatus');
   } 
   
    public function upAction()   {
     $objectManager = $this
        ->getServiceLocator()
        ->get('Doctrine\ORM\EntityManager');   
    
    $id = (int) $this->params('id', null);
    if (null === $id) {
      return $this->redirect()->toRoute('IssueStatus');
    }

    $issueposition = $objectManager->find('Application\Model\Domain\IssueStatus', $id);  
    $getposition = $issueposition->getPosition();
     
     $objectManager ->createQuery("UPDATE Application\Model\Domain\IssueStatus u SET u.position = $getposition  WHERE u.position=$getposition-1")
                            ->execute();              
     $objectManager ->createQuery("UPDATE Application\Model\Domain\IssueStatus u SET u.position = $getposition-1  WHERE u.id=$id")
                            ->execute(); 
     $this->rebuild_positions();
     return $this->redirect()->toRoute('IssueStatus');
   }    

    
  } 

    
    
   
