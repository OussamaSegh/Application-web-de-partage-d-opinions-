/**
 * Controller for the Category model.
 */

// Model
const Category = require("../models/category.model");

// CREATE new category
exports.createCategory = (req,res,next) => {
    console.log("Request to create a new category")
    const newCategory = new Category({
        name: req.body.name,
        url : req.body.url,
        instanciated: false
    });
    console.log("New category created : " + newCategory);
    newCategory.save()
        .then(() => res.status(201).json({category: newCategory}))
        .catch(error => res.status(400).json({error: error} ));
}

// READ all categories
exports.getAllCategories = (req, res, next) => {
    console.log("Request to get all categories");
    Category.find()
        .then(categories => res.status(200).json({"categories": categories} ))
        .catch(error => res.status(400).json( error ));
}

// READ list of categories : not very useful...
exports.getListCategories = (req, res, next) => {
    console.log("Request to list the categories");
    Category.find().select('_id name')
        .then(list => 
            {res.status(200).json({"categoryList": list});
            console.log(list);})
        .catch(error => res.status(400).json( error ));
}

// DELETE category
exports.deleteCategory = (req, res, next) => {
    console.log("Request to delete category");
    Category.deleteOne({_id: req.params.categoryId})
        .then( () => res.status(201).json({result: "Catégorie supprimée! "}))
        .catch( error => res.status(400).json({error: error}));
}

// UPDATE category
exports.updateCategory = (req, res, next) => {
    console.log("Request to update category");
    Category.updateOne({_id: req.params.categoryId}, {...req.body, _id: req.params.categoryId})
        .then( () => res.status(201).json({result: "Catégorie modifiée! "}))
        .catch( error => res.status(400).json({error: error}));
}