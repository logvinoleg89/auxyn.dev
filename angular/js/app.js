var app = angular.module('myApp', ['acl', 'ui.router', 'ngAnimate', 'toaster', 'ngSanitize', 'ui.bootstrap', 'oc.lazyLoad']);

//app.run(function ($rootScope, $state, $stateParams, Acl, $timeout, Helper, LoginModal, User) {
app.run(function ($rootScope, $state, $stateParams, Acl, $timeout, LoginModal) {
// It's very handy to add references to $state and $stateParams to the $rootScope so that you can access them from any scope within your applications.For example,
// <li ng-class="{ active: $state.includes('contacts.list') }"> will set the <li> to active whenever 'contacts.list' or one of its decendents is active.
    $rootScope.$state = $state;
    $rootScope.$stateParams = $stateParams;
//    $rootScope.Helper = Helper; //global helper function

    //change title on state change
    $rootScope.$on('$stateChangeSuccess', function (event, toState) {
        $timeout(function () {
            $rootScope.title = (toState.data && toState.data.pageTitle) ? ' - ' + toState.data.pageTitle : '';

            //every page change state -> update counters
            if (!Acl.isGuest()) {
                User.getcounters({}, function (data) {
                    Acl.user.messages = data.messages;
                    Acl.user.notifications = data.notifications;
                });
                User.getalerts({}, function (data) {
//                    Acl.user.alerts = data;
                });

            }
        });
    });
    $rootScope.$on('$stateChangeStart', function (event, toState, toParams, fromState, fromParams) {
        //REMEMBER ME (reverce logic)
        if (typeof (Acl.user.expired) != 'undefined') {
            var expDate = new Date(Acl.user.expired.toString());
            var curDate = new Date();
            console.log(curDate, expDate);
            if (expDate < curDate) {
                Acl.logout(); //logout inactive
            } else {
                curDate.setMinutes(curDate.getMinutes() + 30); //30 minutes default
                Acl.user.expired = curDate.toString();
                Acl.update();
            }
        }
        var defaultState = '';
        if (Acl.hasRole('user')) { //USER DON'T HAVE HOME!!!
            defaultState = 'root.user.dashboard';
        } else {
            defaultState = 'root.home';
        }
        //check fromState - empty -> go default state
        //if fromStete - DENY -> go default state
        if (!fromState.name || !Acl.can(fromState.name)) {
            fromState = defaultState;
        }

        console.log('toState', toState.name);
        console.log('Acl.can', Acl.can(toState.name))
        if (!Acl.can(toState.name)) {
            event.preventDefault();
            if (Acl.isGuest()) {
                console.log('Acl.isGuest - try login', Acl.user);
                console.log(LoginModal);
                LoginModal.open().then(function (result) {
                    if (result) {
                        $state.go(toState, toParams); //all ok - go next
                    } else {
                        $state.go(fromState, fromParams); //go BACK
                    }
                });
            }
//            else if (Acl.user && Acl.user.status == '11') {
//                console.log('Acl.status==11', Acl.user);
//                $state.go('root.register.step4-' + Acl.user.role); //go confirm email
//            }
            else {
                console.log('default', fromState);
                $state.go(fromState, fromParams); //default go BACK
            }
        }
    });
});