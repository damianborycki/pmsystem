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

    public function showAction() { 
        $objectManager = $this->getObjectManager();

        $id = (int) $this->params('id', null);
        if (null === $id) {
            return $this->redirect()->toRoute('CustomDict');
        } 
        
        $issue = $objectManager->find('Application\Model\Domain\CustomDictionary', $id);

        if($issue->getIsDefault()){                            
                $issue->setIsDefault('<i class="fa fa-check"></i>');
            }
                          
        if($issue->getIsActive()){                           
                $issue->setIsActive('<i class="fa fa-check"></i>');
        }      
                 
        $view = new ViewModel(array('issue'=> $issue));
        $view->setTemplate('CustomDict/show');
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

        $this->rebuild_positions();
    
    	return $this->redirect()->toRoute('CustomDict');
   	}

    public function upAction() {
    	$objectManager = $this->getObjectManager();

    	$id = (int) $this->params('id', null);
        if (null === $id) {
        	return $this->redirect()->toRoute('CustomDict');
        } 

        $issueposition = $objectManager->find('Application\Model\Domain\CustomDictionary', $id);  
        $getposition = $issueposition->getPosition();
     
        $objectManager ->createQuery("UPDATE Application\Model\Domain\CustomDictionary u SET u.position = $getposition  WHERE u.position=$getposition-1")->execute();              
        $objectManager ->createQuery("UPDATE Application\Model\Domain\CustomDictionary u SET u.position = $getposition-1  WHERE u.id=$id")->execute(); 
        $this->rebuild_positions();

    	return $this->redirect()->toRoute('CustomDict');
    }

    public function downAction() {
    	$objectManager = $this->getObjectManager();

    	$id = (int) $this->params('id', null);
        if (null === $id) {
        	return $this->redirect()->toRoute('CustomDict');
        }

        $issueposition = $objectManager->find('Application\Model\Domain\CustomDictionary', $id);  
        $getposition = $issueposition->getPosition();
     
        $objectManager ->createQuery("UPDATE Application\Model\Domain\CustomDictionary u SET u.position = $getposition  WHERE u.position=$getposition+1")->execute();              
        $objectManager ->createQuery("UPDATE Application\Model\Domain\CustomDictionary u SET u.position = $getposition+1  WHERE u.id=$id")->execute();   
        $this->rebuild_positions();
     
    	return $this->redirect()->toRoute('CustomDict');
    } 

    public function editAction()
    {
    	 
    	$objectManager = $this
    	->getServiceLocator()
    	->get('Doctrine\ORM\EntityManager');
    	 
    	$id = (int) $this->params('id', null);
    	if (null === $id) {
    		return $this->redirect()->toRoute('CustomDict');
    	}
    
    	$issueedit = $objectManager->find('Application\Model\Domain\CustomDictionary', $id);
    
    	$form = new CustomDictForm();
    
    	if ($this->getRequest()->isPost()) {
    
    		$issue = new CustomDictionary();
    		$form->setInputFilter($issue->getInputFilter());
    		$form->setData($this->getRequest()->getPost());
    		 
    		if ($form->isValid()) {
    			$data = $form->getData();
    			print_r($data);
    
    			$issue->setName($data['name']);
    			if (isset($data['IsActive']))
    			{
    				$issue->setIsActive($data['IsActive'][0]);
    
    			} else {
                    $issue->setIsActive(false);
                }
    			if (isset($data['IsDefault']))
    			{
    				$issuelist = $objectManager
    				->createQuery('SELECT u FROM Application\Model\Domain\CustomDictionary u')
    				->getResult();
    
    				foreach ($issuelist as $iss)
    				{
    					$iss->setIsDefault(false);
    					$this->getObjectManager()->merge($iss);
    				}
    				$issue->setIsDefault($data['IsDefault'][0]);
    				 
    			} else {
                    $issue->setIsDefault(false);
                }
    
                $issue->setPosition($issueedit->getPosition());
    			$issue->setId($id);
    			$this->getObjectManager()->merge($issue);
    			$this->getObjectManager()->flush();
    
    			return $this->redirect()->toRoute('CustomDict');
    		}
    	}
    
    	$view = new ViewModel(array('issueedit' => $issueedit, 'form2' => $form));
    	$view->setTemplate('CustomDict/edit');
    	return $view;
    }

public function addAction()
{

	$objectManager = $this
	->getServiceLocator()
	->get('Doctrine\ORM\EntityManager');
	 
	echo $_SERVER['REQUEST_METHOD'];
	$form = new CustomDictForm();

	if ($this->getRequest()->isPost()) {
		$issue = new CustomDictionary();
		$form->setInputFilter($issue->getInputFilter());
		$form->setData($this->getRequest()->getPost());

		if ($form->isValid()) {
			$data = $form->getData();
			print_r($data);
			 

			$issue->setName($data['name']);
			if (isset($data['IsActive']))
			{ 
                $issue->setIsActive($data['IsActive'][0]);
			} else {
                $issue->setIsActive(false);
            }

			if (isset($data['IsDefault']))
			{
				$issuelist = $objectManager
				->createQuery('SELECT u FROM Application\Model\Domain\CustomDictionary u')
				->getResult();

				foreach ($issuelist as $iss)
				{
					$iss->setIsDefault(false);
					$this->getObjectManager()->merge($iss);
				}
				$issue->setIsDefault($data['IsDefault'][0]);
			} else {
                $issue->setIsDefault(false);
            }

            $position = count($this->getObjectManager()->getRepository('\Application\Model\Domain\CustomDictionary')->findAll()) + 1;
            $issue->setPosition($position);

			$this->getObjectManager()->persist($issue);
			$this->getObjectManager()->flush();
			
            return $this->redirect()->toRoute('AddAttributesToCustomDict');
		}
	}

	$view = new ViewModel(array('form' => $form));
	$view->setTemplate('CustomDict/add');
	return $view;
}


// -----   attributes of dictionary  	-----


public function indexAttribAction() {
	$objectManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');

	$issuelist = $objectManager->createQuery('SELECT u FROM Application\Model\Domain\CustomDictionaryValue u')->getResult();

	foreach ($issuelist as $iss) {
		if($iss->getIsDefault(true)){
			$iss->setIsDefault('<i class="fa fa-check"></i>');
		}

		if($iss->getIsActive(true)){
			$iss->setIsActive('<i class="fa fa-check"></i>');
		}
	}
	 
	$view = new ViewModel(array('issuelist'=> $issuelist));
	$view->setTemplate('CustomDict/index_attribute');
	return $view;
}

public function addAttribAction()
{

	$objectManager = $this
	->getServiceLocator()
	->get('Doctrine\ORM\EntityManager');

	echo $_SERVER['REQUEST_METHOD'];
	$form = new CustomDictForm();

	if ($this->getRequest()->isPost()) {
		$issue = new IssueCategory();
		$form->setInputFilter($issue->getInputFilter());
		$form->setData($this->getRequest()->getPost());

		if ($form->isValid()) {
			$data = $form->getData();
			print_r($data);


			$issue->setName($data['name']);
			if (isset($data['IsActive']))
			{ $issue->setIsActive($data['IsActive'][0]);
			}

			if (isset($data['IsDefault']))
			{
				$issuelist = $objectManager
				->createQuery('SELECT u FROM Application\Model\Domain\CustomDictValue u')
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
			return $this->redirect()->toRoute('CustomDict');
		}
	}

    $view = new ViewModel(array('form' => $form));
	$view->setTemplate('CustomDict/add_attribute');
	return $view;
}

    public function rebuild_positions(){
        $objectManager = $this->getObjectManager();
        $rebuild_positions = $objectManager->createQuery('SELECT u FROM Application\Model\Domain\CustomDictionary u ORDER BY u.position ASC')->getResult();
         
        $i=1;

        foreach($rebuild_positions as $positions){
            $id = $positions->getId();
            $objectManager ->createQuery("UPDATE Application\Model\Domain\CustomDictionary u SET u.position = $i  WHERE u.id=$id")->execute();    
            
            $i++;     
        }
    } 

}