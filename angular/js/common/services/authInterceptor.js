angular.module('myApp').factory('authInterceptor', function ($q, $window) {
    return {
        request: function (config) {
            if ($window.sessionStorage._auth && config.url.substring(0, 4) == 'http') {
                config.params = {'access-token': $window.sessionStorage._auth};
            }
            return config;
        },
        responseError: function (rejection) {
            if (rejection.status === 401) {
                $window.setTimeout(function () {
                    $window.location = '/#!/login';
                }, 1000);
            }
            return $q.reject(rejection);
        }
    };
});


//+access token
//angular.module('myApp').factory('authInterceptor', function ($q, $window, $location, Acl) {
//    return {
//        request: function (config) {
//            //console.log(config.url);
//            if (Acl.user.access_token && config.url.substring(0, 4) == 'http') {
//                //console.log(Acl.user.access_token)
//                if (config.params !== undefined) {
//                    config.params['access-token'] = Acl.user.access_token;
//                } else {
//                    config.params = {
//                        'access-token': Acl.user.access_token, //'bOntQxE0Z-uPWRE6oVWk79_ppOhUMRPf'
//                    };
//                }
//            }
//            return config;
//        },
//        //???
//        responseError: function (rejection) {
//            if (rejection.status === 401) {
//                console.log('rejection TO DO something like /login show', rejection);
//                //location.reload();//$state not avaliable?
//            }
//            else if (rejection.status === 404) {
//                console.log('PANIC 404')
//            }
//            else if (rejection.status === 500) {
//                console.log('PANIC! SERVER ERROR!', rejection);
//            }
//            return $q.reject(rejection);
//        }
//    };
//});