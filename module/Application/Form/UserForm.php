<?php

namespace Application\Form;

use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\Adapter\Adapter;
use Zend\Form\Form;

class UserForm extends Form {

    protected $adapter;

    public function __construct(AdapterInterface $dbAdapter) {
        $this->adapter = $dbAdapter;
        parent::__construct('user');

        $this->setAttribute('method', 'post');


        $this->add(array(
            'name' => 'login',
            'attributes' => array(
                'id' => 'inputLogin',
                'class' => 'form-control',
                'placeholder' => 'Login',
                'rows' => '5',
                'required' => 'true'
            ),
            'options' => array(
                'label' => 'Login',
                'label_attributes' => array(
                    'for' => 'inputLogin',
                    'class' => 'col-sm-2 control-label'
                ),
            ),
        ));

        $this->add(array(
            'name' => 'hashedPassword',
            'attributes' => array(
                'id' => 'inputHashedPassword',
                'class' => 'form-control',
                'placeholder' => 'Hasło',
                'rows' => '5',
                'required' => 'true'
            ),
            'options' => array(
                'label' => 'Hasło',
                'label_attributes' => array(
                    'for' => 'inputHashedPassword',
                    'class' => 'col-sm-2 control-label'
                ),
            ),
        ));

        $this->add(array(
            'name' => 'salt',
            'attributes' => array(
                'id' => 'inputSalt',
                'class' => 'form-control',
                'placeholder' => 'Salt',
                'rows' => '5',
                'required' => 'true'
            ),
            'options' => array(
                'label' => 'Salt',
                'label_attributes' => array(
                    'for' => 'inputSalt',
                    'class' => 'col-sm-2 control-label'
                ),
            ),
        ));

        $this->add(array(
            'name' => 'firstName',
            'attributes' => array(
                'id' => 'inputFirstName',
                'class' => 'form-control',
                'placeholder' => 'Imie',
                'rows' => '5',
                'required' => 'true'
            ),
            'options' => array(
                'label' => 'Imie',
                'label_attributes' => array(
                    'for' => 'inputFirstName',
                    'class' => 'col-sm-2 control-label'
                ),
            ),
        ));

        $this->add(array(
            'name' => 'lastName',
            'attributes' => array(
                'id' => 'inputLastName',
                'class' => 'form-control',
                'placeholder' => 'Nazwisko',
                'rows' => '5',
                'required' => 'true'
            ),
            'options' => array(
                'label' => 'Nazwisko',
                'label_attributes' => array(
                    'for' => 'inputLastName',
                    'class' => 'col-sm-2 control-label'
                ),
            ),
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Email',
            'name' => 'email',
            'options' => array(
                'label' => 'Email Address'
            ),
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\MultiCheckbox',
            'name' => 'isAdmin',
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
            'name' => 'users',
            'type' => 'Zend\Form\Element\Select',
            'attributes' => array(
                'id' => 'inputUsers',
                'type' => 'select',
                'class' => 'form-control',
                'required' => 'true'
            ),
            'options' => array(
                'label' => 'Użytkownicy',
                'empty_option' => 'Wybierz użytkownika',
                'label_attributes' => array(
                    'for' => 'inputUsers',
                    'class' => 'col-sm-2 control-label'
                ),
                'value_options' => $this->getUsersForSelect(),
            ),
        ));

        $this->add(array(
            'name' => 'id',
            'attributes' => array(
                'type' => 'hidden'
            ),
        ));
    }

    public function getUsersForSelect() {
        $dbAdapter = $this->adapter;
        $sql = 'SELECT ID, NAME FROM USER ORDER BY ID ASC';
        $statement = $dbAdapter->query($sql);
        $result = $statement->execute();

        $selectData = array();

        foreach ($result as $res) {
            $selectData[$res['ID']] = $res['NAME'];
        }
        return $selectData;
    }

}
