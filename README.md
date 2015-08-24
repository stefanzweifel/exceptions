# Exceptions
Easy exception handling in Laravel 5.1.

## Installation
- Add "mallinus/exceptions": "5.1.*" to your composer.json require.


- Update your exception handler. You can use the same exception listener for multiple exceptions.

```php
<?php

namespace App\Exceptions;

use Mallinus\Exceptions\ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\HttpException;

class Handler extends ExceptionHandler
{
    protected $dontReport = [
        HttpException::class,
    ];

    protected $listen = [
        /*
        SomeExceptionListener::class => [
            SomeException::class,
        ],
        */
    ];
}
```

## Custom exception listeners

```php
<?php

namespace App\Exceptions\Listeners;

use Exception;
use Mallinus\Exceptions\ExceptionListener;

class CustomExceptionListener implements ExceptionListener
{
	public function handle(Exception $exception)
	{
		return redirect()->back()->withInput()->with([
			'errors' => $exception->getMessage()
		]);
	}
}
```

### Credits
Special thanks to @Deall0c for the idea.
