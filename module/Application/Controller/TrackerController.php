<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Model\Domain\Tracker;
use Application\Form\TrackerForm;

class TrackerController extends AbstractActionController{
  
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
                        ->createQuery('SELECT u FROM Application\Model\Domain\Tracker u ORDER BY u.position ASC')
                        ->getResult();
     
     $i=1;
     foreach($rebuild_positions as $positions){

        $id = $positions->getId();
        $objectManager ->createQuery("UPDATE Application\Model\Domain\Tracker u SET u.position = $i  WHERE u.id=$id")
                            ->execute();    
        
             $i++;     
        }
   } 
    
   public function indexAction() {
    $objectManager = $this
        ->getServiceLocator()
        ->get('Doctrine\ORM\EntityManager');   
    
    $issuelist = $objectManager
                        ->createQuery('SELECT u FROM Application\Model\Domain\Tracker u ORDER BY u.position ASC')
                        ->getResult();
        
    foreach ($issuelist as $iss)
                     {   
                          if($iss->getIsDefault(true)){                            
                            $iss->setIsDefault('<i class="fa fa-check"></i>');
                          }
                          
                           if($iss->getIsActive(true)){                           
                            $iss->setIsActive('<i class="fa fa-check"></i>');
                          } 
                     }                     
     $view = new ViewModel(array('issuelist'=> $issuelist));
     $view->setTemplate('Tracker/index');
     $this->rebuild_positions();
     return $view;  
}   
 
    public function addAction() 
            {
        
       $objectManager = $this
        ->getServiceLocator()
        ->get('Doctrine\ORM\EntityManager');   
       
    $form = new TrackerForm();

     if ($this->getRequest()->isPost()) {
            $issue = new Tracker();
            $form->setInputFilter($issue->getInputFilter());
            $form->setData($this->getRequest()->getPost());

            if ($form->isValid()) {
                $data = $form->getData();          
   
                $issue->setName($data['name']);
                $issue->setDescription($data['description']); 
                $issue->setAssigned($data['Assigned'][0]); 
                $issue->setCategory($data['Category'][0]); 
                $issue->setParentIssue($data['ParentIssue'][0]); 
                $issue->setStartDate($data['StartDate'][0]); 
                $issue->setDueDate($data['DueDate'][0]); 
                $issue->setEstimateHours($data['EstimateHours'][0]); 
                $issue->setDoneRadio($data['DoneRadio'][0]); 
                $issue->setFiedVersion($data['FiedVersion'][0]); 
                if (isset($data['IsActive'])) 
                    { 
                     $issue->setIsActive($data['IsActive'][0]);                                                        
                    }
                    
                if (isset($data['IsDefault'])) 
                    { 
                         $issuelist = $objectManager
                        ->createQuery('SELECT u FROM Application\Model\Domain\Tracker u')
                        ->getResult();

                     foreach ($issuelist as $iss)
                     {
                          $iss->setIsDefault(false);                       
                          $this->getObjectManager()->merge($iss);
                     }  
                     $issue->setIsDefault($data['IsDefault'][0]);
                    }
              
                $query = $objectManager->createQuery('SELECT COUNT(u.id) FROM Application\Model\Domain\Tracker u');
                $count = $query->getSingleScalarResult();
             //   echo $count;     
                    
                $issue->setPosition($count+1);
                    
                $this->getObjectManager()->persist($issue);                             
                $this->getObjectManager()->flush();  
                $this->rebuild_positions();
                return $this->redirect()->toRoute('Tracker');
 
            }
      }
    
      
      $view = new ViewModel(array('form' => $form));
      $view->setTemplate('Tracker/add');
      return $view;
    }

 
    public function deleteAction()
    {
     $objectManager = $this
        ->getServiceLocator()
        ->get('Doctrine\ORM\EntityManager');   
    
  $id = (int) $this->params('id', null);
    if (null === $id) {
      return $this->redirect()->toRoute('Tracker');
    }

    $issuedelete = $objectManager->find('Application\Model\Domain\Tracker', $id);
 
    $objectManager->remove($issuedelete);
    $objectManager->flush();
    $this->rebuild_positions();
    return $this->redirect()->toRoute('Tracker');
   } 
    
   public function editAction()
  {
       
       $objectManager = $this
        ->getServiceLocator()
        ->get('Doctrine\ORM\EntityManager');  
       
       $id = (int) $this->params('id', null);
        if (null === $id) {
          return $this->redirect()->toRoute('Tracker');
        } 

      $issueedit = $objectManager->find('Application\Model\Domain\Tracker', $id); 
      
       $form = new TrackerForm(); 
      
        if ($this->getRequest()->isPost()) {
            
            $issue = new Tracker();
            $form->setInputFilter($issue->getInputFilter());
           $form->setData($this->getRequest()->getPost());
                         
            if ($form->isValid()) {
                $data = $form->getData();
                
                $issue->setName($data['name']);
                $issue->setAssigned($data['Assigned'][0]); 
                $issue->setCategory($data['Category'][0]); 
                $issue->setParentIssue($data['ParentIssue'][0]); 
                $issue->setStartDate($data['StartDate'][0]); 
                $issue->setDueDate($data['DueDate'][0]); 
                $issue->setEstimateHours($data['EstimateHours'][0]); 
                $issue->setDoneRadio($data['DoneRadio'][0]); 
                $issue->setFiedVersion($data['FiedVersion'][0]);     
                  if (isset($data['IsActive'])) 
                    { 
                        $issue->setIsActive($data['IsActive'][0]);
                                          
                    }
                 if (isset($data['IsDefault'])) 
                    { 
                     $issuelist = $objectManager
                        ->createQuery('SELECT u FROM Application\Model\Domain\Tracker u')
                        ->getResult();

                     foreach ($issuelist as $iss)
                     {
                          $iss->setIsDefault(false);                       
                           $this->getObjectManager()->merge($iss);
                     }  
                     $issue->setIsDefault($data['IsDefault'][0]);
       
                    }

                                       
                $issue->setId($id);
                $issue->setDescription($data['description']);
                $issue->setPosition($data['position']);
                $this->getObjectManager()->merge($issue);   
                $this->getObjectManager()->flush();   
                 $objectManager = $this
                 ->getServiceLocator()
                 ->get('Doctrine\ORM\EntityManager'); 
                 $this->rebuild_positions();
                return $this->redirect()->toRoute('Tracker');
            }
      }

      $view = new ViewModel(array('issueedit' => $issueedit, 'form2' => $form));
      $view->setTemplate('Tracker/edit');   
      return $view;
    }

     public function downAction()  {
     $objectManager = $this
        ->getServiceLocator()
        ->get('Doctrine\ORM\EntityManager');   
    
  $id = (int) $this->params('id', null);
    if (null === $id) {
      return $this->redirect()->toRoute('Tracker');
    }

    $issueposition = $objectManager->find('Application\Model\Domain\Tracker', $id);  
        $getposition = $issueposition->getPosition();
     
     $objectManager ->createQuery("UPDATE Application\Model\Domain\Tracker u SET u.position = $getposition  WHERE u.position=$getposition+1")
                            ->execute();              
     $objectManager ->createQuery("UPDATE Application\Model\Domain\Tracker u SET u.position = $getposition+1  WHERE u.id=$id")
                            ->execute();   
     $this->rebuild_positions();
     return $this->redirect()->toRoute('Tracker');
   } 
   
    public function upAction()   {
     $objectManager = $this
        ->getServiceLocator()
        ->get('Doctrine\ORM\EntityManager');   
    
    $id = (int) $this->params('id', null);
    if (null === $id) {
      return $this->redirect()->toRoute('Tracker');
    }

    $issueposition = $objectManager->find('Application\Model\Domain\Tracker', $id);  
    $getposition = $issueposition->getPosition();
     
     $objectManager ->createQuery("UPDATE Application\Model\Domain\Tracker u SET u.position = $getposition  WHERE u.position=$getposition-1")
                            ->execute();              
     $objectManager ->createQuery("UPDATE Application\Model\Domain\Tracker u SET u.position = $getposition-1  WHERE u.id=$id")
                            ->execute(); 
     $this->rebuild_positions();
     return $this->redirect()->toRoute('Tracker');
   } 
   
  } 

    
    
   
