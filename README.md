# Exceptions

In bigger apps you'll often find yourself having a bunch of if instanceof statements to handle exceptions.
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
Special thanks to @Deall0c for the idea.
