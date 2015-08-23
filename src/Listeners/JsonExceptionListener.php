<?php

namespace Mallinus\Exceptions\Listeners;

use Exception;
use Mallinus\Exceptions\ExceptionListener;

/**
 * Class JsonExceptionListener
 * @package Mallinus\Exceptions\Listeners
 */
class JsonExceptionListener extends ResponseExceptionListener implements ExceptionListener
{
	/**
	 * @param Exception $exception
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function handle(Exception $exception)
	{
		return $this->getResponse()->json([
			'errors' => $exception->getMessage()
		], 400);
	}
}