<?php

namespace Application\Form;

use Zend\Form\Form;

class TrackerForm extends Form {
    public function __construct($name = null) {
        parent::__construct('tracker');

        $this->setAttribute('method', 'post');
        
        
        $this->add(array(
            'name'       => 'name',
            'type'       => 'Zend\Form\Element\Text',
            'attributes' => array( 
                'placeholder' => 'Typ zagadnienia', 
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
            'name' => 'IsActive',
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
            'name'       => 'position',
            'attributes' => array(
                'type'  => 'hidden'
            ),
        ));
        
         $this->add(array(
            'type' => 'Zend\Form\Element\Textarea',
            'name'       => 'description',
            'attributes' => array(               
                'placeholder' => 'Opis typu zagadnienia...'
            )
        ));
         
        $this->add(array(
            'type' => 'Zend\Form\Element\MultiCheckbox',
            'name' => 'Assigned',
            'options' => array(
                'label' => 'Przypisany do', 
                'value_options' => array(
                    '1'=>''
                ),
            ),
            'attributes' => array(
                'value' => '1', //set checked to '1'
                'uncheckedValue' => '0'
            )
        ));
         $this->add(array(
            'type' => 'Zend\Form\Element\MultiCheckbox',
            'name' => 'Category',
            'options' => array(
                'label' => 'Kategoria', 
                'value_options' => array(
                    '1'=>''
                ),
            ),
            'attributes' => array(
                'value' => '1', //set checked to '1'
                'uncheckedValue' => '0'
            )
        ));
         // assigned;category;fiedVersion;parentIssue;startDate;dueDate;estimateHours;doneRadio;
         $this->add(array(
            'type' => 'Zend\Form\Element\MultiCheckbox',
            'name' => 'FiedVersion',
            'options' => array(
                'label' => 'Wersja docelowa', 
                'value_options' => array(
                    '1'=>''
                ),
            ),
            'attributes' => array(
                'value' => '1', //set checked to '1'
                'uncheckedValue' => '0'
            )
        ));
         $this->add(array(
            'type' => 'Zend\Form\Element\MultiCheckbox',
            'name' => 'ParentIssue',
            'options' => array(
                'label' => 'Zagadnienie nadrzędne', 
                'value_options' => array(
                    '1'=>''
                ),
            ),
            'attributes' => array(
                'value' => '1', //set checked to '1'
                'uncheckedValue' => '0'
            )
        ));
         $this->add(array(
            'type' => 'Zend\Form\Element\MultiCheckbox',
            'name' => 'StartDate',
            'options' => array(
                'label' => 'Data rozpoczęcia',
                'value_options' => array(
                    '1'=>''
                ),
            ),
            'attributes' => array(
                'value' => '1', //set checked to '1'
                'uncheckedValue' => '0'
            )
        ));
         $this->add(array(
            'type' => 'Zend\Form\Element\MultiCheckbox',            
            'name' => 'DueDate',
            'options' => array(
                'label' => 'Data oddania', 
                'value_options' => array(
                    '1'=>''
                ),
            ),
            'attributes' => array(
                'value' => '1', //set checked to '1'
                'uncheckedValue' => '0'
            )
        ));
         $this->add(array(
            'type' => 'Zend\Form\Element\MultiCheckbox',             
            'name' => 'EstimateHours',  
            'options' => array(
                'label' => 'Szacowany czas',
                'value_options' => array(
                    '1'=>''
                ),
            ),
            'attributes' => array(
                'value' => '1', //set checked to '1'
                'uncheckedValue' => '0'
            )
        ));
         $this->add(array(
            'type' => 'Zend\Form\Element\MultiCheckbox',         
            'name' => 'DoneRadio',
            'options' => array(
                'label' => '% wykonania', 
                'value_options' => array(
                    '1'=>''
                ),
            ),
            'attributes' => array(
                'value' => '1', //set checked to '1'
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
