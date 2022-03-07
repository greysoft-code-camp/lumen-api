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

# Endpoints

all api endpoints, methods and response

### Register

```
Method: POST
URI: localhost:8000/api/register
Response:   "user": {
                "id": "5a1b9d92-9986-49e6-b401-640d933a3ed2",
                "username": "joshchief1",
                "email": "joshchief1619@gmail.com",
                "api_token": "7FZKMN2e4OxywtSqvbT3AjyaBUocgSw345jYDIsttoTvrEChxR",
                "created_at": "2022-03-07T11:18:00.000000Z",
                "updated_at": "2022-03-07T11:18:00.000000Z"
            }
```

### Login

```
Method: POST
URI: localhost:8000/api/login
Response:   "message": "success",
            "user": {
                "id": "5a1b9d92-9986-49e6-b401-640d933a3ed2",
                "username": "joshchief1",
                "email": "joshchief1619@gmail.com",
                "api_token": "7FZKMN2e4OxywtSqvbT3AjyaBUocgSw345jYDIsttoTvrEChxR",
                "created_at": "2022-03-07T11:18:00.000000Z",
                "updated_at": "2022-03-07T11:18:00.000000Z"
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

## Access
The API is accessible via [https://lumen-api.greysoft.com.ng/](https://lumen-api.greysoft.com.ng/)
