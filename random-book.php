<?php

include_once "vendor/autoload.php";

use GuzzleHttp\Client;

if(!file_exists("secrets.php")) {
	echo "Missing a secrets.php file";
	return;
}
$secrets = include "secrets.php";

$client = new Client([
    // Base URI is used with relative requests
    'base_uri' => 'http://www.goodreads.com/review/list/',
    // You can set any number of default request options.
    'timeout'  => 2.0,
]);

$response = $client->get("56943009.xml", [
	'query' => [
		'key' => $secrets['key'],
		'v' => 2,
		'per_page' => 2000,
		'shelf' => 'to-read',
	]
]);

$xml = new SimpleXMLElement($response->getBody());
$numberOfBooks = (int) $xml->reviews['end'];
$bookIndex = rand(0, $numberOfBooks-1);
$chosenBook = $xml->reviews->review[$bookIndex]->book;

echo <<<EOT

BOOK FOUND
===============================================================================
Title:		{$chosenBook->title}
Author:		{$chosenBook->authors->author[0]->name}


EOT;
