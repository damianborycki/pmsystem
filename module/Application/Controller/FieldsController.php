<?php

namespace Application\Controller;

use Application\Model\Domain\Field;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Model\Domain\ProjectFields;
use Application\Model\Domain\TrackerFields;
use Application\Model\Domain\Project;
use Doctrine\DBAL\DriverManager;
use Application\Form\FieldForm;

class FieldsController extends AbstractActionController {

    protected $_objectManager;

    public function listAction(){

        $fields = $this->getObjectManager()->getRepository('\Application\Model\Domain\Field')->findAll();
        $view = new ViewModel(array('fields' => $fields));
        $view->setTemplate('Fields/List');

        return $view;
    }

    public function removeAction(){
        $id = $this->params('id', null);
        $field = $this->getObjectManager()->find('Application\Model\Domain\Field', $id);

        $this->getObjectManager()->remove($field);
        $this->getObjectManager()->flush();

        return $this->redirect()->toRoute('FieldsList');
    }

    public function addAction(){

        $dbAdapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
        $form = new FieldForm ($dbAdapter);

        $projectsRes = [];
        $projectSql = "SELECT id, name FROM PROJECT";
        $projects = $this->getObjectManager()->getConnection()->query($projectSql)->fetchAll();

        foreach ($projects as $project) {
            $projectsRes[$project['id']] = $project['name'];
        }

        if($projectsRes)
            $form->setProjectsList($projectsRes);

        $trackerSql = "SELECT id, name FROM TRACKER";
        $trackers = $this->getObjectManager()->getConnection()->query($trackerSql)->fetchAll();

        foreach ($trackers as $tracker) {
            $trackersRes[$tracker['id']] = $tracker['name'];
        }

        if($trackersRes)
            $form->setTrackersList($trackersRes);

        if ($this->getRequest()->isPost()) {
            $field = new Field();

            $form->setData($this->getRequest()->getPost());
            $form->isValid();

            if ($form->hasValidated()) {
                $data = $form->getData();

                $field->setName($data['name']);
                $field->setDefaultValue($data['defaultValue']);
                $field->setMaxValue($data['maxValue']);
                $field->setMinValue($data['minValue']);
                $field->setIsHidden($data['isHidden']);
                $field->setIsRequired($data['isRequired']);
                $field->setIsForAll($data['isForAll']);
                $field->setIsFilter($data['isFilter']);
                $field->setType($data['types']);
                $this->getObjectManager()->persist($field);
                $this->getObjectManager()->flush();

                $newId = $field->getId();

                foreach ($data['projects'] as $projectId) {
                    $projectField = new ProjectFields();
                    $projectField->setFieldId($newId);
                    $projectField->setProjectId($projectId);
                    $this->getObjectManager()->persist($projectField);
                    $this->getObjectManager()->flush();
                }

                foreach ($data['trackers'] as $trackerId) {
                    $trackerField = new TrackerFields();
                    $trackerField->setFieldId($newId);
                    $trackerField->setTrackerId($trackerId);
                    $this->getObjectManager()->persist($trackerField);
                    $this->getObjectManager()->flush();
                }

                return $this->redirect()->toRoute('FieldsList');
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
