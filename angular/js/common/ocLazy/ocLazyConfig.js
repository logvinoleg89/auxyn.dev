angular.module('myApp').config(['$ocLazyLoadProvider' ,function ($ocLazyLoadProvider) {

    $ocLazyLoadProvider.config({
//            debug: true,
        modules: [

        // ------
        // Modules
        // ------
        {
            name: 'myApp.post',
            serie: true,
            files: [
                'js/post/PostModule.js',
                'js/post/controllers/PostIndexCtrl.js',
                'js/post/controllers/PostViewCtrl.js',
                'js/post/controllers/PostCreateCtrl.js',
                'js/post/controllers/PostEditCtrl.js',
                'js/post/controllers/PostDeleteCtrl.js',
            ]
        },{
            name: 'myApp.site',
            serie: true,
            files: [
                'js/site/SiteModule.js',
                'js/site/controllers/SiteLoginCtrl.js',
            ]
        },{
            name: 'myApp.testload',
            serie: true,
            files: [
                'js/testload/TestloadModule.js',
                'js/testload/controllers/TestloadCtrl.js',
            ]
        },{
            name: 'myApp.map',
            serie: true,
            files: [
                'js/map/MapModule.js',
                'js/map/controllers/MapIndexCtrl.js',
            ]
        },

        // ------
        // Plugins
        // ------
        {
            name: 'ui.grid',
            files: [
                'vendor/angular-ui-grid/ui-grid.js',
                'vendor/angular-ui-grid/ui-grid.css'
            ]
        },{
            name: 'ngMap',
            files: [
                '//rawgit.com/allenhwkim/angularjs-google-maps/master/build/scripts/ng-map.js',
            ]
        }]
    });
}]);