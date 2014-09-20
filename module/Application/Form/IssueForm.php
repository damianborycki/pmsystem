<?php

namespace Application\Form;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\Adapter\Adapter;
use Zend\Form\Form;

class IssueForm extends Form {
	protected $adapter;
    public function __construct(AdapterInterface $dbAdapter) {
    	$this->adapter =$dbAdapter;
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
                ), 
                'value_options' => $this->getOptionsForSelect(),
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
                    'Task'          => 'Zadanie',
                    'External' => 'Zewnętrzne zadanie',
                    'Bug'           => 'Bug',
                    'Requirement'   => 'Wymaganie',
                    'Request'       => 'Żądanie',
                    'Fix'           => 'Poprawka',
                    'Event'         => 'Wydarzenie',
                    'Client'        => 'Klient'
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
            'name'       => 'issueStatus',
            'type'       => 'Zend\Form\Element\Select',
            'attributes' => array(
                'id'       => 'inputStatus',
                'type'     => 'select',
                'class'    => 'form-control',
                'required' => 'true'
            ),
            'options'    => array(
                'label'            => 'Status',
                'label_attributes' => array(
                    'for'   => 'inputPriority',
                    'class' => 'col-sm-2 control-label'
                ),
                'value_options'    => array(
                    '1' => 'Nowy'
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
    
    public function getOptionsForSelect()
    {
        $dbAdapter = $this->adapter;
        $sql       = 'SELECT ID, NAME FROM PROJECT ORDER BY ID ASC';
        $statement = $dbAdapter->query($sql);
        $result    = $statement->execute();

        $selectData = array();

        foreach ($result as $res) {
            $selectData[$res['ID']] = $res['NAME'];
        }
        return $selectData;
    }
}
