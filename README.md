## About the Project

This project is a web app for creating clubs and organizing its members

## TODO
- [ ] For club members
    - [x] Fix the memberships crud operations
    - [x] Fix the membership types crud operations
    - [x] Fix the membership type names crud operations
    - [x] Fix the vehicles crud operations
    - [x] Add choose-club menu at the upper rightmost corner
    - [ ] As a club admin
        - [x] Fix the club members crud operations 
        - [ ] Fix the create and edit members operation
        - [ ] Fix the delete members operation
        - [ ] I can edit the club details
- [x] Fix the currentUserInfo method in API (try login and logout with and without remember_token)
- [x] Fix the Base Controller of ApiController, remove the middleware auth in api controller

## PRODUCTION DEPLOYMENT
1. Deploying Passport.   
   When deploying Passport to your production servers for the first time, you will likely need to run the passport:keys 
   command. This command generates the encryption keys Passport needs in order to generate access token. The generated 
   keys are not typically kept in source control:   
   ``php artisan passport:keys``
