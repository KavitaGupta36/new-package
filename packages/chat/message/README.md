# Laravel-Vue.js-Chat #

Laravchat is a real-time chat package that will enable logged in users in an application to start conersations with other users and chat in real-time for Laravel 5.4+. This package works with Laravel, Vuejs, Pusher and Laravel Echo.

#Prerequisite

You will need to have Pusher keys. Go to pusher.com and register for free, create an app and you will get your keys for the package.

# Installing

composer require kavita/chat

After this you'll have to have some things, follow these instructions:

# IMPORTANT 
1) First of all you will need to add 

		Kavita\Message\ChatServiceProvider::class,, 

	in app/config/app.php

2) Add in root composer.json
	"autoload":{
		"psr-4": {
			Kavita\\Message\\": "packages/kavita/message/src"
		}
	}

3) run composer dump-autoload 

4) php artisan vendor:publish 

5)	npm install
	npm install Vue 
	npm install vue-router
 	composer require pusher/pusher-php-server "~3.0"
	npm install --save laravel-echo pusher-js

	ALMOST THERE!

		Uncomment the following line in config/app.php

		* 	App\Providers\BroadcastServiceProvider::class

		Also Uncomment the following line in bootstrap.js

		* 	import Echo from 'laravel-echo'

			window.Pusher = require('pusher-js');

			window.Echo = new Echo({
			    broadcaster: 'pusher',
			    key: 'f4e14530aedbfaf9a062',
			    cluster: 'ap2',
			    encrypted: true
			});


6)	npm ru dev
	php artisan migrate


	Go to your localhost, login and enter /message and you'll be able to create chats with any user.









