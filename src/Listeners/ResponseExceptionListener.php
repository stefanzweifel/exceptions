<?php

namespace Mallinus\Exceptions\Listeners;

use Illuminate\Contracts\Routing\ResponseFactory;

/**
 * Class ResponseExceptionListener
 * @package Mallinus\Exceptions\Listeners
 */
abstract class ResponseExceptionListener
{
	/**
	 * @var ResponseFactory
	 */
	private $responseFactory;

	/**
	 * @param ResponseFactory $responseFactory
	 */
	public function __construct(ResponseFactory $responseFactory)
	{
		$this->responseFactory = $responseFactory;
	}

	/**
	 * @return ResponseFactory
	 */
	public function getResponse()
	{
		return $this->responseFactory;
	}
}