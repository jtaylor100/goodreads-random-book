# Goodreads Random Book Picker

Finds a random book in your "to-read" shelf on Goodreads and displays in the console.

## Requires
* PHP 5.3+ with extensions:
	- Curl
	- SimpleXML
* Composer

## Setup

Rename `secrets.example.php` to `secrets.php` and fill it with your goodreads API key and user ID. Then run:

	$ composer install

## Example

	$ php random-book.php
	
	BOOK FOUND
	===============================================================================
	Title:          Dune (Dune Chronicles, #1)
	Author:         Frank Herbert