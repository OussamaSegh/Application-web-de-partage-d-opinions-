const http = require('http');
const app = require('./app');

const port = process.env.PORT || 3000;
const hostname = 'localhost';

const myServer = http.createServer(app);

myServer.listen(port, hostname, ()=>{
    console.log(`Le serveur backend est up sur le port ${port}.`);
});