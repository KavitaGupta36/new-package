<?php
use App\Events\MessageSent;

Route::group(['middleware' => ['web', 'auth']], function(){
	/*Route::get('messages','Chat\Message\ChatController@message');
	Route::post('sendMessage','Chat\Message\ChatController@sendMessage');
	Route::get('contacts','Chat\Message\ChatController@contacts');
	Route::get('conversation/{id}','Chat\Message\ChatController@getMessage');
	Route::get('unreadMessage/{id}','Chat\Message\ChatController@fetchUnreadMessage');

	Route::get('event', 'Chat\Message\ChatController@sendByPusher');

	Broadcast::channel('my-channel',function(){
		return true;
	});*/

	Route::get('/contacts', 'Chat\Message\ChatController@get');
	Route::get('/conversation/{id}', 'Chat\Message\ChatController@getMessagesFor');
	Route::post('/conversation/send', 'Chat\Message\ChatController@send');
});
