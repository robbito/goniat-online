<?php

/**
 * The Bnd record class
 *
 */
class Bnd extends Record
{
	/**
	 * The database table name.
	 * It is used for constructing some of the SQL statements.
	 */
	protected static $table = "bnd";

	/**
	 * The table columns with type.
	 */
	protected static $columns = array('BndId' => 0,'Code' => 0,'Name' => 0,'Type' => 0, 'MillYears' => 1,'Status' => 1);

	// Standard functions

	protected function __construct($arg_row = null)
	{
		if (is_null($arg_row))
			parent::createAttribs(self::$columns);
		else
			parent::fetchAttribs($arg_row,self::$columns);
	}

	static protected function getColumns($arg_prefix = null)
	{
		return parent::getColumnsGeneric(self::$columns,$arg_prefix);
	}

	static public function create()
	{
		return new Bnd;
	}

	public function save()
	{
		parent::saveGeneric(self::$columns,self::$table);
	}

	/**
	 * Bnd::copy()
	 *
	 * @return
	 */
	public function copy()
	{
		return parent::copyGeneric(self::$columns,self::create());
	}

	/**
	 * Bnd::createArchive()
	 *
	 * @return
	 */
	public function createArchive()
	{
		$archive = $this->copy();
		$archive->Status = 1;
		$archive->save();
		return $archive;
	}

	/**
	 * Bnd::delete()
	 *
	 * Doesn't really delete, but changes the status to 1
	 */
	public function delete()
	{
		$this->Status = 1;
		$this->save();
	}

	/**
	 * Bnd::deleteFinal()
	 *
	 * Doesn't really delete, but changes the status to 1
	 */
	public static function deleteFinal($arg_id)
	{
		parent::deleteGeneric(self::$columns,self::$table,$arg_id);
	}

	/**
	 * Bnd::loadAll()
	 *
	 * @param mixed $arg_id
	 * @return
	 */
	public static function loadAll()
	{
		$db = Database::getDatabase();
		$result = $db->Query(	SQL_SELECT_BND_ALL,
								array(	'columns' => self::getColumns()));
		$records = array();

		for ($i = 0; $i < $result->num_rows; $i++)
			$records[] = new Bnd($result->fetch_row());

		return $records;
	}

	public static function loadFromBndId($arg_id)
	{
		if (!isset($arg_id))
			return null;

		$result = parent::loadFromId($arg_id,self::$columns,self::$table);
		$record = null;

		if ($result->num_rows)
			$record = new Bnd($result->fetch_row());

		return $record;
	}

	public static function getRecordCount()
	{
		return Database::getRecordCount(self::$table);
	}

	public static function loadFromYears($arg_years,$arg_loBound)
	{
		if ($arg_loBound == 0.0)
			$arg_loBound = 10000.0;

		$db = Database::getDatabase();
		$result = $db->Query(	SQL_SELECT_BND_FROM_YEARS,
								array(	'columns' => self::getColumns(),
										'MillYears' => $arg_years,
										'LoBound' => $arg_loBound));
		$records = array();

		for ($i = 0; $i < $result->num_rows; $i++)
			$records[] = new Bnd($result->fetch_row());

		return $records;
	}

	public static function loadFromName($arg_name,$arg_loBound)
	{
		if ($arg_loBound == 0.0)
			$arg_loBound = 10000.0;

		$db = Database::getDatabase();
		$result = $db->Query(	SQL_SELECT_BND_FROM_NAME,
								array(	'columns' => self::getColumns(),
										'Name' => $arg_name,
										'LoBound' => $arg_loBound));
		$records = array();

		for ($i = 0; $i < $result->num_rows; $i++)
			$records[] = new Bnd($result->fetch_row());

		return $records;
	}
	
	public function getSelectString()
	{
		return number_format($this->MillYears,1)." ".$this->Name;
	}
	
	/**
	 * Bnd::getLocCount()
	 *
	 * @return	Number of locality records referencing a given boundary
	 */
	public function getLocCount()
	{
		$count = 0;
		$db = Database::getDatabase();
		$result = $db->Query(SQL_COUNT_BND_LOC,array('BndId' => $this->BndId));

		if ($result->num_rows == 1) {
			$row = $result->fetch_row();
			$count = $row[0];
		}

		return $count;
	}

	/**
	 * Bnd::getTaxCount()
	 *
	 * @return	Number of taxa records referencing a given boundary
	 */
	public function getTaxCount()
	{
		$count = 0;
		$db = Database::getDatabase();
		$result = $db->Query(SQL_COUNT_BND_TAX,array('BndId' => $this->BndId));

		if ($result->num_rows == 1) {
			$row = $result->fetch_row();
			$count = $row[0];
		}

		return $count;
	}

	public function isDeletable()
	{
		return $this->isEditable();
	}

}

?>