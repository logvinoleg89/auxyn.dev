angular.module('myApp.post')
    .controller('PostEdit', ['$scope', 'rest', 'toaster', '$window', function ($scope, rest, toaster, $window) {

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

        $scope.post = {};

        $scope.icons = [
            {value: '1', label: 'Draft'},
            {value: '2', label: 'Published'},
        ];

        rest.model().success(function (data) {
            $scope.post = data;
            $scope.post.status = $scope.post.status.toString();
        }).error(errorCallback);

        $scope.save = function () {
            rest.putModel($scope.post).success(function () {

                toaster.pop('success', "Saved");

                $window.setTimeout(function () {
                    $window.location = '/#!/post/' + $scope.post.id;
                }, 1000);
            }).error(errorCallback);
        };

    }])
;