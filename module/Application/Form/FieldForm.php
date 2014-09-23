<?php

namespace Application\Form;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\Adapter\Adapter;
use Zend\Form\Form;

class FieldForm extends Form {
	protected $adapter;
    public function __construct(AdapterInterface $dbAdapter) {
    	$this->adapter =$dbAdapter;
        parent::__construct('field');

        $this->setAttribute('method', 'post');

        $this->add(array(
            'name'       => 'id',
            'attributes' => array(
                'type'  => 'hidden'
            ),
        ));

        $this->add(array(
            'name'       => 'name',
            'type'       => 'Zend\Form\Element\Text',
            'attributes' => array(
                'id'       => 'inputName',
                'type'     => 'text',
                'class'    => 'form-control',
                'required' => 'true',
                'placeholder' => 'Wpisz nazwę pola'
            ),
            'options'    => array(
                'label'            => 'Nazwa',
                'label_attributes' => array(
                    'for'   => 'inputName',
                    'class' => 'control-label'
                ), 
            ),
        ));

        $this->add(array(
            'name'       => 'minValue',
            'type'       => 'Zend\Form\Element\Text',
            'attributes' => array(
                'id'       => 'inputMinValue',
                'type'     => 'text',
                'class'    => 'form-control',
                'required' => 'true',
                'value'    => '0'
            ),
            'options'    => array(
                'label'            => 'Wartość minimalna',
                'label_attributes' => array(
                    'for'   => 'inputMinValue',
                    'class' => 'control-label'
                ),
            ),
        ));

        $this->add(array(
            'name'       => 'maxValue',
            'type'       => 'Zend\Form\Element\Text',
            'attributes' => array(
                'id'       => 'inputMaxValue',
                'type'     => 'text',
                'class'    => 'form-control',
                'required' => 'true',
                'value'    => '0'

            ),
            'options'    => array(
                'label'            => 'Wartość maksymalna',
                'label_attributes' => array(
                    'for'   => 'inputMaxValue',
                    'class' => 'control-label'
                ),
            ),
        ));

        $this->add(array(
            'name'       => 'defaultValue',
            'type'       => 'Zend\Form\Element\Text',
            'attributes' => array(
                'id'       => 'inputDefaultValue',
                'type'     => 'text',
                'class'    => 'form-control',
                'required' => 'false',
                'placeholder'    => 'Wpisz wartość domyślną pola'
            ),
            'options'    => array(
                'label'            => 'Wartość domyślna',
                'label_attributes' => array(
                    'for'   => 'inputDefaultValue',
                    'class' => 'control-label'
                ),
            ),
        ));

        $this->add(array(
            'name'       => 'regex',
            'type'       => 'Zend\Form\Element\Text',
            'attributes' => array(
                'id'       => 'inputRegex',
                'type'     => 'text',
                'class'    => 'form-control',
                'required' => 'false',
                'placeholder'    => 'Wpisz wyrażenie regularne'
            ),
            'options'    => array(
                'label'            => 'Wyrażenie regularne',
                'label_attributes' => array(
                    'for'   => 'inputRegex',
                    'class' => 'control-label'
                ),
            ),
        ));

        $this->add(array(
            'name'       => 'types',
            'type'       => 'Zend\Form\Element\Select',
            'attributes' => array(
                'id'       => 'inputType',
                'type'     => 'select',
                'class'    => 'form-control',
                'required' => 'true'
            ),
            'options'    => array(
                'label'            => 'Typ pola',
                'label_attributes' => array(
                    'for'   => 'inputType',
                    'class' => 'control-label'
                ),
                'value_options'    => array(
                    'text'          => 'Tekst',
                    'number' => 'Liczba',
                    'list'           => 'Lista wartości',
                    'bool'   => 'Tak/Nie',
                )
            ),
        ));

        $this->add(array(
            'name'       => 'submit',
            'attributes' => array(
                'type'  => 'submit',
                'value' => 'Zapisz'
            ),
        ));
    }

    public function setProjectsList ($projectsList) {
        $this->add(array(
            'type' => 'Zend\Form\Element\MultiCheckbox',
            'name' => 'projects',
            'attributes' => array(
                'id'       => 'inputProjects',
                'type'     => 'select',
                'required' => 'false'
            ),
            'options' => array(
                'label' => 'Przypisz pole do',
                'label_attributes' => array(
                    'for'   => 'inputProjects',
                    'class' => 'checkbox'
                ),
                'value_options' => $projectsList
            )
        ));
    }
}
