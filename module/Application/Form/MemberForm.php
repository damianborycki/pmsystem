<?php

namespace Application\Form;

use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\Adapter\Adapter;
use Zend\Form\Form;

class MemberForm extends Form {

    protected $adapter;

    public function __construct(AdapterInterface $dbAdapter) {
        $this->adapter = $dbAdapter;
        parent::__construct('member');

        $this->add(array(
            'type' => 'Zend\Form\Element\Hidden',
            'name' => 'project',
            'attributes' => array(
                'value' => '1'
            )
        ));
        $this->add(array(
            'type' => 'Zend\Form\Element\Hidden',
            'name' => 'user',
            'attributes' => array(
                'value' => '1'
            )
        ));
        $this->add(array(
            'name' => 'memberRoles',
            'type' => 'Zend\Form\Element\Select',
            'attributes' => array(
                'id' => 'inputMemberRoles',
                'type' => 'select',
                'class' => 'form-control',
                'required' => 'true'
            ),
            'options' => array(
                'label' => 'Role użytkownika',
                'empty_option' => 'Wybierz role',
                'label_attributes' => array(
                    'for' => 'inputMemberRoles',
                    'class' => 'col-sm-2 control-label'
                ),
                'value_options' => $this->getMemberRolesForSelect(),
            ),
        ));

        $this->add(array(
            'name' => 'id',
            'attributes' => array(
                'type' => 'hidden'
            ),
        ));
    }

    public function getMemberRolesForSelect() {
        $dbAdapter = $this->adapter;
        $sql = 'SELECT ID, NAME FROM MEMBERROLES ORDER BY ID ASC';
        $statement = $dbAdapter->query($sql);
        $result = $statement->execute();

        $selectData = array();

        foreach ($result as $res) {
            $selectData[$res['ID']] = $res['NAME'];
        }
        return $selectData;
    }

}
