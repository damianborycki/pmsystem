<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;

class IndexController extends AbstractActionController
{
    public function indexAction(){
    	$this->layout()->setVariable('breadcrumb', 'Strona Główna');
        return;
    }
}
