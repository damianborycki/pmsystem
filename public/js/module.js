angular.module('app', [
    'projectControllers',
    'projectServices',
    'projectDirectives',
    'ui.router',
    'ngRoute',
    'notificationWidget',
    'angularFileUpload',
    'ui.bootstrap.tabs',
    'ui.bootstrap.popover',
    'ui.bootstrap.tpls',
    'ui.bootstrap.buttons',
    'ui.bootstrap.collapse',
    'ui.bootstrap.progressbar',
    'ui.sortable',
    'xeditable'
])

// http://stackoverflow.com/questions/11252780/whats-the-correct-way-to-communicate-between-controllers-in-angularjs
.config(['$provide', function($provide){
    $provide.decorator('$rootScope', ['$delegate', function($delegate){

        Object.defineProperty($delegate.constructor.prototype, '$onRootScope', {
            value: function(name, listener){
                var unsubscribe = $delegate.$on(name, listener);
                this.$on('$destroy', unsubscribe);
            },
            enumerable: false
        });

        return $delegate;
    }]);
}])

.config(['$stateProvider', '$urlRouterProvider', function($stateProvider, $urlRouterProvider) {
    $stateProvider
        .state('index', {
            url: '/',
            // views: {
            //     leftView: {
            //         controller: 'exTypeCtrl',
            //         templateUrl: 'extemplate.html'
            //     }
            // }
            controller: 'indexCtrl',
            templateUrl: 'index.html'
        })
        ;
    $urlRouterProvider.otherwise('/');
}])

.run(function(editableOptions) {
  editableOptions.theme = 'bs3';
})
.run(['$rootScope', '$state', '$stateParams', function ($rootScope,   $state,   $stateParams) {
    $rootScope.$state = $state;
    $rootScope.$stateParams = $stateParams;
}])


.run(['$templateCache', function($templateCache) {
    window.$templateCache = $templateCache;
}])

.run(['documentTypeService', function(documentTypeService){
        documentTypeService.load();
}]);
