'use strict';

// Declare module which depends on filters, and services
angular.module('notificationWidget', [])
// Declare an http interceptor that will signal the start and end of each request
        .config(['$httpProvider', function($httpProvider) {
        var $http,
                interceptor = ['$q', '$injector', function($q, $injector) {
                var notificationChannel;
                return {
                    response: function(response) {
                        // get $http via $injector because of circular dependency problem
                        $http = $http || $injector.get('$http');
                        // don't send notification until all requests are complete
                        if ($http.pendingRequests.length < 1) {
                            // get requestNotificationChannel via $injector because of circular dependency problem
                            notificationChannel = notificationChannel || $injector.get('requestNotificationChannel');
                            // send a notification requests are complete
                            notificationChannel.requestEnded();
                        }
                        return response || $q.when(response);
                    },
                    responseError: function error(response) {
                        // get $http via $injector because of circular dependency problem
                        $http = $http || $injector.get('$http');
                        // don't send notification until all requests are complete
                        if ($http.pendingRequests.length < 1) {
                            // get requestNotificationChannel via $injector because of circular dependency problem
                            notificationChannel = notificationChannel || $injector.get('requestNotificationChannel');
                            // send a notification requests are complete
                            notificationChannel.requestEnded();
                        }
                        return $q.reject(response);
                    },
                    request: function(promise) {
                        // get requestNotificationChannel via $injector because of circular dependency problem
                        notificationChannel = notificationChannel || $injector.get('requestNotificationChannel');
                        // send a notification requests are complete
                        notificationChannel.requestStarted();
                        return promise || $q.when(promise);
                    }
                }
            }];

        $httpProvider.interceptors.push(interceptor);
    }])
// declare the notification pub/sub channel
        .factory('requestNotificationChannel', ['$rootScope', function($rootScope) {
        // private notification messages
        var _START_REQUEST_ = '_START_REQUEST_';
        var _END_REQUEST_ = '_END_REQUEST_';

        // publish start request notification
        var requestStarted = function() {
            $rootScope.$broadcast(_START_REQUEST_);
        };
        // publish end request notification
        var requestEnded = function() {
            $rootScope.$broadcast(_END_REQUEST_);
        };
        // subscribe to start request notification
        var onRequestStarted = function($scope, handler) {
            $scope.$on(_START_REQUEST_, function(event) {
                handler();
            });
        };
        // subscribe to end request notification
        var onRequestEnded = function($scope, handler) {
            $scope.$on(_END_REQUEST_, function(event) {
                handler();
            });
        };

        return {
            requestStarted: requestStarted,
            requestEnded: requestEnded,
            onRequestStarted: onRequestStarted,
            onRequestEnded: onRequestEnded
        };
    }])
// declare the directive that will show and hide the loading widget
        .directive('loadingWidget', ['$compile', 'requestNotificationChannel', function($compile, requestNotificationChannel) {
        return {
            scope: {
                ngModel: '='
            },
            restrict: "A",
            link: function(scope, element, attr, ctrl) {
                // hide the element initially
                var $element = $(element);

                var startRequestHandler = function() {
                    var show;
                    if (attr.loadingWidget) {
                        show = scope[attr.loadingWidget];
                    }else{
                        show = true;
                    }
                    if (show) {
                        $element.loadingOverlay({
                            loadingClass: 'loading', // Class added to `target` while loading
                            overlayClass: 'loading-overlay', // Class added to loading overlay (to be styled in CSS)
                            spinnerClass: 'loading-spinner', // Class added to loading overlay spinner
                            iconClass: 'loading-icon', // Class added to loading overlay spinner
                            textClass: 'loading-text', // Class added to loading overlay spinner
                            loadingText: 'Wczytywanie'              // Text within loading overlay
                        });
                    }
                };

                var endRequestHandler = function() {
                    $element.loadingOverlay('remove');
                };
                // register for the request start notification
                requestNotificationChannel.onRequestStarted(scope, startRequestHandler);
                // register for the request end notification
                requestNotificationChannel.onRequestEnded(scope, endRequestHandler);

                if (scope.ngModel !== undefined) {
                    scope.$watch('ngModel', function(newVal) {
                        if (newVal === true)
                            startRequestHandler();
                        else
                            endRequestHandler();
                    });
                }
            }
        };
    }]);