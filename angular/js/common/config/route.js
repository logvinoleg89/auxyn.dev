angular.module('myApp').config([
    '$httpProvider', '$stateProvider', '$urlRouterProvider', '$ocLazyLoadProvider', '$locationProvider' ,
    function ($httpProvider, $stateProvider, $urlRouterProvider, $ocLazyLoadProvider, $locationProvider) {
        
    var modulesPath = 'js';

    $urlRouterProvider.otherwise("/");
    $locationProvider.hashPrefix('!');

    $stateProvider
        .state('/', {
            url: '/',
            templateUrl: modulesPath + '/site/views/main.html'
        })
        
        .state('/auth/foursquare', {
            url: '/auth/foursquare',
            templateUrl: modulesPath + '/satellizer/views/login.html',
            controller: 'SatellizerLoginCtrl',
            resolve: {
                lazy: ['$ocLazyLoad', function($ocLazyLoad) {
                    return $ocLazyLoad.load([
                        'myApp.satellizer'
                    ]);
                }]
            }
        })
        
        .state('/testload', {
            url: '/testload',
            templateUrl: modulesPath + '/testload/views/index.html',
            controller: 'TestloadCtrl',
            resolve: {
                lazy: ['$ocLazyLoad', function($ocLazyLoad) {
                    return $ocLazyLoad.load([
                        'myApp.testload'
                    ]);
                }]
            }
        })
        
        .state('/map', {
            url: '/map',
            templateUrl: modulesPath + '/map/views/index.html',
            controller: 'MapIndexCtrl',
            resolve: {
                lazy: ['$ocLazyLoad', function($ocLazyLoad) {
                    return $ocLazyLoad.load([
                        'myApp.map'
                    ]);
                }]
            }
        })

        .state('/login', {
            url: '/login',
            templateUrl: modulesPath + '/site/views/login.html',
            controller: 'SiteLoginCtrl',
            resolve: {
                lazy: ['$ocLazyLoad', function($ocLazyLoad) {
                    return $ocLazyLoad.load([
                        'myApp.site'
                    ]);
                }]
            }
        })

        .state('/post/published', {
            url: '/post/published',
            templateUrl: modulesPath + '/post/views/index.html',
            controller: 'PostIndex',
            resolve: {
                lazy: ['$ocLazyLoad', function($ocLazyLoad) {
                    return $ocLazyLoad.load([
                        'myApp.post'
                    ]);
                }],
                status: function () {
                    return 2;
                }
            }
        })

        .state('/post/draft', {
            url: '/post/draft',
            templateUrl: modulesPath + '/post/views/index.html',
            controller: 'PostIndex',
            resolve: {
                lazy: ['$ocLazyLoad', function($ocLazyLoad) {
                    return $ocLazyLoad.load([
                        'myApp.post'
                    ]);
                }],
                status: function () {
                    return 1;
                }
            }
        })

        .state('/post/create', {
            url: '/post/create',
            templateUrl: modulesPath + '/post/views/form.html',
            controller: 'PostCreate'
        })

        .state('/post/:id/edit', {
            url: '/post/:id/edit',
            templateUrl: modulesPath + '/post/views/form.html',
            controller: 'PostEdit',
            resolve: {
                lazy: ['$ocLazyLoad', function($ocLazyLoad) {
                    return $ocLazyLoad.load([
                        'myApp.post'
                    ]);
                }]
            }
        })

        .state('/post/:id/delete', {
            url: '/post/:id/delete',
            templateUrl: modulesPath + '/post/views/delete.html',
            controller: 'PostDelete',
            resolve: {
                lazy: ['$ocLazyLoad', function($ocLazyLoad) {
                    return $ocLazyLoad.load([
                        'myApp.post'
                    ]);
                }]
            }
        })

        .state('/post/:id', {
            url: '/post/:id',
            templateUrl: modulesPath + '/post/views/view.html',
            controller: 'PostView',
            resolve: {
                lazy: ['$ocLazyLoad', function($ocLazyLoad) {
                    return $ocLazyLoad.load([
                        'myApp.post'
                    ]);
                }]
            }
        })

        .state('/404', {
            url: '/404',
            templateUrl: '404.html'
        })
    ;
    $locationProvider.html5Mode(true).hashPrefix('!');
    $httpProvider.interceptors.push('authInterceptor');
}]);