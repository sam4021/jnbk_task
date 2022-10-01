Samson Wandah - JNBK Task



For JWT I used this package: tymon/jwt-auth
Models:
- Users
- Product
- Category
- ProductCategory

## User
- Datatypes
    -- 
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
        Route::patch('update/{id}', 'CategoryController@update');
        Route::post('delete/{id}', 'CategoryController@destroy');
    });
## Products
Route::prefix('products')->group(function () {
        Route::get('/', 'ProductController@index');
        Route::get('view/{id}', 'ProductController@show');
        Route::post('store', 'ProductController@store');
        Route::patch('update/{id}', 'ProductController@update');
        Route::post('delete/{id}', 'ProductController@destroy');
        Route::post('add-category/{id}/', 'ProductController@category_add');
        Route::post('delete-category/{id}', 'ProductController@category_delete');
    });








Requirement
Create a simple and secure REST API using Laravel and SQL database.
The project shall contain the following functionality:
● JWT token
● Admin / User authentication is required
● One or more model (Table) is required
● CRUD API is required

Assessment
We will be reviewing the submitted application using the following guidelines:
● Does the app handle error conditions?
● Does the app perform the required functionality?
● Is the code well-formatted?
● Does the code contain comments if not self-explanatory?

Deliverables
• A final version of your code as a zip archive or private repository link.
• Readme file that explains how to run/test applications locally.
