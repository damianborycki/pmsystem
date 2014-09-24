<?php

namespace Application\Form;

use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\Adapter\Adapter;
use Zend\Form\Form;

class ProjectForm extends Form {

    protected $adapter;

    public function __construct(AdapterInterface $dbAdapter) {
        $this->adapter = $dbAdapter;
        parent::__construct('project');

        $this->setAttribute('method', 'post');

        $this->add(array(
            'name' => 'name',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'id' => 'inputName',
                'type' => 'text',
                'class' => 'form-control',
                'required' => 'true',
                'placeholder' => 'Wpisz nazwę projektu'
            ),
            'options' => array(
                'label' => 'Nazwa',
                'label_attributes' => array(
                    'for' => 'inputName',
                    'class' => 'control-label'
                ),
            ),
        ));

        $this->add(array(
            'name' => 'description',
            'attributes' => array(
                'id' => 'inputDescription',
                'class' => 'form-control',
                'placeholder' => 'Dokładny opis projektu',
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
            'name' => 'identitier',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'id' => 'inputIdentitier',
                'type' => 'text',
                'class' => 'form-control',
                'required' => 'true',
                'placeholder' => 'Wpisz nazwę identitieru projektu'
            ),
            'options' => array(
                'label' => 'Identitier',
                'label_attributes' => array(
                    'for' => 'inputIdentitier',
                    'class' => 'control-label'
                ),
            ),
        ));

        $this->add(array(
            'name' => 'trackers',
            'type' => 'Zend\Form\Element\Select',
            'attributes' => array(
                'id' => 'inputTrackers',
                'type' => 'select',
                'class' => 'form-control',
                'required' => 'true'
            ),
            'options' => array(
                'label' => 'Trackers',
                'empty_option' => 'Wybierz Trackers',
                'label_attributes' => array(
                    'for' => 'inputTrackers',
                    'class' => 'col-sm-2 control-label'
                ),
                'value_options' => $this->getTrackersForSelect(),
            ),
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Hidden',
            'name' => 'projectStatus',
            'attributes' => array(
                'value' => '1'
            )
        ));

        $this->add(array(
            'name' => 'issuesCategorys',
            'type' => 'Zend\Form\Element\Select',
            'attributes' => array(
                'id' => 'inputCategorys',
                'type' => 'select',
                'class' => 'form-control',
                'required' => 'true'
            ),
            'options' => array(
                'label' => 'Kategoria',
                'empty_option' => 'Wybierz kategorię projektu',
                'label_attributes' => array(
                    'for' => 'inputCategorys',
                    'class' => 'col-sm-2 control-label'
                ),
                'value_options' => $this->getIssueCategorysForSelect(),
            ),
        ));

        $this->add(array(
            'name' => 'id',
            'attributes' => array(
                'type' => 'hidden'
            ),
        ));

        $this->add(array(
            'name' => 'issues',
            'type' => 'Zend\Form\Element\Select',
            'attributes' => array(
                'id' => 'inputIssues',
                'type' => 'select',
                'class' => 'form-control',
                'required' => 'true'
            ),
            'options' => array(
                'label' => 'Zadanie',
                'empty_option' => 'Wybierz zadanie',
                'label_attributes' => array(
                    'for' => 'inputIssues',
                    'class' => 'col-sm-2 control-label'
                ),
                'value_options' => $this->getIssueForSelect(),
            ),
        ));
    }

    public function getIssueCategorysForSelect() {
        $dbAdapter = $this->adapter;
        $sql = 'SELECT ID, NAME FROM ISSUECATEGORY ORDER BY ID ASC';
        $statement = $dbAdapter->query($sql);
        $result = $statement->execute();

        $selectData = array();

        foreach ($result as $res) {
            $selectData[$res['ID']] = $res['NAME'];
        }
        return $selectData;
    }

    public function getIssueForSelect() {
        $dbAdapter = $this->adapter;
        $sql = 'SELECT ID, NAME FROM ISSUE ORDER BY ID ASC';
        $statement = $dbAdapter->query($sql);
        $result = $statement->execute();

        $selectData = array();

        foreach ($result as $res) {
            $selectData[$res['ID']] = $res['NAME'];
        }
        return $selectData;
    }

    public function getTrackersForSelect() {
        $dbAdapter = $this->adapter;
        $sql = 'SELECT ID, NAME FROM TRACKER ORDER BY ID ASC';
        $statement = $dbAdapter->query($sql);
        $result = $statement->execute();

        $selectData = array();

        foreach ($result as $res) {
            $selectData[$res['ID']] = $res['NAME'];
        }
        return $selectData;
    }

}
