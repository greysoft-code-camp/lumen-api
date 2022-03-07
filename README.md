# Lumen API
An API built over Laravel's Lumen to cause great stuff to happen

## installation

```
composer create-project --prefer-dist laravel/lumen lumen-api
```

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
```
Response:   "user": {
                "id": "5a1b9d92-9986-49e6-b401-640d933a3ed2",
                "username": "joshchief1",
                "email": "joshchief1619@gmail.com",
                "api_token": "7FZKMN2e4OxywtSqvbT3AjyaBUocgSw345jYDIsttoTvrEChxR",
                "created_at": "2022-03-07T11:18:00.000000Z",
                "updated_at": "2022-03-07T11:18:00.000000Z"
            }



