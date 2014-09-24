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
                'required' => true,
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
                'required' => true,
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
                'required' => true,
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
                'required' => false,
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
                'required' => false,
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
                )
            ),
        ));

        $this->add(array(
            'name'       => 'regex',
            'type'       => 'Zend\Form\Element\Text',
            'attributes' => array(
                'id'       => 'inputRegex',
                'type'     => 'text',
                'class'    => 'form-control',
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
            'name'       => 'isRequired',
            'type'       => 'Zend\Form\Element\Checkbox',
            'attributes' => array(
                'id'       => 'inputIsRequired',
            ),
            'options'    => array(
                'label'            => 'Czy jest wymagane',
                'label_attributes' => array(
                    'for'   => 'inputIsRequired',
                    'class' => 'checkbox'
                ),
            ),
        ));

        $this->add(array(
            'name'       => 'isFilter',
            'type'       => 'Zend\Form\Element\Checkbox',
            'attributes' => array(
                'id'       => 'inputIsFilter',
            ),

            'options'    => array(
                'label'            => 'Czy jest filtrem',
                'label_attributes' => array(
                    'for'   => 'inputIsFilter',
                    'class' => 'checkbox'
                ),
            ),
        ));

        $this->add(array(
            'name'       => 'isForAll',
            'type'       => 'Zend\Form\Element\Checkbox',
            'attributes' => array(
                'id'       => 'inputIsForAll',
            ),
            'options'    => array(
                'label'            => 'Czy jest dla wszystkich',
                'label_attributes' => array(
                    'for'   => 'inputIsForAll',
                    'class' => 'checkbox'
                ),
            ),
        ));

        $this->add(array(
            'name'       => 'isHidden',
            'type'       => 'Zend\Form\Element\Checkbox',
            'attributes' => array(
                'id'       => 'inputIsHidden',
            ),
            'options'    => array(
                'label'            => 'Czy jest ukryte',
                'label_attributes' => array(
                    'for'   => 'inputIsHidden',
                    'class' => 'checkbox'
                ),
            ),
        ));
    }

    public function setProjectsList ($projectsList) {
        $this->add(array(
            'type' => 'Zend\Form\Element\MultiCheckbox',
            'name' => 'projects',
            'required' => false,
            'attributes' => array(
                'id'       => 'inputProjects',
            ),
            'options' => array(
                'label' => 'Przypisz do projektu',
                'label_attributes' => array(
                    'for'   => 'inputProjects',
                    'class' => 'checkbox col-md-4'
                ),
                'value_options' => $projectsList
            )
        ));
    }

    public function setTrackersList ($trackersList) {
        $this->add(array(
            'type' => 'Zend\Form\Element\MultiCheckbox',
            'name' => 'trackers',
            'required' => false,
            'attributes' => array(
                'id'       => 'inputTrackers',
            ),
            'options' => array(
                'label' => 'Przypisz do trackerów',
                'label_attributes' => array(
                    'for'   => 'inputTrackers',
                    'class' => 'checkbox col-md-4'
                ),
                'value_options' => $trackersList
            )
        ));
    }
}
