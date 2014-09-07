<?php

namespace Application\Form;

use Zend\Form\Form;

class IssueForm extends Form {
    public function __construct($name = null) {
        parent::__construct('issue');

        $this->setAttribute('method', 'post');

        $this->add(array(
            'name'       => 'id',
            'attributes' => array(
                'type'  => 'hidden'
            ),
        ));

        $this->add(array(
            'name'       => 'project',
            'type'       => 'Zend\Form\Element\Select',
            'attributes' => array(
                'id'       => 'inputProject',
                'type'     => 'select',
                'class'    => 'form-control',
                'required' => 'true'
            ),
            'options'    => array(
                'label'            => 'Projekt',
                'label_attributes' => array(
                    'for'   => 'inputProject',
                    'class' => 'col-sm-2 control-label'
                ), # TODO: Trzeba zaimplementowac mapowanie projektow jak juz ta funkcjonalnosc bedzie gotowa
                'value_options'    => array(
                    '1' => 'projekt 1',
                    '2' => 'projekt 2',
                    '3' => 'projekt 3',
                    '4' => 'projekt 4'
                )
            ),
        ));

        $this->add(array(
            'name'       => 'description',
            'attributes' => array(
                'id'          => 'inputDescription',
                'class'       => 'form-control',
                'placeholder' => 'Dokładny opis dodawanego zadania',
                'rows'        => '5',
                'required'    => 'true'
            ),
            'options'    => array(
                'label'            => 'Dokładny opis',
                'label_attributes' => array(
                    'for'   => 'inputDescription',
                    'class' => 'col-sm-2 control-label'
                ),
            ),
        ));

        $this->add(array(
            'name'       => 'subject',
            'type'       => 'Zend\Form\Element\Select',
            'attributes' => array(
                'id'       => 'inputSubject',
                'type'     => 'select',
                'class'    => 'form-control',
                'required' => 'true'
            ),
            'options'    => array(
                'label'            => 'Typ Zadania',
                'label_attributes' => array(
                    'for'   => 'inputSubject',
                    'class' => 'col-sm-2 control-label'
                ),
                'value_options'    => array(
                    'task'          => 'Zadanie',
                    'external_task' => 'Zewnętrzne zadanie',
                    'bug'           => 'Bug',
                    'requirement'   => 'Wymaganie',
                    'request'       => 'Żądanie',
                    'fix'           => 'Poprawka',
                    'event'         => 'Wydarzenie',
                    'client'        => 'Klient'
                )
            ),
        ));

        $this->add(array(
            'name'       => 'issuePriority',
            'type'       => 'Zend\Form\Element\Select',
            'attributes' => array(
                'id'       => 'inputPriority',
                'type'     => 'select',
                'class'    => 'form-control',
                'required' => 'true'
            ),
            'options'    => array(
                'label'            => 'Priorytet',
                'label_attributes' => array(
                    'for'   => 'inputPriority',
                    'class' => 'col-sm-2 control-label'
                ), #TODO: z tego co widac to prioryety beda zapisane w bazie, trzeba zaimplementowac mapowanie
                'value_options'    => array(
                    '1' => 'Blocker',
                    '2' => 'Krytyczny',
                    '3' => 'Wysoki',
                    '4' => 'Normalny',
                    '5' => 'Niski',
                    '6' => 'Bardzo niski'
                )
            ),
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
