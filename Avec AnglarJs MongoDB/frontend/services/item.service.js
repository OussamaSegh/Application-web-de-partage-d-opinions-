/**
 * Service to interact with ITEM Backend API Endpoint
 * Uses userId from $localStorage. 
 */

angular
    .module('app')
    .factory('itemService', itemService);

itemService.$inject = ['$http', '$localStorage'];

function itemService($http, $localStorage) {
    // backend URL
    const itemURL = "http://localhost:3000/api/item";

    return {
        getItemList: getItemList,
        addItem: addItem
    }

    /**
      * Get list of items.
      * @returns [{_id:  , name:  }]
      */
    function getItemList() {
        return $http.get(itemURL + '/')
            .then(getItemListComplete)
            .catch(getItemListFailed);

        function getItemListComplete(response) {
            return response.data.items;
        }

        function getItemListFailed(error) {
            console.log('XHR failed for getItemList. ' + error.data);
        }
    };

    /**
     * Adds an item to the DB with userID from local storage.
     */
    function addItem(newItem) {
        newItem.userId = $localStorage.currentUser.userId;
        return $http.post(itemURL + '/addItem', newItem)
            .then(res => console.log(res.data))
            .catch(err => console.log(err.data))
    };




};