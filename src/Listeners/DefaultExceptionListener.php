<?php

namespace Mallinus\Exceptions\Listeners;

use Exception;
use Mallinus\Exceptions\ExceptionListener;

/**
 * Class DefaultExceptionListener
 * @package Mallinus\Exceptions\Listeners
 */
class DefaultExceptionListener extends RedirectExceptionListener implements ExceptionListener
{
	/**
	 * @param Exception $exception
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function handle(Exception $exception)
	{
		return $this->redirect()->back()->withInput()->with([
			'errors' => $exception->getMessage()
		]);
	}
}