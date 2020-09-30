/**
 * Service to interact with CATEGORY Backend API Endpoint.
 * Uses userId from $localStorage. 
 */

angular
    .module('app')
    .factory('categoryService', categoryService);
    
categoryService.$inject = ['$http', '$localStorage'];
    
function categoryService($http, $localStorage){
    // backend URL
    const categoryURL = "http://localhost:3000/api/category";
    
    return {
        getCategoryList: getCategoryList,
        getAllCategories: getAllCategories,
        addCategory: addCategory,
        deleteCategory: deleteCategory,
        updateCategory: updateCategory,
        instanciateCategory: instanciateCategory
    };

    
    /**
     * Get list of categories.
     * @returns [{_id:  , name:  }]
     */
    function getCategoryList(){
        return $http.get(categoryURL + '/listCategories')
            .then(getCategoryListComplete)
            .catch(getCategoryListFailed);

        function getCategoryListComplete(response){
            return response.data.categoryList;
        }

        function getCategoryListFailed(error){
            console.log('XHR failed for getCategoryList. ' + error.data);
        }
    };


    // GET all categories
    function getAllCategories(){
        return $http.get(categoryURL + '/');
    };


    /**
     * Post new category.
     * @param {object} newCategory 
     */
    function addCategory(newCategory){
        return $http.post('http://localhost:3000/api/category/addCategory', newCategory)
            .then(addCategorySuccess)
            .catch(addCategoryFailure);

        function addCategorySuccess(response){
            return response.data.category;
        }

        function addCategoryFailure(err){
            console.log('XHR failed for addCategory. ' + err.data.error);
        }
    }

    /**
     * Deletes category
     */
    function deleteCategory(category_id){
        return $http.delete(categoryURL + '/deleteCategory/' + category_id)
            .then(res => res.data.result)
            .catch(err => console.log(err));
    }

    /**
     * Updates a category
     * @param {object} modifiedCategory 
     */
    function updateCategory(category_id, updatedCategory){
        return $http.put(categoryURL + '/updateCategory/' + category_id, updatedCategory)
            .then(res => res.data.result)
            .catch(err => console.log(err));
    }

    /**
     * Instanciates a category based on its ID.
     */
    function instanciateCategory(category_id){
        var instanciatedCategory = {
            instanciated: true
        };
        return $http.put(categoryURL + '/updateCategory/' + category_id, instanciatedCategory)
            .then(res => res.data.result)
            .catch(err => console.log(err));
    }
};