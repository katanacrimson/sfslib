<?php
/**
 *
 *===================================================================
 *
 *  StopForumSpam integration library
 *-------------------------------------------------------------------
 * @package     sfsintegration
 * @author      Damian Bushong
 * @copyright   (c) 2010 Damian Bushong
 * @license     MIT License
 * @link        http://github.com/Obsidian1510/SFSIntegration
 *
 *===================================================================
 *
 * This source file is subject to the MIT license that is bundled
 * with this package in the file LICENSE.
 *
 */

/**
 * The following is an example file demonstrating how the
 * StopForumSpam integration library should be prepared for use
 * within your own code.
 *
 * This code should be used by PHP 5.2.3+ users, or users running PHP 5.3+ and
 * do not wish to use the PHAR archive.
 *
 * - Define the required root include path for the autoloader
 * - Require the main file
 * - Register our autoloader
 * - Instantiate the main object
 */
define('SFSLIB', dirname(__FILE__) . '/src/');
require SFSLIB . 'SFS.php';
spl_autoload_register('SFS::loader');
$sfs = new SFS();

//###############################################################################
// Example of how to set a bunch of options on the SFS library before you request...
//###############################################################################
$sfs->setTimeout(10)->setRequestMethod(SFS::TRX_REQUEST_CURL);

//###############################################################################
// Example of making a lookup request to StopForumSpam's API
//###############################################################################

try
{
	// @note $result is an object of type SFSRequestResult, and can have its properties accessed as an array, or through its built-in methods.
	$result = $sfs->newRequest()->setUsername('Some username here')->setEmail('someemail@email.tld')->setIP('127.0.0.2')->send();
}
catch(SFSException $e)
{
	// error handling goes here, handle errors however you'd want.
	echo $e->getMessage() . PHP_EOL;
	exit;
}

// Examples of accessing the SFSRequestResult data
print_r($result['username']['lastseen']); // object of type DateTime
var_dump($result['email']); // array containing all result data that is available for the email looked up
echo $result->getIPFrequency(); // integer of how many times the IP was found in the StopForumSpam database



//###############################################################################
// Example of how to report a spammer to StopForumSpam...
//###############################################################################

try
{
	// @note $result is an object of type SFSReportResult, and can have its properties accessed as an array, or through its built-in methods.
	$result = $sfs->newReport()->setUsername('Some username here')->setEmail('someemail@email.tld')->setIP('127.0.0.2')->setAPIKey('abcdef12345678')->send();
}
catch(SFSException $e)
{
	// error handling goes here, handle errors however you'd want.
	echo $e->getMessage() . PHP_EOL;
	exit;
}

// Should just be the success message.
//echo $result->getMessage();
