<?php

namespace Application\Controller;

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
