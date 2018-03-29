let app = angular.module('myapp', ['ui.router']);

app.config(function($stateProvider, $urlRouterProvider, ){
    $urlRouterProvider.otherwise('/myhome');

    $stateProvider
        .state('myhome', {
            url: '/myhome',
            template: '<myhome class="col-xl-12 col-lg-12 col-md-12 col-sm-12"></myhome>'
        })
        .state('info', {
            url: '/university-info',
            template: '<university-info></university-info>'
        })
        .state('create', {
            url: '/course-create',
            template: '<course-create></course-create>'
        })
        .state('update', {
            url: '/update/:id',
            template: '<course-create></course-create>',
            resolve: {
                parameters: function($stateParams){
                    return $stateParams;
                }
            }
        })
});

app.controller('mainctrl', function() {
    this.hello = '';
});
