<?php

/**
 * The Account record class
 *
 */
class Account extends Record
{
	/**
	 * The database table name.
	 * It is used for constructing some of the SQL statements.
	 */
	protected static $table = "account";

	/**
	 * The table columns with type.
	 */
	protected static $columns = array('AccountId' => 0,'Email' => 0,'Password' => 0,'User' => 0,'Created' => 0,'LastLogin' => 0,'Perm' => 1,'Status' => 1);

	/**
	 * The password hash complexity
	 */
	protected static $cost = 10;
	
	/**
	 * The currently logged in user.
	 */
	protected static $currentUser = null;
	
	protected static $permStrings = array('Administrator','Editor','Commentor');
	
	protected static $statusStrings = array('Active','Inactive');
	
	// Standard functions

	/**
	 * Account::__construct()
	 *
	 * @param string $arg_row
	 */
	protected function __construct($arg_row = null)
	{
		if (is_null($arg_row))
			parent::createAttribs(self::$columns);
		else
			parent::fetchAttribs($arg_row,self::$columns);
	}

	/**
	 * Account::getColumns()
	 *
	 * @param mixed $arg_prefix
	 * @return
	 */
	static protected function getColumns($arg_prefix = null)
	{
		return parent::getColumnsGeneric(self::$columns,$arg_prefix);
	}

	/**
	 * Account::create()
	 *
	 * @return
	 */
	static public function create()
	{
		$account =  new Account;
		$account->Created = date("Y-m-d H:i:s",time());
		return $account;
	}

	/**
	 * Account::save()
	 *
	 * @return
	 */
	public function save()
	{
		parent::saveGeneric(self::$columns,self::$table);
	}
	
	/**
	 * Account::delete()
	 *
	 * @return
	 */
	public static function delete($arg_id)
	{
		parent::deleteGeneric(self::$columns,self::$table,$arg_id);
	}
	
	public function getData()
	{
		return parent::getDataGeneric(self::$columns);
	}

	/**
	 * Account::loadFromAccId()
	 *
	 * @param mixed $arg_id
	 * @return
	 */
	public static function loadFromAccountId($arg_id)
	{
		if (!isset($arg_id) || strlen($arg_id) != 32)
			return null;

		$result = parent::loadFromId($arg_id,self::$columns,self::$table);
		$record = null;

		if ($result->num_rows)
			$record = new Account($result->fetch_row());

		return $record;
	}

	/**
	 * Account::loadActiveFromUser()
	 *
	 * @param mixed $arg_user
	 * @return
	 */
	public static function loadActiveFromUser($arg_user)
	{
		if (!isset($arg_user))
			return null;

		$db = Database::getDatabase();
		$result = $db->Query(	SQL_SELECT_ACC_FROM_USER,
								array(	'columns' => self::getColumns(),
										'User' => $arg_user));
		$record = null;

		if ($result->num_rows)
			$record = new Account($result->fetch_row());

		return $record;
	}
	
	/**
	 * Account::loadAll()
	 *
	 * @return array	all users in the database
	 */
	public static function loadAll()
	{
		$db = Database::getDatabase();
		$result = $db->Query(	SQL_SELECT_ACC_ALL,
								array(	'columns' => self::getColumns()));
		$records = array();

		for ($i = 0; $i < $result->num_rows; $i++)
			$records[] = new Account($result->fetch_row());

		return $records;
	}
	
	/**
	 * Account::getCurrentAccount()
	 *
	 * @return object	the current user, if logged in
	 */
	public static function getCurrentAccount()
	{
		if (!isset(self::$currentUser) && isset($_SESSION['AID']))
			self::$currentUser = self::loadFromAccountId($_SESSION['AID']);
		if (isset(self::$currentUser) && self::$currentUser->Status != 0)
			self::logout();
		return self::$currentUser;
	}

	/**
	 * Account::setCurrentAccount()
	 *
	 * Sets the current user
	 */
	public function setCurrentAccount()
	{
		// Set account id
		$_SESSION['AID'] = $this->AccountId;
		$this->LastLogin = date("Y-m-d H:i:s",time());
		$this->save();
		self::$currentUser = $this;
	}
	
	/**
	 * Account::logout()
	 *
	 * Sets the current user
	 */
	public static function logout()
	{
		// Unset all of the session variables.
		$_SESSION = array();

		// If it's desired to kill the session, also delete the session cookie.
		// Note: This will destroy the session, and not just the session data!
		if (isset($_COOKIE[session_name()])) {
			setcookie(session_name(), '', time()-42000, '/');
		}
		
		// Finally, destroy the session.
		session_destroy();
		self::$currentUser = null;
	}
	
	/**
	 * Account::getRecordCount()
	 *
	 * @return
	 */
	public static function getRecordCount()
	{
		return Database::getRecordCount(self::$table);
	}
	
	/**
	 * Account::setPassword()
	 *
	 * @return
	 */
	public function setPassword($password)
	{
		$this->Password = password_hash($password,PASSWORD_BCRYPT);
		return isset($this->Password);
	}
	
	/**
	 * Account::checkPassword()
	 *
	 * @return
	 */
	public function checkPassword($password)
	{
		return password_verify($password,$this->Password);
	}
	
	public function getPermString()
	{
		return self::$permStrings[$this->Perm];
	}

	public function getStatusString()
	{
		return self::$statusStrings[$this->Status];
	}

}

?>