<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Model\Domain\QueryType;
use Application\Model\Domain\Issue;
use Application\Model\Domain\Project;
use Application\Model\Domain\Field;

class QueryController extends AbstractActionController  {
    protected $_objectManager;
    
    public function addAction()
    {
        $dbAdapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
        $form = new FieldForm ($dbAdapter);
        
        $name = $this->getObjectManager()->getRepository('\Application\Model\Domain\QueryType')->find($name);
        
        $view = new ViewModel(array(
            'QueryType' => $name,
        ));
        $view->setTemplate('Query/QueryType');
        return $view;
    }
    
    protected function getObjectManager()
    {
        if (!$this->_objectManager) {
            $this->_objectManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        }

        return $this->_objectManager;
    }
}