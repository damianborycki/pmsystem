<?php

return array(
    'controllers' => array(
        'invokables' => array(
            /* generator-begin-controllers.invokables */
            'Application\Controller\Index' => 'Application\Controller\IndexController',
            'Application\Controller\Issues' => 'Application\Controller\IssuesController',
            'Application\Controller\Project' => 'Application\Controller\ProjectController',
            'Application\Controller\Fields' => 'Application\Controller\FieldsController',
			'Application\Controller\FieldsPermission' => 'Application\Controller\FieldsPermissionController',
			'Application\Controller\StatusTransition' => 'Application\Controller\StatusTransitionController',
			'Application\Controller\IssueStatus' => 'Application\Controller\IssueStatusController',
            'Application\Controller\Enumeration' => 'Application\Controller\EnumerationController',
        	'Application\Controller\CustomDict' => 'Application\Controller\CustomDictController',
        	'Application\Controller\Tracker' => 'Application\Controller\TrackerController',
            'Application\Controller\UserAssignment' => 'Application\Controller\UserAssignmentController'
            /* generator-end-controllers.invokables */
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../View'
        ),
        'strategies' => array(
            'ViewJsonStrategy',
        ),
        'display_not_found_reason' => true,
        'display_exceptions' => true,
        'doctype' => 'HTML5',
        'not_found_template' => 'error/404',
        'not_found_layout' => 'layout/blank',
        'exception_template' => 'error/index',
        'template_map' => array(
            'layout/layout' => __DIR__ . '/../../Application/View/Layout/angular_layout.phtml',
            'error/index' => __DIR__ . '/../../Application/View/Error/index.phtml',
            'error/404' => __DIR__ . '/../../Application/View/Error/404.phtml'
        ),
    ),
    'service_manager' => array(
        'abstract_factories' => array(
        ),
        'factories' => array(
            'translator' => 'Zend\I18n\Translator\TranslatorServiceFactory',
        ),
        'invokables' => array(
            // FINDERS
            /* generator-begin-servicemanager.invokables.finders */
            /* generator-end-servicemanager.invokables.finders */


            // APPLICATION SERVICES      
            /* generator-begin-servicemanager.invokables.applicationservices */
            /* generator-end-servicemanager.invokables.applicationservices */


            // COMMANDS
            /* generator-begin-servicemanager.invokables.commands */
            /* generator-end-servicemanager.invokables.commands */

            // DTOs
            /* generator-begin-servicemanager.invokables.dtos */
            /* generator-end-servicemanager.invokables.dtos */
        ),
    ),
    'router' => array(
        'routes' => array(
            /**
             * SCIEZKA DO HOME
             */
            'home' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Index',
                        'action' => 'index'
                    )
                ),
            ),
            /**
             * SCIEZKA DO KONKRETNEGO PROJEKTU
             */
            'ShowProject' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/[:project]/',
                    'constraints' => array(
                        'project' => '[0-9]*',
                    ),
                    'defaults' => array(
                        'controller' => 'Application\Controller\Project',
                        'action' => 'show'
                    )
                ),
            ),

			/**
             * SCIEZKA DO DODAWANIA PROJEKTU
             */
            'AddProject' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/add_project/',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Project',
                        'action' => 'add'
                    )
                ),
            ),

			/**
             * SCIEZKA DO LISTY PROJEKTÓW
             */
            'ListProjects' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/projects/',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Project',
                        'action' => 'list'
                    )
                ),
            ),
			

            /**
             * SCIEZKA DO LISTY ZAGADNIEn
             */
            'IssueList' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/[:project]/issues',
            		'constraints' => array(
                        'project' => '[0-9]*',
                    ),
                    'defaults' => array(
                        'controller' => 'Application\Controller\Issues',
                        'action' => 'list'
                    )
                ),
            ),

            /**
             * SCIEZKA DO DODAWANIA ZAGADNIEĹ�
             */
            'AddIssue' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/[:project]/issues/add',
                    'constraints' => array(
                        'project' => '[0-9]*',
                    ),
                    'defaults' => array(
                        'controller' => 'Application\Controller\Issues',
                        'action' => 'add'
                    )
                ),
            ),

            /**
             * SCIEZKA DO KONKRETNEGO ZAGADNIENIA
             */
            'ShowIssue' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/issue/[:id]',
                    'constraints' => array(
                        'id' => '[0-9]*',
                    ),
                    'defaults' => array(
                        'controller' => 'Application\Controller\Issues',
                        'action' => 'show'
                    )
                ),
            ),


            /**
             * SCIEZKA DO EDYCJI KONKRETNEGO ZAGADNIENIA
             */
            'EditIssue' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/issue/[:id]/edit',
                    'constraints' => array(
                        'id' => '[0-9]*',
                    ),
                    'defaults' => array(
                        'controller' => 'Application\Controller\Issues',
                        'action' => 'edit'
                    )
                ),
            ),

            'AssignUser' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/issue/[:id]/assignuser',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Issues',
                        'action' => 'assignUser'
                    )
                ),
            ),
			
            /**
             * SCIEZKA DO ZMIANY STATUSU KONKRETNEGO ZAGADNIENIA
             */
            'IssueStatusChange' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/issue/[:id]/statusChange',
                    'constraints' => array(
                        'id' => '[0-9]*',
                    ),
                    'defaults' => array(
                        'controller' => 'Application\Controller\Issues',
                        'action' => 'statusChange'
                    )
                ),
            ),
            
            /**
             * SCIEZKA DO STWORZENIA PODZADANIA
             */
            'AddChildIssue' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/[:project]/issue/[:id]/child/add',
                    'constraints' => array(
                        'project' => '[0-9]*',
                        'id' => '[0-9]*',
                    ),
                    'defaults' => array(
                        'controller' => 'Application\Controller\Issues',
                        'action' => 'add'
                    )
                ),
            ),
            
            /**
             * SCIEZKA DO LISTY CUSTOM FIELDOW
             */
            'FieldsList' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/fields',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Fields',
                        'action' => 'list'
                    )
                ),
            ),

            /**
             * SCIEZKA DO DODAWANIA CUSTOM FIELDOW
             */
            'AddField' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/fields/add',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Fields',
                        'action' => 'add'
                    )
                ),
            ),

            /**
             * SCIEZKA DO ZMIANY STATUSU KONKRETNEGO ZAGADNIENIA
             */
            'RemoveField' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/fields/remove/[:id]',
                    'constraints' => array(
                        'id' => '[0-9]*',
                    ),
                    'defaults' => array(
                        'controller' => 'Application\Controller\Fields',
                        'action' => 'remove'
                    )
                ),
            ),
            
             /**
             * SCIEZKA DO INDEX PRIORYTETÓW ZAGADNIEĹ� ++
             */
            'IssuePriority' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '[:project]/issuecpriority/index',
                    'constraints' => array(
                        'project' => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ),
                    'defaults' => array(
                        'controller' => 'Application\Controller\Enumeration',
                        'action' => 'index'
                    )
                ),
            ),
            
             /**
             * SCIEZKA DO DODAWANIA PRIORYTETÓW ++
             */
            'AddIssuePriority' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '[:project]/issuepriority/add',
                    'constraints' => array(
                        'project' => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ),
                    'defaults' => array(
                        'controller' => 'Application\Controller\Enumeration',
                        'action' => 'addpriority'
                    )
                ),
            ),
            
            /**
             * SCIEZKA DO USUWANIA PRIORYTETÓW ++
             */
            'DeleteIssuePriority' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '[:project]/issuepriority/delete/[:id]',
                    'constraints' => array(
                        'project' => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ),
                    'defaults' => array(
                        'controller' => 'Application\Controller\Enumeration',
                        'action' => 'deletepriority'
                    )
                ),
            ),
            
            /**
             * SCIEZKA DO EDYCJI PRIORYTETÓW ++
             */
            'UpdateIssuePriority' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '[:project]/issuepriority/edit/[:id]',
                    'constraints' => array(
                        'project' => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ),
                    'defaults' => array(
                        'controller' => 'Application\Controller\Enumeration',
                        'action' => 'editpriority'
                    )
                ),
            ),
            
	
	
	      /**
             * SCIEZKA DO DODAWANIA KATEGORII DOKUMENTW --
             */
            'IssueCategory' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '[:project]/issuecategory/index',
                    'constraints' => array(
                        'project' => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ),
                    'defaults' => array(
                        'controller' => 'Application\Controller\Enumeration',
                        'action' => 'index'
                    )
                ),
            ),
            
             /**
             * SCIEZKA DO DODAWANIA KATEGORII DOKUMENTÓW --
             */
            'AddIssueCategory' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '[:project]/issuecategory/add',
                    'constraints' => array(
                        'project' => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ),
                    'defaults' => array(
                        'controller' => 'Application\Controller\Enumeration',
                        'action' => 'addcategory'
                    )
                ),
            ),
            
            /**
             * SCIEZKA DO EDYTOWANIA KATEGORII DOKUMENTÓW --
             */
            'UpdateIssueCategory' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '[:project]/issuecategory/edit/[:id]',
                    'constraints' => array(
                        'project' => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ),
                    'defaults' => array(
                        'controller' => 'Application\Controller\Enumeration',
                        'action' => 'editcategory'
                    )
                ),
            ),
            /**
             * SCIEZKA DO USUWANIA KATEGORII DOKUMENTÓW --
             */
            'DeleteIssueCategory' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '[:project]/issuecategory/delete/[:id]',
                    'constraints' => array(
                        'project' => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ),
                    'defaults' => array(
                        'controller' => 'Application\Controller\Enumeration',
                        'action' => 'deletecategory'
                    )
                ),
            ),
	
	
	
	/**
             * SCIEZKA DO DODAWANIA Statusów --
             */
            'AddIssueStatus' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '[:project]/issuestatus/add',
                    'constraints' => array(
                        'project' => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ),
                    'defaults' => array(
                        'controller' => 'Application\Controller\IssueStatus',
                        'action' => 'add'
                    )
                ),
            ),
            
             /**
             * SCIEZKA DO USUWANIA Statusów
             */
            'DeleteIssueStatus' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '[:project]/issuestatus/delete/[:id]',
                    'constraints' => array(
                        'project' => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ),
                    'defaults' => array(
                        'controller' => 'Application\Controller\IssueStatus',
                        'action' => 'delete'
                    )
                ),
            ),
            
             /**
             * SCIEZKA DO Idex Statusów
             */
            'IssueStatus' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '[:project]/issuestatus',
                    'constraints' => array(
                        'project' => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ),
                    'defaults' => array(
                        'controller' => 'Application\Controller\IssueStatus',
                        'action' => 'index'
                    )
                ),
            ),
            
             /**
             * SCIEZKA DO EDYTOWANIA Statusów
             */
            'UpdateIssueStatus' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '[:project]/issuestatus/edit/[:id]',
                    'constraints' => array(
                        'project' => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ),
                    'defaults' => array(
                        'controller' => 'Application\Controller\IssueStatus',
                        'action' => 'edit'
                    )
                ),
            ),
            
             /**
             * SCIEZKA DO PRZEMIESZCZANIA W DÓŁ Statusów
             */
            'DownIssueStatus' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '[:project]/issuestatus/down/[:id]',
                    'constraints' => array(
                        'project' => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ),
                    'defaults' => array(
                        'controller' => 'Application\Controller\IssueStatus',
                        'action' => 'down'
                    )
                ),
            ),
            
            /**
             * SCIEZKA DO PRZEMIESZCZANIA W GÓRĘ Statusów
             */
            'UpIssueStatus' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '[:project]/issuestatus/up/[:id]',
                    'constraints' => array(
                        'project' => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ),
                    'defaults' => array(
                        'controller' => 'Application\Controller\IssueStatus',
                        'action' => 'up'
                    )
                ),
            ),
            
        	/**
             * SCIEZKA DO listy slownikow slownikow uzytkownika
             */
            'CustomDict' => array(
                    'type' => 'segment',
                    'options' => array(
                            'route' => '[:project]/customdict',
                            'constraints' => array(
                                    'project' => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                                    'controller' => 'Application\Controller\CustomDict',
                                    'action' => 'index'
                            )
                    ),
            ),
            /**
             * SCIEZKA DO dodawania pozycji w slowniku uzytkownika
             */
            'AddAttributesToCustomDict' => array(
                    'type' => 'segment',
                    'options' => array(
                            'route' => '[:project]/customdict/add/addAttr',
                            'constraints' => array(
                                    'project' => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                                    'controller' => 'Application\Controller\CustomDict',
                                    'action' => 'addAttrib'
                            )
                    ),
            ),
            /**
             * SCIEZKA DO dodawania slownikow uzytkownika
             */
            'AddCustomDict' => array(
                    'type' => 'segment',
                    'options' => array(
                            'route' => '[:project]/customdict/add',
                            'constraints' => array(
                                    'project' => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                                    'controller' => 'Application\Controller\CustomDict',
                                    'action' => 'add'
                            )
                    ),
            ),  
            /**
             * SCIEZKA DO edytowania slownikow uzytkownika
             */
            'UpdateCustomDict' => array(
                    'type' => 'segment',
                    'options' => array(
                            'route' => '[:project]/customdict/edit/[:id]',
                            'constraints' => array(
                                    'project' => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                                    'controller' => 'Application\Controller\CustomDict',
                                    'action' => 'edit'
                            )
                    ),
            ),  
            /**
             * SCIEZKA DO usuwania slownikow uzytkownika
             */
            'DeleteCustomDict' => array(
                    'type' => 'segment',
                    'options' => array(
                            'route' => '[:project]/customdict/delete/[:id]',
                            'constraints' => array(
                                    'project' => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                                    'controller' => 'Application\Controller\CustomDict',
                                    'action' => 'delete'
                            )
                    ),
            ),
             /**
             * SCIEZKA DO zmiany pozycji o jedna w dol slownikow uzytkownika
             */
            'DownCustomDict' => array(
                    'type' => 'segment',
                    'options' => array(
                            'route' => '[:project]/customdict/down/[:id]',
                            'constraints' => array(
                                    'project' => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                                    'controller' => 'Application\Controller\CustomDict',
                                    'action' => 'down'
                            )
                    ),
            ),      
            /**
             * SCIEZKA DO zmiany pozycji o jedna w gore slownikow uzytkownika
             */
            'UpCustomDict' => array(
                    'type' => 'segment',
                    'options' => array(
                            'route' => '[:project]/customdict/up/[:id]',
                            'constraints' => array(
                                    'project' => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                                    'controller' => 'Application\Controller\CustomDict',
                                    'action' => 'up'
                            )
                    ),
            ), 		
            /**
             * SCIEZKA DO wyswietlania pelnego slownika uzytkownika
             */
            'ShowDict' => array(
                    'type' => 'segment',
                    'options' => array(
                            'route' => '[:project]/customdict/show/[:id]',
                            'constraints' => array(
                                    'project' => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                                    'controller' => 'Application\Controller\CustomDict',
                                    'action' => 'show'
                            )
                    ),
            ),
			/**
             * SCIEZKA DO PRZEJSC STANOW
             */
            'statusTransiton' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '[:project]/statustransition/statustransition',
					'constraints' => array(
                        'project' => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ),
                    'defaults' => array(
                        'controller' => 'Application\Controller\StatusTransition',
                        'action' => 'StatusTransition'
                    )
                ),
            ),
			
			/*
			Dodanie nowego przejścia stanów 
			*/
			
			'addStatusTransiton' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '[:project]/statustransition/add',
					'constraints' => array(
                        'project' => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ),
                    'defaults' => array(
                        'controller' => 'Application\Controller\StatusTransition',
                        'action' => 'add'
                    )
                ),
            ),
		
			/**
             * SCIEZKA DO DODAWANIA DZIAŁAŃ ++
             */
            'AddIssueActivity' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '[:project]/issueactivity/add',
                    'constraints' => array(
                        'project' => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ),
                    'defaults' => array(
                        'controller' => 'Application\Controller\Enumeration',
                        'action' => 'addactivity'
                    )
                ),
            ),
            
            /**
             * SCIEZKA DO USUWANIA DZIAŁAŃ ++
             */
            'DeleteIssueActivity' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '[:project]/issueactivity/delete/[:id]',
                    'constraints' => array(
                        'project' => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ),
                    'defaults' => array(
                        'controller' => 'Application\Controller\Enumeration',
                        'action' => 'deleteactivity'
                    )
                ),
            ),
            
             /**
             * SCIEZKA DO EDYCJI DZIAŁAŃ ++
             */
            'UpdateIssueActivity' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '[:project]/issueactivity/edit/[:id]',
                    'constraints' => array(
                        'project' => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ),
                    'defaults' => array(
                        'controller' => 'Application\Controller\Enumeration',
                        'action' => 'editactivity'
                    )
                ),
            ),
	
	/**
             * SCIEZKA DO WYŚWIETLANIA TRACKERS
             */
            'Tracker' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '[:project]/tracker',
                    'constraints' => array(
                        'project' => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ),
                    'defaults' => array(
                        'controller' => 'Application\Controller\Tracker',
                        'action' => 'index'
                    )
                ),
            ),
            
            /**
             * SCIEZKA DO DODAWANIA TRACKERS
             */
            'AddTracker' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '[:project]/tracker/add',
                    'constraints' => array(
                        'project' => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ),
                    'defaults' => array(
                        'controller' => 'Application\Controller\Tracker',
                        'action' => 'add'
                    )
                ),
            ),
            
            /**
             * SCIEZKA DO USUWANIA TRACKERS
             */
            'DeleteTracker' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '[:project]/tracker/delete/[:id]',
                    'constraints' => array(
                        'project' => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ),
                    'defaults' => array(
                        'controller' => 'Application\Controller\Tracker',
                        'action' => 'delete'
                    )
                ),
            ),
            
            /**
             * SCIEZKA DO EDYTOWANIA TRACKERS
             */
            'UpdateTracker' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '[:project]/tracker/edit/[:id]',
                    'constraints' => array(
                        'project' => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ),
                    'defaults' => array(
                        'controller' => 'Application\Controller\Tracker',
                        'action' => 'edit'
                    )
                ),
            ),
            
            
             /**
             * SCIEZKA DO PRZEMIESZCZANIA W DÓŁ TRACKER
             */
            'DownTracker' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '[:project]/tracker/down/[:id]',
                    'constraints' => array(
                        'project' => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ),
                    'defaults' => array(
                        'controller' => 'Application\Controller\Tracker',
                        'action' => 'down'
                    )
                ),
            ),
            
            /**
             * SCIEZKA DO PRZEMIESZCZANIA W GÓRĘ  TRACKER
             */
            'UpTracker' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '[:project]/tracker/up/[:id]',
                    'constraints' => array(
                        'project' => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ),
                    'defaults' => array(
                        'controller' => 'Application\Controller\Tracker',
                        'action' => 'up'
                    )
                ),
            ),	
			
			/**
             * SCIEZKA DO PRAW DO POL
             */
            'fieldsPermission' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '[:project]/fieldsPermission',
					'constraints' => array(
                        'project' => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ),
                    'defaults' => array(
                        'controller' => 'Application\Controller\FieldsPermission',
                        'action' => 'fieldsPermission'
                    )
                ),
            ),

            'FetchUsers' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/userassignment/fetchusers/[:issueID]',
                    'defaults' => array(
                        'controller' => 'Application\Controller\UserAssignment',
                        'action' => 'fetchUsers'
                    )
                ),
            ),
			
        ),
    ),
    'doctrine' => array(
        'authentication' => array(
            // configuration for the `doctrine.authentication.orm_default` authentication service
            'lib_authentication' => array(
                // name of the object manager to use. By default, the EntityManager is used
                'objectManager' => 'doctrine.entitymanager.orm_default',
                // encja uzytkownika
                'identityClass' => 'Application\Model\Domain\User',
                // property zawierajace nazwe uzytkownika
                'identityProperty' => 'login',
                // property zawierajace haslo
                'credentialProperty' => 'hashedPassword',
                // funkcja porownujaca hasla i zwracajaca true jesli haslo jest prawidlowe,
                // format: bool function verify(User object, string uncryptedPassword)
                'credentialCallable' => 'Application\Model\Application\Services\User\AbstractUserApplicationService::verifyPassword'
            ),
        ),
        'driver' => array(
            'entities' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
            ),
            'agregates' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
            ),
            'Application' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(
                    'module/Application/Model/Domain',
                )
            ),
            'orm_default' => array(
                'drivers' => array(
                    'Application' => 'Application'
                )
            ),
        ),
        'connection' => array(
            // default connection name
            'orm_default' => array(
                'driverClass' => 'Doctrine\DBAL\Driver\PDOMySql\Driver',
                'params' => array(
                    'host'     => 'justidea.pl',
                    'port'     => '3306',
                    'user'     => 'xawier_pmsystem',
                    'password' => '5eAC3Tba',
                    'dbname'   => 'xawier_pmsystem',
                )
            )
        )
    ),
);
