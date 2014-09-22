<?php

namespace Application\Controller;

use Application\Model\Domain\Field;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Model\Domain\Issue;
use Application\Model\Domain\Project;
use Application\Form\FieldForm;

class FieldsController extends AbstractActionController {

    protected $_objectManager;

    public function listAction(){

        $fields = $this->getObjectManager()->getRepository('\Application\Model\Domain\Field')->find('Field');

        $view = new ViewModel(array('fields' => $fields));
        $view->setTemplate('Fields/List');

        return $view;
    }

    public function addAction(){

        $dbAdapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
        $form = new FieldForm ($dbAdapter);

        if ($this->getRequest()->isPost()) {
            $field = new Field();
            $form->setInputFilter($field->getInputFilter());
            $form->setData($this->getRequest()->getPost());

            if ($form->isValid()) {
                $data     = $form->getData();

                $project  = $this->getObjectManager()->find('\Application\Model\Domain\Project', $data['project']);
                $priority = $this->getObjectManager()->find('\Application\Model\Domain\IssuePriority', $data['issuePriority']);
                $status = $this->getObjectManager()->find('\Application\Model\Domain\IssueStatus', $data['issueStatus']);
                $creator = $this->getObjectManager()->find('\Application\Model\Domain\User', $data['User']);


                $field->setName($data['name']);
                $field->setDefaultValue($data['defaultValue']);
                $field->
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
        $view->setTemplate('Fields/Add');

        return $view;
    }


    protected function getObjectManager() {
        if (!$this->_objectManager) {
            $this->_objectManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        }

        return $this->_objectManager;
    }
}
