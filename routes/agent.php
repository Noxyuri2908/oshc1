<?php
Route::middleware(['auth', 'can:agent'])->prefix('agent')->group(function () {
	Route::get('/profile', 'Admin\AgentController@getProfile')->name('agent-profile.get');
	Route::post('/profile/{id}', 'Admin\AgentController@postProfile')->name('agent-profile.post');
	Route::get('/commission', 'Admin\AgentController@getCommission')->name('agent-commission.get');
	Route::get('/service/register', 'Admin\AgentController@getReg')->name('agent-reg.get');	
});