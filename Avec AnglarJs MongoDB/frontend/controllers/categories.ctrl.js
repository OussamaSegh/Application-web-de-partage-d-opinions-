/**
 * Controller for categories.
 * TODO : add search / order functionnalities
 */
angular
    .module('app')
    .controller('categoriesCtrl', categoriesCtrl);

categoriesCtrl.$inject = ['$scope', '$routeParams', 'categoryService', '$location'];

function categoriesCtrl($scope, $routeParams, categoryService, $location) {
    $scope.routeParams = $routeParams;
    $scope.categories = [];
    $scope.addCategory = addCategory;
    $scope.addCategoryMsg = "";
    $scope.updateCategory = updateCategory;
    $scope.deleteCategory = deleteCategory;

    /**
     * Get all the categories from the DB, append it to base categories
     * Executed at controller instanciation
     */
    categoryService.getAllCategories()
        .then(function (res) {
            var newCategories = res.data.categories;
            newCategories.forEach(category => {
                if ((category.name != null) & (category.url != null)) {
                    $scope.categories.push(category);
                }
            });
        }).catch(function (error) {
            console.log(error);
        });

    /**
     * Adds the category to DB
     * Logs response/error in the console (To be verified)
     */
    function addCategory(name, url) {
        var newCategory = {
            name: name,
            url: url
        };
        categoryService.addCategory(newCategory)
            .then(function (category) {
                var categoryName = category.name;
                $scope.addCategoryMsg = "Catégorie " + category.name + " bien ajoutée au site"
            });
    };

    /**
     * UPDATE a category.
     * @param {String} category_id 
     */
    function updateCategory(name, url, category_id) {
        var updatedCategory = {
            name: name,
            url: url
        }
        categoryService.updateCategory(category_id, updatedCategory)
            .then(res => console.log(res))
            .catch(err => console.log(err));
    }


    /**
     * DELETE a category.
     * @param {String} category_id 
     */
    function deleteCategory(category_id) {
        categoryService.deleteCategory(category_id)
            .then(function (result) {
                $scope.categoryMsg = result;
                $location.path('/');
            });
    }

};