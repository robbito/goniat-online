<?php

/**
 * Contains general includes and utility functions
 * needed throughout the system. This file is included
 * every controller file.
 *
 * @author Peter Kullmann
 * @copyright 2007
 */

require 'inc/cnf.inc.php5';
require 'inc/sql.inc.php5';
require 'lib/password.php';
require 'lib/trc.class.php5';
include 'lib/dbs.class.php5';
require 'lib/xpt.class.php5';
require 'lib/rcd.class.php5';
require 'lib/pag.class.php5';
require 'lib/log.class.php5';

require 'lib/acc.class.php5';
require 'lib/aut.class.php5';
require 'lib/bnd.class.php5';
require 'lib/cat.class.php5';
require 'lib/tax.class.php5';
require 'lib/mra.class.php5';
require 'lib/mrb.class.php5';
require 'lib/lit.class.php5';
require 'lib/geo.class.php5';
require 'lib/loc.class.php5';

//error_reporting(0);

/**
 * Sends a JSON response.
 *
 * @param	string	$status		either "success" or "error"
 * @param	string	$msg		optional msg to be displayed as modal dialog
 * @param	string	$url		optional redirection URL
 * @param	array	$data		optional result data
 */

function sendResponse($status,$msg = null,$url = null,$data = null)
{
	$response = array("status" => $status);
	if (isset($msg)) {
		$response["msg"] = $msg;
	}
	if (isset($url)) {
		$response["url"] = getLinkBase()."/".$url;
		if (strpos($url,"html") === false) {
				$response["url"] .= ".html";
		}
	}
	if (isset($data)) {
		$response["data"] = $data;
	}
	header('Content-Type: application/json');
	echo(json_encode($response));
	exit();
}

/**
 * Returns the installation directory name.
 *
 * @return	string		Directory name of the installation
 */

function getDirName()
{
	$dirName = dirname($_SERVER['PHP_SELF']);
	if ($dirName == '.' || $dirName == '/' || $dirName == '\\') {
		return '';
	}
	return $dirName;
}

/**
 * Returns the base HTTP address where the system is installed.
 *
 * @returns	string		Base directory for links
 */

function getLinkBase()
{
	return "http://".$_SERVER['HTTP_HOST'].getDirName();
}

/**
 * Redirect to another file in the system.
 *
 * @param	string	$arg_file		The redirection target without file extension
 * @param	string	$arg_param		Optional parameters, added to the URL
 */

function redirect($arg_file,$arg_param = "")
{
	$link = getLinkBase()."/".$arg_file.".html";

	if (strlen($arg_param)) {
		$link.="?".$arg_param;
	}

	header("Location: ".$link);
	exit();
}

/**
 * Process a string, such that it is XML conformant, i.e. some special
 * characters have to be replaced with so-called XML entities.
 *
 * @param	string	$arg_string		the source text
 * @return	string					the text with replaced special characters
 */

function xmlentities($arg_string)
{
	return str_replace(array("&","<",">","'","\""),array("&amp;","&lt;","&gt;","&apos;","&quot;"),$arg_string);
}

/**
 * Process a string, such that it is safe to be used as a JavaScript string.
 * I.e. some special characters have to be escaped.
 *
 * @param	string	$arg_string		the source text
 * @return	string					the processed text
 */

function jsSafe($arg_string)
{
	return str_replace(array("'","\"","\n","\r"),array("\\'","\\\"","\\n","\\r"),$arg_string);
}

/**
 * Process a string, such that it is safe to be used on a HTML page, i.e. to
 * avoid cross-site-scripting.
 * This means that tags are stripped, special characters are replaced with
 * the corresponding HTML entities and line breaks are properly treated.
 *
 * @param	string	$arg_string		the source text
 * @return	string					the processed string
 */

function htmlSafe($arg_string)
{
	$arg_string = strip_tags($arg_string);
	$arg_string = htmlentities($arg_string,ENT_COMPAT,'UTF-8');
	$arg_string = str_replace("\r\n","<br />",$arg_string);
	return $arg_string;
}

/**
 * Echo a string after making it safe for HTML output.
 *
 * @param	string	$arg_string		the source text
 * @param	bool	$arg_inject		true, if record links should be injected
 */

function htmlOut($arg_string,$arg_inject = false)
{
	$arg_string = htmlSafe($arg_string);
	if ($arg_inject)
		$arg_string = injectRecordLinks($arg_string);
	echo ($arg_string);
}

/**
 * Recognize links to tax, lit, loc and inject appropriate HTML-Links *
 *
 * @param	string	$arg_string		the source text
 * @return	string					the processed string
 */

function injectRecordLinks($arg_string)
{
	return preg_replace(	array(	'/TAX(\d+)/',
									'/LOC(\d+)/',
									'/LIT(\d+)/'),
							array(	'TAX$1<a href="searchTax.html?TaxNo=$1"><img title="View Details" src="img/link-small.png" /></a>',
									'LOC$1<a href="searchLoc.html?LocNo=$1"><img title="View Details" src="img/link-small.png" /></a>',
									'LIT$1<a href="searchLit.html?LitNo=$1"><img title="View Details" src="img/link-small.png" /></a>'),
							$arg_string);
}

/**
 * General exception handling.
 * Send an email to an admin.
 * or echo error according to program configuration.
 * and exit script processing
 *
 * @param Exception $arg_exception		Exception object.
 * @param string 	$arg_file			file name string.
 */

function handleException($arg_exception,$arg_file = "unknown")
{
	if (ENABLE_MAIL) {
		mail(ADMIN_MAILTO,"GONIAT Error",$arg_exception->getCompleteMessage()." in file ".$arg_file);
	}
	if (ENABLE_ECHO) {
		$msg = $arg_exception->getCompleteMessage();
		$linkBase = getLinkBase();
		require ('tpl/error.tpl.php5');
		exit();
	}
}

?>