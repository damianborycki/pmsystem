<?php

return array(
    'controllers' => array(
        'invokables' => array(
            /* generator-begin-controllers.invokables */
            'Application\Controller\Index' => 'Application\Controller\IndexController',
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
            'error/404' => __DIR__ . '/../../Application/View/Error/404.phtml',
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
    ),
);
