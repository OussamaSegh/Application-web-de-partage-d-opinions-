/**
 * Model for Category.
 * TODO : unique validator for name & url.
 */
const mongoose = require('mongoose');
const uniqueValidator = require('mongoose-unique-validator');

const categorySchema = mongoose.Schema({
    name: {type: String, required: true, unique: true},
    url: {type: String, required: true},
    instanciated: {type: Boolean, required: true, unique: true}
})

categorySchema.plugin(uniqueValidator);

module.exports = mongoose.model("Category", categorySchema);