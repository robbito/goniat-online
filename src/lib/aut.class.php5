<?php

/**
 * The Aut record class
 *
 */
class Aut extends Record
{
	/**
	 * The database table name.
	 * It is used for constructing some of the SQL statements.
	 */
	protected static $table = "aut";

	/**
	 * The table columns with type.
	 */
	protected static $columns = array('AutId' => 0,'FirstName' => 0,'LastName' => 0,'Status' => 1);

	// Standard functions

	/**
	 * Aut::__construct()
	 *
	 * @param string $arg_row
	 */
	protected function __construct($arg_row = null)
	{
		if (is_null($arg_row)) {
			parent::createAttribs(self::$columns);
		}
		else {
			parent::fetchAttribs($arg_row,self::$columns);
		}
	}

	/**
	 * Aut::getColumns()
	 *
	 * @param mixed $arg_prefix
	 * @return
	 */
	static protected function getColumns($arg_prefix = null)
	{
		return parent::getColumnsGeneric(self::$columns,$arg_prefix);
	}

	/**
	 * Aut::create()
	 *
	 * @return
	 */
	static public function create()
	{
		return new Aut;
	}

	/**
	 * Aut::save()
	 *
	 * @return
	 */
	public function save()
	{
		parent::saveGeneric(self::$columns,self::$table);
	}

	/**
	 * Aut::copy()
	 *
	 * @return
	 */
	public function copy()
	{
		return parent::copyGeneric(self::$columns,self::create());
	}

	/**
	 * Aut::createArchive()
	 *
	 * @return
	 */
	public function createArchive()
	{
		$archive = $this->copy();
		$archive->Status = 1;
		$archive->save();
		$notes = $this->getNotes();
		if (!is_null($notes)) {
			$archive->saveNotes($notes);
		}
		return $archive;
	}

	/**
	 * Aut::delete()
	 *
	 * Doesn't really delete, but changes the status to 1
	 */
	public function delete()
	{
		$this->Status = 1;
		$this->save();
	}

	/**
	 * Aut::deleteFinal()
	 *
	 * Doesn't really delete, but changes the status to 1
	 */
	public static function deleteFinal($arg_id)
	{
		parent::deleteGeneric(self::$columns,self::$table,$arg_id);
	}

	/**
	 * Aut::loadAll()
	 *
	 * @param mixed $arg_id
	 * @return
	 */
	public static function loadAll()
	{
		$db = Database::getDatabase();
		$result = $db->Query(	SQL_SELECT_AUT_ALL,
								array(	'columns' => self::getColumns()));
		$records = array();

		for ($i = 0; $i < $result->num_rows; $i++) {
			$records[] = new Aut($result->fetch_row());
		}

		return $records;
	}

	/**
	 * Aut::loadFromAutId()
	 *
	 * @param mixed $arg_id
	 * @return
	 */
	public static function loadFromAutId($arg_id)
	{
		if (!Record::isIdValid($arg_id)) {
			return null;
		}

		$result = parent::loadFromId($arg_id,self::$columns,self::$table);
		$record = null;

		if ($result->num_rows) {
			$record = new Aut($result->fetch_row());
		}

		return $record;
	}

	/**
	 * Aut::loadFromName()
	 *
	 * @param mixed $arg_name
	 * @return
	 */
	public static function loadFromName($arg_name,$arg_all = false)
	{
		if (!isset($arg_name)) {
			return null;
		}

		$db = Database::getDatabase();
		$result = $db->Query(	$arg_all ? SQL_SELECT_AUT_FROM_NAME_ALL : SQL_SELECT_AUT_FROM_NAME,
								array(	'columns' => self::getColumns(),
										'Name' => $arg_name));
		$records = array();

		for ($i = 0; $i < $result->num_rows; $i++) {
			$records[] = new Aut($result->fetch_row());
		}

		return $records;
	}

	/**
	 * Aut::getRecordCount()
	 *
	 * @return
	 */
	public static function getRecordCount()
	{
		return Database::getRecordCount(self::$table);
	}

	/**
	 * Aut::getName()
	 *
	 * @return
	 */
	public function getName()
	{
		if (strlen($this->FirstName)) {
			return $this->LastName.", ".$this->FirstName;
		}
		return $this->LastName;
	}
	
	/**
	 * Aut::getLitCount()
	 *
	 * @return	Number of literature records referencing a given author
	 */
	public function getLitCount()
	{
		$count = 0;
		$db = Database::getDatabase();
		$result = $db->Query(SQL_COUNT_AUT_LIT,array('AutId' => $this->AutId));

		if ($result->num_rows == 1) {
			$row = $result->fetch_row();
			$count = $row[0];
		}

		return $count;
	}

	/**
	 * Aut::getTaxCount()
	 *
	 * @return	Number of taxa records referencing a given author
	 */
	public function getTaxCount()
	{
		$count = 0;
		$db = Database::getDatabase();
		$result = $db->Query(SQL_COUNT_AUT_TAX,array('AutId' => $this->AutId));

		if ($result->num_rows == 1) {
			$row = $result->fetch_row();
			$count = $row[0];
		}

		return $count;
	}

	public function getNotes()
	{
		$db = Database::getDatabase();
		$result = $db->Query(	SQL_SELECT_NOTES_AUT_FROM_AUTID,
								array(	'AutId' => $this->AutId ));
		$notes = "";

		if ($result->num_rows == 1) {
			$row = $result->fetch_row();
			$notes = $row[0];
		}

		return $notes;
	}

	public function saveNotes($notes)
	{
		$db = Database::getDatabase();
		$db->query(SQL_UPDATE_NOTES_AUT_FROM_AUTID,array('AutId' => $this->AutId,'Notes' => $notes));
	}

	public function isDeletable()
	{
		return $this->isEditable();
	}
}
