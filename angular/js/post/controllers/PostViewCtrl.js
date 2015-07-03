angular.module('myApp.post')
    .controller('PostView', ['$scope', 'rest', 'toaster', function ($scope, rest, toaster) {

        rest.path = 'v1/posts';

        $scope.post = {};

        var errorCallback = function (data) {
            toaster.clear();
            if (data.status == undefined) {
                angular.forEach(data, function (error) {
                    toaster.pop('error', "Field: " + error.field, error.message);
                });
            } else {
                toaster.pop('error', "code: " + data.code + " " + data.name, data.message);
            }
        };

        rest.model().success(function (data) {
            $scope.post = data;
            $scope.post.comment = {"post_id": data.id, "content": null};
        }).error(errorCallback);

        $scope.addComment = function () {

            rest.path = 'v1/comments';

            rest.postModel($scope.post.comment)
                .success(function (data) {
                    if (!angular.isArray($scope.post.comments)) {
                        $scope.post.comments = [];
                    }
                    $scope.post.comments.unshift(data);
                    $scope.post.comment.content = null;
                    toaster.pop('success', "Comment is added!");
                })
                .error(errorCallback);
        };

        $scope.deleteComment = function (comment) {

            rest.path = 'v1/comments/' + comment.id;

            rest.deleteModel()
                .success(function () {
                    angular.forEach($scope.post.comments, function (value, key) {
                        if (value.id == comment.id) {
                            $scope.post.comments.splice(key, 1);
                            toaster.pop('success', "Comment is deleted!");
                            return true;
                        }
                    });
                })
                .error(errorCallback);
        };
    }])
;