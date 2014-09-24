<?php

namespace Application\Form;

use Zend\Form\Form;

class ProjectStatusForm extends Form {

    public function __construct($name = null) {
        parent::__construct('projectstatus');

        $this->setAttribute('method', 'post');


        $this->add(array(
            'name' => 'code',
            'attributes' => array(
                'id' => 'inputCode',
                'class' => 'form-control',
                'placeholder' => 'Dokładny opis kodu',
                'rows' => '5',
                'required' => 'true'
            ),
            'options' => array(
                'label' => 'Dokładny opis',
                'label_attributes' => array(
                    'for' => 'inputCode',
                    'class' => 'col-sm-2 control-label'
                ),
            ),
        ));

        $this->add(array(
            'name' => 'name',
            'attributes' => array(
                'id' => 'inputName',
                'class' => 'form-control',
                'placeholder' => 'Dokładny opis nazwy',
                'rows' => '5',
                'required' => 'true'
            ),
            'options' => array(
                'label' => 'Dokładny opis',
                'label_attributes' => array(
                    'for' => 'inputName',
                    'class' => 'col-sm-2 control-label'
                ),
            ),
        ));

        $this->add(array(
            'name' => 'value',
            'attributes' => array(
                'id' => 'inputValue',
                'class' => 'form-control',
                'placeholder' => 'Dokładny opis wartości',
                'rows' => '5',
                'required' => 'true'
            ),
            'options' => array(
                'label' => 'Dokładny opis',
                'label_attributes' => array(
                    'for' => 'inputValue',
                    'class' => 'col-sm-2 control-label'
                ),
            ),
        ));

        $this->add(array(
            'name' => 'position',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'id' => 'inputPosition',
                'type' => 'text',
                'class' => 'form-control',
                'required' => 'true',
                'value' => '0'
            ),
            'options' => array(
                'label' => 'Pozycja',
                'label_attributes' => array(
                    'for' => 'inputPosition',
                    'class' => 'control-label'
                ),
            ),
        ));

        $this->add(array(
            'name' => 'description',
            'attributes' => array(
                'id' => 'inputDescription',
                'class' => 'form-control',
                'placeholder' => 'Dokładny opis statusu',
                'rows' => '5',
                'required' => 'true'
            ),
            'options' => array(
                'label' => 'Dokładny opis',
                'label_attributes' => array(
                    'for' => 'inputDescription',
                    'class' => 'col-sm-2 control-label'
                ),
            ),
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\MultiCheckbox',
            'name' => 'isDefault',
            'options' => array(
                'value_options' => array(
                    '1' => ''
                ),
            ),
            'attributes' => array(
                'value' => '0', //set checked to '1'
                'uncheckedValue' => '0'
            )
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\MultiCheckbox',
            'name' => 'isActive',
            'options' => array(
                'value_options' => array(
                    '1' => ''
                ),
            ),
            'attributes' => array(
                'value' => '0', //set checked to '1'
                'uncheckedValue' => '0'
            )
        ));

        $this->add(array(
            'name' => 'id',
            'attributes' => array(
                'type' => 'hidden'
            ),
        ));
    }

}
