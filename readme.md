Code Challenge - API with User ratings 
============================================

Backend Developer Code Challenge user ratings

The specifications for this exercise are not very detailed on purpose, we leave you the freedom
to build a solution that you think make sense.

Objective of the test: imagine you have a website with users, and those users can write
comments. Your task is to add a REST API to the backend for a new feature: the possibility for
users to rate comments written by other users.

    ● Install the PHP framework and setup a MySQL database.
    ● Create a model in the database for the entities: users, comments (and later ratings).
    ● Create 2 REST endpoints:
        ● one to rate a comment (a rating is a thumb up or a thumb down).
        ● one to get the total score (sum of ratings) for a comment.


Requirements
============

* PHP >= 7.1


Conclusion
==========

I decided to choose Laravel Lumen for that project. 
A note of my solution for the endpoint to get the total score of ratings for one comment:
I do not like it to deliver custom endpoints, as I want to play by the rules of an RESTful API.
If you call a comment via API you retrieve the comment including all the ratings by default. 
You can count the total score on the response.  

Includes
========

Lumen Route List 
https://github.com/appzcoder/lumen-route-list

Fractal module for the Lumen PHP framework.
https://github.com/digiaonline/lumen-fractal


API endpoints
=============


#### Display on comment including all ratings

    GET /comment/{commentId}
    
##### Response

    {
        "data": {
            "id": 1,
            "text": "Lumen is cool",
            "user": {
                "data": {
                    "id": 1,
                    "name": "ben",
                    "email": "ben@exampe.com"
                }
            },
            "ratings": {
                "data": [
                    {
                        "id": 1,
                        "rate": 1
                    },
                    {
                        "id": 2,
                        "rate": 0
                    }
                ]
            }
        }
    }
        
#### Store one Rating

    POST /rate 
    
##### Request      

Request parameter with validation rules

    'user_id' => 'required|integer',
    'comment_id' => 'required|integer', 
    'rate' => 'required|boolean'
    
    
##### Response 

    {
        "data": {
            "id": 6,
            "rate": "1"
        }
    }
    

