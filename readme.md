## Quick Installation Guide

### 1. Set Up .env.local.php

```php
<?php

return array(
	'TWILIO_API_SID' => 'TWILIO REST API SID',
	'TWILIO_API_TOKEN' => 'TWILIO REST API TOKEN',
	'TWILIO_API_NUMBER' => 'THE PHONE NUMBER TO CALL WHEN USER CALLS DISPLAYED NUMBER',
);
```

### 2. Set Up Database Connection

```php
<?php

return array(
	'fetch'			 => PDO::FETCH_CLASS,
	'default'		 => 'mysql',
	'connections'	 => array(
		'mysql' => array(
			'driver'	 => 'mysql',
			'host'		 => 'localhost', // SERVER ADDRESS
			'database'	 => 'DATABASE NAME',
			'username'	 => 'DATABASE USER NAME',
			'password'	 => 'DATABASE USER PASSWORD',
			'charset'	 => 'utf8',
			'collation'	 => 'utf8_unicode_ci',
			'prefix'	 => '',
		),
	),
	'migrations'	 => 'migrations',
);
```

### 3. Run migrations

```
php artisan migrate
```
