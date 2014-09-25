<?php
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Model\Domain\User;
use Application\Model\Domain\UserType;
use Application\Form\UserForm; 
use Application\Form\UserTypeForm;

class usersController extends AbstractActionController
{

    protected $_objectManager;

    public function showUser()
    {
        $id = $this->getEvent()
            ->getRouteMatch()
            ->getParam('id');
        $user = $this->getObjectManager()
            ->getRepository('\Application\Model\Domain\User')
            ->find($id);
        $dbAdapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter'); 
        $form = new UserForm($dbAdapter);
        $view = new ViewModel(array(
            'user' => $user,
            'form' => $form
        ));
        $view->setTemplate('Users/Show');
        return $view;
    }

    public function listUser()
    {
        $id = $this->getEvent()
            ->getRouteMatch()
            ->getParam('user');
        $users = $this->getObjectManager()
            ->getRepository('\Application\Model\Domain\users')
            ->findBy(array(
            'users' => $id
        ));
        $project = $this->getObjectManager()
            ->getRepository('\Application\Model\Domain\Project')
            ->findAll();
        $view = new ViewModel(array(
            'users' => $users,
            'projects' => $project,
            'id' => $id
        ));
        $view->setTemplate('Users/List');
        return $view;
    }

    public function addUser()
    {
        $login = $this->getEvent()
            ->getRouteMatch()
            ->getParam('login'); 
        $parentId = $this->getEvent()
            ->getRouteMatch()
            ->getParam('id');
        $dbAdapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
        $form = new UserForm($dbAdapter);
        if ($this->getRequest()->isPost()) {
            $user = new User();
            $form->setInputFilter($user->getInputFilter());
            $form->setData($this->getRequest()
                ->getPost());
            
            if ($form->isValid()) {
                $data = $form->getData();
                
                $user = $this->getObjectManager()->find('\Application\Model\Domain\User', $data['user']);
                
                $login = $this->getObjectManager()->find('\Application\Model\Domain\User', $data['login']);
                $firsName = $this->getObjectManager()->find('\Application\Model\Domain\User', $data['firstName']);
                $lastName = $this->getObjectManager()->find('\Application\Model\Domain\User', $data['lastName']);
                $email = $this->getObjectManager()->find('\Application\Model\Domain\User', $data['email']);
                $password = $this->getObjectManager()->find('\Application\Model\Domain\User', $data['password']);
                $salt = $this->getObjectManager()->find('\Application\Model\Domain\User', $data['salt']);
                $type = $this->getObjectManager()->find('\Application\Model\Domain\User', $data['users']);
                $creator = $this->getObjectManager()->find('\Application\Model\Domain\users', $data['users']); 
                
                if (! empty($parentId)) {
                    $parent = $this->getObjectManager()->find('\Application\Model\Domain\user', $parentId);
                    if (! empty($parent)) {
                        $user->setParent($parent);
                    }
                }
                
                $user->setLogin($login);
                $user->setHashedPassword($password);
                $user->setSalt($salt);                 
                $user->setFirstName($firsName);
                $user->setLastName($lastName);
                $user->setMail($email);
                
                $this->getObjectManager()->persist($user);
                $this->getObjectManager()->flush();
                $newId = $user->getId();
                return $this->redirect()->toUrl('/user/' . $newId);
            }
        }
        $view = new ViewModel(array(
            'form' => $form,
            'user' => $user
        ));
        $view->setTemplate('users/Add');
        return $view;
    }

    public function editUser()
    {
        $id = $this->getEvent()
            ->getRouteMatch()
            ->getParam('id');
        if (! empty($id)) {
            $user = $this->getObjectManager()
                ->getRepository('\Application\Model\Domain\User')
                ->find($id);
        }
        if (empty($user)) {
            return $this->redirect()->toRoute('AddUser');
        }
        $user = $this->getObjectManager()
            ->getRepository('\Application\Model\Domain\User')
            ->find($id);
        
        $dbAdapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
        
        $form = new UserForm($dbAdapter, $user->getProject()->getId()); 
        
        if ($this->getRequest()->isPost()) {
            $form->setInputFilter($user->getInputFilter());
            $form->setData($this->getRequest()
                ->getPost());
            
            if ($form->isValid()) {
                $data = $form->getData();
                $project = $this->getObjectManager()->find('\Application\Model\Domain\Project', $data['project']);
                
                $login = $this->getObjectManager()->find('\Application\Model\Domain\User', $data['login']);
                $firsName = $this->getObjectManager()->find('\Application\Model\Domain\User', $data['firstName']);
                $lastName = $this->getObjectManager()->find('\Application\Model\Domain\User', $data['lastName']);
                $email = $this->getObjectManager()->find('\Application\Model\Domain\User', $data['email']);
                $type = $this->getObjectManager()->find('\Application\Model\Domain\User', $data['users']);
                $creator = $this->getObjectManager()->find('\Application\Model\Domain\Users', $data['users']); 
                
                $user->setLogin($login);
                $user->setFirstName($firsName);
                $user->setLastName($lastName);
                $user->setMail($email);
                
                             
                $userType = new UserType();
                $userType = $this->getObjectManager()->find('\Application\Model\Domain\UserType', $data['usertype']);
                $description = $this->getObjectManager()->find('\Application\Model\Domain\UserType', $data['description']);
                $position = $this->getObjectManager()->find('\Application\Model\Domain\UserType', $data['description']);
                
                $userType->setDescription($description);
                $userType->setPosition($position);
                
                $user->setUserType($userType);
                
                $this->getObjectManager()->merge($user);
                $this->getObjectManager()->flush();
                $id = $user->getId();
                return $this->redirect()->toUrl('/user/' . $id);
            }
        }
        $form->get('description')->setAttribute('value', $user->getUserType()
            ->getDescription());
       
        $view = new ViewModel(array(
            'user' => $user,
            'form' => $form
        ));
        $view->setTemplate('Users/Edit');
        return $view;
    }
    
    
    public function deleteUser()
    {
        $objectManager = $this->getObjectManager();
    
        $id = (int) $this->params('id', null);
        if (null === $id) {
            return $this->redirect()->toRoute('User');
        }
    
        $userdelete = $objectManager->find('Application\Model\Domain\User', $id);
    
        $objectManager->remove($userdelete);
        $objectManager->flush();
    
        $this->rebuild_positions();
    
        return $this->redirect()->toRoute('User');
    }

    
   
    protected function getObjectManager()
    {
        if (! $this->_objectManager) {
            $this->_objectManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        }
        return $this->_objectManager;
    }
}
