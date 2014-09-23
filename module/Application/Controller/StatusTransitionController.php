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
	
    protected function getObjectManager() {
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
		
		
		$view = new ViewModel(array('issuelist'=> $issuelist, 'roleList'=> $roleList, 'trackerList'=> $trackerList));
		$view->setTemplate('StatusTransition');
		return $view;
	}
	
    
    
	
	public function __construct($ProjectId=null)
    {
    }

    /**
     * Sprawdzanie mozliwych stanow do przejscia przy danej konfiguracji
     *
     * @access public
     * 
     * @param int $taskType typ taska
     * @param int $taskState stan taska
     * @param int $userRole rola usera - w postaci id ze slownika
     * 
     * @return int[] id stanow ze slownika, na ktore mozna zmienic stan taska
     */
    public function getPossibleStates($taskType, $taskState, $userRole)
    {
    }

    /**
     * Dodawanie nowego przejscia
     *
     * @access public
     * 
     * @param int $taskType typ taska
     * @param int $oldTaskState wyjsciowy stan taska
     * @param int $oldUserRole wyjsciowa rola usera - w postaci id ze slownika
     * @param int $newTaskState nowy stan, do ktorego task moze przejsc
     * @param int $newUserRole rola, z ktorymi user moze zostac przypisany do taska po zmianie stanu na ten nowy
     */
    public function addNewTransition($taskType, $oldTaskState, $oldUserRole, $newTaskState, $newUserRole)
    {
    }

}