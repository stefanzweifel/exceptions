<?php

namespace Mallinus\Exceptions;

use Exception;

/**
 * Interface ExceptionListener
 * @package Mallinus\Exceptions
 */
interface ExceptionListener
{
	public function handle(Exception $exception);
}