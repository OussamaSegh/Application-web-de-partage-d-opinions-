// Model
const User = require("../models/user.model");

const jwt = require('jsonwebtoken');
const bcrypt = require('bcrypt');

// CREATE new user
exports.signin = (req, res, next) => {
  console.log("Request to create a new user.");
  bcrypt.hash(req.body.password, 10)
    .then(hash => {
      const user = new User({
        email: req.body.email,
        firstName: req.body.firstName,
        lastName: req.body.lastName,
        status: '2',
        password: hash,
        banned: false
      });
      user.save()
        .then(() => {res.status(201).json({userId: user._id, token: jwt.sign({userId: user._id},'SECRET_TOKEN',{expiresIn: '24h'})});
                     console.log("Nouvel utilisateur créé : " + user);})
        .catch(error => res.status(400).json({ error: error }));
    })
    .catch(error => res.status(500).json({ error: error }));
};

// VERIFY user
exports.login = (req, res, next) => {
  console.log("Request to log user.")
  User.findOne({ email: req.body.email })
    .then(user => {
      if (!user) {
        return res.status(401).json({ error: 'Utilisateur non trouvé !' });
      }
      bcrypt.compare(req.body.password, user.password)
        .then(valid => {
          if (!valid) {
            return res.status(401).json({ error: 'Mot de passe incorrect !' });
          }
          res.status(200).json({
            userId: user._id,
            token: jwt.sign(
              { userId: user._id },
              'SECRET_TOKEN',
              { expiresIn: '24h' }
            )
          });
        })
        .catch(error => res.status(500).json({ error: error }));
    })
    .catch(error => res.status(500).json({ error: error }));
};


// GET all users from DB (for admin and testing)
exports.users = (req, res, next) => {
  User.find()
    .then(users => res.status(200).json({ users: users }))
    .catch(error => res.status(400).json({ error: error }));
}


// GET info on one user based on its ID
exports.userInfo = (req, res, next) => {
  console.log("Request to get user info.")
  var userId = req.params.userId;
  User.findById(userId)
    .then(user => {
      res.status(200).json({ userInfo: user});
      console.log("User info sent : " + user);})
    .catch(err => res.status(400).json({error: err}));

}