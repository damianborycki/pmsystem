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
        $od = $this->params()->fromPost('filtrujPoDacieOd');
        $do = $this->params()->fromPost('filtrujPoDacieDo');
        
        $em = $this->getObjectManager();
        
        $issue = $em->getRepository('\Application\Model\Domain\Issue')->find($issueId);
        $timeEntries = $em->getRepository('\Application\Model\Domain\WorkTimeEntry')->getWorkTimeEntriesForIssue($issue, $od, $do);
        
        $view = new ViewModel(array(
            'issue' => $issue,
            'timeEntries' => $timeEntries,
        ));
        $view->setTemplate('WorkTimeEntry/Issue');
        return $view;
    }
    
    public function addAction()
    {
        $issueId = $this->params('issueId');
        $em = $this->getObjectManager();
        $issue = $em->getRepository('\Application\Model\Domain\Issue')->find($issueId);
        $form = new \Application\Form\WorkTimeEntryForm();
        $entity = new \Application\Model\Domain\WorkTimeEntry();
        $form->bind($entity);
        
        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $ae = new \Application\Model\Domain\ActivityEntry();
                $ae->setIssue($issue);
                $ae->setProject($issue->getProject());
                $ae->setUser($em->getRepository('\Application\Model\Domain\User')->find(1));
                $em->persist($ae);
                $em->flush();
                
                $entity->setEntryDate(new \DateTime($entity->getEntryDate()));
                $entity->setActivityEntries($ae);
                $em->persist($entity);
                $em->flush();
                
                return $this->redirect()->toRoute('WorkTimeEntry-Issue', array('issueId' => $issue->getId()));
            }
        }
        
    	$view = new ViewModel(array(
            'issue' => $issue,
            'form' => $form,
        ));
        $view->setTemplate('WorkTimeEntry/Add');
        return $view;
    }
    
    public function deleteAction()
    {
        $issueId = $this->params('issueId');
        $timeEntryId = $this->params('id2');
        $em = $this->getObjectManager();
        $issue = $em->getRepository('\Application\Model\Domain\Issue')->find($issueId);
        $timeEntry = $em->getRepository('\Application\Model\Domain\WorkTimeEntry')->find($timeEntryId);
        
        $request = $this->getRequest();
        if ($request->isPost()) {
            if ($request->getPost()->get('naPewno') == '1') {
                $em->remove($timeEntry);
                $em->flush();
                return $this->redirect()->toRoute('WorkTimeEntry-Issue', array('issueId' => $issue->getId()));
            }
        }
        
    	$view = new ViewModel(array(
            'issue' => $issue,
            'timeEntry' => $timeEntry,
        ));
        $view->setTemplate('WorkTimeEntry/Delete');
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