# Lumen API

An API built over Laravel's Lumen to cause great stuff to happen

## installation

```
composer create-project --prefer-dist laravel/lumen lumen-api
```

> Open up the `bootstrap/app.php` and uncomment this line, // app->withEloquent

> Open up the `bootstrap/app.php` and uncomment this line, // //$app->withFacades();

> Don't forget to set your database credentials in the `.env` file

### Run migrations

```bash
php arisan migrate
```

## Access

The API is accessible via [https://lumen-api.greysoft.com.ng/](https://lumen-api.greysoft.com.ng/api)

# Endpoints

all api endpoints, methods and response

### Register

```
Method: POST
URI: localhost:8000/api/register
Body:   {
            "username": "joshchief1",
            "email": "joshchief1619@gmail.com",
            "password":"password"
        }
Response:   {
                "token": "7FZKMN2e4OxywtSqvbT3AjyaBUocgSw345jYDIsttoTvrEChxR",
                "user": {
                    "id": "5a1b9d92-9986-49e6-b401-640d933a3ed2",
                    "username": "joshchief1",
                    "email": "joshchief1619@gmail.com",
                    "created_at": "2022-03-07T11:18:00.000000Z",
                    "updated_at": "2022-03-07T11:18:00.000000Z"
                }
            }
```

### Login

```
Method: POST
URI: localhost:8000/api/login
Body:   {
            "email": "joshchief1619@gmail.com",
            "password":"password"
        }
Response:   {
                "message": "success",
                "token": "7FZKMN2e4OxywtSqvbT3AjyaBUocgSw345jYDIsttoTvrEChxR",
                "user": {
                    "id": "5a1b9d92-9986-49e6-b401-640d933a3ed2",
                    "username": "joshchief1",
                    "email": "joshchief1619@gmail.com",
                    "created_at": "2022-03-07T11:18:00.000000Z",
                    "updated_at": "2022-03-07T11:18:00.000000Z"
                }
            }
```

### Logout

```
Method: GET
URI: localhost:8000/api/logout?api_token=7FZKMN2e4OxywtSqvbT3AjyaBUocgSw345jYDIsttoTvrEChxR
Response:   {
                "message": "user logged out"
            }
```

### Get all Boards

```
Method: GET
URI: localhost:8000/api/boards?api_token=7FZKMN2e4OxywtSqvbT3AjyaBUocgSw345jYDIsttoTvrEChxR
Response:   {
                {
                    "message": "success",
                    "boards": {
                        "id": 1,
                        "user_id": "5a1b9d92-9986-49e6-b401-640d933a3ed2",
                        "name": "Make Shift",
                        "created_at": "2022-03-07T11:18:00.000000Z",
                        "updated_at": "2022-03-07T11:18:00.000000Z"
                    }
                },
                {
                    "message": "success",
                    "boards": {
                        "id": 2,
                        "user_id": "5a1b9d92-9986-49e6-b401-640d933a3ed2",
                        "name": "Build Wells",
                        "created_at": "2022-03-07T11:18:00.000000Z",
                        "updated_at": "2022-03-07T11:18:00.000000Z"
                    }
                }
            }
```

### Get a single Board

```
Method: GET
URI: localhost:8000/api/boards/1?api_token=7FZKMN2e4OxywtSqvbT3AjyaBUocgSw345jYDIsttoTvrEChxR
Response:   {
                "message": "success",
                "boards": {
                    "id": 1,
                    "user_id": "5a1b9d92-9986-49e6-b401-640d933a3ed2",
                    "name": "Make Shift",
                    "created_at": "2022-03-07T11:18:00.000000Z",
                    "updated_at": "2022-03-07T11:18:00.000000Z"
                }
            }
```

### Create Board

```
Method: POST
URI: localhost:8000/api/boards/create
Response:   {
                "message": "success",
                "board": {
                    "id": 1,
                    "name": "personal",
                    "user_id": "bfebd953-e453-43a7-a302-01c51187addf",
                    "created_at": "2022-03-08T03:56:00.000000Z",
                    "updated_at": "2022-03-08T03:56:00.000000Z"
                }
            }
```

### Create List

```
Method: POST
URI: localhost:8000/api/lists/create/{board}?api_token=nXc9xHU78QzMj2nFDLj4fPon3RFq3yYr4TjcvKnPe2Q6g2MkWz

###Form-data   ###Properties
list            string

Response:   "message": "list created",
            "list": [
                "break",
                "puke",
                "cord"
```

### Get List

```
Method: GET
URI: localhost:8000/api/lists/{board}?api_token=nXc9xHU78QzMj2nFDLj4fPon3RFq3yYr4TjcvKnPe2Q6g2MkWz
Response:   "message": "success",
            "lists": [
                {
                    "id": 3,
                    "list": "blown",
                    "board_id": 2,
                    "created_at": "2022-03-10T22:46:46.000000Z",
                    "updated_at": "2022-03-10T22:46:46.000000Z"
                }
            ]
```

### Update List

```
Method: PUT
URI: localhost:8000/api/lists/{lists}/update?api_token=nXc9xHU78QzMj2nFDLj4fPon3RFq3yYr4TjcvKnPe2Q6g2MkWz
Response:   {
                "message": "list updated",
                "List": {
                    "id": 4,
                    "list": "unpacking",
                    "board_id": 2,
                    "created_at": "2022-03-10T22:56:41.000000Z",
                    "updated_at": "2022-03-10T23:18:27.000000Z"
                }
            }
```

### Delete List

```
Method: DELETE
URI: localhost:8000/api/lists/{lists}/delete?api_token=nXc9xHU78QzMj2nFDLj4fPon3RFq3yYr4TjcvKnPe2Q6g2MkWz
Response:   {
                "message": "{list->name} removed"
            }
```

### Create Task

```
Method: POST
URI: localhost:8000/api/tasks/create/1?api_token=7FZKMN2e4OxywtSqvbT3AjyaBUocgSw345jYDIsttoTvrEChxR
Response:   "message": "success",
            "task": {
                "id": 3,
                "name": "build lumen",
                "list_id": 3,
                "created_at": "2022-03-11T00:08:47.000000Z",
                "updated_at": "2022-03-11T00:08:47.000000Z"
            }
```

### Get Task

```
Method: GET
URI: localhost:8000/api/tasks/4?api_token=7FZKMN2e4OxywtSqvbT3AjyaBUocgSw345jYDIsttoTvrEChxR
Response:   "message": "success",
            "task": {
                "id": 3,
                "name": "build lumen",
                "list_id": 3,
                "created_at": "2022-03-11T00:08:47.000000Z",
                "updated_at": "2022-03-11T00:08:47.000000Z"
            },
            {
                "id": 4,
                "name": "build lumen",
                "list_id": 3,
                "created_at": "2022-03-11T01:32:49.000000Z",
                "updated_at": "2022-03-11T01:32:49.000000Z"
            }
```

### Update Task

```
Method: GET
URI: localhost:8000/api/tasks/4/update?api_token=7FZKMN2e4OxywtSqvbT3AjyaBUocgSw345jYDIsttoTvrEChxR
Response:   "message": "task updated",
            "task": {
                "id": 4,
                "name": "lumen-api",
                "list_id": 3,
                "created_at": "2022-03-11T01:32:49.000000Z",
                "updated_at": "2022-03-11T01:35:48.000000Z"
            }
```

### Delete Task

```
Method: GET
URI: localhost:8000/api/tasks/4/delete?api_token=7FZKMN2e4OxywtSqvbT3AjyaBUocgSw345jYDIsttoTvrEChxR
Response:   {
                "message": "success"
            }
```
