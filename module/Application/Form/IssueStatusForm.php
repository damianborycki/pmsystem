<?php

namespace Application\Form;

use Zend\Form\Form;

class IssueStatusForm extends Form {
    public function __construct($name = null) {
        parent::__construct('issuestatus');

        $this->setAttribute('method', 'post');
        
        
        $this->add(array(
            'name'       => 'name',
            'type'       => 'Zend\Form\Element\Text',
            'attributes' => array( 
                'placeholder' => 'Status', 
                'required' => 'required', 
            ), 
            'options' => array( 
                'label' => 'Status', 
            ), 
            
        ));
        
        $this->add(array(
            'type' => 'Zend\Form\Element\MultiCheckbox',
            'name' => 'IsClosed',
            'options' => array(
                'value_options' => array(
                    '1'=>''
                ),
            ),
            'attributes' => array(
                'value' => '0', //set checked to '1'
                'uncheckedValue' => '0'
            )
        ));
        
        $this->add(array(
            'type' => 'Zend\Form\Element\MultiCheckbox',
            'name' => 'IsDefault',
            'options' => array(
                'value_options' => array(
                    '1'=>''
                ),
            ),
            'attributes' => array(
                'value' => '0', //set checked to '1'
                'uncheckedValue' => '0'
            )
        ));
        

        

        $this->add(array(
            'name'       => 'submit',
            'attributes' => array(
                'type'  => 'submit',
                'value' => 'Dodaj zadanie'
            ),
        )); 
    }
}
