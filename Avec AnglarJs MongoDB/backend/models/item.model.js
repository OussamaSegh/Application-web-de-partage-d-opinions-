/**
 * Model for Item.
 */
const mongoose = require('mongoose');
const uniqueValidator = require('mongoose-unique-validator');

const itemSchema = mongoose.Schema({
    name: {type: String, required: true, unique: true},
    category: {type: String, required: true},
    url: {type: String, required: true, unique: true},
    description: {type: String, required: true},
    date: {type: Date, required: true, default: Date.now},
    userId: {type: String, required: true}
})

itemSchema.plugin(uniqueValidator);

module.exports = mongoose.model("Item", itemSchema);