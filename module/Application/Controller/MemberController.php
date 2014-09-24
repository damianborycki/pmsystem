<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Model\Domain\Member;
use Application\Model\Domain\MemberRole;
use Application\Form\MemberForm;
use Application\Form\MemberRoleForm;

class MemberController extends AbstractActionController {

    protected $_objectManager;

    protected function getObjectManager() {
        if (!$this->_objectManager) {
            $this->_objectManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        }
        return $this->_objectManager;
    }

    public function showAllMember() {
        $id = $this->getEvent()->getRouteMatch()->getParam('project');

        $members = $this->getObjectManager()->getRepository('\Application\Model\Domain\Member')->findBy(array('project' => $id));

        $project = $this->getObjectManager()->getRepository('\Application\Model\Domain\Project')->findAll();

        $view = new ViewModel(array('issues' => $members, 'projects' => $project, 'id' => $id));
        $view->setTemplate('Members/List');

        return $view;
    }

    public function showOneMember() {
        $id = $this->getEvent()->getRouteMatch()->getParam('id');
        $role = $this->getObjectManager()->getRepository('\Application\Model\Domain\Member')->find($id);

        $dbAdapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');

        $form = new MemberRoleForm($dbAdapter);

        $view = new ViewModel(array('role' => $role, 'form' => $form));
        $view->setTemplate('Members/Show');

        return $view;
    }

    public function editMember() {
        $id = $this->getEvent()->getRouteMatch()->getParam('id');

        if (!empty($id)) {
            $memberedit = $this->getObjectManager()->getRepository('\Application\Model\Domain\Member')->find($id);
        }
        if (empty($memberedit)) {
            return $this->redirect()->toRoute('AddMember');
        }
        $memberedit = $this->getObjectManager()->getRepository('\Application\Model\Domain\Member')->find($id);

        $dbAdapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');

        $form = new MemberForm($dbAdapter, $memberedit->getProject()->getId());

        if ($this->getRequest()->isPost()) {
            $form->setInputFilter($memberedit->getInputFilter());
            $form->setData($this->getRequest()->getPost());

            if ($form->isValid()) {
                $data = $form->getData();
                $project = $this->getObjectManager()->find('\Application\Model\Domain\Project', $data['project']);
                $user = $this->getObjectManager()->find('\Application\Model\Domain\User', $data['user']);
                $memeberRole = $this->getObjectManager()->find('\Application\Model\Domain\User', $data['memberRole']);


                $memberedit->setCreator($user);
                $memberedit->setProject($project);
                $memberedit->setMemberRoles(array($memeberRole));

                $this->getObjectManager()->merge($memberedit);
                $this->getObjectManager()->flush();
                $id = $memberedit->getId();

                return $this->redirect()->toUrl('/member/' . $id);
            }
        }

        $form->get('project')->setValue($memberedit->getProject()->getId());
        $form->get('memberRole')->setValue($memberedit->getMemberRole()->getCode());

        $view = new ViewModel(array('member' => $memberedit, 'form' => $form));
        $view->setTemplate('Members/Edit');

        return $view;
    }

    public function addMember() {
        $projectId = $this->getEvent()->getRouteMatch()->getParam('project');
        $userId = $this->getEvent()->getRouteMatch()->getParam('id');
        $dbAdapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
        $form = new IssueForm($dbAdapter, $projectId);

        if ($this->getRequest()->isPost()) {
            $memberadd = new Member();
            $form->setInputFilter($memberadd->getInputFilter());
            $form->setData($this->getRequest()->getPost());

            if ($form->isValid()) {
                $data = $form->getData();
                $project = $this->getObjectManager()->find('\Application\Model\Domain\Project', $data['project']);
                $user = $this->getObjectManager()->find('\Application\Model\Domain\User', $data['user']);
                $memeberRole = $this->getObjectManager()->find('\Application\Model\Domain\User', $data['memberRole']);


                if (!empty($userId)) {
                    $user = $this->getObjectManager()->find('\Application\Model\Domain\Member', $userId);
                    if (!empty($user)) {
                        $memberadd->setParent($user);
                    }
                }
                $memberadd->setUser($user);
                $memberadd->setProject($project);
                ;
                $memberadd->setCreationTime(new \DateTime());
                $memberadd->setMemberRoles(array($memeberRole));

                $this->getObjectManager()->persist($memberadd);
                $this->getObjectManager()->flush();

                $newId = $memberadd->getId();

                return $this->redirect()->toUrl('/member/' . $newId);
            }
        }
    }

    public function deleteMember() {
        $objectManager = $this->getObjectManager();

        $id = (int) $this->params('id', null);
        if (null === $id) {
            return $this->redirect()->toRoute('Member');
        }

        $memberdelete = $objectManager->find('Application\Model\Domain\Member', $id);

        $objectManager->remove($memberdelete);
        $objectManager->flush();

        $this->rebuild_positions();

        return $this->redirect()->toRoute('Member');
    }

}
