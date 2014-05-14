<?php

return array(
    'layout' => array(
        'ng-app' => 'app',
        'title' => 'Project Management System - WPZ 2014',
        'css' => array(
            '/css/select2-bootstrap.css',
            '/css/font-awesome.min.css',
            '/css/bootstrap.min.css',
            '/css/xeditable.css',
            '/css/style.css'
        ),
        'js' => array(
            // jQuery (necessary for Bootstrap's JavaScript plugins)
            '/js/vendor/jquery-1.11.0.min.js',
        
            // Include all compiled plugins (below), or include individual files as needed
            '/js/vendor/angular-1.2.16/angular.js',
            '/js/vendor/angular-modules/xeditable.min.js',
            '/js/vendor/bootstrap.min.js',
            '/js/vendor/angular-modules/ui-bootstrap-tpls-0.10.2.js',
            '/js/vendor/angular-modules/angular-file-upload.js',
            '/js/vendor/angular-1.2.16/angular-route.js',
            '/js/vendor/angular-1.2.16/angular-resource.js',
            '/js/vendor/angular-modules/angular-ui-router.min.js',
            '/js/vendor/angular-modules/notificationWidget.js',
            '/js/vendor/angular-modules/select2.js',
            '/js/vendor/angular-modules/sortable.js',

            // Services

            // Controllers
            '/js/controllers/ControllersModule.js',

            // Directives
            '/js/directives/DirectivesModule.js',

            // Module
            '/js/module.js',            
        )
    )
);
