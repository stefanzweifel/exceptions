<?php

namespace Mallinus\Exceptions;

use Exception;

/**
 * Interface ExceptionListener
 * @package Mallinus\Exceptions
 */
interface ExceptionListener
{
	/**
	 * @param Exception $exception
	 * @return mixed
	 */
	public function handle(Exception $exception);
}