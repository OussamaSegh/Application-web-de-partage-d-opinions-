/**
 * Controller for items.
 * TODO : add search / order functionnalities
 * TODO : add the user id
 */
angular
    .module('app')
    .controller('itemsCtrl', itemCtrl);

itemCtrl.$inject = ['$scope', '$routeParams', 'itemService', 'categoryService', '$location'];

function itemCtrl($scope, $routeParams, itemService, categoryService, $location) {

    $scope.routeParams = $routeParams; 
    $scope.itemList = getItemList();
    $scope.addItem = addItem;
    $scope.categoryName = getCategoryName($routeParams.category_id);
    $scope.categoryList = getCategoryList();
    


    /**
     * Get all the items from API
     * TODO : check fields are not empty
     */
    function getItemList() {
        return itemService.getItemList().then(function (itemList) {
            $scope.itemList = itemList;
            return $scope.itemList;
        })
    };


    /**
     * Adds an item to API
     * Logs response/error in the console (To be verified)
     * The date in automatically included. 
     * The category is instanciated.
     */
    function addItem(name, category, url, description) {
        var newItem = {
            name: name,
            category_id: category._id,
            url: url,
            description: description
        };
        itemService.addItem(newItem);
        categoryService.instanciateCategory(category._id);
        $location.path('/');

    };

    /**
     * Get list of categories for the selector in addItemView.
     * @returns [ {_id:, name:} ]
     */
    function getCategoryList() {
        return categoryService.getCategoryList().then(function (categoryList) {
            $scope.categoryList = categoryList;
            return $scope.categoryList;
        });
    }

    /**
     * Get the category name from its id.
     * @param {id} category_id 
     * @returns {name}
     */
    function getCategoryName(category_id) {
        return categoryService.getCategoryList().then(function (categoryList) {
            categoryList.forEach(category => {
                if (category._id == category_id) {
                    $scope.categoryName = category.name;
                    return $scope.categoryName;
                }
            });
        })
    };
};