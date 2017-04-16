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
    'base_uri' => 'http://www.goodreads.com/review/list/' . $secrets['user'].".xml",
    // You can set any number of default request options.
    'timeout'  => 5.0,
]);

// First send a request to get the total number of books
$response = $client->get("", [
	'query' => [
		'key' => $secrets['key'],
		'v' => 2,
		'per_page' => 1,
		'shelf' => 'to-read',
	]
]);
$xml = new SimpleXMLElement($response->getBody());
$numberOfBooks = (int) $xml->reviews['total'];
$bookPage = rand(1, $numberOfBooks);

// Send another request to get details of the selected book
$response = $client->get("", [
	'query' => [
		'key' => $secrets['key'],
		'v' => 2,
		'per_page' => 1,
		'shelf' => 'to-read',
		'page' => $bookPage
	]
]);
$xml = new SimpleXMLElement($response->getBody());
$chosenBook = $xml->reviews->review[0]->book;

echo <<<EOT

Title:		{$chosenBook->title}
Author:		{$chosenBook->authors->author[0]->name}


EOT;
