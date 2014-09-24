<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Model\Domain\Role;
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
                $role->setIsDefault($data['isDeafuly']);
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
        
    }

    public function removeRole() {
        
    }

}
