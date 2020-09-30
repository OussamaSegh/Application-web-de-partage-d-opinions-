/**
 * Express App
 * TODO : define CORS policies at the routes level
 */

// require packages
const express = require('express');
const mongoose = require('mongoose');
const bodyParser = require('body-parser');
const cors = require('cors');


// require routes
const categoryRoute = require('./routes/category.route.js');
const userRoutes = require('./routes/user.route');
const itemRoute = require('./routes/item.route.js');

// instanciate Express App
const app = express();

// use JSON parser
app.use(bodyParser.json());

// allow CORS for all the backend
app.use(cors());

// connexion BDD
mongoose.connect('mongodb+srv://pi:rasp@cluster0-ofbpk.mongodb.net/test?retryWrites=true&w=majority',
    {
        useNewUrlParser: true,
        useUnifiedTopology: true
    })
    .then(() => console.log('Connexion à MongoDB réussie !'))
    .catch(() => console.log('Connexion à MongoDB échouée !'));

// routers
app.use('/api/category', categoryRoute);
app.use('/api/item', itemRoute)
app.use('/api/auth', userRoutes);


// export app to be used by server
module.exports = app;