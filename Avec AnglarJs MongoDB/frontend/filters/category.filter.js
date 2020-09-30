angular
    .module('app')
    .filter('categoryFilter', categoryFilter);

function categoryFilter(){
    return function(categoryList, category_id){
        console.log(categoryList);
        categoryList.then(function(data){
            console.log(data);
        });
        categoryList.forEach(category => {
            if(category._id == category_id){
                return category.name;
            }
        })
    }
}