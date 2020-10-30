<?php

/**
 * The Geo record class
 *
 */
class Geo extends Record
{
	/**
	 * The database table name.
	 * It is used for constructing some of the SQL statements.
	 */
	protected static $table = "geo";

	/**
	 * The table columns with type.
	 */
	protected static $columns = array('GeoId' => 0,'ParentId' => 0,'Name' => 0,'Type' => 1,'Status' => 1,'Lft' => 1,'Rgt' => 1);

	/**
	 * For decoding the type.
	 */
	protected static $types = array('Layer','Locality','Province','Country','Continent');

	/**
	 * Simple record cache.
	 */
	protected static $cache = array();

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
		return new Geo;
	}

	public function save()
	{
		// Is it a new record?
		if ($this->GeoId == "") {
			// Is it top level?
			if ($this->ParentId == "") {
				$left = parent::getMaxGeneric("geo","Rgt");
				$this->Lft = $left + 1;
				$this->Rgt = $left + 2;
			}
			else {
				$parent = self::loadFromGeoId($this->ParentId);
				$this->Lft = $parent->Rgt;
				$this->Rgt = $parent->Rgt + 1;
				parent::insertChildGeneric("geo",$parent->Lft,$parent->Rgt);
			}
		}
		parent::saveGeneric(self::$columns,self::$table);
	}

	public function copy()
	{
		return parent::copyGeneric(self::$columns, self::create());
	}

	public function delete()
	{
		$this->Status = 1;
		$this->save();
	}

	/**
	 * Geo::deleteFinal()
	 *
	 * Doesn't really delete, but changes the status to 1
	 */
	public static function deleteFinal($arg_id)
	{
		parent::deleteGeneric(self::$columns,self::$table,$arg_id);
	}

	public function createArchive()
	{
		$archive = $this->copy();
		$archive->Status = 1;
		$archive->save();
		$notes = $this->getNotes();
		if (!is_null($notes))
			$archive->saveNotes($notes);
		return $archive;
	}

	public static function loadFromGeoId($arg_id)
	{
		// Validate the argument
		if (!self::isIdValid($arg_id))
			return null;

		// Check the cache for the record.
		if (array_key_exists($arg_id,self::$cache)) {
			// Return the cached record.
			return self::$cache[$arg_id];
		}

		$result = parent::loadFromId($arg_id,self::$columns,self::$table);
		$record = null;

		if ($result->num_rows) {
			$record = new Geo($result->fetch_row());
			self::$cache[$arg_id] = $record;
		}

		return $record;
	}

	public static function loadFromParentId($arg_geoId)
	{
		if (!isset($arg_geoId) || strlen($arg_geoId) != 32)
			return null;

		$db = Database::getDatabase();
		$result = $db->Query(	SQL_SELECT_GEO_FROM_PARENTID,
								array(	'columns' => self::getColumns(),
										'GeoId' => $arg_geoId));

		$records = array();

		for ($i = 0; $i < $result->num_rows; $i++) {
			$records[] = new Geo($result->fetch_row());
		}

		return $records;
	}

	public static function loadFromName($arg_name,$arg_type,$arg_parentName,$arg_parentType)
	{
		if (!isset($arg_name) || !isset($arg_type))
			return null;

		$db = Database::getDatabase();
		$result = null;

		if (isset($arg_parentName)) {
			$result = $db->Query(	SQL_SELECT_GEO_FROM_NAMEANDTYPE_WITH_PARENT,
								array(	'columns' => self::getColumns('a'),
										'Name' => $arg_name,
										'Type'	=> $arg_type,
										'ParentName' => $arg_parentName,
										'ParentType' => $arg_parentType));
		}
		else {
			$result = $db->Query(	SQL_SELECT_GEO_FROM_NAMEANDTYPE,
								array(	'columns' => self::getColumns(),
										'Name' => $arg_name,
										'Type'	=> $arg_type));
		}

		$records = array();

		for ($i = 0; $i < $result->num_rows; $i++) {
			$records[] = new Geo($result->fetch_row());
		}

		return $records;
	}

	public static function getQueryStringFromName($arg_name,$arg_type,$arg_parentName,$arg_parentType)
	{
		if (!isset($arg_name) || !isset($arg_type))
			return null;

		$db = Database::getDatabase();

		$query = "";

		if (isset($arg_parentName)) {
			if ($arg_type == 0) {
				$query = $db->getQueryString(	SQL_SELECT_GEO_FROM_NAMEANDTYPE_WITH_PARENT,
												array(	'columns' => "a.GeoId",
														'Name' => $arg_name,
														'Type'	=> $arg_type,
														'ParentName' => $arg_parentName,
														'ParentType' => $arg_parentType));
			}
			else {
				$query = $db->getQueryString(	SQL_SELECT_GEO_LAY_FROM_NAMEANDTYPE_WITH_PARENT,
												array(	'columns' => "c.GeoId",
														'Name' => $arg_name,
														'Type'	=> $arg_type,
														'ParentName' => $arg_parentName,
														'ParentType' => $arg_parentType));
			}
		}
		else {
			if ($arg_type == 0) {
				$query = $db->getQueryString(	SQL_SELECT_GEO_FROM_NAMEANDTYPE,
													array(	'columns' => "GeoId",
															'Name' => $arg_name,
															'Type'	=> $arg_type));
			}
			else {
				$query = $db->getQueryString(	SQL_SELECT_GEO_LAY_FROM_NAMEANDTYPE,
													array(	'columns' => "b.GeoId",
															'Name' => $arg_name,
															'Type'	=> $arg_type));
			}
		}

		return $query;
	}

	public static function loadPathFromGeoId($arg_geoId,$arg_maxType = 100)
	{
		if (!isset($arg_geoId) || strlen($arg_geoId) != 32)
			return null;

		$db = Database::getDatabase();
		$result = $db->Query(	SQL_SELECT_GEO_PATH_FROM_GEOID,
								array(	'columns' => self::getColumns('b'),
										'Id' => $arg_geoId,
										'Type'	=> $arg_maxType));

		$records = array();

		for ($i = 0; $i < $result->num_rows; $i++) {
			$records[] = new Geo($result->fetch_row());
		}

		return $records;
	}

	public static function loadPathsFromAncestorId($arg_geoId,$arg_maxType = 100)
	{
		if (!Record::isIdValid($arg_geoId))
			return null;

		$db = Database::getDatabase();
		$result = $db->Query(	SQL_SELECT_GEO_PATHS_FROM_ANCESTORID,
								array(	'columns' => self::getColumns('b'),
										'GeoId' => $arg_geoId,
										'Type'	=> $arg_maxType));

		$records = array();
		$geography = array();
		$geoId = "";

		for ($i = 0; $i < $result->num_rows; $i++) {
			$geo = new Geo($result->fetch_row());
			$geography[] = $geo;
			if ($geo->Type == 0) {
				$records[self::getGeographyLayerString($geography)] = $geo->GeoId;
				$geography = array();
			}
		}

		ksort($records);

		return $records;
	}
	
	public static function getRecordCount()
	{
		return Database::getRecordCount(self::$table);
	}

    static public function loadAllIds()
	{
		$db = Database::getDatabase();
		$result = $db->Query(	SQL_SELECT_ALL,
                                        array(	'columns'   => 'GeoId',
                                                'Table'     => self::$table));
		$ids = array();

		for ($i = 0; $i < $result->num_rows; $i++) {
                        $row = $result->fetch_row();
			$ids[] = $row[0];
                }
                
		return $ids;
	}

    public function getTypeText()
	{
		if ($this->Type < 0 || $this->Type >= 4)
			return "undefined";
		return self::$types[$this->Type];
	}

	public function getGeography()
	{
		$geography = self::loadPathFromGeoId($this->GeoId);
		if (end($geography) != $this->GeoId) {
			// This can happen if $this is an archive record
			array_pop($geography);
			$geography[] = $this;
		}
		return $geography;
	}

	public function getGeographyString($arg_geography = null)
	{
		$string = "";

		if (!isset($arg_geography)) {
			$arg_geography = $this->getGeography();
		}

		foreach ($arg_geography as $geo) {
			$string .= $geo->Name.", ";
		}

		return rtrim($string," ,");
	}
	
	public static function getGeographyLayerString($arg_geography = null)
	{
		$string = "";
		foreach ($arg_geography as $geo) {
			if ($geo->Type == 0) {
				$string .= "#";
			}
			else if (!empty($string)) {
				$string .= ", ";
			}
			$string .= $geo->Name;
		}
		return $string;
	}

	public static function getLocalityString($arg_full)
	{
		return explode('#',$arg_full)[0];
	}

	public static function getLayerString($arg_full)
	{
		return explode('#',$arg_full)[1];
	}

	public function getSubCount()
	{
		$count = 0;
		$db = Database::getDatabase();
		$result = $db->Query(	SQL_COUNT_GEO_SUB,
								array(	'GeoId' => $this->GeoId ));

		if ($result->num_rows == 1) {
			$row = $result->fetch_row();
			$count = $row[0];
		}

		return $count;
	}

	public function getSiblingsCount($arg_type)
	{
		$db = Database::getDatabase();
		$result = $db->Query(	SQL_COUNT_GEO_FROM_ANCESTORID,
								array(	'GeoId' => $this->GeoId,
										'Type'	=> $arg_type) );

		$count = 0;

		if ($result->num_rows) {
			$row = $result->fetch_row();
			$count = $row[0];
		}

		return $count;
	}

	public function getNotes()
	{
		$db = Database::getDatabase();
		$result = $db->Query(	SQL_SELECT_NOTES_GEO_FROM_GEOID,
								array(	'GeoId' => $this->GeoId ));
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
		$result = $db->query(	SQL_UPDATE_NOTES_GEO_FROM_GEOID,
								array(	'GeoId' => $this->GeoId,
										'Notes' => $notes));
	}

	public static function loadHierarchy()
	{
		$db = Database::getDatabase();
		$result = $db->Query(	SQL_SELECT_GEO_ROOTS,
								array(	'columns' => self::getColumns() ));

		$records = array();

		for ($i = 0; $i < $result->num_rows; $i++) {
			$records[] = new Geo($result->fetch_row());
		}

		return $records;
	}
	
	public function isDeletable()
	{
		return $this->isEditable();
	}
	
	public function moveNode($arg_newParent)
	{
		$newPos = 0;
		if (!isset($arg_newParent)) {
			$newPos = parent::getMaxGeneric("geo","Rgt") + 1;
			$this->ParentId = null;
		}
		else {
			$newPos = $arg_newParent->Rgt;
			$this->ParentId = $arg_newParent->GeoId;
		}
		$this->save();
		parent::moveNodeGeneric("geo",$this->Lft,$this->Rgt,$newPos);

		// Lft and Rgt of $this and $arg_parent might be invalid now!
	}
}

?>