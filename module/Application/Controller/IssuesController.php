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
       //var_dump($issue);
        $view   = new ViewModel(array('issue' => $issue));
        $view->setTemplate('Issues/Show');

        return $view;
    }

    public function listAction(){
    	$id = $this->getEvent()->getRouteMatch()->getParam('project');
    	
        $issues = $this->getObjectManager()->getRepository('\Application\Model\Domain\Issue')->findBy(array('project' => $id));

        $view   = new ViewModel(array('issues' => $issues));
        $view->setTemplate('Issues/List');

        return $view;
    }
    
    
    public function addAction() {
    	$dbAdapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
		$form = new IssueForm ($dbAdapter);
        //$form = new IssueForm();
        
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

                $issue->setCreator($creator);
                $issue->setProject($project);
                $issue->setSubject($data['subject']);
                $issue->setDescription($data['description']);
                $issue->setIssueStatus($status);
                $issue->setIssuePriority($priority);
                $issue->setCreationTime(new \DateTime());

                $this->getObjectManager()->persist($issue);
                $this->getObjectManager()->flush();
                $newId = $issue->getId();

                return $this->redirect()->toRoute('home');
            }
        }

        $view = new ViewModel(array('form' => $form));
        $view->setTemplate('Issues/Add');

        return $view;
    }

    protected function getObjectManager() {
        if (!$this->_objectManager) {
            $this->_objectManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        }

        return $this->_objectManager;
    }
}
