<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
*/




Route::get('/go', function()
{
	$data = db::query('SELECT album FROM data ORDER BY id DESC')->fetchAll();

	foreach ($data as $d)
	{
		$slug = Str::slug(trimer($d->album), '_');

		Keyword::create(ucwords(str_replace('_', ' ', $slug)), $slug );
	}

});

// home page
Route::get('/', 'HomeController::index');

Route::post('/', 'HomeController::search');

Route::get('/(:name)', 'Mp3Controller::result');

Route::get('/get/(:num)', 'Mp3Controller::getById');

Route::get('/load/(:num)', 'Mp3Controller::download');

Route::get('/list/(:name)', 'ListController::getList');


// sitemap index
Route::get('/sitemap', 'SitemapController::index');

Route::get('/sitemap/(:num)', 'SitemapController::sitemap');

function trimer($str)
{
	$patterns = "/([\dA-Za-z\.:\/-]+)\.([A-Za-z\.]{1,6})/i";
	$str = preg_replace($patterns, '', $str);
	$str = preg_replace("/(19|20)[0-9][0-9]/", '', $str);

	$str = str_ireplace('www', '', $str);
	return $str;	
}

?>