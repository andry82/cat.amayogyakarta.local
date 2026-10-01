
$routes->add('register', '\App\Controllers\Auth::register', ['as' => 'register']);

$routes->add('activate', '\App\Controllers\Auth::activate');
$routes->add('activate/(:alphanum)', '\App\Controllers\Auth::activate/$1');
$routes->add('activate(:any)', '\App\Controllers\Auth::activate/$1', ['as' => 'activate']);

$routes->add('activation-request', '\App\Controllers\Auth::requestActivation', ['as' => 'activation-request']);
$routes->add('reset-password', '\App\Controllers\Auth::requestReset', ['as' => 'reset-password']);

$routes->add('reset', '\App\Controllers\Auth::resetPassword');
$routes->add('reset/(:alphanum)', '\App\Controllers\Auth::resetPassword/$1');
$routes->add('reset(:any)', '\App\Controllers\Auth::resetPassword/$1', ['as' => 'reset']);

$routes->add('login', '\App\Controllers\Auth::login', ['as' => 'login']);
$routes->add('logout', '\App\Controllers\Auth::logout', ['as' => 'logout']);

$routes->group('forbidden', function ($routes)
{
	$routes->add('role', '\App\Controllers\Auth::forbidden/role', ['as' => 'forbidden-role']);
	$routes->add('group', '\App\Controllers\Auth::forbidden/group', ['as' => 'forbidden-group']);
});