<?php


// Before Router Middleware
$router->before('GET', '/.*', function () {
    header('X-Powered-By: g-server');
    header('User-Agent: '.$_SERVER['HTTP_USER_AGENT']);
});





/*admin auth*/
$router->before('GET|POST|DELETE', '/administration/.*', function() {///admin/.*
    if (!isset($_SESSION['USER'])) {
        if($_SERVER['REQUEST_URI'] != "/login"){
        	header('location: /login');
        	exit();
        }
    }
});
$router->before('GET|POST|DELETE|PUT', '/api/.*', function() {///admin/.*
    header('Content-Type: application/json');
});




// Define routes
$router->get('/','\App\Controllers\Customers\PageController@home');

//customer feedback receiving api cff customer feedbackform
$router->post('/cff-api/comment/{customer_code}/{app_id}/{ref_code}','\App\Controllers\Customers\ApiController@comment');




/*Administration*/
$router->get('/login','\App\Controllers\Management\AuthController@login'); 
$router->post('/login','\App\Controllers\Management\AuthController@post_login');
$router->get('/logout','\App\Controllers\Management\AuthController@logout');

$router->get('/administration','\App\Controllers\Management\PageController@home');
$router->get('/administration/{app_id}','\App\Controllers\Management\PageController@view_app');
/************************************8888/ 




//web auth
$router->get('/login','\Web\OS\Controllers\AuthController@get_login');
$router->post('/login','\Web\OS\Controllers\AuthController@post_login');
$router->get('/logout','\Web\OS\Controllers\AuthController@logout');

$router->get('/users','\Web\OS\Controllers\PageController@users_page');
$router->get('/companies','\Web\OS\Controllers\PageController@companies_page');
$router->get('/credentials_init','\Web\OS\Controllers\PageController@credentials_init_page');

$router->get('/admin/','\Web\OS\Controllers\PageController@home');





$router->get('/api','\Web\OS\Controllers\APIController@home');
$router->post('/api/add_player','\Web\OS\Controllers\APIController@add_player');
$router->post('/api/unsubscribe_player','\Web\OS\Controllers\APIController@unsubscribe_player');
$router->post('/api/subscribe_player','\Web\OS\Controllers\APIController@subscribe_player');
$router->post('/api/remove_cat_from_acc','\Web\OS\Controllers\APIController@removeCategoryFromAccount');
$router->post('/api/add_cat_to_acc','\Web\OS\Controllers\APIController@addCategoryToAccount');



$router->get('/api/get_companies','\Web\OS\Controllers\APIController@getCompanies');
$router->post('/api/update_company','\Web\OS\Controllers\APIController@updateCompany');
$router->post('/api/add_company','\Web\OS\Controllers\APIController@addCompany');
$router->post('/api/delete_company','\Web\OS\Controllers\APIController@deleteCompany');



$router->get('/api/get_accounts/{customer_code}','\Web\OS\Controllers\APIController@getAccounts');
$router->post('/api/add_account','\Web\OS\Controllers\APIController@addAccount');
$router->post('/api/update_account','\Web\OS\Controllers\APIController@updateAccount');
$router->post('/api/delete_account','\Web\OS\Controllers\APIController@deleteAccount');
$router->post('/api/send_sms_to_account','\Web\OS\Controllers\APIController@send_sms_to_account');



//$router->get('/api/get_categories','\Web\OS\Controllers\APIController@getCategories');
$router->post('/api/update_category','\Web\OS\Controllers\APIController@updateCategory');
$router->post('/api/add_category','\Web\OS\Controllers\APIController@addCategory');
$router->post('/api/delete_category','\Web\OS\Controllers\APIController@deleteCategory');


*/

$router->set404(function() {
    header('HTTP/1.1 404 Not Found');
    echo "<span style='margin-top:30px;'/><p style='font-size:3em;color:gray;'>404 - Page not found.</p>";
});



?>