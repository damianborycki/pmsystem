<?php

namespace Application\Form;

use Zend\Form\Form;

class CustomDictForm extends Form {
	public function __construct($name = null) {
		parent::__construct('customdicts');

		$this->setAttribute('method', 'post');
		$this->add(array(
				'name'       => 'name',
				'type'       => 'Zend\Form\Element\Text',
				'attributes' => array(
						'placeholder' => 'Priorytet',
						'required' => 'required',
				),
				'options' => array(
						'label' => 'Status',
				),
				)
			)	
	}
}
		