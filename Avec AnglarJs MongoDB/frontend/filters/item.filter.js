/**
 * Filters items based on categoryID
 */
angular
    .module('app')
    .filter('itemFilter', itemFilter);


function itemFilter(){
    return function(itemList, category_id){

        var selectedItems = [];

        itemList.forEach(item => {
            if(item.category == category_id){
                selectedItems.push(item);
            }
        })

        return selectedItems;
    }
}