<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of pag
 *
 * @author kullmann
 */
class Page {
	protected static $linkBase;
	protected static $referrer;
	protected static $query;
	protected static $error;
	protected static $showPrintButton = false;
	
	public static function init($setReferrer = true,$startSession = true)
	{
		self::$linkBase = getLinkBase();

		if ($startSession) {
			session_start();
			if (isset($_SESSION['Referrer']))
				self::$referrer = $_SESSION['Referrer'];
			if (isset($_SESSION['Query']))
				self::$query = $_SESSION['Query'];
			if (isset($_SESSION['Error'])) {
				self::$error = $_SESSION['Error'];
				unset($_SESSION['Error']);
			}
			if ($setReferrer) {
				$_SESSION['Referrer'] = pathinfo($_SERVER['SCRIPT_NAME'])['filename'];
				$_SESSION['Query'] = isset($_SERVER['QUERY_STRING']) ? $_SERVER['QUERY_STRING'] : "";
			}
		}	
	}
	
	public static function isLoggedIn()
	{
		return !is_null(self::getAccount());
	}
	
	public static function isAdmin()
	{
		if (!self::isLoggedIn() || self::getAccount()->Status != 0 || self::getAccount()->Perm != 0)
			return false;
		return true;
	}

	public static function isEditor()
	{
		if (!self::isLoggedIn() || self::getAccount()->Status != 0 || self::getAccount()->Perm > 1)
			return false;
		return true;
	}

	public static function blockDirect()
	{
		if (is_null(self::$referrer))
			self::redirect('index');
	}
	
	public static function blockExcept($arg_pages)
	{
		if (is_null(self::$referrer) || !in_array(self::$referrer, $arg_pages))
			self::redirect('index');
	}
	
	
	public static function getAccount()
	{
		return Account::getCurrentAccount();
	}
	
	public static function getLinkBase()
	{
		return self::$linkBase;
	}
	
	public static function getReferrer()
	{
		return self::$referrer;
	}

	public static function getError()
	{
		return self::$error;
	}

	public static function redirect($arg_file = "",$arg_param = "")
	{
		if (strlen($arg_file) == 0) {
			$arg_file = self::$referrer;
			$arg_param = self::$query;
		}

		$link = self::getLinkBase()."/".$arg_file.".html";
		if (strlen($arg_param))
			$link.="?".$arg_param;

		header("Location: ".$link);
		exit();
	}
	
	protected static function cleanParam($arg_param)
	{
		return stripslashes($arg_param);
	}
	
	public static function getString($arg_param)
	{
		if (!isset($_GET[$arg_param]))
			return null;
		return self::cleanParam($_GET[$arg_param]);
	}

	public static function getHtmlString($arg_param)
	{
		if (!isset($_GET[$arg_param]))
			return null;
		return self::cleanParam($_GET[$arg_param]);
	}

	public static function postString($arg_param)
	{
		if (!isset($_POST[$arg_param]))
			return null;
		return self::cleanParam($_POST[$arg_param]);	
	}
	
	public static function getInt($arg_param)
	{
		if (!isset($_GET[$arg_param]))
			return null;
		return (int)$_GET[$arg_param];
	}

	public static function postInt($arg_param)
	{
		if (!isset($_POST[$arg_param]))
			return null;
		return (int)$_POST[$arg_param];
	}

	public static function getFloat($arg_param)
	{
		if (!isset($_GET[$arg_param]))
			return null;
		return (float)$_GET[$arg_param];
	}

	public static function postFloat($arg_param)
	{
		if (!isset($_POST[$arg_param]))
			return null;
		return (float)$_POST[$arg_param];
	}
	
	public static function getBool($arg_param)
	{
		if (!isset($_GET[$arg_param]))
			return false;
		return ($_GET[$arg_param] == 'true') ? true : false;
	}

	public static function postBool($arg_param)
	{
		if (!isset($_POST[$arg_param]))
			return false;
		return ($_POST[$arg_param] == 'true') ? true : false;
	}
	
	public static function error($arg_msg = null)
	{
		$msg = is_null($arg_msg) ? 'Internal error.' : $arg_msg;
		require 'tpl/error.tpl.php5';
		exit();
	}
}

?>
