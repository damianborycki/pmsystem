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
        // takie linijki jak poni�ej piszesz tylko je�li przesy�asz formularze aby do widoku przes�a� dane :)
        //return new ViewModel(array('message' => $message));
        
    	//tu nic nie przesy�amy (p�ki co) wi�c bez argumen�w
         $view = new ViewModel();
         // tu wywo�uj� �cie�k� do widoku. Plik View jest �adowany bo tak jest ustawione w systemie. Reszt� trzeba wywo�a� sobie samemu ;)
         $view->setTemplate('CustomDict/index');
         return $view;
         
    }
}