/**
 * Routes related to items
 */
// imports
const express = require('express');
const itemCtrl = require('../controllers/item.ctrl');

// instanciate router
const router = express.Router();

// Authentification middleware
const auth = require("../middleware/auth");

// ADD category
router.post('/addItem', auth, itemCtrl.createItem);

// DISPLAY all items : no need to auth as it is available to all visitors
router.get('/', itemCtrl.getAllItems);

module.exports = router;