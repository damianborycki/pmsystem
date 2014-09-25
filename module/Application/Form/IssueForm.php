<?php

namespace Application\Form;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\Adapter\Adapter;
use Zend\Form\Form;

class IssueForm extends Form {
	protected $adapter;
    public function __construct(AdapterInterface $dbAdapter, $projectId, $additionalFields = array()) {
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
            'name'       => 'project',
            'type'       => 'Zend\Form\Element\Select',
            'attributes' => array(
                'id'       => 'inputProject',
                'type'     => 'select',
                'class'    => 'form-control',
                'required' => 'true',
                'value'        => $projectId,
            ),
            'options'    => array(
                'label'            => 'Projekt',
                'label_attributes' => array(
                    'for'   => 'inputProject',
                    'class' => 'col-sm-2 control-label'
                ),
                'value_options' => $this->getProjectsNameForSelect(),
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
            'attributes' => array(
                'id'          => 'inputSubject',
                'class'       => 'form-control',
                'placeholder' => 'Temat zadania',
                'rows'        => '1',
                'required'    => 'true'
            ),
            'options'    => array(
                'label'            => 'Temat',
                'label_attributes' => array(
                    'for'   => 'inputSubject',
                    'class' => 'col-sm-2 control-label'
                ),
            ),
        ));

        $this->add(array(
            'name'       => 'issueTracker',
            'type'       => 'Zend\Form\Element\Select',
            'attributes' => array(
                'id'       => 'inputTracker',
                'type'     => 'select',
                'class'    => 'form-control',
                'required' => 'true',
                'value'        => $this->getDefault('TRACKER')
            ),
            'options'    => array(
                'label'            => 'Typ Zadania',
                'label_attributes' => array(
                    'for'   => 'inputTracker',
                    'class' => 'col-sm-2 control-label'
                ),
                'value_options'    => $this->getArrayForSelect('TRACKER'),
            ),
        ));

        $this->add(array(
            'name'       => 'issueStatus',
            'type'       => 'Zend\Form\Element\Select',
            'attributes' => array(
                'id'       => 'inputStatus',
                'type'     => 'select',
                'class'    => 'form-control',
                'required' => 'true',
                'value'        => $this->getDefault('ISSUESTATUS')
            ),
            'options'    => array(
                'label'            => 'Status Zadania',
                'label_attributes' => array(
                    'for'   => 'inputStatus',
                    'class' => 'col-sm-2 control-label'
                ),
                'value_options'    => $this->getArrayForSelect('ISSUESTATUS'),
            ),
        ));

        $this->add(array(
            'name'       => 'issuePriority',
            'type'       => 'Zend\Form\Element\Select',
            'attributes' => array(
                'id'       => 'inputPriority',
                'type'     => 'select',
                'class'    => 'form-control',
                'required' => 'true',
                'value'        => $this->getDefault('ISSUEPRIORITY')
            ),
            'options'    => array(
                'label'            => 'Priorytet',
                'label_attributes' => array(
                    'for'   => 'inputPriority',
                    'class' => 'col-sm-2 control-label'
                ),
                'value_options'    => $this->getArrayForSelect('ISSUEPRIORITY'),
            ),
        ));

        $this->add(array(
            'name'       => 'issueAssigned',
            'type'       => 'Zend\Form\Element\Select',
            'attributes' => array(
                'id'       => 'inputAssigned',
                'type'     => 'select',
                'class'    => 'form-control',
                'required' => 'true'
            ),
            'options'    => array(
                'label'            => 'Przypisz do:',
                'label_attributes' => array(
                    'for'   => 'inputTracker',
                    'class' => 'col-sm-2 control-label'
                ),
                'empty_option' => 'Przypisz do użytkownika',
                'value_options'    => $this->getIssueAssignedForSelect(),
            ),
        ));
		
      
        foreach ($additionalFields as $field) {
        	$this->add(array(
	            'name'       => $field->getName(),
	            'attributes' => array(
	                'class'       => 'form-control',
	                'placeholder' => $field->getName(),
	            ),
	            'options'    => array(
	                'label'            => $field->getName(),
	                'label_attributes' => array(
	                    'class' => 'col-sm-2 control-label'
	                ),
	                'value' => $field->getDefaultValue()
	            ),
	        ));
        }
        
        $this->add(array(
            'name'       => 'submit',
            'attributes' => array(
                'type'  => 'submit',
                'value' => 'Dodaj zadanie'
            ),
        )); 
    }
    
    public function getProjectsNameForSelect()
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
    
    public function getIssueAssignedForSelect()
    {
        $dbAdapter = $this->adapter;
        $sql       = 'SELECT m.ID, u.FIRSTNAME, u.LASTNAME FROM MEMBER m JOIN USER u ON m.USERID = u.ID WHERE m.PROJECTID = 1 ORDER BY m.ID ASC';
        $statement = $dbAdapter->query($sql);
        $result    = $statement->execute();

        $selectData = array();

        foreach ($result as $res) {
            $selectData[$res['ID']] = $res['FIRSTNAME'] . ' ' . $res['LASTNAME'];
            //Przydało by się aby ta tablica posiadała Imiona i Nazwiska a nie ID'ki userów...
        }
        return $selectData;
    }

    public function getArrayForSelect($table)
    {
        $dbAdapter = $this->adapter;
        $sql       = 'SELECT ID, NAME FROM '.$table.' ORDER BY POSITION ASC';
        $statement = $dbAdapter->query($sql);
        $result    = $statement->execute();

        $selectData = array();

        foreach ($result as $res) {
            $selectData[$res['ID']] = $res['NAME'];
        }
        return $selectData;
    }


    public function getDefault($table)
    {
        $dbAdapter = $this->adapter;
        $sql       = 'SELECT ID, NAME, ISDEFAULT FROM '.$table.' ORDER BY ID ASC';
        $statement = $dbAdapter->query($sql);
        $result    = $statement->execute();


        foreach ($result as $res) {
            if($res['ISDEFAULT'] == 1){
                $returnData = $res['ID'];
            }
        }
        return $returnData;
    }
}
