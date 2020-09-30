const mongoose = require('mongoose');
const uniqueValidator = require('mongoose-unique-validator');

/**
 * User model. Constraints :
 * Not possible to have same email address.
 * Status is integer.
 */
const userSchema = mongoose.Schema({
    email: {type: String, required: true, unique: true},
    firstName: {type: String, required: true},
    lastName: {type: String, required: true},
    status : {type: Number,required:true, 
        validate: {validator: Number.isInteger,
        message: '{VALUE} is not an integer value'}},
    password : {type : String, required:true},
    banned : {type : Boolean,required:true}
});

userSchema.plugin(uniqueValidator);

module.exports = mongoose.model("User", userSchema);