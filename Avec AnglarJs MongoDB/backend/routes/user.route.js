const express = require('express');

const router = express.Router();

const userCtrl = require('../controllers/user.ctrl');

router.post('/signin', userCtrl.signin);
router.post('/login', userCtrl.login);

// GET users for admin and testing
router.get('/users', userCtrl.users);

// GET info on one user
router.get('/userInfo/:userId', userCtrl.userInfo);

module.exports = router;