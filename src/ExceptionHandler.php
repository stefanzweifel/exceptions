<?php

namespace Mallinus\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler;

/**
 * Class ExceptionHandler
 * @package Mallinus\Exceptions
 */
class ExceptionHandler extends Handler
{
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
	 * @return null|array
	 * @throws Exception
	 */
	private function getListeners()
	{
		$listeners = $this->listen;

		if ( ! isset($listeners))
		{
			return null;
		}

		if ( ! is_array($listeners))
		{
			throw new Exception('$listen property in ' . get_called_class() . ' must be an array.');
		}

		return $listeners;
	}

	/**
	 * @param $listener
	 * @param Exception $exception
	 * @return mixed
	 * @throws Exception
	 */
	private function handleException($listener, Exception $exception)
	{
		if ( ! class_exists($listener))
		{
			throw new Exception($listener . ' is not an instantiatable class.');
		}

		$listenerInstance = new $listener();

		if ($listenerInstance instanceof ExceptionListener)
		{
			return $listenerInstance->handle($exception);
		}
		else
		{
			throw new Exception($listener . ' must implement ' . ExceptionListener::class . '.');
		}
	}
}