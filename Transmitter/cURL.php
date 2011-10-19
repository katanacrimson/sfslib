<?php
/**
 *
 *===================================================================
 *
 *  StopForumSpam integration library
 *-------------------------------------------------------------------
 * @package     sfslib
 * @author      emberlabs.org
 * @copyright   (c) 2010 - 2011 Damian Bushong
 * @license     MIT License
 * @link        https://github.com/emberlabs/sfslib
 *
 *===================================================================
 *
 * This source file is subject to the MIT license that is bundled
 * with this package in the file LICENSE.
 *
 */

namespace emberlabs\sfslib\Transmitter;
use \emberlabs\sfslib\Core;
use \OpenFlame\Framework\Utility\JSON;

/**
 * StopForumSpam integration library - Transmitter object
 * 	     Provides functionality to communicate with StopForumSpam.
 *
 * @package     sfslib
 * @author      emberlabs.org
 * @license     http://opensource.org/licenses/mit-license.php The MIT License
 * @link        https://github.com/emberlabs/sfslib
 */
class cURL implements TransmitterInterface
{
	public function __construct()
	{
		if(!function_exists('curl_init'))
		{
			throw new \Exception(); // @todo exception - curl not supported on server
		}
	}
	
	public function send(\emberlabs\sfslib\Transmission\TransmissionInstanceInterface $transmission)
	{
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $transmission->buildURL() . '&useragent=' . rawurlencode(Core::getUserAgent()));
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_TIMEOUT, Core::getConfig('sfs.timeout'));
		curl_setopt($curl, CURLOPT_USERAGENT, $this->buildUserAgent());
		$json = curl_exec($curl);
		if(curl_errno($curl))
		{
			throw new \Exception('cURL error: ' . curl_error($curl), curl_errno($curl)); // @todo exception - replace exception class with appropriate class
		}
		curl_close($curl);

		return $transmission->newResponse($json);
	}
}