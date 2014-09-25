<?php

namespace Application\Form;

use Zend\Form\Form;

class WorkTimeEntryForm extends Form
{
    public function __construct()
    {
        parent::__construct();
        
        $this->setInputFilter(new WorkTimeEntryFilter());
        $this->setHydrator(new \Zend\Stdlib\Hydrator\ClassMethods());
        
        $this->add(array(
            'name' => 'hours',
            'type' => 'Number',
            'options' => array(
                'label' => 'Liczba godzin',
                'label_attributes' => array(
                    'class' => 'control-label col-sm-2',
                ),
            ),
            'attributes' => array(
                'class' => 'form-control',
            ),
        ));
        
        $this->add(array(
            'name' => 'comment',
            'type' => 'Textarea',
            'options' => array(
                'label' => 'Komentarz',
                'label_attributes' => array(
                    'class' => 'control-label col-sm-2',
                ),
            ),
            'attributes' => array(
                'class' => 'form-control',
                'rows' => 5,
            ),
        ));
        
        $this->add(array(
            'name' => 'entryDate',
            'type' => 'DateTimeLocal',
            'options' => array(
                'label' => 'Data',
                'label_attributes' => array(
                    'class' => 'control-label col-sm-2',
                ),
            ),
            'attributes' => array(
                'class' => 'form-control',
            ),
        ));
    }
}