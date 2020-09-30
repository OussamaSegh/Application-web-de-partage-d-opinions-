/**
 * Routes related to categories
 */
// imports
const express = require('express');
const categoryCtrl = require('../controllers/category.ctrl');
const auth = require('../middleware/auth');
// instanciate router
const router = express.Router();

// DISPLAY all categories
router.get('/', categoryCtrl.getAllCategories);

// ADD category
router.post('/addCategory',auth, categoryCtrl.createCategory);

// LIST categories : no need to auth as it is available to any visitor.
router.get('/listCategories', categoryCtrl.getListCategories);

// DELETE category
router.delete('/deleteCategory/:categoryId', auth, categoryCtrl.deleteCategory);

// UPDATE category
router.put('/updateCategory/:categoryId', auth, categoryCtrl.updateCategory);

module.exports = router;