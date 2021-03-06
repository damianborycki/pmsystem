<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Model\Domain\Issue;
use Application\Model\Domain\Project;
use Application\Model\Domain\Field;
use Application\Model\Domain\FieldValue;
use Application\Model\Domain\Tracker;
use Application\Model\Domain\IssueStatus;
use Application\Form\IssueForm;
use Application\Form\IssueStatusChangeForm;

class IssuesController extends AbstractActionController {

    protected $_objectManager;

    public function showAction(){
        $id = $this->getEvent()->getRouteMatch()->getParam('id');
        $issue = $this->getObjectManager()->getRepository('\Application\Model\Domain\Issue')->find($id);

		$fieldsValue = $this->getObjectManager()->getRepository('\Application\Model\Domain\FieldValue')->findBy(array('contextId' => $id));
		$additionalFields = array();
		foreach ($fieldsValue as $field) {
        	$fieldId = $field->getFieldId();
        	$tmpField = $this->getObjectManager()->getRepository('\Application\Model\Domain\Field')->findOneBy(array('id' => $fieldId));

        	array_push($additionalFields, array('name' => $tmpField->getName(), 'value' => $field->getValue()));
		}
        if($parentId = $issue->getParent()){
            $parent = $this->getObjectManager()->getRepository('\Application\Model\Domain\Issue')->find($parentId);
        }else{
            $parent = NULL;
        }


        $dbAdapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');

        $memberStatus = 1;
        $tracker = $issue->getTracker()->getId();
        $currentStatus = $issue->getIssueStatus()->getId();

        $form = new IssueStatusChangeForm($dbAdapter, $memberStatus, $tracker, $currentStatus);

        $view   = new ViewModel(array('issue' => $issue, 'form' => $form, 'additionalFields' => $fieldsValue));

        $view   = new ViewModel(array('issue' => $issue, 'form' => $form, 'parent' => $parent, 'additionalFields' => $additionalFields));

        $view->setTemplate('Issues/Show');

        return $view;
    }

    public function listAction(){
    	$id = $this->getEvent()->getRouteMatch()->getParam('project');
        //setcookie('ProjectId', $id, time()+(60*60*24*30), '/', '.pms.localhost');

        $issues = $this->getObjectManager()->getRepository('\Application\Model\Domain\Issue')->findBy(array('project' => $id));

		$project  = $this->getObjectManager()->getRepository('\Application\Model\Domain\Project')->findAll();

        $view   = new ViewModel(array('issues' => $issues, 'projects' => $project, 'id' => $id));
        $view->setTemplate('Issues/List');

        return $view;
    }

    public function addAction() {
        $projectId = $this->getEvent()->getRouteMatch()->getParam('project');
        $parentId = $this->getEvent()->getRouteMatch()->getParam('id');
      	$dbAdapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
      	$projectFields =  $this->getObjectManager()->getRepository('\Application\Model\Domain\ProjectFields')->findBy(array('projectId' => $projectId));
    	$additionalFields = array();
      	foreach ($projectFields as $projectField) {
        	$fieldId = $projectField->getFieldId();
        	$field = $this->getObjectManager()->getRepository('\Application\Model\Domain\Field')->findBy(array('id' => $fieldId));
        	if (!empty($field) && $field[0]->getIsActive() == 1) {
        		array_push($additionalFields, $field[0]);
        	}
        }

      	$form = new IssueForm ($dbAdapter, $projectId, $additionalFields);

        if ($this->getRequest()->isPost()) {
            $issue = new Issue();
            $form->setInputFilter($issue->getInputFilter($additionalFields));
            $form->setData($this->getRequest()->getPost());

            if ($form->isValid()) {
                $data     = $form->getData();
                $project  = $this->getObjectManager()->find('\Application\Model\Domain\Project', $data['project']);
                $priority = $this->getObjectManager()->find('\Application\Model\Domain\IssuePriority', $data['issuePriority']);
                $status = $this->getObjectManager()->find('\Application\Model\Domain\IssueStatus', $data['issueStatus']);
                $creator = $this->getObjectManager()->find('\Application\Model\Domain\User', $data['User']);
                //$userAssigned = $this->getObjectManager()->find('\Application\Model\Domain\User', $data['issueAssigned']);
                $tracker = $this->getObjectManager()->find('\Application\Model\Domain\Tracker', $data['issueTracker']);

                if (!empty($parentId)) {
                	$parent = $this->getObjectManager()->find('\Application\Model\Domain\Issue', $parentId);
                	if (!empty($parent)) {
                		$issue->setParent($parent);
                	}
                }
                $issue->setCreator($creator);
                $issue->setProject($project);
                $issue->setTracker($tracker);
                $issue->setSubject($data['subject']);
                $issue->setDescription($data['description']);
                $issue->setIssueStatus($status);
                $issue->setIssuePriority($priority);
                $issue->setCreationTime(new \DateTime());
				//$issue->setAssignedUsers(array($userAssigned));



                $this->getObjectManager()->persist($issue);
                $this->getObjectManager()->flush();

                $newId = $issue->getId();
            	foreach ($additionalFields as $field) {
        	 		$fieldValue = new FieldValue();
        	 		$fieldValue->setContextId($newId);
        	 		$fieldValue->setContext('0');
        	 		$fieldValue->setFieldId($field->getId());
        	 		$fieldValue->setValue($data[$field->getName()]);

        	 		$this->getObjectManager()->persist($fieldValue);
                	$this->getObjectManager()->flush();
        		}
                return $this->redirect()->toUrl('/issue/'.$newId);
            }
        }

        $view = new ViewModel(array('form' => $form, 'projectId' => $projectId, 'parentId' => $parentId, 'additionalFields' => $additionalFields));
        $view->setTemplate('Issues/Add');

        return $view;
    }

    public function editAction(){
        $id = $this->getEvent()->getRouteMatch()->getParam('id');

        if (!empty($id)) {
        	$issue = $this->getObjectManager()->getRepository('\Application\Model\Domain\Issue')->find($id);
        }
        if (empty($issue)) {
        	return $this->redirect()->toRoute('AddIssue');
        }
        $issue = $this->getObjectManager()->getRepository('\Application\Model\Domain\Issue')->find($id);


        $fieldsValue = $this->getObjectManager()->getRepository('\Application\Model\Domain\FieldValue')->findBy(array('contextId' => $id));

		$dbAdapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
    	$projectFields =  $this->getObjectManager()->getRepository('\Application\Model\Domain\ProjectFields')->findBy(array('projectId' => $issue->getProject()->getId()));
    	$additionalFields = array();
      	foreach ($projectFields as $projectField) {
        	$fieldId = $projectField->getFieldId();
        	$field = $this->getObjectManager()->getRepository('\Application\Model\Domain\Field')->findBy(array('id' => $fieldId));
      	    if (!empty($field) && $field[0]->getIsActive() == 1) {
        		array_push($additionalFields, $field[0]);
        	}
        }
        $form = new IssueForm ($dbAdapter, $issue->getProject()->getId(), $additionalFields);

        if ($this->getRequest()->isPost()) {
            $form->setInputFilter($issue->getInputFilter());
            $form->setData($this->getRequest()->getPost());

            if ($form->isValid()) {
                $data     = $form->getData();
                $project  = $this->getObjectManager()->find('\Application\Model\Domain\Project', $data['project']);
                $priority = $this->getObjectManager()->find('\Application\Model\Domain\IssuePriority', $data['issuePriority']);
                $status = $this->getObjectManager()->find('\Application\Model\Domain\IssueStatus', $data['issueStatus']);
                $creator = $this->getObjectManager()->find('\Application\Model\Domain\User', $data['User']);

                $issue->setCreator($creator);
                $issue->setProject($project);
                $issue->setSubject($data['subject']);
                $issue->setDescription($data['description']);
                $issue->setIssueStatus($status);
                $issue->setIssuePriority($priority);

                $this->getObjectManager()->merge($issue);
                $this->getObjectManager()->flush();
                $id = $issue->getId();
	            foreach ($additionalFields as $field) {
		        	$fieldValue = $this->getObjectManager()->getRepository('\Application\Model\Domain\FieldValue')->findOneBy(array('contextId' => $id, 'fieldId' => $field->getId()));
	            	if (!empty($fieldValue)) {
        	 			$fieldValue->setValue($data[$field->getName()]);
	        	 		$this->getObjectManager()->merge($fieldValue);
	                	$this->getObjectManager()->flush();
        	 		}
		        }

                return $this->redirect()->toUrl('/issue/'.$id);
            }
        }

		$form->get('description')->setAttribute('value', $issue->getDescription());
        $form->get('subject')->setValue($issue->getSubject());
        $form->get('project')->setValue($issue->getProject()->getId());
        $form->get('issueTracker')->setValue($issue->getTracker()->getId());
        $form->get('issuePriority')->setValue($issue->getIssuePriority()->getCode());

        foreach ($additionalFields as $field) {
        	 $fieldValue = $this->getObjectManager()->getRepository('\Application\Model\Domain\FieldValue')->findOneBy(array('contextId' => $id, 'fieldId' => $field->getId()));

        	 if (!empty($fieldValue)) {
        	 	$form->get($field->getName())->setValue($fieldValue->getValue());
        	 }
        }

        $view   = new ViewModel(array('issue' => $issue, 'form' => $form, 'additionalFields' => $additionalFields));
        $view->setTemplate('Issues/Edit');

        return $view;
    }

    public function statusChangeAction() {
    	$id = $this->getEvent()->getRouteMatch()->getParam('id');

        if (!empty($id)) {
        	$issue = $this->getObjectManager()->getRepository('\Application\Model\Domain\Issue')->find($id);
        }
        if (empty($issue)) {
        	return $this->redirect()->toRoute('home');
        }

        $issue = $this->getObjectManager()->getRepository('\Application\Model\Domain\Issue')->find($id);

        $dbAdapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');

        $memberStatus = 1;
        $tracker = $issue->getTracker()->getId();
        $currentStatus = $issue->getIssueStatus()->getId();

        $form = new IssueStatusChangeForm($dbAdapter, $memberStatus, $tracker, $currentStatus);

        if ($this->getRequest()->isPost()) {
            $form->setData($this->getRequest()->getPost());

            if ($form->isValid()) {
                $data     = $form->getData();

                $status = $this->getObjectManager()->find('\Application\Model\Domain\IssueStatus', $data['issueStatus']);

                $issue->setIssueStatus($status);
                if ($status->getIsClosed()) {
                	$children = $this->getObjectManager()->getRepository('\Application\Model\Domain\Issue')->findBy(array('parent' => $issue->getId()));
                	foreach ($children as $child) {
	               		$child->setCloseTime(new \DateTime());
                	}
	                $issue->setCloseTime(new \DateTime());
                }

                $this->getObjectManager()->merge($issue);
                $this->getObjectManager()->flush();
                $id = $issue->getId();

            }
        }
        return $this->redirect()->toRoute('ShowIssue', array('id' => $id));
    }

    public function assignUserAction() {
        $id     = $this->getEvent()->getRouteMatch()->getParam("id");
        $userID = $this->getRequest()->getPost("userId", null);

        $issue  = $this->getObjectManager()->getRepository('\Application\Model\Domain\Issue')->find($id);
        $user   = $this->getObjectManager()->getRepository('\Application\Model\Domain\User')->find($userID);

        $issue->addAssignedUser($user);
        $this->getObjectManager()->merge($issue);
        $this->getObjectManager()->flush();

        return $this->response;
    }

    protected function getObjectManager() {
        if (!$this->_objectManager) {
            $this->_objectManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        }

        return $this->_objectManager;
    }
}
