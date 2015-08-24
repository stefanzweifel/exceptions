# Exceptions

## Installation
- Add "mallinus/exceptions": "dev-master" to your composer.json require.


- Update your exception handler.

```
<?php

namespace App\Exceptions;

use App\Exceptions\Listeners\SomeExceptionListener;
use Mallinus\Exceptions\ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\HttpException;

/**
 * Class Handler
 * @package App\Exceptions
 */
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

```
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
