<?php

/**
 * The MorphB record class
 * 
 * Additional morphology for diverging middle and early age stages.
 *
 */
class MorphB extends Record
{
	/**
	 * The database table name.
	 * It is used for constructing some of the SQL statements.
	 */
	protected static $table = "morphb";

	/**
	 * The table columns with type.
	 */
	protected static $columns = array('TaxId' => 0,'A22' => 0,'B35' => 0,'C41' => 0,'D49' => 0,'F54' => 0,'Status' => 1);

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
		return new MorphB;
	}

	public function save()
	{
		parent::saveGeneric(self::$columns,self::$table);
	}

	public function insert()
	{
		parent::insertGeneric(self::$columns,self::$table);
	}

	public function copy()
	{
		return parent::copyGeneric(self::$columns,self::create());
	}

	/**
	 * MorphB::deleteFinal()
	 *
	 */
	public static function deleteFinal($arg_id)
	{
		parent::deleteGeneric(self::$columns,self::$table,$arg_id);
	}

	
	/**
	 * Updates an existing record in the database.
	 */
	public function update($arg_oldId)
	{
		$db = Database::getDatabase();
		$params = array(	'values'	=> parent::getUpdateValues(self::$columns,true),
							'AttribId'	=> 'TaxId',
							'Id'		=> $arg_oldId,
							'Table'		=> self::$table);

		$db->query(SQL_UPDATE,$params);
	}

	public static function loadFromTaxId($arg_id)
	{
		if (!isset($arg_id))
			return null;

		$db = Database::getDatabase();
		$result = $db->query(	SQL_SELECT_MORPH_FROM_TAXID,
								array(
									'columns' => parent::getColumnsGeneric(self::$columns),
									'Table' => self::$table,
									'TaxId' => $arg_id));
		$record = null;

		if ($result->num_rows)
			$record = new MorphB($result->fetch_row());

		return $record;
	}

	public static function getRecordCount()
	{
		return Database::getRecordCount(self::$table);
	}
}

?>