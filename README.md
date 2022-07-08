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

