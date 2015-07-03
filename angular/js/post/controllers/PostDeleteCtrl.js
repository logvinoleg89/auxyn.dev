angular.module('myApp.post')
    .controller('PostDelete', ['$scope', 'rest', 'toaster', '$window', function ($scope, rest, toaster, $window) {

        $scope.post = {};

        var errorCallback = function (data) {
            toaster.clear();
            if (data.status == undefined) {
                angular.forEach(data, function (error) {
                    toaster.pop('error', "Field: " + error.field, error.message);
                });
            } else {
                toaster.pop('error', "status: " + data.status + " " + data.name, data.message);
            }
        };

        rest.path = 'v1/posts';

        rest.model().success(function (data) {
            $scope.post = data;
        }).error(errorCallback);


        $scope.deleteModel = function () {

            rest.path = 'v1/posts/' + $scope.post.id;

            rest.deleteModel().success(function () {

                toaster.pop('success', "Deleted!");

                $window.setTimeout(function () {
                    $window.location = '/';
                }, 1000);

            }).error(errorCallback);
        }

    }]);
;