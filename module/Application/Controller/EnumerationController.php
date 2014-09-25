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
    
    public function rebuild_positions_category(){
       $objectManager = $this
        ->getServiceLocator()
        ->get('Doctrine\ORM\EntityManager'); 
        $rebuild_positions = $objectManager
                        ->createQuery('SELECT u FROM Application\Model\Domain\IssueCategory u ORDER BY u.position ASC')
                        ->getResult();
     
     $i=1;
     foreach($rebuild_positions as $positions){

        $id = $positions->getId();
        $objectManager ->createQuery("UPDATE Application\Model\Domain\IssueCategory u SET u.position = $i  WHERE u.id=$id")
                            ->execute();    
        
             $i++;     
        }
   } 
   
    public function rebuild_positions_priority(){
       $objectManager = $this
        ->getServiceLocator()
        ->get('Doctrine\ORM\EntityManager'); 
        $rebuild_positions = $objectManager
                        ->createQuery('SELECT u FROM Application\Model\Domain\IssuePriority u ORDER BY u.position ASC')
                        ->getResult();
     
     $i=1;
     foreach($rebuild_positions as $positions){

        $id = $positions->getId();
        $objectManager ->createQuery("UPDATE Application\Model\Domain\IssuePriority  u SET u.position = $i  WHERE u.id=$id")
                            ->execute();    
        
             $i++;     
        }
   } 
    
    public function rebuild_positions_activity(){
       $objectManager = $this
        ->getServiceLocator()
        ->get('Doctrine\ORM\EntityManager'); 
        $rebuild_positions = $objectManager
                        ->createQuery('SELECT u FROM Application\Model\Domain\IssueActivity u ORDER BY u.position ASC')
                        ->getResult();
     
     $i=1;
     foreach($rebuild_positions as $positions){

        $id = $positions->getId();
        $objectManager ->createQuery("UPDATE Application\Model\Domain\IssueActivity u SET u.position = $i  WHERE u.id=$id")
                            ->execute();    
        
             $i++;     
        }
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
     $this->rebuild_positions_category();
     $this->rebuild_positions_priority();
     $this->rebuild_positions_activity();
     return $view;
}   
 
// category
 public function addcategoryAction() 
     {
        
       $objectManager = $this
        ->getServiceLocator()
        ->get('Doctrine\ORM\EntityManager');   
       
    echo $_SERVER['REQUEST_METHOD'];
    $form = new IssueCategoryForm();

     if ($this->getRequest()->isPost()) {
            $issue = new IssueCategory();
            $form->setInputFilter($issue->getInputFilter());
            $form->setData($this->getRequest()->getPost());

            if ($form->isValid()) {
                $data = $form->getData();
                print_r($data);
                               
                
                $issue->setName($data['name']);
                $issue->setDescription($data['description']);
                if (isset($data['IsActive'])) 
                    { $issue->setIsActive($data['IsActive'][0]);                                        
                    }
                    
                 if (isset($data['IsDefault'])) 
                    { 
                         $issuelist = $objectManager
                        ->createQuery('SELECT u FROM Application\Model\Domain\IssueCategory u')
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
                
                $this->getObjectManager()->persist($issue);                             
                $this->getObjectManager()->flush();   
                $this->rebuild_positions_category();
                return $this->redirect()->toRoute('IssueCategory');
            }
      }

      $view = new ViewModel(array('form' => $form));
      $view->setTemplate('Enumeration/add');
      return $view;
    }

    public function deletecategoryAction()
     {
     $objectManager = $this
        ->getServiceLocator()
        ->get('Doctrine\ORM\EntityManager');   
    
    $id = (int) $this->params('id', null);
     if (null === $id) {
      return $this->redirect()->toRoute('IssueCategory');
    }

    $issuedelete = $objectManager->find('Application\Model\Domain\IssueCategory', $id);
 
    $objectManager->remove($issuedelete);
    $objectManager->flush();
    
    return $this->redirect()->toRoute('IssueCategory');
   } 
    
    public function editcategoryAction()
     {
       
       $objectManager = $this
        ->getServiceLocator()
        ->get('Doctrine\ORM\EntityManager');  
       
       $id = (int) $this->params('id', null);
        if (null === $id) {
          return $this->redirect()->toRoute('IssueCategory');
        } 

      $issueedit = $objectManager->find('Application\Model\Domain\IssueCategory', $id); 
      
       $form = new IssueCategoryForm(); 
      
        if ($this->getRequest()->isPost()) {
            
            $issue = new IssueCategory();
            $form->setInputFilter($issue->getInputFilter());
           $form->setData($this->getRequest()->getPost());
                         
            if ($form->isValid()) {
                $data = $form->getData();
                print_r($data);
                
                $issue->setName($data['name']);
                $issue->setDescription($data['description']);
                $issue->setPosition($data['position']); 
                 if (isset($data['IsActive'])) 
                    { 
                        $issue->setIsActive($data['IsActive'][0]);
                                          
                    }
                 if (isset($data['IsDefault'])) 
                    { 
                     $issuelist = $objectManager
                        ->createQuery('SELECT u FROM Application\Model\Domain\IssueCategory u')
                        ->getResult();

                     foreach ($issuelist as $iss)
                     {
                          $iss->setIsDefault(false);                       
                           $this->getObjectManager()->merge($iss);
                     }  
                     $issue->setIsDefault($data['IsDefault'][0]);
       
                    }
   
                    
                    
                $issue->setId($id);
                $this->getObjectManager()->merge($issue);                  
                $this->getObjectManager()->flush();        
                $this->rebuild_positions_category();
                return $this->redirect()->toRoute('IssueCategory');
            }
      }

      $view = new ViewModel(array('issueedit' => $issueedit, 'form2' => $form));
      $view->setTemplate('Enumeration/edit');
      return $view;
    }
    
  //   priority
    
    public function addpriorityAction() 
     {
        
       $objectManager = $this
        ->getServiceLocator()
        ->get('Doctrine\ORM\EntityManager');   
       
    echo $_SERVER['REQUEST_METHOD'];
    $form = new IssuePriorityForm();

     if ($this->getRequest()->isPost()) {
            $issue = new IssuePriority();
            $form->setInputFilter($issue->getInputFilter());
            $form->setData($this->getRequest()->getPost());

            if ($form->isValid()) {
                $data = $form->getData();
                print_r($data);
                               
                
                $issue->setName($data['name']);
                $issue->setDescription($data['description']);
                if (isset($data['IsActive'])) 
                    { $issue->setIsActive($data['IsActive'][0]);                                        
                    }
                    
                 if (isset($data['IsDefault'])) 
                    { 
                         $issuelist = $objectManager
                        ->createQuery('SELECT u FROM Application\Model\Domain\IssuePriority u')
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
                $this->rebuild_positions_priority();
                return $this->redirect()->toRoute('IssueCategory');
            }
      }

      $view = new ViewModel(array('form' => $form));
      $view->setTemplate('Enumeration/add_priority');
      return $view;
    }
    
    public function deletepriorityAction()
     {
     $objectManager = $this
        ->getServiceLocator()
        ->get('Doctrine\ORM\EntityManager');   
    
    $id = (int) $this->params('id', null);
     if (null === $id) {
      return $this->redirect()->toRoute('IssueCategory');
    }

    $issuedelete = $objectManager->find('Application\Model\Domain\IssuePriority', $id);
 
    $objectManager->remove($issuedelete);
    $objectManager->flush();
    
    return $this->redirect()->toRoute('IssueCategory');
   } 
   
    public function editpriorityAction()
     {
       
       $objectManager = $this
        ->getServiceLocator()
        ->get('Doctrine\ORM\EntityManager');  
       
       $id = (int) $this->params('id', null);
        if (null === $id) {
          return $this->redirect()->toRoute('IssueCategory');
        } 

      $issueedit = $objectManager->find('Application\Model\Domain\IssuePriority', $id); 
      
       $form = new IssuePriorityForm(); 
      
        if ($this->getRequest()->isPost()) {
            
            $issue = new IssuePriority();
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
                 if (isset($data['IsDefault'])) 
                    { 
                     $issuelist = $objectManager
                        ->createQuery('SELECT u FROM Application\Model\Domain\IssuePriority u')
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
                $this->rebuild_positions_priority();
                return $this->redirect()->toRoute('IssueCategory');
            }
      }

      $view = new ViewModel(array('issueedit' => $issueedit, 'form2' => $form));
      $view->setTemplate('Enumeration/edit_priority');
      return $view;
    }
    

   
  // activity
    
    public function addactivityAction() 
     {
        
       $objectManager = $this
        ->getServiceLocator()
        ->get('Doctrine\ORM\EntityManager');   
       
    echo $_SERVER['REQUEST_METHOD'];
    $form = new IssueActivityForm();

     if ($this->getRequest()->isPost()) {
            $issue = new IssueActivity();
            $form->setInputFilter($issue->getInputFilter());
            $form->setData($this->getRequest()->getPost());

            if ($form->isValid()) {
                $data = $form->getData();
                print_r($data);
                               
                
                $issue->setName($data['name']);
                $issue->setDescription($data['description']);
                if (isset($data['IsActive'])) 
                    { $issue->setIsActive($data['IsActive'][0]);                                        
                    }
                    
                 if (isset($data['IsDefault'])) 
                    { 
                         $issuelist = $objectManager
                        ->createQuery('SELECT u FROM Application\Model\Domain\IssueActivity u')
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
                $this->getObjectManager()->persist($issue);                             
                $this->getObjectManager()->flush();   
                $this->rebuild_positions_activity();
                return $this->redirect()->toRoute('IssueCategory');
            }
      }


      $view = new ViewModel(array('form' => $form));
      $view->setTemplate('Enumeration/add_activity');
      return $view;
    }
    
    public function deleteactivityAction()
     {
     $objectManager = $this
        ->getServiceLocator()
        ->get('Doctrine\ORM\EntityManager');   
    
    $id = (int) $this->params('id', null);
     if (null === $id) {
      return $this->redirect()->toRoute('IssueCategory');
    }

    $issuedelete = $objectManager->find('Application\Model\Domain\IssueActivity', $id);
 
    $objectManager->remove($issuedelete);
    $objectManager->flush();
    
    return $this->redirect()->toRoute('IssueCategory');
   } 
   
    public function editactivityAction()
     {
       
       $objectManager = $this
        ->getServiceLocator()
        ->get('Doctrine\ORM\EntityManager');  
       
       $id = (int) $this->params('id', null);
        if (null === $id) {
          return $this->redirect()->toRoute('IssueCategory');
        } 

      $issueedit = $objectManager->find('Application\Model\Domain\IssueActivity', $id); 
      
       $form = new IssueActivityForm(); 
      
        if ($this->getRequest()->isPost()) {
            
            $issue = new IssueActivity();
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
                 if (isset($data['IsDefault'])) 
                    { 
                     $issuelist = $objectManager
                        ->createQuery('SELECT u FROM Application\Model\Domain\IssueActivity u')
                        ->getResult();

                     foreach ($issuelist as $iss)
                     {
                          $iss->setIsDefault(false);                       
                           $this->getObjectManager()->merge($iss);
                     }  
                     $issue->setIsDefault($data['IsDefault'][0]);
       
                    }
   
                    
                $issue->setDescription($data['description']);
                $issue->setPosition($data['position']);     
                $issue->setId($id);
                $this->getObjectManager()->merge($issue);                  
                $this->getObjectManager()->flush();        
                
                return $this->redirect()->toRoute('IssueCategory');
            }
      }

      $view = new ViewModel(array('issueedit' => $issueedit, 'form2' => $form));
      $view->setTemplate('Enumeration/edit_activity');
      return $view;
    }
    
    //up, down
    
    public function downcategoryAction()  {
     $objectManager = $this
        ->getServiceLocator()
        ->get('Doctrine\ORM\EntityManager');   
    
  $id = (int) $this->params('id', null);
    if (null === $id) {
      return $this->redirect()->toRoute('IssueCategory');
    }

    $issueposition = $objectManager->find('Application\Model\Domain\IssueCategory', $id);  
        $getposition = $issueposition->getPosition();
     
     $objectManager ->createQuery("UPDATE Application\Model\Domain\IssueCategory u SET u.position = $getposition  WHERE u.position=$getposition+1")
                            ->execute();              
     $objectManager ->createQuery("UPDATE Application\Model\Domain\IssueCategory u SET u.position = $getposition+1  WHERE u.id=$id")
                            ->execute();   
     $this->rebuild_positions_category();
     return $this->redirect()->toRoute('IssueCategory');
   } 
   
    public function upcategoryAction()   {
     $objectManager = $this
        ->getServiceLocator()
        ->get('Doctrine\ORM\EntityManager');   
    
    $id = (int) $this->params('id', null);
    if (null === $id) {
      return $this->redirect()->toRoute('IssueCategory');
    }

    $issueposition = $objectManager->find('Application\Model\Domain\IssueCategory', $id);  
    $getposition = $issueposition->getPosition();
     
     $objectManager ->createQuery("UPDATE Application\Model\Domain\IssueCategory u SET u.position = $getposition  WHERE u.position=$getposition-1")
                            ->execute();              
     $objectManager ->createQuery("UPDATE Application\Model\Domain\IssueCategory u SET u.position = $getposition-1  WHERE u.id=$id")
                            ->execute(); 
     $this->rebuild_positions_category();
     return $this->redirect()->toRoute('IssueCategory');
   } 
   
    public function downpriorityAction()  {
     $objectManager = $this
        ->getServiceLocator()
        ->get('Doctrine\ORM\EntityManager');   
    
  $id = (int) $this->params('id', null);
    if (null === $id) {
      return $this->redirect()->toRoute('IssueCategory');
    }

    $issueposition = $objectManager->find('Application\Model\Domain\IssuePriority', $id);  
        $getposition = $issueposition->getPosition();
     
     $objectManager ->createQuery("UPDATE Application\Model\Domain\IssuePriority u SET u.position = $getposition  WHERE u.position=$getposition+1")
                            ->execute();              
     $objectManager ->createQuery("UPDATE Application\Model\Domain\IssuePriority u SET u.position = $getposition+1  WHERE u.id=$id")
                            ->execute();   
     $this->rebuild_positions_category();
     return $this->redirect()->toRoute('IssuePriority');
   } 
   
    public function uppriorityAction()   {
     $objectManager = $this
        ->getServiceLocator()
        ->get('Doctrine\ORM\EntityManager');   
    
    $id = (int) $this->params('id', null);
    if (null === $id) {
      return $this->redirect()->toRoute('IssueCategory');
    }

    $issueposition = $objectManager->find('Application\Model\Domain\IssuePriority', $id);  
    $getposition = $issueposition->getPosition();
     
     $objectManager ->createQuery("UPDATE Application\Model\Domain\IssuePriority u SET u.position = $getposition  WHERE u.position=$getposition-1")
                            ->execute();              
     $objectManager ->createQuery("UPDATE Application\Model\Domain\IssuePriority u SET u.position = $getposition-1  WHERE u.id=$id")
                            ->execute(); 
     $this->rebuild_positions_category();
     return $this->redirect()->toRoute('IssueCategory');
   } 
   
    public function downactivityAction()  {
     $objectManager = $this
        ->getServiceLocator()
        ->get('Doctrine\ORM\EntityManager');   
    
  $id = (int) $this->params('id', null);
    if (null === $id) {
      return $this->redirect()->toRoute('IssueCategory');
    }

    $issueposition = $objectManager->find('Application\Model\Domain\IssueActivity', $id);  
        $getposition = $issueposition->getPosition();
     
     $objectManager ->createQuery("UPDATE Application\Model\Domain\IssueActivity u SET u.position = $getposition  WHERE u.position=$getposition+1")
                            ->execute();              
     $objectManager ->createQuery("UPDATE Application\Model\Domain\IssueActivity u SET u.position = $getposition+1  WHERE u.id=$id")
                            ->execute();   
     $this->rebuild_positions_category();
     return $this->redirect()->toRoute('IssuePriority');
   } 
   
    public function upactivityAction()   {
     $objectManager = $this
        ->getServiceLocator()
        ->get('Doctrine\ORM\EntityManager');   
    
    $id = (int) $this->params('id', null);
    if (null === $id) {
      return $this->redirect()->toRoute('IssueCategory');
    }

    $issueposition = $objectManager->find('Application\Model\Domain\IssueActivity', $id);  
    $getposition = $issueposition->getPosition();
     
     $objectManager ->createQuery("UPDATE Application\Model\Domain\IssueActivity u SET u.position = $getposition  WHERE u.position=$getposition-1")
                            ->execute();              
     $objectManager ->createQuery("UPDATE Application\Model\Domain\IssueActivity u SET u.position = $getposition-1  WHERE u.id=$id")
                            ->execute(); 
     $this->rebuild_positions_category();
     return $this->redirect()->toRoute('IssueCategory');
   } 
    
    
  } 

    
    
   
