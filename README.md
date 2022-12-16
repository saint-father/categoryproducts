# Categoryproducts module by Alexey Fedorov
Newbe test task: category-product relations in API 

## Features
- "Accept" header is not required in request. 'Application/json' response type will be set in any cases.

### Available methods

    Login:              method:GET, URL:http://localhost:8000/oauth/token
    Register:           method:GET, URL:http://localhost:8000/api/register
    Current user info:  method:GET, URL:http://localhost:8000/api/get-user

    List:               method:GET, URL:http://localhost:8000/api/products
    Create:             method:POST, URL:http://localhost:8000/api/products
    Show:               method:GET, URL:http://localhost:8000/api/products/{id}
    Update:             method:PUT, URL:http://localhost:8000/api/products/{id}
    Delete:             method:DELETE, URL:http://localhost:8000/api/products/{id}
    AssignCategory:     method:DELETE, URL:http://localhost:8000/api/assign-category/{productId}
    
    List:               method:GET, URL:http://localhost:8000/api/categories
    Create:             method:POST, URL:http://localhost:8000/api/categories
    Show:               method:GET, URL:http://localhost:8000/api/categories/{id}
    Update:             method:PUT, URL:http://localhost:8000/api/categories/{id}
    Delete:             method:DELETE, URL:http://localhost:8000/api/categories/{id}

## Installation
- Install Laravel 8/9 and create new project then
- Add "categoryproducts" repository to composer.json:
```json
"repositories": [
        {
            "type": "git",
            "url": "https://github.com/saint-father/categoryproducts.git"
        }
    ],
```
- Install the module:
```console
composer require alexfed/categoryproducts:dev-master#v0.0.6
```
