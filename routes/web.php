<?php

/*
|--------------------------------------------------------------------------
| Pixel Home Routes
|--------------------------------------------------------------------------
|
| The following are the routes that list out downloads. These include 
| the Home, Latest, Popular, Tag, and Search page.
|
*/

	Route::get('/', 'HomeController@home');
	Route::get('/home', 'HomeController@home');
	Route::get('/latest', 'HomeController@home');
	Route::get('/popular', 'HomeController@popular');
	Route::get('/tags/{tagname}', 'HomeController@tags');
	Route::get('/search', 'HomeController@search');


	/*
	 * phần code route mới update thêm
	 * phần này sẽ thêm các route phục vụ cho việc đăng kí thành viên
	 * đăng kí sẽ vào route /sign-up để thực hiện
	 * xử lí chính khi nhận thông tin đăng  kí là postSignUp
	 * đã có logout, logout thì cẩn truy cập đến link www.domain/logout
	 * note: logout chưa được gắn trên giao diện
	 * đăng kí thành viên mặc định sẽ là free user
	 * tạo free user cần requesst tới route 'wwww.domain.com/themUSerFree'
	 *  được code như sau
	 Route::get('/themUSerFree', function(){
        \DB::table('roles')->insert(array (
            2 =>
                array (
                    'id' => 3,
                    'name' => 'free user',
                    'display_name' => 'Free User',
                    'created_at' => '2017-02-10 14:18:17',
                    'updated_at' => '2017-02-10 14:18:17',
                )
        ));
        echo 'đẵ thêm user';download_count
    });
	 * ***/
    Route::get('/logout', 'HomeController@logout')->name('logout');
    Route::get('/sign-up', 'HomeController@signup')->name('sign-up');
    Route::post('/sign-up', 'HomeController@postSignUp')->name('post-sign-up');







/*
|--------------------------------------------------------------------------
| Pixel Category Routes
|--------------------------------------------------------------------------
|
| The following are the routes for the Pixel Category Pages
|
*/

	Route::get('/category/{slug}', 'HomeController@category');


/*
|--------------------------------------------------------------------------
| Pixel Download Routes
|--------------------------------------------------------------------------
|
| The following are the routes for the Pixel Download Pages, including
| Routes for liking and downloading content.
|
*/

	$download_url_slug = (config('downloads_url_slug') !== null) ? config('downloads_url_slug') : 'download';
	Route::get($download_url_slug . '/{slug}', 'DownloadController@index')->name('download');
	Route::get('/download_page/{slug}', 'DownloadController@download_page')->name('download_page')->middleware('userFreeCheck');
	Route::get('/download_file/{slug}', 'DownloadController@download_file')->name('download_file')->middleware('userFreeCheck');

	Route::post('download_like', 'DownloadController@download_like')->middleware('userFreeCheck');
	Route::get('/download_count/{slug}', 'DownloadController@download_count')->name('download_count')->middleware('userFreeCheck');

/*
|--------------------------------------------------------------------------
| Pixel RSS Feed
|--------------------------------------------------------------------------
|
| The following route will show an rss feed of the last 100 downloads 
| that have been added to the site
|
*/

	Route::get('/rss', 'HomeController@rss');


/*
|--------------------------------------------------------------------------
| Pixel Sitemap
|--------------------------------------------------------------------------
|
| The following route will output the current sitemap xml file
|
*/

	Route::get('sitemap.xml', 'HomeController@sitemap');


/*
|--------------------------------------------------------------------------
| Page Routes
|--------------------------------------------------------------------------
|
| This is the route when a user visits a single page
|
*/

	Route::get('page/{slug}', 'PageController@read');


/*
|--------------------------------------------------------------------------
| Blog Routes
|--------------------------------------------------------------------------
|
| The following routes are the routes that handle the blog functionality
|
*/

	Route::get('blog', 'PostController@browse');
	Route::get('blog/{slug}', 'PostController@read');


/*
|--------------------------------------------------------------------------
| Voyager Admin Routes
|--------------------------------------------------------------------------
|
| The following are the routes for the Pixel Voyager Admin Section
| If you would like to learn more about voyager you can visit: 
| https://the-control-group.github.io/voyager/
|
*/

	Route::group(['prefix' => 'admin'], function () {
	    Voyager::routes();
	});
