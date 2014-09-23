<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Model\Domain\Issue;
use Application\Model\Domain\Project;
use Application\Form\IssueForm;

class IssuesController extends AbstractActionController {

    protected $_objectManager;

    public function showAction(){
        $id = $this->getEvent()->getRouteMatch()->getParam('id');
        $issue = $this->getObjectManager()->getRepository('\Application\Model\Domain\Issue')->find($id);

        $dbAdapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');

        $form = new IssueStatusChangeForm($dbAdapter);
        
        $view   = new ViewModel(array('issue' => $issue, 'form' => $form));
        $view->setTemplate('Issues/Show');

        return $view;
    }

    public function listAction(){
    	$id = $this->getEvent()->getRouteMatch()->getParam('project');
    	
        $issues = $this->getObjectManager()->getRepository('\Application\Model\Domain\Issue')->findBy(array('project' => $id));

		$project  = $this->getObjectManager()->getRepository('\Application\Model\Domain\Project')->findAll();
		
        $view   = new ViewModel(array('issues' => $issues, 'projects' => $project, 'id' => $id));
        $view->setTemplate('Issues/List');

        return $view;
    }
    
    public function addAction() {
        $projectId = $this->getEvent()->getRouteMatch()->getParam('project');

      	$dbAdapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
		$form = new IssueForm ($dbAdapter, $projectId);
        
        if ($this->getRequest()->isPost()) {
            $issue = new Issue();
            $form->setInputFilter($issue->getInputFilter());
            $form->setData($this->getRequest()->getPost());

            if ($form->isValid()) {
                $data     = $form->getData();
                $project  = $this->getObjectManager()->find('\Application\Model\Domain\Project', $data['project']);
                $priority = $this->getObjectManager()->find('\Application\Model\Domain\IssuePriority', $data['issuePriority']);
                $status = $this->getObjectManager()->find('\Application\Model\Domain\IssueStatus', $data['issueStatus']);
                $creator = $this->getObjectManager()->find('\Application\Model\Domain\User', $data['User']);
                $userAssigned = $this->getObjectManager()->find('\Application\Model\Domain\User', $data['issueAssigned']);

                $issue->setCreator($creator);
                $issue->setProject($project);
                $issue->setSubject($data['subject']);
                $issue->setDescription($data['description']);
                $issue->setIssueStatus($status);
                $issue->setIssuePriority($priority);
                $issue->setCreationTime(new \DateTime());
				$issue->setAssignedUsers(array($userAssigned));
				
                $this->getObjectManager()->persist($issue);
                $this->getObjectManager()->flush();

                $newId = $issue->getId();

                return $this->redirect()->toUrl('/issue/'.$newId);
            }
        }

        $view = new ViewModel(array('form' => $form, 'projectId' => $projectId));
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

        $dbAdapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');

        $form = new IssueForm ($dbAdapter, $issue->getProject()->getId());
        
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

                return $this->redirect()->toUrl('/issue/'.$id);
            }
        } 
        
		$form->get('description')->setAttribute('value', $issue->getDescription());
        $form->get('subject')->setValue($issue->getSubject());
        $form->get('project')->setValue($issue->getProject()->getId());
        $form->get('issuePriority')->setValue($issue->getIssuePriority()->getCode());
        
        $view   = new ViewModel(array('issue' => $issue, 'form' => $form));
        $view->setTemplate('Issues/Edit');

        return $view;
    }

    protected function getObjectManager() {
        if (!$this->_objectManager) {
            $this->_objectManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        }

        return $this->_objectManager;
    }
}
