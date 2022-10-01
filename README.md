Samson Wandah - JNBK Task

# How to Run The Application
- Clone your project : `git clone https://github.com/sam4021/jnbk_task.git`
- Go to the folder application 
- Run `composer install` on your cmd or terminal
- Run `npm install` on your cmd or terminal
- Copy .env.example file to .env on the root folder. You can type copy .env.example .env if using command prompt Windows or cp .env.example .env if using terminal, Ubuntu
- Open your .env file and change the database name (DB_DATABASE) to whatever you have, username (DB_USERNAME) and password (DB_PASSWORD) field correspond to your configuration.
- Run `php artisan key:generate`
- Run `php artisan migrate`
- Run `php artisan serve`
- Go to http://localhost:8000/

## To run Test
- `php artisan test`

- For JWT I used this package: tymon/jwt-auth
## Models:
- Users
- Product
- Category
- ProductCategory

## User
    Datatypes
    - name: string
    - email: string| email
    - password: string
- Register: POST  /api/auth/register
    - Fields: name, email, password, password_confirmation

- Login: POST /api/auth/login
    - Fields: [email, Password]   
    - you will be issued with a token

- User Profile : GET  /api/auth/user-profile
    - Fields: []
    - use issued token to get user profile

- Refresh Token: POST	/api/auth/refresh
    - Fields: []
- Logout: POST	/api/auth/logout
    - Fields: []

## Category
    Datatypes:
    - Title: string
    - is_active: Boolean

- All Categories:  GET /api/category
- View Category: GET /api/category/view/{id}
- Save New Category: POST /api/category/store
    - Fields: [title, is_active]
- Update: PATCH /api/update/{id}
- Delete: POST /api/delete/{id}
    
## Products
    Datatypes:
    - Title: string
    - price: int
    - is_active: Boolean
    - category: int| category id


- All Products: GET /api/products/
- View Product: GET /api/products/view/{id}
- New Product: POST /api/products/store
    - Fields: title, price, is_active, category
- Update Product: PATCH /api/products/update/{id}
    - Fields: title, price, is_active
- Delete Product: POST /api/products/delete/{id}
- Add Product to Category: POST /api/products/add-category/{id}
    - Fields:  category
- Delete Product from Category: POST /api/products/delete-category/{id}
    - Fields: category
