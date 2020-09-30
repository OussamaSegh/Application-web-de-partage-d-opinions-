angular
    .module('app')
    .controller('adminCtrl', adminCtrl);

adminCtrl.$inject = ['$scope', 'userService'];

function adminCtrl($scope, userService) {

    $scope.userList = listUsers(); // executed at controller instanciation

    /**
     * List all users on the website.
     */
    function listUsers(){
        return userService.getAllUsers().then(function(users){
            $scope.userList = users;
            return $scope.userList;
        })
    }

}