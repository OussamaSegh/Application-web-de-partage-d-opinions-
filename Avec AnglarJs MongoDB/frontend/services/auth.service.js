/**
 * Service to interact with AUTH Backend API Endpoint. 
 * It uses $localStorage to keep user info : 
 * - userId
 * - auth token from backend
 */

angular
    .module('app')
    .factory('authService', authService);

authService.$inject = ['$http', '$localStorage'];

function authService($http, $localStorage) {
    // backend URL
    const authURL = "http://localhost:3000/api/auth";

    return {
        login: login,
        signin: signin,
        logout: logout
    }

    /**
     * Login : checks if user exists.
     * Response contains userId and token.
     */
    function login(user) {
        return $http.post(authURL + '/login', user)
            .then(function (response) {
                // login successful if there's a token in the response
                if (response.data.token) {
                    // store username and token in local storage to keep user logged in between page refreshes
                    $localStorage.currentUser = { userId: response.data.userId, token: response.data.token };
                    // add jwt token to auth header for all requests made by the $http service
                    $http.defaults.headers.common.Authorization = 'Bearer ' + response.data.token;
                    // returns userId, maybe useful later.
                    return response.data;
                }
            })
            .catch(err => err.data);
    };


    /**
     * Signin : creates new User in DB.
     * Error if email already exists.
     * Status and banned are managed in Backend.
     */
    function signin(newUser) {
        return $http.post(authURL + '/signin', newUser)
            .then(function (response) {
                if (response.data.token) {
                    $localStorage.currentUser = { userId: response.data.userId, token: response.data.token };
                    $http.defaults.headers.common.Authorization = 'Bearer ' + response.data.token;
                    return response.data;
                }
            })
            .catch(err => err.data.error);
    };


    /**
     * Logout the user.
     * Removes auth token. 
     */
    function logout(){
        delete $localStorage.currentUser;
        $http.defaults.headers.common.Authorization = '';
    }
}