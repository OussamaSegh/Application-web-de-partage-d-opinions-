# MEAN Project

Toutes les parties ont été dev par Francois et Florian

Only a few functionalities from spec have been implemented.

## Functionnalities
### implemented : 
User :
- signin
- login
- logout
- list users in admin panel

Items :
- add
- list based on category
- only the item owner can access to modify/delete buttons

Categories :
- add
- no delete/update once instanciated

### not implemented : 
Comments : 
- list
- revision

Admin :
- authentification
- delete / ban user
- delete / ban comment


Categories : 
- add only for admin
- update category
- search

Items :
- search 
- delete
- update


## Organisation

The MEAN version of the website is separated in 2 parts.

## Backend API : NodeJS + Express + MongoDB
- runs at localhost:3000
- routes requests from frontend
- interacts with MongoDB for CRUD operations
- manages access rights with JWT tokens

cmd to run in backend/ folder : 
'''sh
node server.js
'''


## Frontend App : AngularJS
- runs at http://localhost/projet-web-equipe-2/MEAN/frontend/
- makes calls to backend API with services.

As a user : go to http://localhost/projet-web-equipe-2/MEAN/frontend/
Creates an account or use this one :
email : user@user.com
password : pwd