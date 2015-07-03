angular.module('myApp.satellizer')
    .config(function($authProvider) {

        $authProvider.facebook({
          clientId: '624059410963642'
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
          redirectUri: window.location.origin,
          clientId: 'MTCEJ3NGW2PNNB31WOSBFDSAD4MTHYVAZ1UKIULXZ2CVFC2K',
          authorizationEndpoint: 'https://foursquare.com/oauth2/authenticate',
        });
    });