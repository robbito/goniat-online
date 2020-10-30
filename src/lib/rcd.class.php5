<?php

/**
 * Contains the record class.
 * Record is a base class for the specific classes which exist for each table.
 */

abstract class Record
{
	/**
	 * The attributes of the record.
	 * Attributes are stored as associative array with Name-Value pairs.
	 *
	 * The available columns are defined in an array which is a static member
	 * of the specific record class for a table. The column definition array must
	 * follow these conventions:
	 * - it is an associative array with Name-Type pairs. The type can be either
	 *   1 for numeric values or 0 for string values.
	 * - the first column is the primary key of the table.
	 */
	protected $attribs = array();
	
	/**
	 * Initializes the attribute array according to the column definition array.
	 */
	public function createAttribs($arg_columns)
	{
		foreach( $arg_columns as $col => $type ) {
			if ($type == 0) {
				$this->attribs[$col] = '';
			}
			else {
				$this->attribs[$col] = 0;
			}
		}
	}

	/**
	 * Copies fetched values into the attribute array.
	 */
	public function fetchAttribs($arg_row,$arg_columns)
	{
		$index = 0;
		foreach( $arg_columns as $col => $type ) {
			$this->attribs[$col] = $arg_row[$index];
			$index++;
		}
	}

	/**
	 * Copies attributes into the attribute array.
	 */
	public function copyAttribs($arg_record,$arg_columns)
	{
		$index = 0;
		foreach ($arg_columns as $col => $type) {
			$this->attribs[$col] = $arg_record->getAttrib($col);
		}
	}

	/**
	 * Sets an attribute value.
	 */
	public function setAttrib($arg_column,$arg_value)
	{
		$this->attribs[$arg_column] = $arg_value;
	}

	/**
	 * Returns an attribute value.
	 */
	public function getAttrib($arg_column)
	{
		if (key_exists($arg_column, $this->attribs)) {
			return $this->attribs[$arg_column];
		}
		return null;
	}

	/**
	 * Returns a comma separated list of column names, optionally
	 * with a given prefix.
	 */
	static protected function getColumnsGeneric($arg_columns,$arg_prefix = null)
	{
		$columns = '';
		foreach ($arg_columns as $col => $type) {
			if ($columns != '') {
				$columns .= ',';
			}
			if (!is_null($arg_prefix)) {
				$columns .= $arg_prefix . '.';
			}
			$columns .= $col;
		}
		return $columns;
	}

	/**
	 * Returns an attribute value by column name.
	 */
	public function __get($arg_column)
	{
		if (key_exists($arg_column, $this->attribs)) {
			return $this->attribs[$arg_column];
		}
		return null;
	}

	/**
	 * Sets an attribute value for a column.
	 */
	public function __set($arg_column,$arg_value)
	{
		$this->attribs[$arg_column] = $arg_value;
	}

	/**
	 * Creates a string from column values to be used in an SQL INSERT
	 * statement.
	 */
	private function getInsertValues($arg_columns)
	{
		$values = '';
		$db = Database::getDatabase();
		foreach ($arg_columns as $col => $type) {
			if ($values != '') {
				$values .= ',';
			}
			if (is_null($this->attribs[$col])) {
				$values .= 'null';
			}
			else if ($type == 0) {
				$attrib = $db->real_escape_string($this->attribs[$col]);
				$values .= "'".$attrib."'";
			}
			else {
				$values .= $this->attribs[$col];
			}
		}
		return $values;
	}

	/**
	 * Creates a string from column values to be used in an SQL UPDATE
	 * statement.
	 */
	protected function getUpdateValues($arg_columns,$arg_includeId = false)
	{
		$values = '';
		$process = $arg_includeId;
		$db = Database::getDatabase();
		foreach ($arg_columns as $col => $type) {
			// Skip the first element.
			if ($process) {
				if ($values != '') {
					$values .= ',';
				}
				if (is_null($this->attribs[$col])) {
					$values .= $col . "=null";
				}
				else if ($type == 0) {
					$attrib = $db->real_escape_string($this->attribs[$col]);
					$values .= $col . "='" . $attrib . "'";
				}
				else {
					$values .= $col . '=' . $this->attribs[$col];
				}
			}
			else {
				$process = true;
			}
		}
		return $values;
	}

	/**
	 * Saves a record in the database.
	 * This is either an insert or an update depending if the record
	 * is new or already exists.
	 */
	protected function saveGeneric($arg_columns,$arg_table,$arg_insertSQL = SQL_INSERT,$arg_updateSQL = SQL_UPDATE)
	{
		reset($arg_columns);
		$attribId = key($arg_columns);
		if ($this->attribs[$attribId] == '') {
			$this->attribs[$attribId] = md5(uniqid(rand(), true));
			self::insertGeneric($arg_columns, $arg_table, $arg_insertSQL);
		}
		else {
			self::updateGeneric($arg_columns, $arg_table, $attribId, $arg_updateSQL);
		}
	}

	/**
	 * Inserts a new record in the database.
	 */
	protected function insertGeneric($arg_columns,$arg_table,$arg_insertSQL = SQL_INSERT)
	{
		$db = Database::getDatabase();
		$params = array(	'columns'	=> self::getColumnsGeneric($arg_columns),
							'values'	=> self::getInsertValues($arg_columns));
		if (!is_null($arg_table)) {
			$params['Table'] = $arg_table;
		}
		$db->query($arg_insertSQL,$params);
	}

	/**
	 * Updates an existing record in the database.
	 */
	protected function updateGeneric($arg_columns,$arg_table,$arg_attribId,$arg_updateSQL = SQL_UPDATE)
	{
		$db = Database::getDatabase();
		$params = array(	'values'	=> self::getUpdateValues($arg_columns),
							'AttribId'	=> $arg_attribId,
							'Id'		=> $this->attribs[$arg_attribId]);
		if (!is_null($arg_table)) {
			$params['Table'] = $arg_table;
		}
		$db->query($arg_updateSQL,$params);
	}
	
	/**
	 * Deletes a record from the database.
	 */
	protected static function deleteGeneric($arg_columns,$arg_table,$arg_id,$arg_deleteSQL = SQL_DELETE)
	{
		reset($arg_columns);
		$attribId = key($arg_columns);
		$db = Database::getDatabase();
		$params = array(	'AttribId'	=> $attribId,
							'Id'		=> $arg_id);
		if (!is_null($arg_table)) {
			$params['Table'] = $arg_table;
		}
		$db->Query($arg_deleteSQL,$params);
	}
	
	protected function getDataGeneric($arg_columns)
	{
		$data = array();
		foreach ($arg_columns as $col => $type) {
			$data[$col] = $this->attribs[$col];
		}
		return $data;
	}

	public function copyGeneric($arg_columns,$arg_copy)
	{
		$arg_copy->copyAttribs($this, $arg_columns);
		reset($arg_columns);
		$arg_copy->setAttrib(key($arg_columns),'');
		return $arg_copy;
	}

	protected function getMaxGeneric($arg_table,$arg_column)
	{
		$db = Database::getDatabase();
		$result = $db->query(SQL_SELECT_MAX,array('Table' => $arg_table,'AttribId' => $arg_column));
		$max = 0;
		if ($result->num_rows) {
			$row = $result->fetch_row();
			$max = $row[0];
		}
		return $max;
	}
	
	/**
	 * Loads a record with id.
	 */
	protected static function loadFromId($arg_id,$arg_columns,$arg_table)
	{
		$db = Database::getDatabase();
		$attribId = key($arg_columns);
		$params = array(	'columns'	=> self::getColumnsGeneric($arg_columns),
							'Table'		=> $arg_table,
							'AttribId'	=> $attribId,
							'Id'		=> $arg_id );
		return $db->query(SQL_SELECT_FROM_ID,$params);
	}
	 
	public static function isIdValid($arg_id)
	{
		if (!isset($arg_id)) {
			return false;
		}
		if (strlen($arg_id) != 32) {
			return false;
		}
		return true;
	}
	 
	public function isEditable()
	{
		$status = $this->Status;
		if (is_null($status) || $status == 0) {
			return true;
		}
		return false;
	}
	
	/** isDeletable
	 * 
	 * Default implementation returns false
	 * 
	 * @return boolean
	 */
	public function isDeletable()
	{
		return false;
	}
	
	public static function getFigNameGeneric($arg_rcdNo,$arg_prefix)
	{
		$name = $arg_prefix . $arg_rcdNo;
		if (count(glob("fig/" . $name . ".*")) == 0) {
			return $name;
		}
		foreach(range('A','Z') as $i) {		
			$name = $arg_prefix . $arg_rcdNo . $i;
			if (count(glob("fig/" . $name . ".*")) == 0) {
				return $name;
			}
		}
		return "";
	}

 	public static function getFigArchiveName($arg_fig)
	{
		 if (count(glob("fig/archive/" . $arg_fig)) == 0) {
			return $arg_fig;
		}
		$i = 1;
		while ($i < 1000) {		
			$file = pathinfo($arg_fig,PATHINFO_FILENAME)."-".$i.".".pathinfo($arg_fig,PATHINFO_EXTENSION);
			if (count(glob("fig/archive/" . $file)) == 0) {
				return $file;
			}
			$i++;
		}
		return "";
	}
	
	public static function deleteFig($arg_fig)
	{
		$archive = self::getFigArchiveName($arg_fig);
		rename("fig/".$arg_fig,"fig/archive/".$archive);
		return $archive;
	}

	public static function deleteFigFinal($arg_fig)
	{
		unlink("fig/archive/".$arg_fig);
	}

	/**
	 * Generic insertion into nested set
	 * 
	 * @param type $arg_table
	 * @param type $arg_left
	 * @param type $arg_right
	 */
	protected static function insertChildGeneric($arg_table,$arg_left,$arg_right)
	{
		$db = Database::getDatabase();

		$db->Query(	SQL_SET_UPDATE_ANC,
					array(	'Table' => $arg_table,
							'Offset' => 2,
							'Left' => $arg_left,
							'Right' => $arg_right ));

		$db->Query(	SQL_SET_UPDATE_RGT,
					array(	'Table' => $arg_table,
							'Offset' => 2,
							'Right' => $arg_right ));
	}

	protected static function moveNodeGeneric($arg_table,$arg_left,$arg_right,$arg_newPos)
	{
		// Invalid arguments
		if ($arg_left >= $arg_right || $arg_newPos > $arg_left && $arg_newPos < $arg_right) {
			throw new GonInvalidArgumentException;
		}
		// The :distance variable is the distance between the new and old positions
		// the :width is the size of the subtree,
		// and :tmppos is used to keep track of the subtree being moved during the updates.
		// These variables are defined as:

		$width = $arg_right - $arg_left + 1;
		$distance = $arg_newPos - $arg_left;
		$tmpPos = $arg_left;
            
		// backwards movement must account for new space
		if ($distance < 0) {
			$distance -= $width;
			$tmpPos += $width;
		}

		$db = Database::getDatabase();

		/**
		 *  -- create new space for subtree
		 *  UPDATE tags SET lpos = lpos + :width WHERE lpos >= :newpos
		 *  UPDATE tags SET rpos = rpos + :width WHERE rpos >= :newpos */
 
		$db->Query(	SQL_SET_UPDATE_LFT_FOR_MOVE,
					array(	'Table' => $arg_table,
							'Width' => $width,
							'Pos' => $arg_newPos,
							'Op' => "+",
							'Cmp' => ">=" ));

		$db->Query(	SQL_SET_UPDATE_RGT_FOR_MOVE,
					array(	'Table' => $arg_table,
							'Width' => $width,
							'Pos' => $arg_newPos,
							'Op' => "+",
							'Cmp' => ">=" ));

		/**  -- move subtree into new space
		 *  UPDATE tags SET lpos = lpos + :distance, rpos = rpos + :distance
		 *           WHERE lpos >= :tmppos AND rpos < :tmppos + :width */
		
		$db->Query(	SQL_SET_UPDATE_LFTRGT_FOR_MOVE,
					array(	'Table' => $arg_table,
							'Width' => $width,
							'Distance' => $distance,
							'TmpPos' => $tmpPos ));
		
		/**  -- remove old space vacated by subtree
		 *  UPDATE tags SET lpos = lpos - :width WHERE lpos > :oldrpos
		 *  UPDATE tags SET rpos = rpos - :width WHERE rpos > :oldrpos */
		
		$db->Query(	SQL_SET_UPDATE_LFT_FOR_MOVE,
					array(	'Table' => $arg_table,
							'Width' => $width,
							'Pos' => $arg_right,
							'Op' => "-",
							'Cmp' => ">" ));

		$db->Query(	SQL_SET_UPDATE_RGT_FOR_MOVE,
					array(	'Table' => $arg_table,
							'Width' => $width,
							'Pos' => $arg_right,
							'Op' => "-",
							'Cmp' => ">" ));
		
	}
}