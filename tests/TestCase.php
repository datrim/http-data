<?php
/**
 * Created by chris.
 * Date: 09/03/16
 * Time: 08:15
 * Copyright (c) 2016, Datrim Web Design Ltd. All rights reserved.
 */
use Datrim\HttpData\HttpDataDecoder;
use Datrim\HttpData\HttpDataEncoder;

class TestCase extends PHPUnit_Framework_TestCase
{
	private $data =	[
		'name' => 'Test',
		'value' => 'ALongStringWithNumbers12345678909876544321'
	];

	/** @test */
	function it_encodes_and_decodes_a_string_with_compression()
	{
		$encoder = new HttpDataEncoder($this->data['value']);
		$compressed = $encoder->data();
		$decoder = new HttpDataDecoder($compressed);
		$result = $decoder->data();

		$this->assertEquals($this->data['value'], $result);
	}

	/** @test */
	function it_encodes_and_decodes_a_string_without_compression()
	{
		$encoder = new HttpDataEncoder($this->data['value'], false);
		$compressed = $encoder->data();
		$decoder = new HttpDataDecoder($compressed);
		$result = $decoder->data();

		$this->assertEquals($this->data['value'], $result);
	}

	/** @test */
	function it_encodes_and_decodes_an_array_with_compression()
	{
		$encoder = new HttpDataEncoder($this->data);
		$compressed = $encoder->data();
		$decoder = new HttpDataDecoder($compressed);
		$result = $decoder->data();

		$this->assertArrayHasKey('name', $result);
		$this->assertArrayHasKey('value', $result);
		$this->assertContains($this->data['name'], $result);
		$this->assertContains($this->data['value'], $result);
	}

	/** @test */
	function it_encodes_and_decodes_an_array_without_compression()
	{
		$encoder = new HttpDataEncoder($this->data, false);
		$compressed = $encoder->data();
		$decoder = new HttpDataDecoder($compressed);
		$result = $decoder->data();

		$this->assertArrayHasKey('name', $result);
		$this->assertArrayHasKey('value', $result);
		$this->assertContains($this->data['name'], $result);
		$this->assertContains($this->data['value'], $result);
	}
}
