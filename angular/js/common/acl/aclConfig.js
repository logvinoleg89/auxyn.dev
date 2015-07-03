angular.module('myApp').config(function (AclProvider) {
    AclProvider.config({
        storage: 'localStorage',
        storageKey: 'o2o',
        defaultRole: 'guest',
        emptyActionDefault: 'true',
        defaultUser: {
            username: 'Guest'
        },
        permissions: {
            guest: {
                actions: {
                    '/map': false,
                }
            },
            user: {
                actions: {
//                    '/map': true,
                },
                roles: ['guest']
            },
            student: {
                actions: {
                    'root.register.step4-expert': false,
                    
                },
                roles: ['user']
            },
            expert: {
                actions: {
                    'root.register.step4-student': false,
                    
                },
                roles: ['user']
            }
        },
    });
});