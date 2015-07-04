angular.module('myApp.satellizer')
    .controller('SatellizerLoginCtrl', function($scope, $auth, Acl) {
        $scope.authenticate = function(provider) {
            $auth.authenticate(provider)
                .then(function(response) {
                    
                    Acl.login('user', {
                        id: 1,
                        username: 2,
                        email: 3,
                        access_token: response.access_token,
                        status: 'ok'
                    });
                    console.log(Acl);
                })
                .catch(function(response) {
                    console.log(response);
                });
            };
    });