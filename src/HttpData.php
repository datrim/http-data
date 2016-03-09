<?php
/**
 * Created by chris.
 * Date: 06/03/13
 * Time: 14:17
 * Copyright (c) 2016, Datrim Web Design Ltd. All rights reserved.
 */
namespace Datrim\HttpData;

use Datrim\HttpData\Exceptions\HttpDataEncodeException;
use Datrim\HttpData\Exceptions\HttpDataDecodeException;

/**
 * Class HttpData
 *
 * Serialize and unserialize data.
 *
 * @package App\Core
 */
abstract class HttpData
{
	const DATA_INDEX = 'data';

	/**
	 * @var mixed
	 */
	protected $data;

	/**
	 * Encode data.
	 *
	 * @param      $data
	 * @param bool $compress
	 *
	 * @return array|null|string
	 * @throws HttpDataEncodeException
	 */
	protected function encode($data, $compress = true)
	{
		if (!is_null($data)) {
			if ($compress) {

				// First serialize the data.
				$data = serialize($data);

				// Now compress it.
				if (!($data = gzdeflate($data, 9))) {
					throw new HttpDataEncodeException;
				}

				// Create an array containing the compressed data and the
				// 'compressed' item.
				$data = [static::DATA_INDEX => $data];
				$data['compressed'] = true;

				// Serialize it again.
				if (!($data = serialize($data))) {
					throw new HttpDataEncodeException;
				}
			} else {

				// Add the 'compressed' item and serialize.
				$data = [static::DATA_INDEX => $data];
				$data['compressed'] = false;
				$data = serialize($data);
			}
		}

		return $data;
	}

	/**
	 * Decode data.
	 *
	 * @param $data
	 *
	 * @return mixed|string
	 * @throws HttpDataDecodeException
	 */
	protected function decode($data)
	{
		if (!is_null($data)) {

			// First unserialize the data.
			if (!($data = unserialize($data))) {
				throw new HttpDataDecodeException;
			}

			// Do we have a 'compressed' item.
			if (!isset($data['compressed'])) {
				throw new HttpDataDecodeException;
			}

			// Is the data compressed?
			if ($data['compressed']) {

				// Make sure we have the data in the array.
				if (!isset($data['data'])) {
					throw new HttpDataDecodeException;
				}

				// Decompress it.
				if (!($data = gzinflate($data[static::DATA_INDEX]))) {
					throw new HttpDataDecodeException;
				}

				// Unserialize again.
				$data = unserialize($data);
			} else {
				$data = $data[static::DATA_INDEX];
			}
		}

		return $data;
	}

	public function data()
	{
		return $this->data;
	}
}
