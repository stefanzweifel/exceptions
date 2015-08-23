<?php

namespace Mallinus\Exceptions;

use Exception;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Foundation\Exceptions\Handler;

/**
 * Class ExceptionHandler
 * @package Mallinus\Exceptions
 */
class ExceptionHandler extends Handler
{
	/**
	 * A list of the exception types that should not be reported.
	 *
	 * @var array
	 */
	protected $dontReport = [
		HttpException::class,
	];

	/**
	 * Report or log an exception.
	 *
	 * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
	 *
	 * @param  \Exception  $e
	 * @return void
	 */
	public function report(Exception $e)
	{
		return parent::report($e);
	}

	/**
	 * Render an exception into an HTTP response.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Exception  $e
	 * @return \Illuminate\Http\Response
	 */
	public function render($request, Exception $e)
	{
		foreach ($this->getListeners() as $listener => $exceptions)
		{
			foreach ($exceptions as $exception)
			{
				if ($e instanceof $exception)
				{
					return $this->handleException($listener, $e);
				}
			}
		}

		return parent::render($request, $e);
	}

	/**
	 * @return array
	 */
	private function getListeners()
	{
		return isset($this->listen) ? $this->listen : array();
	}

	/**
	 * @param $listener
	 * @param Exception $exception
	 * @return mixed
	 * @throws Exception
	 */
	private function handleException($listener, Exception $exception)
	{
		if ($listener instanceof ExceptionListener)
		{
			return (new $listener())->handle($exception);
		}
		else
		{
			throw new Exception($listener . ' must implement ' . ExceptionListener::class . '.');
		}
	}
}