angular
    .module('app').
    config(function ($routeProvider, $locationProvider) {
        $routeProvider
            .when('/', {
                templateUrl: 'views/categoriesView.html',
                controller: 'categoriesCtrl'
            })
            .when('/signin', {
                templateUrl: 'views/signinView.html',
                controller: 'userCtrl'
            })
            .when('/login', {
                templateUrl: 'views/loginView.html',
                controller: 'userCtrl'
            })
            .when('/admin', {
                templateUrl: 'views/adminView.html',
                controller: 'adminCtrl'
            })
            .when('/addCategory', {
                templateUrl: 'views/addCategoryView.html',
                controller: 'categoriesCtrl'
            })
            .when('/items', {
                templateUrl: 'views/itemsView.html',
                controller: 'itemsCtrl'
            })
            .when('/addItem', {
                templateUrl: 'views/addItemView.html',
                controller: 'itemsCtrl'
            })
            .otherwise('/');
        $locationProvider.html5Mode({
            enabled: true,
            requireBase: false
        });
    });