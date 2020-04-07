## About ClubReady

ClubReady is a web app for creating clubs and organizing its members

## TODO

## FIXED
- Fix the currentUserInfo method in API (try login and logout with and without remember_token)

## PRODUCTION DEPLOYMENT
1. Deploying Passport.   
   When deploying Passport to your production servers for the first time, you will likely need to run the passport:keys 
   command. This command generates the encryption keys Passport needs in order to generate access token. The generated 
   keys are not typically kept in source control:   
   ``php artisan passport:keys``
