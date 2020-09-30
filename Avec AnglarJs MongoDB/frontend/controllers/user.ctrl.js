angular
    .module('app')
    .controller('userCtrl', userCtrl);

userCtrl.$inject = ['$scope', '$location', 'authService'];

function userCtrl($scope, $location, authService) {

    $scope.signin = signin;
    $scope.login = login;
    $scope.loginError = "";
    $scope.signinError = "";

    /**
     * Login function.
     * Prints response message in the console.
     * Stays on same page with alert if error.
     * Goes to home page if success.
     * @param {String} email 
     * @param {String} password 
     */
    function login(email, password) {
        var user = {
            email: email,
            password: password
        }
        authService.login(user).then(function (response) {
            if ('error' in response) {
                $scope.loginError = "Email ou mot de passe incorrect.";
            } else if ('userId' in response) {
                $scope.loginError = "";
                $scope.mainObj.userConnected = true;
                $location.path('/');
            }
            console.log(response);
        })
    }

    /**
     * Signin function.
     * Prints response in console.
     * Stays on same page with alert if error.
     * Goes to home page if success.
     * TODO : save auth.
     * @param {String} email 
     * @param {String} password 
     * @param {String} lastName 
     * @param {String} firstName 
     */
    function signin(email, password, confirm_password, lastName, firstName) {
        if (password != confirm_password) {
            $scope.signinError = "Les mots de passe ne correspondent pas";
        } else {
            var newUser = {
                email: email,
                password: password,
                lastName: lastName,
                firstName: firstName
            }
            authService.signin(newUser).then(function (response) {
                if ('error' in response) {
                    $scope.signinError = "L'email est déjà utilisé.";
                } else if ('userId' in response){
                    $scope.signinError = "";
                    $scope.mainObj.userConnected = true;
                    $location.path('/');
                }
                console.log(response);
            })
        }
    }

}