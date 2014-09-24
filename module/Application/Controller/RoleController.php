<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Model\Domain\Role;
use Application\Model\Domain\MemberRole;
use Application\Model\Domain\Permission;
use Application\Form\RoleForm;

class RoleController extends AbstractActionController {

    protected $_objectManager;

    protected function getObjectManager() {
        if (!$this->_objectManager) {
            $this->_objectManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        }
        return $this->_objectManager;
    }

    public function addRole() {
        $projectId = $this->getEvent()->getRouteMatch()->getParam('project');
        $parentId = $this->getEvent()->getRouteMatch()->getParam('id');
        $dbAdapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
        $form = new IssueForm($dbAdapter, $projectId);

        if ($this->getRequest()->isPost()) {
            $role = new Role();
            $form->setInputFilter($role->getInputFilter());
            $form->setData($this->getRequest()->getPost());

            if ($form->isValid()) {
                $data = $form->getData();
                $code = $this->getObjectManager()->find('\Application\Model\Domain\Role', $data['code']);
                $value = $this->getObjectManager()->find('\Application\Model\Domain\Role', $data['value']);
                $position = $this->getObjectManager()->find('\Application\Model\Domain\Role', $data['position']);
               //$isDefault - TODO
                //$isActive
                $permission = $this->getObjectManager()->find('\Application\Model\Domain\Permission', $data['permission']);

                if (!empty($parentId)) {
                    $parent = $this->getObjectManager()->find('\Application\Model\Domain\Role', $parentId);
                    if (!empty($parent)) {
                        $role->setParent($parent);
                    }
                }
                $role->setCode($code);
                $role->setValue($value);
                $role->setDescription($data['description']);
                $role->setPosition($position);
                $role->setIsActive($data['isActive']);
                $role->setIsDefault($data['isDeafult']);
                $role->setPermissions(array($permission));

                $this->getObjectManager()->persist($role);
                $this->getObjectManager()->flush();

                $newId = $role->getId();

                return $this->redirect()->toUrl('/role/' . $newId);
            }
        }

        $view = new ViewModel(array('form' => $form, 'projectId' => $projectId, 'parentId' => $parentId));
        $view->setTemplate('Roles/Add');

        return $view;
    }

    public function getAllRole() {
        $id = $this->getEvent()->getRouteMatch()->getParam('project');

        $roles = $this->getObjectManager()->getRepository('\Application\Model\Domain\Member')->findBy(array('memberRoles' => $id));

        $memberRoles = $this->getObjectManager()->getRepository('\Application\Model\Domain\MemberRoles')->findAll();

        $view = new ViewModel(array('roles' => $roles, 'memberRoles' => $memberRoles, 'id' => $id));
        $view->setTemplate('Roles/List');

        return $view;
    }

    public function removeRole() {
        $objectManager = $this->getObjectManager();

        $id = (int) $this->params('id', null);
        if (null === $id) {
            return $this->redirect()->toRoute('Role');
        }

        $roledelete = $objectManager->find('Application\Model\Domain\Role', $id);

        $objectManager->remove($roledelete);
        $objectManager->flush();

        $this->rebuild_positions();

        return $this->redirect()->toRoute('Role');        
    }

}
