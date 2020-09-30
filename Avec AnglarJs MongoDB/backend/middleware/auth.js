const jwt = require('jsonwebtoken');

module.exports = (req, res, next) => {
  try {
    // decode token
    const token = req.headers.authorization.split(' ')[1];
    const decodedToken = jwt.verify(token, 'SECRET_TOKEN');
    const userId = decodedToken.userId;
    // check userId matches
    if (req.body.userId && req.body.userId !== userId) {
      throw 'Invalid user ID';
    } else {
      next();
    }
  } catch {
    res.status(401).json({
      error: "not authorized to access this ressource"
    });
  }
};