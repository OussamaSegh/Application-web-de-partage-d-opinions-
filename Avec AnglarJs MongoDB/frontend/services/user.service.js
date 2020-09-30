/**
 * Service to interact with USER Backend API Endpoint. Actually, same endpoint as AUTH.
 * Operations from this service are not as sensitive as the auth.service.
 */

angular
    .module('app')
    .factory('userService', userService);

userService.$inject = ['$http'];

function userService($http){
    // backend URL
    const authURL = "http://localhost:3000/api/auth";

    return{
        getAllUsers: getAllUsers,
        getOneUser: getOneUser
    };
  
    /**
     * List Users : for admin and testing.
     */
    function getAllUsers() {
        return $http.get(authURL + '/users')
            .then(res => res.data.users)
            .catch(err => err.data.error);
    };

    /**
     * Get info on a user based on its userID
     */
    function getOneUser(userId){
        return $http.get(userURL + '/userInfo/' + userId)
            .then(res => res.data.userInfo)
            .catch(err => err.data.error);
    };

};