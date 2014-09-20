<?php
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class CustomDictController extends AbstractActionController
{

    public function indexAction(){
    	

         $view = new ViewModel();
         
         $view->setTemplate('CustomDict/index');
         return $view;
         
    }
}