<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Model\Domain\User;
use Application\Model\Domain\Issue;

class UserAssignmentController extends AbstractActionController {

	protected $_objectManager;

	public function fetchUsersAction() {
        $issueID = $this->getEvent()->getRouteMatch()->getParam('issueID');
        $issue   = $this->getObjectManager()->getRepository('\Application\Model\Domain\Issue')->find($issueID);

        $assignedUsersIds = $issue->getAssignedUsers()->map(
            function($user) { 
                return $user->getId(); 
            }
        )->toArray();

        if (empty($assignedUsersIds)) {
            $users = $this->getObjectManager()->getRepository('\Application\Model\Domain\User')->findAll();
        }
        else {
            $sql   = "SELECT u FROM Application\Model\Domain\User u WHERE u.id NOT IN (" . implode(", ", $assignedUsersIds) . ")";
            $users = $this->getObjectManager()->createQuery($sql)->getResult();
        }

		$view = new ViewModel(array('users' => $users));
        $view->setTemplate('UserAssignment/FetchUsers')->setTerminal(true);

        return $view;
	}

	protected function getObjectManager() {
        if (!$this->_objectManager) {
            $this->_objectManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        }

        return $this->_objectManager;
    }
}
