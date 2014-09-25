<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Model\Domain\IssueStatus;
use Application\Model\Domain\Tracker;
use Application\Model\Domain\MemberRole;
use Doctrine\ORM\Query\ResultSetMapping;

class FieldsPermissionController extends AbstractActionController {
    
    public function __construct($ProjectId=null)
    {
    }
	
	public function fieldsPermissionAction(){
		$objectManager = $this
			->getServiceLocator()
			->get('Doctrine\ORM\EntityManager');
		
		$issuelist = $objectManager->getRepository('Application\Model\Domain\IssueStatus')->findAll();
		$roleList =  $objectManager->getRepository('Application\Model\Domain\MemberRole')->findAll();
		$trackerList =  $objectManager->getRepository('Application\Model\Domain\Tracker')->findAll();
		$fieldPermission = $objectManager->getRepository('Application\Model\Domain\FieldPermission')->findAll();
		$fplist = $objectManager->getRepository('Application\Model\Domain\FieldsPermission')->findAll();
		$fieldlist = $objectManager->getRepository('Application\Model\Domain\Field')->findAll();
		
		
		$view = new ViewModel(array('fplist'=> $fplist, 'roleList'=> $roleList, 'trackerList'=> $trackerList, 'issuelist'=> $issuelist, 'fieldPermission' => $fieldPermission, 'fields'=> $fieldlist, 'controller' => $this));
		$view->setTemplate('FieldsPermission/FieldsPermission');
		return $view;
	}
	
	public function addFieldPermissions($post){
	
		//Usuwanie śmieci
		$objectManager = $this
			->getServiceLocator()
			->get('Doctrine\ORM\EntityManager');
			
		$issuelist = $objectManager->getRepository('Application\Model\Domain\IssueStatus')->findAll();
		$fplist = $objectManager->getRepository('Application\Model\Domain\FieldsPermission')->findAll();
		
		$memberRole = $post['memberRole'];
		$tracker = $post['tracker'];
		
		$queryDelete = "DELETE FROM `FIELDSPERMISSION` WHERE TRACKERID = " . $tracker . " AND MEMBERROLEID = " . $memberRole;
			
		$stmt = $objectManager->getConnection()->prepare($queryDelete);
		$params = array();
		$stmt->execute($params);
		
		//Teraz tylko dodać
		foreach($fplist as $fp){
			$id = $fp->getField()->getId();
			foreach($issuelist as $il){
				$ilId = $il->getId();
				$selected = $post["field" . $fp->getField()->getId() . "issue" . $il->getId()];
				
				$query = "INSERT INTO `FIELDSPERMISSION` (TRACKERID, MEMBERROLEID, FIELDID, ISSUESTATUSID, FIELDPERMISSIONID) VALUES (" . $tracker . "," . $memberRole . "," . $id . "," . $ilId . "," . $selected . ")";
				$stmt = $objectManager->getConnection()->prepare($query);
				$params = array();
				$stmt->execute($params);
			}
		}
		
		echo "</tr>";
	}
}