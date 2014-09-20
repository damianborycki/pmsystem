<?php
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class CustomDictController extends AbstractActionController
{
//     public function worldAction()
//     {
//         $message = "message";
//         return new ViewModel(array('message' => $message));
//     }
//     public function showAction(){
//     	// pokaz pojedynczy
//     	return;
//     }
    public function indexAction(){
    	
    	
        //$message = "message";
        // takie linijki jak poni¿ej piszesz tylko jeœli przesy³asz formularze aby do widoku przes³aæ dane :)
        //return new ViewModel(array('message' => $message));
        
    	//tu nic nie przesy³amy (póki co) wiêc bez argumenów
         $view = new ViewModel();
         // tu wywo³ujê œcie¿kê do widoku. Plik View jest ³adowany bo tak jest ustawione w systemie. Resztê trzeba wywo³aæ sobie samemu ;)
         $view->setTemplate('CustomDict/index');
         return $view;
         
    }
}