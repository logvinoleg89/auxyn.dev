angular.module('myApp.satellizer')
    .controller('SatellizerLoginCtrl', function($scope, $auth) {

        $scope.authenticate = function(provider) {
          $auth.authenticate(provider);
        };
    });