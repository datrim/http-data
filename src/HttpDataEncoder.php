<?php
/**
 * Created by chris.
 * Date: 08/03/16
 * Time: 21:14
 * Copyright (c) 2016, Datrim Web Design Ltd. All rights reserved.
 */
namespace Datrim\HttpData;

/**
 * Class HttpDataEncoder
 *
 * @package Datrim\HttpData
 */
class HttpDataEncoder extends HttpData
{
	public function __construct($data, $compress = true)
	{
		$this->data = $this->encode($data, $compress);
	}
}
