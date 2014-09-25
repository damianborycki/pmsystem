<?php
namespace Application\Form;

use Zend\InputFilter\InputFilter;

class WorkTimeEntryFilter extends InputFilter
{
    const CZAS_REGEXP = '/^[0-9]{1,4}-[0-9]{2}-[0-9]{2}T[0-9]{2}:[0-9]{2}$/';
    
    public function __construct()
    {
        $this->add(array(
            'name' => 'hours',
            'required' => true,
            'filters' => array(
                array(
                    'name' => 'Int',
                ),
            ),
            'validators' => array(
                array(
                    'name' => 'Digits',
                ),
            ),
        ));
        
        $this->add(array(
            'name' => 'comment',
            'required' => false,
            'filters' => array(
                array(
                    'name' => 'StringTrim',
                ),
            ),
        ));
        
        $this->add(array(
            'name' => 'entryDate',
            'required' => true,
            'filters' => array(
                array(
                    'name' => 'StringTrim',
                ),
            ),
            'validators' => array(
                array(
                    'name' => 'Regex',
                    'options' => array(
                        'pattern' => self::CZAS_REGEXP,
                    ),
                ),
            ),
        ));
    }
}