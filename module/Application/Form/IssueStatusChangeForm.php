<?php

namespace Application\Form;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\Adapter\Adapter;
use Zend\Form\Form;

class IssueStatusChangeForm extends Form {
	protected $adapter;
    public function __construct(AdapterInterface $dbAdapter, $memberStatus, $tracker, $currentStatus) {
    	$this->adapter =$dbAdapter;
        parent::__construct('issue');

        $this->setAttribute('method', 'post');

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
                'empty_option' => 'Zmień status',
                'value_options'    => $this->getIssueStatusForSelect($memberStatus, $tracker, $currentStatus),
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
    
    public function getIssueStatusForSelect($memberStatus, $tracker, $currentStatus)
    {
        $dbAdapter = $this->adapter;
        //$sql       = 'SELECT ID, NAME FROM ISSUESTATUS WHERE ISACTIVE = 1 ORDER BY POSITION ASC';
        $sql = 'SELECT ISSUESTATUS.ID, ISSUESTATUS.NAME FROM ISSUESTATUS, STATUSTRANSITION WHERE MEMBERROLEID = '.$memberStatus.' and TRACKERID = '.$tracker.' and STATUSTRANSITION.PREVSTATUSID = '. $currentStatus.' and STATUSTRANSITION.NEXTSTATUSID = ISSUESTATUS.ID
ORDER BY ID ASC';
        $statement = $dbAdapter->query($sql);
        $result    = $statement->execute();

        $selectData = array();

        foreach ($result as $res) {
            $selectData[$res['ID']] = $res['NAME'];
        }
        return $selectData;
    }
}
