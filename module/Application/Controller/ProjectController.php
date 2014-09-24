<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Model\Domain\Project;

class ProjectController extends AbstractActionController {

    protected $_objectManager;

    public function showAction(){
        $id = $this->getEvent()->getRouteMatch()->getParam('project');

        setcookie('ProjectId', $id, time()+(60*60*24*30), '/', '.pms.localhost');

		$project = $this->getObjectManager()->getRepository('\Application\Model\Domain\Project')->find($id);
		
        $view   = new ViewModel(array('project' => $project));
        $view->setTemplate('Project/Show');

        return $view;
    }


    protected function getObjectManager() {
        if (!$this->_objectManager) {
            $this->_objectManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        }

        return $this->_objectManager;
    }
}
