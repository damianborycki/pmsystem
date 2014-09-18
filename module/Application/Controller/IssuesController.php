<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Model\Domain\Issue;
use Application\Form\IssueForm;

class IssuesController extends AbstractActionController {

    protected $_objectManager;

    public function showAction(){
        // pokaz pojedynczy
        return;
    }

    public function listAction(){
        $issues = $this->getObjectManager()->getRepository('\Application\Model\Domain\Issue')->findAll();
        $view   = new ViewModel(array('issues' => $issues));
        $view->setTemplate('Issues/List');

        return $view;
    }

    public function addAction() {
        $form = new IssueForm();

        if ($this->getRequest()->isPost()) {
            $issue = new Issue();
            $form->setInputFilter($issue->getInputFilter());
            $form->setData($this->getRequest()->getPost());

            if ($form->isValid()) {
                $data     = $form->getData();
                $project  = $this->getObjectManager()->find('\Application\Model\Domain\Project', $data['project']);
                $priority = $this->getObjectManager()->find('\Application\Model\Domain\IssuePriority', $data['issuePriority']);

                $issue->setProject($project);
                $issue->setSubject($data['subject']);
                $issue->setDescription($data['description']);
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
