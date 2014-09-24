<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Model\Domain\Project;

use Application\Form\ProjectForm;

class ProjectController extends AbstractActionController {

    protected $_objectManager;

    public function showAction(){
        $id = $this->getEvent()->getRouteMatch()->getParam('project');

        setcookie('ProjectId', $id, time()+(60*60*24*30), '/', '.pms.localhost');
		$projects  = $this->getObjectManager()->getRepository('\Application\Model\Domain\Project')->findAll();
		$project = $this->getObjectManager()->getRepository('\Application\Model\Domain\Project')->find($id);
		
        $view = new ViewModel(array('project' => $project, 'projects' => $projects, 'id' => $id));
        $view->setTemplate('Project/show');

        return $view;
    }

	public function listAction(){
    	
        $projects = $this->getObjectManager()->getRepository('\Application\Model\Domain\Project')->findAll();

	    $view   = new ViewModel(array('projects' => $projects));
        $view->setTemplate('Project/list');

        return $view;
    }
    
    public function addAction() {
    	
      	$dbAdapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
    	$additionalFields = array();
      	        
      	$form = new ProjectForm ($dbAdapter);
        
        if ($this->getRequest()->isPost()) {
            $project = new Project();
            $form->setData($this->getRequest()->getPost());

            if ($form->isValid()) {
                $data     = $form->getData();
                
				$this->getObjectManager()->persist($project);
                $this->getObjectManager()->flush();

                return $this->redirect()->toUrl('/' . $project->getId() . '/');
            }
        }

        $view   = new ViewModel(array('project' => $project, 'projects' => $projects, 'id' => $id));
        $view->setTemplate('Project/Show');

        return $view;
    }

    // public function editAction(){
        // $id = $this->getEvent()->getRouteMatch()->getParam('id');
//         
        // if (!empty($id)) {
        	// $issue = $this->getObjectManager()->getRepository('\Application\Model\Domain\Issue')->find($id);
        // } 
        // if (empty($issue)) {
        	// return $this->redirect()->toRoute('AddIssue');
        // }
        // $issue = $this->getObjectManager()->getRepository('\Application\Model\Domain\Issue')->find($id);
// 		
//         
        // $fieldsValue = $this->getObjectManager()->getRepository('\Application\Model\Domain\FieldValue')->findBy(array('contextId' => $id));
//        
		// $dbAdapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
    	// $projectFields =  $this->getObjectManager()->getRepository('\Application\Model\Domain\ProjectFields')->findBy(array('projectId' => $issue->getProject()->getId()));
    	// $additionalFields = array();
      	// foreach ($projectFields as $projectField) {
        	// $fieldId = $projectField->getFieldId();
        	// $field = $this->getObjectManager()->getRepository('\Application\Model\Domain\Field')->findBy(array('id' => $fieldId));
        	// if (!empty($field)) {
        		// array_push($additionalFields, $field[0]);
        	// }
        // }
        // $form = new IssueForm ($dbAdapter, $issue->getProject()->getId(), $additionalFields);
//         
        // if ($this->getRequest()->isPost()) {
            // $form->setInputFilter($issue->getInputFilter());
            // $form->setData($this->getRequest()->getPost());
// 			
            // if ($form->isValid()) {
                // $data     = $form->getData();
                // $project  = $this->getObjectManager()->find('\Application\Model\Domain\Project', $data['project']);
                // $priority = $this->getObjectManager()->find('\Application\Model\Domain\IssuePriority', $data['issuePriority']);
                // $status = $this->getObjectManager()->find('\Application\Model\Domain\IssueStatus', $data['issueStatus']);
                // $creator = $this->getObjectManager()->find('\Application\Model\Domain\User', $data['User']);
// 
                // $issue->setCreator($creator);
                // $issue->setProject($project);
                // $issue->setSubject($data['subject']);
                // $issue->setDescription($data['description']);
                // $issue->setIssueStatus($status);
                // $issue->setIssuePriority($priority);
// 
                // $this->getObjectManager()->merge($issue);
                // $this->getObjectManager()->flush();
                // $id = $issue->getId();
	            // foreach ($additionalFields as $field) {
		        	// $fieldValue = $this->getObjectManager()->getRepository('\Application\Model\Domain\FieldValue')->findOneBy(array('contextId' => $id, 'fieldId' => $field->getId()));
	            	// if (!empty($fieldValue)) {
        	 			// $fieldValue->setValue($data[$field->getName()]);
	        	 		// $this->getObjectManager()->merge($fieldValue);
	                	// $this->getObjectManager()->flush();
        	 		// }
		        // }
//             	
                // return $this->redirect()->toUrl('/issue/'.$id);
            // }
        // } 
//         
		// $form->get('description')->setAttribute('value', $issue->getDescription());
        // $form->get('subject')->setValue($issue->getSubject());
        // $form->get('project')->setValue($issue->getProject()->getId());
        // $form->get('issueTracker')->setValue($issue->getTracker()->getId());
        // $form->get('issuePriority')->setValue($issue->getIssuePriority()->getCode());
//         
        // foreach ($additionalFields as $field) {
        	 // $fieldValue = $this->getObjectManager()->getRepository('\Application\Model\Domain\FieldValue')->findOneBy(array('contextId' => $id, 'fieldId' => $field->getId()));
//         	 
        	 // if (!empty($fieldValue)) {
        	 	// $form->get($field->getName())->setValue($fieldValue->getValue());	
        	 // }
        // }
//         
        // $view   = new ViewModel(array('issue' => $issue, 'form' => $form, 'additionalFields' => $additionalFields));
        // $view->setTemplate('Issues/Edit');
// 
        // return $view;
    // }

    protected function getObjectManager() {
        if (!$this->_objectManager) {
            $this->_objectManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        }

        return $this->_objectManager;
    }
}
