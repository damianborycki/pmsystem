<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class WorkTimeEntryController extends AbstractActionController
{
    protected $_objectManager;
    
    public function issueAction()
    {
        $issueId = $this->params('issueId');
        
        $issue = $this->getObjectManager()->getRepository('\Application\Model\Domain\Issue')->find($issueId);
        
        $view = new ViewModel(array(
            'issue' => $issue,
        ));
        $view->setTemplate('WorkTimeEntry/Issue');
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