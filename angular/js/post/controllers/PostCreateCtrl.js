angular.module('myApp.post')
    .controller('PostCreate', ['$scope', 'rest', 'toaster', '$window', function ($scope, rest, toaster, $window) {

        rest.path = 'v1/posts';

        $scope.post = {};

        $scope.icons = [
            {value: '1', label: 'Draft'},
            {value: '2', label: 'Published'},
        ];

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

        $scope.save = function () {
            rest.postModel($scope.post).success(function (data) {

                toaster.pop('success', "Saved");

                $window.setTimeout(function () {
                    $window.location = '/#!/post/' + data.id;
                }, 1000);

            }).error(errorCallback);
        };
    }])
;