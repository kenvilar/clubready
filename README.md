## About the Project

This project is a web app for creating clubs and organizing its members

## TODO
- [x] Fix all the list tables especially the ID and User columns
- [x] Fix the club members to display verified and unverified users for club-admins
- [x] Redirect to 404 page if json content is "The specified URL cannot be found"
- [x] For club members
    - [x] Fix the memberships crud operations
    - [x] Fix the membership types crud operations
    - [x] Fix the membership type names crud operations
    - [x] Fix the vehicles crud operations
    - [x] Add choose-club menu at the upper rightmost corner
    - [x] Display the club name at the upper leftmost menu
    - [x] As a club admin
        - [x] Fix the club members crud operations 
        - [x] Fix the create and edit members operation
        - [x] Unverified the member instead of deleting them
        - [x] I can edit the club details
- [x] Fix the currentUserInfo method in API (try login and logout with and without remember_token)
- [x] Fix the Base Controller of ApiController, remove the middleware auth in api controller
- [x] When the system not the user logout its account, its oauth token should revoked 
- [x] Hide the current user in super-admin list
- [x] Redirect to dashboard page after login for super-admin users
- [x] Add settings for site name and logo
- [ ] Can remove the logo image

## PRODUCTION DEPLOYMENT
1. Deploying Passport.   
   When deploying Passport to your production servers for the first time, you will likely need to run the passport:keys 
   command. This command generates the encryption keys Passport needs in order to generate access token. The generated 
   keys are not typically kept in source control:   
   ``php artisan passport:keys``
