// Need set url REST Api in controller!
angular.module('myApp').service('rest', function ($http, $location, $stateParams) {
    return {

//        baseUrl: 'http://rest-jeca.net/rest/web/',
        baseUrl: 'http://logvin.gbksoft.net/rest-jeca/rest/web/',
        path: undefined,

        models: function () {
            return $http.get(this.baseUrl + this.path + location.search);
        },

        model: function () {
            if ($stateParams.expand != null) {
                return $http.get(this.baseUrl + this.path + "/" + $stateParams.id + '?expand=' + $stateParams.expand);
            }
            return $http.get(this.baseUrl + this.path + "/" + $stateParams.id);
        },

        get: function () {
            return $http.get(this.baseUrl + this.path);
        },

        postModel: function (model) {
            return $http.post(this.baseUrl + this.path, model);
        },

        putModel: function (model) {
            return $http.put(this.baseUrl + this.path + "/" + $stateParams.id, model);
        },

        deleteModel: function () {
            return $http.delete(this.baseUrl + this.path);
        }
    };

});