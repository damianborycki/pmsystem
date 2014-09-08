<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;

class FieldsPermissionController extends AbstractActionController {
    /**
     * Constructor.
     *
     * @access public
     */
    public function __construct($ProjectId=null)
    {
    }
	
	public function fieldsPermissionAction(){
		return;
	}

    /**
     * Prawa do danego pola przy zadanej kombinacji typu zadania, stanu zadania i roli usera.
     *
     * @access public
     * 
     * @param int $taskType typ taska
     * @param int $taskState stan taska
     * @param int $userRole rola usera - w postaci id ze slownika
     * @param int $fieldId id pola do wypelnienia
     * 
     * @return int flaga prawa do pola
     */
    public function getFieldPermission($taskType, $taskState, $userRole, $fieldId)
    {
    }

    /**
     * Dodawanie nowego prawa (dla nowych stanow, nowych rol, etc.
     *
     * @access public
     * 
     * @param int $taskType typ taska
     * @param int $taskState stan taska
     * @param int $userRole rola usera - w postaci id ze slownika
     * @param int $fieldId id pola do wypelnienia
     * @param int $permission flaga prawa, jakie ma nadane podane pole przy podanej konfiguracji
     */
    public function addNewPermission($taskType, $taskState, $userRole, $fieldId, $permission)
    {
        
//       TEST SZYMON
        
    }

    /**
     * Zapytanie o wszystkie obowiazkowe pola dla danego typu i stanu zadania, oraz dla danej roli pytajacego usera.
     *
     * @access public
     * 
     * @param int $taskType typ taska
     * @param int $taskState stan taska
     * @param int $userRole rola usera - w postaci id ze slownika
     * 
     * @return int[] tablica z ID wszystkich pol obowiazowych (tzn ktore user musi wypelnic)
     */
    public function getRequiredFields($taskType, $taskState, $userRole)
    {
    }

    /**
     * Zapytanie o wszystkie pola, ktore user tylko widzi,
     * a ktorych nie moze edytowac - dla danego typu i stanu zadania, oraz dla danej roli pytajacego usera.
     *
     * @access public
     * 
     * @param int $taskType typ taska
     * @param int $taskState stan taska
     * @param int $userRole rola usera - w postaci id ze slownika
     * 
     * @return int[] tablica z ID wszystkich pol obowiazowych (tzn ktore user musi wypelnic)
     */
    public function getReadOnlyFields($taskType, $taskState, $userRole)
    {
    }
}