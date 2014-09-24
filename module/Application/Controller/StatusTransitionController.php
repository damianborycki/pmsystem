<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Model\Domain\IssueStatus;
use Application\Model\Domain\Tracker;
use Application\Model\Domain\MemberRole;

class StatusTransitionController extends AbstractActionController 
{
	protected $_objectManager;
	
    public function getObjectManager() {
    if (!$this->_objectManager) {
        $this->_objectManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
    }
        return $this->_objectManager;
    }
	
	public function statusTransitionAction(){
		$objectManager = $this
			->getServiceLocator()
			->get('Doctrine\ORM\EntityManager');
		$issStat = $objectManager->getRepository('Application\Model\Domain\IssueStatus');
		$issuelist = $issStat->findAll();
		
		$roleList =  $objectManager->getRepository('Application\Model\Domain\MemberRole')->findAll();
		$trackerList =  $objectManager->getRepository('Application\Model\Domain\Tracker')->findAll();
				
		$statusTransitions = $objectManager->getRepository('Application\Model\Domain\StatusTransition')->findAll();
		
		
		$view = new ViewModel(array('issuelist'=> $issuelist, 'roleList'=> $roleList, 'trackerList'=> $trackerList, 'przejscia'=> $statusTransitions, 'controler'=> $this));
		$view->setTemplate('StatusTransition/StatusTransition');
		return $view;
	}
	
	public function addNewStatusTransition($post){
		
		$objectManager = $this
			->getServiceLocator()
			->get('Doctrine\ORM\EntityManager');
			
		$queryDelete = "DELETE FROM STATUSTRANSITION WHERE TRACKERID = " . $post['tracker'] . " and MEMBERROLEID = " . $post['memberRole'];
			
		$stmt = $objectManager->getConnection()->prepare($queryDelete);
		$params = array();
		$stmt->execute($params);		
		
		if(isset($post['check_list'])){ 
			foreach($post['check_list'] as $check){
				$ids = explode("-", $check);
			
				$queryInsert = "INSERT INTO STATUSTRANSITION (`TRACKERID`, `MEMBERROLEID`,	`PREVSTATUSID`, `NEXTSTATUSID`) VALUES ('" . $post['tracker'] . "',  '" . $post['memberRole'] . "', '" 
				. $ids[0] . "',  '" . $ids[1] . "')";

				$stmt = $objectManager->getConnection()->prepare($queryInsert);
				$params = array();
				$stmt->execute($params);
			}
			
			
		}
		return "OK";
	}
	
    
    
	
	public function __construct($ProjectId=null)
    {
    }

    /**
     * Dodawanie nowego przejscia
     *
     * @access public
     * 
     */
    public function addAction()
    {
		$objectManager = $this
        ->getServiceLocator()
        ->get('Doctrine\ORM\EntityManager');  
    }

}