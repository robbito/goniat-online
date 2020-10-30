<?php

/**
 * The Cat record class
 *
 */
class Cat extends Record
{
	/**
	 * The database table name.
	 * It is used for constructing some of the SQL statements.
	 */
	protected static $table = "cat";

	/**
	 * The table columns with type.
	 */
	protected static $columns = array('CatId' => 0,'ParentId' => 0,'Name' => 0,'Type' => 1,'Status' => 1,'Lft' => 1,'Rgt' => 1);

	/**
	 * For decoding the type.
	 */
	protected static $types = array('Species','NomSpecies','Subgenus','Genus','Subfamily','Family','Superfamily','Suborder','Order');

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
		return new Cat;
	}

	public function save()
	{
		// Is it a new record?
		if ($this->CatId == "") {
			// Is it top level?
			if ($this->ParentId == "") {
				$left = parent::getMaxGeneric("cat","Rgt");
				$this->Lft = $left + 1;
				$this->Rgt = $left + 2;
			}
			else {
				$parent = self::loadFromCatId($this->ParentId);
				$this->Lft = $parent->Rgt;
				$this->Rgt = $parent->Rgt + 1;
				parent::insertChildGeneric("cat",$parent->Lft,$parent->Rgt);
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
	 * Cat::deleteFinal()
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

	public static function loadFromCatId($arg_id)
	{
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
			$record = new Cat($result->fetch_row());
			self::$cache[$arg_id] = $record;
		}

		return $record;
	}

	public static function loadFromName($arg_name,$arg_type,$arg_parentName,$arg_parentType)
	{
		if (!isset($arg_name) || !isset($arg_type))
			return null;

		$db = Database::getDatabase();
		$result = null;

		if (isset($arg_parentName)) {
			$result = $db->Query(	SQL_SELECT_CAT_FROM_NAMEANDTYPE_WITH_PARENT,
								array(	'columns' => self::getColumns('a'),
										'Name' => $arg_name,
										'Type'	=> $arg_type,
										'ParentName' => $arg_parentName,
										'ParentType' => $arg_parentType));
		}
		else {
			$result = $db->Query(	SQL_SELECT_CAT_FROM_NAMEANDTYPE,
								array(	'columns' => self::getColumns(),
										'Name' => $arg_name,
										'Type'	=> $arg_type));
		}

		$records = array();

		for ($i = 0; $i < $result->num_rows; $i++) {
			$records[] = new Cat($result->fetch_row());
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
				$query = $db->getQueryString(	SQL_SELECT_CAT_FROM_NAMEANDTYPE_WITH_PARENT,
												array(	'columns' => "a.CatId",
														'Name' => $arg_name,
														'Type'	=> $arg_type,
														'ParentName' => $arg_parentName,
														'ParentType' => $arg_parentType));
			}
			else {
				$query = $db->getQueryString(	SQL_SELECT_CAT_SPC_FROM_NAMEANDTYPE_WITH_PARENT,
												array(	'columns' => "c.CatId",
														'Name' => $arg_name,
														'Type'	=> $arg_type,
														'ParentName' => $arg_parentName,
														'ParentType' => $arg_parentType));
			}
		}
		else {
			if ($arg_type == 0) {
				$query = $db->getQueryString(	SQL_SELECT_CAT_FROM_NAMEANDTYPE,
												array(	'columns' => "CatId",
														'Name' => $arg_name,
														'Type'	=> $arg_type));
			}
			else {
				$query = $db->getQueryString(	SQL_SELECT_CAT_SPC_FROM_NAMEANDTYPE,
												array(	'columns' => "b.CatId",
														'Name' => $arg_name,
														'Type'	=> $arg_type));
			}
		}

		return $query;
	}

	public static function loadPathFromCatId($arg_catId,$arg_maxType = 100)
	{
		if (!isset($arg_catId) || strlen($arg_catId) != 32)
			return null;

		$db = Database::getDatabase();
		$result = $db->Query(	SQL_SELECT_CAT_PATH_FROM_CATID,
								array(	'columns' => self::getColumns('b'),
										'Id' => $arg_catId,
										'Type'	=> $arg_maxType));

		$records = array();

		for ($i = 0; $i < $result->num_rows; $i++) {
			$records[] = new Cat($result->fetch_row());
		}

		return $records;
	}

	public static function loadPathsFromAncestorId($arg_catId,$arg_maxType = 100)
	{
		if (!isset($arg_catId) || strlen($arg_catId) != 32)
			return null;

		$db = Database::getDatabase();
		$result = $db->Query(	SQL_SELECT_CAT_PATHS_FROM_ANCESTORID,
								array(	'columns' => self::getColumns('b'),
										'CatId' => $arg_catId,
										'Type'	=> $arg_maxType));

		$records = array();
		$taxonomy = array();
		$catId = "";

		for ($i = 0; $i < $result->num_rows; $i++) {
			$cat = new Cat($result->fetch_row());
			$taxonomy[] = $cat;
			if ($cat->Type == 0) {
				$records[Tax::getTaxonomyString($taxonomy)] = $cat->CatId;
				$taxonomy = array();
			}
		}

		ksort($records);

		return $records;
	}

	public static function loadPathsFromCatSet($arg_catSet,$arg_maxType = 100,$arg_short = false)
	{
		if (count($arg_catSet) == 0)
			return null;

		$db = Database::getDatabase();
		$result = $db->Query(	SQL_SELECT_CAT_PATHS_FROM_CATSET,
								array(	'columns' => self::getColumns('b'),
										'values' => "'".join("','",$arg_catSet)."'",
										'Type'	=> $arg_maxType));

		$records = array();
		$taxonomy = array();
		$catId = "";
		$type = 100;

		for ($i = 0; $i < $result->num_rows; $i++) {
			$cat = new Cat($result->fetch_row());
			if ($type <= $cat->Type) {
				if ($arg_short)
					$records[Tax::getTaxonomyShortStringSmart($taxonomy)] = $catId;
				else
					$records[Tax::getTaxonomyString($taxonomy)] = $catId;
				$taxonomy = array();
			}
			$taxonomy[] = $cat;
			$type = $cat->Type;
			$catId = $cat->CatId;
		}

		if ($arg_short)
			$records[Tax::getTaxonomyShortStringSmart($taxonomy)] = $catId;
		else
			$records[Tax::getTaxonomyString($taxonomy)] = $catId;

		ksort($records);

		return $records;
	}

	public static function loadFromParentId($arg_catId)
	{
		if (!isset($arg_catId) || strlen($arg_catId) != 32)
			return null;

		$db = Database::getDatabase();
		$result = $db->Query(	SQL_SELECT_CAT_FROM_PARENTID,
								array(	'columns' => self::getColumns(),
										'CatId' => $arg_catId));

		$records = array();

		for ($i = 0; $i < $result->num_rows; $i++) {
			$records[] = new Cat($result->fetch_row());
		}

		return $records;
	}

	public static function loadFromAncestorId($arg_catId,$arg_type)
	{
		if (!isset($arg_catId) || strlen($arg_catId) != 32)
			return null;

		$db = Database::getDatabase();
		$result = $db->Query(	SQL_SELECT_CAT_FROM_ANCESTORID,
								array(	'columns' => self::getColumns('b'),
										'CatId' => $arg_catId,
										'Type' => $arg_type));

		$records = array();

		for ($i = 0; $i < $result->num_rows; $i++) {
			$records[] = new Cat($result->fetch_row());
		}

		return $records;
	}

	public function getChildrenCount()
	{
		$db = Database::getDatabase();
		$result = $db->Query(	SQL_COUNT_CAT_FROM_PARENTID,
								array(	'CatId' => $this->CatId) );

		$count = 0;

		if ($result->num_rows) {
			$row = $result->fetch_row();
			$count = $row[0];
		}

		return $count;
	}

	public function getSiblingsCount($arg_type)
	{
		$db = Database::getDatabase();
		$result = $db->Query(	SQL_COUNT_CAT_FROM_ANCESTORID,
								array(	'CatId' => $this->CatId,
										'Type'	=> $arg_type) );

		$count = 0;

		if ($result->num_rows) {
			$row = $result->fetch_row();
			$count = $row[0];
		}

		return $count;
	}

	public function getSiblingsQualifiedCount($arg_type,$arg_qualifiers)
	{
		$db = Database::getDatabase();
		$result = $db->Query(	SQL_COUNT_CAT_QUAL_FROM_ANCESTORID,
								array(	'CatId' => $this->CatId,
										'Type'	=> $arg_type,
										'values' => $arg_qualifiers) );

		$count = 0;

		if ($result->num_rows) {
			$row = $result->fetch_row();
			$count = $row[0];
		}

		return $count;
	}

	public static function getRecordCount()
	{
		return Database::getRecordCount(self::$table);
	}

       	static public function loadAllIds()
	{
		$db = Database::getDatabase();
		$result = $db->Query(	SQL_SELECT_ALL,
                                        array(	'columns'   => 'CatId',
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
		return self::$types[$this->Type];
	}

	public function getNotes()
	{
		$db = Database::getDatabase();
		$result = $db->Query(	SQL_SELECT_NOTES_CAT_FROM_CATID,
								array(	'CatId' => $this->CatId ));
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
		$result = $db->query(	SQL_UPDATE_NOTES_CAT_FROM_CATID,
								array(	'CatId' => $this->CatId,
										'Notes' => $notes));
	}

	public static function loadHierarchy()
	{
		$db = Database::getDatabase();
		$result = $db->Query(	SQL_SELECT_CAT_ROOTS,
								array(	'columns' => self::getColumns() ));

		$records = array();

		for ($i = 0; $i < $result->num_rows; $i++) {
			$records[] = new Cat($result->fetch_row());
		}

		return $records;
	}

	public function getTaxonomy()
	{
		$taxonomy = Cat::loadPathFromCatId($this->CatId);
		if (end($taxonomy) != $this->CatId) {
			// This can happen if $this is an archive record
			array_pop($taxonomy);
			$taxonomy[] = $this;
		}
		return $taxonomy;
	}

	public function isDeletable()
	{
		return $this->isEditable();
	}
	
	public function moveNode($arg_newParent)
	{
		$newPos = 0;
		if (!isset($arg_newParent)) {
			$newPos = parent::getMaxGeneric("cat","Rgt") + 1;
			$this->ParentId = null;
		}
		else {
			$newPos = $arg_newParent->Rgt;
			$this->ParentId = $arg_newParent->CatId;
		}
		$this->save();
		parent::moveNodeGeneric("cat",$this->Lft,$this->Rgt,$newPos);

		// Lft and Rgt of $this and $arg_parent might be invalid now!
	}
}

?>