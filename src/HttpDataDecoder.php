<?php
/**
 * Created by chris.
 * Date: 08/03/16
 * Time: 20:53
 * Copyright (c) 2016, Datrim Web Design Ltd. All rights reserved.
 */
namespace Datrim\HttpData;

/**
 * Class HttpDataDecoder
 *
 * @package App\Core
 */
class HttpDataDecoder extends HttpData
{
	public function __construct($data)
	{
		$this->data = $this->decode($data);
	}
}
