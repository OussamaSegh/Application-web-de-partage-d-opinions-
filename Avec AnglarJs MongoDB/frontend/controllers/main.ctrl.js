/**
 * Main controller for routing and param passing
 */
angular
    .module('app')
    .controller('mainCtrl', mainCtrl);

mainCtrl.$inject = ['$scope', '$route', '$routeParams', '$location', '$localStorage', '$http', 'authService', '$window'];

function mainCtrl($scope, $route, $routeParams, $location, $localStorage, $http, authService, $window) {
    $scope.route = $route;
    $scope.routeParams = $routeParams;
    $scope.location = $location;
    $scope.$storage = $localStorage;
    $scope.userConnected;
    $scope.logout;

    // to update data from child controller
    $scope.mainObj ={};
    $scope.mainObj.userConnected = false;

    // on page refresh
    if ($localStorage.currentUser) {
        console.log("Application running with user " + $localStorage.currentUser.userId);
        $scope.userConnected = true;
        $http.defaults.headers.common.Authorization = 'Bearer ' + $localStorage.currentUser.token;
    } else {
        $scope.userConnected = false;
    };


    // after signin or login
    $scope.$watch('mainObj.userConnected', function(){
        if($scope.mainObj.userConnected){
            $scope.userConnected = true;
            $http.defaults.headers.common.Authorization = 'Bearer ' + $localStorage.currentUser.token;
        }
    });


    // logout
        /**
     * Logout.
     * Goes back to the main page. 
     */
    $scope.logout = function(){
        authService.logout();
        $scope.mainObj.userConnected = false;
        $scope.userConnected = false;
        $location.path('/');
        $window.alert("Vous vous êtes bien déconnecté.");
    }
};