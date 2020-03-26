<?php
Route::post('/onbording/init/save', 'Eq3w\Onboarding\Components\FrontendCapture@save')->middleware('web');
Route::post('/onbording/init/update/{code}', 'Eq3w\Onboarding\Components\FrontendCapture@update')->middleware('web');
Route::get('/onbording/init/save', 'Eq3w\Onboarding\Components\FrontendCapture@save')->middleware('web');

//Route::get('/fakecomp', 'Eq3w\Onboarding\Components\Companies@fakesave')->middleware('web');
Route::get('/fakecomp', 'Eq3w\Onboarding\Components\Company@bulkdummies')->middleware('web');

//Route::get('/capture{code}', 'Eq3w\Onboarding\Components\Companies@fakesave')->middleware('web');

Route::post('/company/update', 'Eq3w\Onboarding\Components\Company@update')->middleware('web');
Route::post('/contact/create', 'Eq3w\Onboarding\Components\Company@addContact')->middleware('web');

Route::get('/company/create', 'Eq3w\Onboarding\Components\Company@create')->middleware('web');
Route::get('/company/exl/{id}', 'Eq3w\Onboarding\Components\Company@createSpredsheet')->middleware('web');

Route::get('/company/dlarch/{id}', 'Eq3w\Onboarding\Components\Company@getOnboardingDataArch')->middleware('web');

Route::get('/countries', 'Eq3w\Onboarding\Components\Company@getCountries')->middleware('web');


