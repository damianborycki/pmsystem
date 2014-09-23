<?php

namespace Application\Form;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\Adapter\Adapter;
use Zend\Form\Form;

class IssueStatusChangeForm extends Form {
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
             'type' => 'Zend\Form\Element\Hidden',
             'name' => 'User',
             'attributes' => array(
                     'value' => '1'
             )
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
                'label'            => 'Priorytet',
                'empty_option' => 'Zmień status',
                'value_options'    => $this->getIssueStatusForSelect(),
            ),
        ));


        $this->add(array(
            'name'       => 'submit',
            'attributes' => array(
                'type'  => 'submit',
                'value' => 'Zmień status'
            ),
        )); 
    }
    
    public function getIssueStatusForSelect()
    {
    	return;
        $dbAdapter = $this->adapter;
        $sql       = 'SELECT ID, NAME FROM ISSUESTATUS ORDER BY ID ASC';
        $statement = $dbAdapter->query($sql);
        $result    = $statement->execute();

        $selectData = array();

        foreach ($result as $res) {
            $selectData[$res['ID']] = $res['NAME'];
        }
        return $selectData;
    }
}
