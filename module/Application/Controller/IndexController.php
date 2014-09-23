<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Application\Model\Domain\Project;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
	protected $_objectManager;
	
    public function indexAction(){
        $projects  = $this->getObjectManager()->getRepository('\Application\Model\Domain\Project')->findAll();
        
        $view   = new ViewModel(array('projects' => $projects));
        $view->setTemplate('Index');

        return $view;
    }
    
    protected function getObjectManager() {
        if (!$this->_objectManager) {
            $this->_objectManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        }

        return $this->_objectManager;
    }
}
