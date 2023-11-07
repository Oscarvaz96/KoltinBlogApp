## About Application

This is an API that allows user to be registered and login.
The User(Author) can create posts, and comments inside the posts.

Tools used:
    -Composer
    -Laravel 9.x
    -PHP 8.0.x
    -Php Intelephense
    -XDebugger 3
    -XAMPP

## Application layers
    HTTP
        -Controllers
        -Requests
        -Resources
        -Middleware
    Service
        -Services
    Persistence
        -Models
        -Database (migrations, seeder and factories)

## Seeder
If you want to generate random data and test endpoints where you can check the data, just run
php artisan db:seed 
I created a factory for each model (User, Post and Comment) and a DB Seeder where this 3 models are generated and related.

## Routes

API Endpoints
Authentication:

You need to add the api_token on bearer token, auth in order to be authenticated

Note: Make sure in your headers you have 
Accept: application/json
So you can visualize responses of API as JSON
### Author
    -POST /api/author/register
        payload:
        {
            "name":"User Two",
            "email" : "user2@gmail.com",
            "password": "abcd@1234",
            "password_confirmation": "abcd@1234"
        }
    -POST /api/author/login
        payload:
        {
            "email" : "user1@gmail.com",
            "password": "abcd@1234"
        }
    -GET /api/author/me
        response:
        {
            "data": {
                "name": "User Two",
                "email": "user2@gmail.com",
                "api_token": "OlB0N4jsuNJFTTtRhiApSOdv27vlxrj00l2uPhsp15937yA5E5S41mrR5759Z4fRpxpL6bouGC9uvPfP",
                "posts": []
            }
        }
    -GET /api/authors
    Get all authors, with their posts and comments

### Posts

    -POST /api/post
        payload:
        {
            "title" : "Post title",
            "content" : "Content of Post the post"
        }
    -GET /api/posts/all
        return all posts with comments and author names
    -GET /api/posts/{post_id}
        respone:
        {
			"id": 4,
			"author": "User One",
			"title": "Post Three",
			"content": "Content of Post Three",
			"comments": [
				{
					"id": 4,
					"post_id": 4,
					"text": "This is the text of this comment",
					"created_at": "2023-11-07T17:30:11.000000Z",
					"updated_at": "2023-11-07T17:30:11.000000Z"
				}
			]
		}

### Comments
    -POST /api/posts/{post_id}/comment
        payload:
        {
            "text": "This is the text of this comment"
        }
    -GET /api/posts/{post}/comments
        response:
        {
            "data": [
                {
                    "author": "User One",
                    "text": "This is the text of this comment"
                },
                {
                    "author": "User One",
                    "text": "This is another comment on the same post!!"
                },
                {
                    "author": "User One",
                    "text": "This is another comment on the same post!!"
                }
            ]
        }
