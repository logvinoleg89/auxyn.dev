angular.module('myApp.post')
    .controller('PostIndex', ['$scope', 'rest', 'toaster', '$sce', 'status', '$filter', function ($scope, rest, toaster, $sce, status, $filter) {

        rest.path = 'v1/posts';

        var errorCallback = function (data) {
            toaster.clear();
            toaster.pop('error', "status: " + data.status + " " + data.name, data.message);
        };

        rest.models().success(function (data) {
            $scope.posts = $filter('filter')(data, {"status": status});
        }).error(errorCallback);

    }])
;