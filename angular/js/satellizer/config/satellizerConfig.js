angular.module('myApp.satellizer')
    .config(function($authProvider) {

        $authProvider.facebook({
          clientId: '1618806771733580',
    //      redirectUri: window.location.origin || window.location.protocol + '//' + window.location.host,
//          url: "http://auxyn.dev/backend/oauth"
          url: "api/v1/user/oauth-facebook"
//          url: "frontend/site/qwe"
        });

        $authProvider.google({
          clientId: '631036554609-v5hm2amv4pvico3asfi97f54sc51ji4o.apps.googleusercontent.com'
        });

        $authProvider.twitter({
          url: '/auth/twitter'
        });

        $authProvider.oauth2({
            name: 'foursquare',
            url: '/auth/foursquare',
            clientId: 'MTCEJ3NGW2PNNB31WOSBFDSAD4MTHYVAZ1UKIULXZ2CVFC2K',
            redirectUri: window.location.origin || window.location.protocol + '//' + window.location.host,
            authorizationEndpoint: 'https://foursquare.com/oauth2/authenticate'
        });
    });