# Exceptions

In bigger Laravel applications you'll often find yourself having a bunch of if statements in the exception handler:
```php
public function render($request, Exception $e)
{
    if ($e instanceof UserNotFoundException)
    {
        return response()->json([
            'error' => $e->getMessage()
        ], 404);
    }
        
    // more if instanceof statements...
        
    return parent::render($request, $e);
}
```
Instead of using repetitive if instanceof code blocks, this package offers a listener approach.
```php
protected $listen = [
    ModelNotFoundExceptionListener::class => [
        UserNotFoundException::class,
    ],
];
```
If no exception listener is bound to the exception thrown, then the default Laravel 5.1 behaviour will be used. This means that you'll get the Laravel error page as per default. Don't forget to set app_debug to false in your app config in case you are in production.

## Installation
- Add "mallinus/exceptions": "5.1.*" to your composer.json require.
- Update your exception handler. You may use the same exception listener for multiple exceptions.

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
        ModelNotFoundExceptionListener::class => [
            UserNotFoundException::class,
            PostNotFoundException::class,
            CommentNotFoundException::class,
        ],
        */
    ];
}
```

## Custom exception listeners
- Implement the ExceptionListener contract.

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

## Credits
Special thanks to [@Deall0c](https://github.com/Deall0c/) for the idea.
