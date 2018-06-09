<?php

// Front End
Route::get('/',"FrontController@index");
Route::get('/page/{id}', "FrontPageController@index");
Route::get('/category/{id}', "FrontController@category");
Route::get('/sub-category/{id}', "FrontController@subcategory");
Route::get('/post/{id}', "FrontController@post");
Route::post('/send-email', "FrontController@send_email");
Route::get('/room', "FrontRoomController@index");
Route::get('/gallery', "FrontGalleryController@index");
Route::get('/offer', "FrontOfferController@index");
Route::get('/room/detail/{id}', "FrontRoomController@book");
Auth::routes();

/////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////
// Back End
Route::get('/admin',"HomeController@index");
Route::get('/admin/dashboard',"HomeController@index");

// load file manager
Route::get('/fm', "FileManagerController@index");

// featured work admin
Route::get('/admin/room', "RoomController@index");
Route::get('/admin/room/create', "RoomController@create");
Route::get('/admin/room/edit/{id}', "RoomController@edit");
Route::get('/admin/room/delete/{id}', "RoomController@delete");
Route::get('/admin/room/view/{id}', "RoomController@view");
Route::post('/admin/room/save', "RoomController@save");
Route::post('/admin/room/update', "RoomController@update");
// Page
Route::get('/admin/page', "PageController@index");
Route::get('/admin/page/create', "PageController@create");
Route::post('/admin/page/save', "PageController@save");
Route::get('/admin/page/delete/{id}', "PageController@delete");
Route::get('/admin/page/edit/{id}', "PageController@edit");
Route::post('/admin/page/update', "PageController@update");
Route::get('/admin/page/view/{id}', "PageController@view");
// text welcome
Route::get('/admin/text-welcome', "OurServiceController@index");
Route::get('/admin/text-welcome/edit/{id}', "OurServiceController@edit");
Route::post('/admin/text-welcome/update', "OurServiceController@update");
// catogory
Route::get('/admin/category', "CategoryController@index");
Route::get('/admin/category/create', "CategoryController@create");
Route::get('/admin/category/edit/{id}', "CategoryController@edit");
Route::get('/admin/category/delete/{id}', "CategoryController@delete");
Route::post('/admin/category/save', "CategoryController@save");
Route::post('/admin/category/update', "CategoryController@update");
//Main Menu
Route::get('/main-menu', "MainMenuController@index");
Route::get('/main-menu/create', "MainMenuController@create");
Route::post('/main-menu/save', "MainMenuController@save");
Route::get('/main-menu/delete/{id}', "MainMenuController@delete");
Route::get('/main-menu/edit/{id}', "MainMenuController@edit");
Route::post('/main-menu/update', "MainMenuController@update");

//Sub Menu
Route::get('/sub-menu', "SubMenuController@index");
Route::get('/sub-menu/create', "SubMenuController@create");
Route::post('/sub-menu/save', "SubMenuController@save");
Route::get('/sub-menu/delete/{id}', "SubMenuController@delete");
Route::get('/sub-menu/edit/{id}', "SubMenuController@edit");
Route::post('/sub-menu/update', "SubMenuController@update");
// user route
Route::get('/user', "UserController@index");
Route::get('/user/profile', "UserController@load_profile");
Route::get('/user/reset-password', "UserController@reset_password");
Route::post('/user/change-password', "UserController@change_password");
Route::get('/user/finish', "UserController@finish_page");
Route::post('/user/update-profile', "UserController@update_profile");
Route::get('/user/delete/{id}', "UserController@delete");
Route::get('/user/create', "UserController@create");
Route::post('/user/save', "UserController@save");
Route::get('/user/edit/{id}', "UserController@edit");
Route::post('/user/update', "UserController@update");
Route::get('/user/update-password/{id}', "UserController@load_password");
Route::post('/user/save-password', "UserController@update_password");

// role
Route::get('/role', "RoleController@index");
Route::get('/role/create', "RoleController@create");
Route::post('/role/save', "RoleController@save");
Route::get('/role/delete/{id}', "RoleController@delete");
Route::get('/role/edit/{id}', "RoleController@edit");
Route::post('/role/update', "RoleController@update");
Route::get('/role/permission/{id}', "PermissionController@index");
Route::post('/rolepermission/save', "PermissionController@save");

// portfolio category
Route::get('/portfolio-category', "PortfolioCategoryController@index");
Route::get('/portfolio-category/create', "PortfolioCategoryController@create");
Route::get('/portfolio-category/edit/{id}', "PortfolioCategoryController@edit");
Route::get('/portfolio-category/delete/{id}', "PortfolioCategoryController@delete");
Route::post('/portfolio-category/save', "PortfolioCategoryController@save");
Route::post('/portfolio-category/update', "PortfolioCategoryController@update");

// portfolio
Route::get('/portfolio', "PortfolioController@index");
Route::get('/portfolio/create', "PortfolioController@create");
Route::get('/portfolio/edit/{id}', "PortfolioController@edit");
Route::get('/portfolio/delete/{id}', "PortfolioController@delete");
Route::post('/portfolio/save', "PortfolioController@save");
Route::post('/portfolio/update', "PortfolioController@update");

Route::get('/home', 'HomeController@index')->name('home');

// Slide 
Route::get('/slide', "SlideController@index");
Route::get('/slide/create', "SlideController@create");
Route::post('/slide/save', "SlideController@save");
Route::get('/slide/edit/{id}', "SlideController@edit");
Route::post('/slide/update', "SlideController@update");
Route::get('/slide/delete/{id}', "SlideController@delete");

// Social
Route::get('/social', "SocialController@index");
Route::get('/social/create', "SocialController@create");
Route::post('/social/save', "SocialController@save");
Route::get('/social/edit/{id}', "SocialController@edit");
Route::post('/social/update', "SocialController@update");
Route::get('/social/delete/{id}', "SocialController@delete");

// Gallery 
Route::get('/admin/gallery', "GalleryController@index");
Route::get('/admin/gallery/create', "GalleryController@create");
Route::post('/admin/gallery/save', "GalleryController@save");
Route::get('/admin/gallery/edit/{id}', "GalleryController@edit");
Route::post('/admin/gallery/update', "GalleryController@update");
Route::get('/admin/gallery/delete/{id}', "GalleryController@delete");
// Gallery 
Route::get('/admin/offer', "OfferController@index");
Route::get('/admin/offer/create', "OfferController@create");
Route::post('/admin/offer/save', "OfferController@save");
Route::get('/admin/offer/edit/{id}', "OfferController@edit");
Route::post('/admin/offer/update', "OfferController@update");
Route::get('/admin/offer/delete/{id}', "OfferController@delete");