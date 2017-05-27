<?php

declare(strict_types=1);

namespace UselessSoft\Queries;

interface QueryHandlerInterface
{

	/**
	 * @param QueryInterface
	 * @return bool
	 */
	public function supports(QueryInterface $query) : bool;


	/**
	 * @param QueryInterface
	 * @return mixed|ResultSetInterface
	 */
	public function handle(QueryInterface $query);

}
