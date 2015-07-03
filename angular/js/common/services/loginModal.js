app.factory('LoginModal', function ($modal, Acl, $q) {
    return {
        open: function () {
            var deferred = $q.defer();
            $modal.open({
//                template: '<div>1111111111</div>',
                templateUrl: 'js/site/views/loginModal.html',
//                controller: 'LoginCtrl',
                windowClass: 'loginModal',
                size: 'sm',
                backdrop: true,
                backdropClass: 'loginModal'
            }).result.finally(function () {
                if (Acl.isGuest()) {
                    deferred.resolve(false);
                } else {
                    deferred.resolve(true);
                }
            });
            return deferred.promise;
        }
    };
});