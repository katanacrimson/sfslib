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
 * SFS Integration - Subordinate exception class,
 *      Extension of the SFS exception class.
 *
 *
 * @package     sfsintegration
 * @author      Damian Bushong
 * @license     MIT License
 * @link        http://github.com/Obsidian1510/SFSIntegration
 *
 * @note reserves 12xxx error codes
 */
class SFSJSONException extends Exception
{
	const ERR_JSON_NO_FILE = 12000;
	const ERR_JSON_UNKNOWN = 12001;
	const ERR_JSON_NO_ERROR = 12002;
	const ERR_JSON_DEPTH = 12003;
	const ERR_JSON_CTRL_CHAR = 12004;
	const ERR_JSON_SYNTAX = 12005;
}
