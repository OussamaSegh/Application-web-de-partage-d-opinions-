/**
 * Controller for the Item model.
 */

// Model
const Item = require("../models/item.model");

// CREATE new category
exports.createItem = (req,res,next) => {
    console.log("Request to create a new item")
    const newItem = new Item({
        name: req.body.name,
        category: req.body.category_id,
        url : req.body.url,
        description: req.body.description,
        userId: req.body.userId
    });
    console.log("New item created : " + newItem);
    newItem.save()
        .then(() => res.status(201).json({result: "Nouvel item : " + newItem.name}))
        .catch(error => res.status(400).json( error ));
}


// READ all items
exports.getAllItems = (req, res, next) => {
    console.log("Request to get all items");
    Item.find()
        .then(items => res.status(200).json({"items": items} ))
        .catch(error => res.status(400).json( error ));
}