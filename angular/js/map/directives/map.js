angular.module('myApp.map').directive('map', ['$http', function ($http) {
    return {
        link: function (scope, element, attrs) {
            scope.isGuest = window.sessionStorage._auth == undefined;
        },

        template: '<a ui-sref="/login">Login</a>'
    };
}]);