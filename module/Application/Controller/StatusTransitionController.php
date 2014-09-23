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
		
		
		$view = new ViewModel(array('issuelist'=> $issuelist, 'roleList'=> $roleList, 'trackerList'=> $trackerList, 'controler'=> $this));
		$view->setTemplate('StatusTransition/StatusTransition');
		return $view;
	}
	
	public function addNewStatusTransition($post){
		
		$objectManager = $this
			->getServiceLocator()
			->get('Doctrine\ORM\EntityManager');
			
		$queryDelete = "DELETE FROM `STATUSTRANSITION`";
			
		$stmt = $objectManager->getConnection()->prepare($queryDelete);
		$params = array();
		$stmt->execute($params);
		//$query = $objectManager->createQuery($queryDelete);
		//$query->execute();
		
		
		foreach($post['check_list'] as $check){
			$ids = explode("-", $check);
		
			$queryInsert = "INSERT INTO STATUSTRANSITION (`TRACKERID`, `MEMBERROLEID`,	`PREVSTATUSID`, `NEXTSTATUSID`) VALUES ('" . $post['tracker'] . "',  '" . $post['memberRole'] . "', '" 
			. $ids[0] . "',  '" . $ids[1] . "')";
			
			//return $queryUpdate;
			//echo "<script>alert('" . $queryUpdate . "');</script>";
			
			//$db = $this->$objectManager->getConnection();
			//$query = "INSERT INTO table2 (myfield) SELECT table1.myfield FROM table1 WHERE table1.id < 1000";
			$stmt = $objectManager->getConnection()->prepare($queryInsert);
			$params = array();
			$stmt->execute($params);
			
			//$query = $objectManager->createQuery($queryInsert);
			//$query->execute();
		
		}
		
		//$ret = $post['tracker'] . ", " . $post['memberRole'] . ", " . implode(" ", $post['check_list']);
		//return $ret;
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
        
		//$id = $this->getRequest()->getPost('tracker', null);
		
        //$view = new ViewModel(array('statusId'=> $id, 'controler'=> $this));
		//$view->setTemplate('StatusTransition/add');
		//return $view;
    }

}