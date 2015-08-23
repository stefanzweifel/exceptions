<?php

namespace Mallinus\Exceptions\Listeners;

use Illuminate\Routing\Redirector;

/**
 * Class RedirectExceptionListener
 * @package Mallinus\Exceptions\Listeners
 */
abstract class RedirectExceptionListener
{
	/**
	 * @var Redirector
	 */
	private $redirector;

	/**
	 * @param Redirector $redirector
	 */
	public function __construct(Redirector $redirector)
	{
		$this->redirector = $redirector;
	}

	/**
	 * @return Redirector
	 */
	public function redirect()
	{
		return $this->redirector;
	}
}