<?php

/**
 * The Tax record class
 *
 */
class Lit extends Record
{
	/**
	 * The database table name.
	 * It is used for constructing some of the SQL statements.
	 */
	protected static $table = "lit";

	/**
	 * The table columns with type.
	 */
	protected static $columns = array('LitId' => 0,'LitNo' => 1,'Author1Id' => 0,'Author2Id' => 0,'Author3Id' => 0,'Year' => 0,'Title' => 0,'Short' => 0,'Reference' => 0,'Url' => 0,'Status' => 1);

	// Standard functions

	protected function __construct($arg_row = null)
	{
		if (is_null($arg_row)) {
			parent::createAttribs(self::$columns);
		}
		else {
			parent::fetchAttribs($arg_row,self::$columns);
		}
	}

	static protected function getColumnArray()
	{
		return self::$columns;
	}

	static protected function getTable()
	{
		return self::$table;
	}

	static protected function getColumns($arg_prefix = null)
	{
		return parent::getColumnsGeneric(self::$columns,$arg_prefix);
	}

	static public function create()
	{
		return new Lit;
	}

	public function save()
	{
		if ($this->LitNo == 0) {
			$this->LitNo = parent::getMaxGeneric(self::$table,'LitNo') + 1;
		}
		parent::saveGeneric(self::$columns,self::$table);
	}

	public function copy()
	{
		return parent::copyGeneric(self::$columns,self::create());
	}

	public static function deleteFinal($arg_id)
	{
		// Delete relations first...
		parent::deleteGeneric(self::$columns,self::$table,$arg_id);
	}

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
	
	public function delete()
	{
		$this->Status = 1;
		$this->save();
	}

	public static function loadFromLitId($arg_id)
	{
		if (!Record::isIdValid($arg_id)) {
			return null;
		}

		$result = parent::loadFromId($arg_id,self::$columns,self::$table);
		$record = null;

		if ($result->num_rows) {
			$record = new Lit($result->fetch_row());
		}

		return $record;
	}

	static public function loadFromLitNo($arg_litNo)
	{
		if (!isset($arg_litNo)) {
			return null;
		}
		
		$db = Database::getDatabase();
		$result = $db->Query(	SQL_SELECT_LIT_FROM_LITNO,
								array(	'columns' => self::getColumns(),
										'LitNo' => $arg_litNo));
		$record = null;

		if ($result->num_rows) {
			$record = new Lit($result->fetch_row());
		}

		return $record;
	}

	static public function loadFromAuthor($arg_aut)
	{
		if (strlen($arg_aut) == 0) {
			throw new GonInvalidArgumentException;
		}
	
		$db = Database::getDatabase();
		$result = $db->Query(	SQL_SELECT_LIT_FROM_AUT,
  								array(	'columns' => self::getColumns('a'),
                                        'Author'  => $arg_aut));
		
		$records = array();

		for ($i = 0; $i < $result->num_rows; $i++) {
			$records[] = new Lit($result->fetch_row());
		}

		return $records;
	}

	static public function loadFromTitle($arg_title)
	{
		if (strlen($arg_title) == 0) {
			throw new GonInvalidArgumentException;
		}
	
		$db = Database::getDatabase();
		$result = $db->Query(	SQL_SELECT_LIT_FROM_TITLE,
  								array(	'columns' => self::getColumns(),
                                        'Title'  => $arg_title));
		
		$records = array();

		for ($i = 0; $i < $result->num_rows; $i++) {
			$records[] = new Lit($result->fetch_row());
		}

		return $records;
	}
	
	static public function loadFromReference($arg_ref)
	{
		if (strlen($arg_ref) == 0) {
			throw new GonInvalidArgumentException;
		}
	
		$db = Database::getDatabase();
		$result = $db->Query(	SQL_SELECT_LIT_FROM_REFERENCE,
  								array(	'columns' => self::getColumns(),
                                        'Reference'  => $arg_ref));
		
		$records = array();

		for ($i = 0; $i < $result->num_rows; $i++) {
			$records[] = new Lit($result->fetch_row());
		}

		return $records;
	}	

    static public function loadAllIds()
	{
		$db = Database::getDatabase();
		$result = $db->Query(	SQL_SELECT_ALL,
                                        array(	'columns'   => 'LitId',
                                                'Table'     => self::$table));
		$ids = array();

		for ($i = 0; $i < $result->num_rows; $i++) {
			$row = $result->fetch_row();
			$ids[] = $row[0];
         }
                
		return $ids;
	}

	public static function getRecordCount()
	{
		return Database::getRecordCount(self::$table);
	}

	static public function loadFromTaxId($arg_taxId)
	{
		if (!Record::isIdValid($arg_taxId)) {
			return null;
		}

		$db = Database::getDatabase();
		$result = $db->Query(	SQL_SELECT_LIT_FROM_TAXID,
								array(	'columns' => self::getColumns('a'),
										'TaxId' => $arg_taxId));
		$records = array();

		for ($i = 0; $i < $result->num_rows; $i++) {
			$records[] = new Lit($result->fetch_row());
		}

		return $records;
	}

	static public function loadFromLocId($arg_locId)
	{
		if (!Record::isIdValid($arg_locId)) {
			return null;
		}

		$db = Database::getDatabase();
		$result = $db->Query(	SQL_SELECT_LIT_FROM_LOCID,
								array(	'columns' => self::getColumns('a'),
										'LocId' => $arg_locId));
		$records = array();

		for ($i = 0; $i < $result->num_rows; $i++) {
			$records[] = new Lit($result->fetch_row());
		}

		return $records;
	}

	static public function loadFromAutId($arg_autId)
	{
		if (!Record::isIdValid($arg_autId)) {
			return null;
		}

		$db = Database::getDatabase();
		$result = $db->Query(	SQL_SELECT_LIT_FROM_AUTID,
								array(	'columns' => self::getColumns('a'),
										'AutId' => $arg_autId));
		$records = array();

		for ($i = 0; $i < $result->num_rows; $i++) {
			$records[] = new Lit($result->fetch_row());
		}

		return $records;
	}

	static public function getSelectionListFromQuery($arg_query,$arg_params)
	{
		if (!isset($arg_query)) {
			return null;
		}

		$db = Database::getDatabase();
		$arg_params['columns'] = self::getColumns('a');
		$result = $db->Query($arg_query,$arg_params);
		$sel = array();

		for ($i = 0; $i < $result->num_rows; $i++) {
			$sel[] = new Lit($result->fetch_row());
		}

		return $sel;
	}

	public function getAuthors()
	{
		$author1 = Aut::loadFromAutId($this->Author1Id);
		$author2 = Aut::loadFromAutId($this->Author2Id);
		$author3 = Aut::loadFromAutId($this->Author3Id);

		$authors = $author1->LastName;
		if (isset($author2)) {
			if (isset($author3)) {
			 	$authors .= ", ".$author2->LastName." & ".$author3->LastName;
			}
			else {
				$authors .= " & ".$author2->LastName;
			}
		}
		return $authors;
	}

	public function getAuthor1()
	{
		return Aut::loadFromAutId($this->Author1Id);
	}

	public function getAuthor2()
	{
		return Aut::loadFromAutId($this->Author2Id);
	}

	public function getAuthor3()
	{
		return Aut::loadFromAutId($this->Author3Id);
	}

	public function getNotes()
	{
		$db = Database::getDatabase();
		$result = $db->Query(	SQL_SELECT_NOTES_LIT_FROM_LITID,
								array(	'LitId' => $this->LitId ));
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
		$db->query(SQL_UPDATE_NOTES_LIT_FROM_LITID,array('LitId' => $this->LitId,
			'Notes' => $notes));
	}

	public function getTaxCount()
	{
		$count = 0;
		$db = Database::getDatabase();
		$result = $db->Query(	SQL_COUNT_LIT_TAX,
								array(	'LitId' => $this->LitId ));

		if ($result->num_rows == 1) {
			$row = $result->fetch_row();
			$count = $row[0];
		}

		return $count;
	}

	public function getLocCount()
	{
		$count = 0;
		$db = Database::getDatabase();
		$result = $db->Query(	SQL_COUNT_LIT_LOC,
								array(	'LitId' => $this->LitId ));

		if ($result->num_rows == 1) {
			$row = $result->fetch_row();
			$count = $row[0];
		}

		return $count;
	}
	
	public function isTaxLinkExist($arg_taxId)
	{
		if (!Record::isIdValid($arg_taxId)) {
			return false;
		}
	
		$db = Database::getDatabase();
		$result = $db->query(SQL_COUNT_LIT_TAX_FROM_LITID_TAXID,array('LitId' => $this->LitId,
			'TaxId' => $arg_taxId));
		$count = 0;
		if ($result->num_rows) {
			$row = $result->fetch_row();
			$count = $row[0];
		}
		if ($count != 0) {
			return true;
		}

		return false;
	}

	public function isLocLinkExist($arg_locId)
	{
		if (!Record::isIdValid($arg_locId)) {
			return false;
		}

		$db = Database::getDatabase();
		$result = $db->query(SQL_COUNT_LIT_LOC_FROM_LITID_LOCID,array('LitId' => $this->LitId,
			'LocId' => $arg_locId));
		$count = 0;
		
		if ($result->num_rows) {
			$row = $result->fetch_row();
			$count = $row[0];
		}
		
		if ($count != 0) {
			return true;
		}

		return false;
	}

	public function addTaxLink($arg_taxId)
	{
		$tax = Tax::loadFromTaxId($arg_taxId);

		if (is_null($tax)) {
			throw new GonInvalidArgumentException;
		}

		if ($this->isTaxLinkExist($arg_taxId)) {
			throw new GonInvalidArgumentException;
		}

		$db = Database::getDatabase();
		$db->query(SQL_CREATE_LIT_TAX_FROM_LITID_TAXID,array('LitId' => $this->LitId,
			'TaxId' => $arg_taxId));
	}
	
	public function addLocLink($arg_locId)
	{
		$loc = Loc::loadFromLocId($arg_locId);

		if (is_null($loc)) {
			throw new GonInvalidArgumentException;
		}

		if ($this->isLocLinkExist($arg_locId)) {
			throw new GonInvalidArgumentException;
		}

		$db = Database::getDatabase();
		$db->query(SQL_CREATE_LIT_LOC_FROM_LITID_LOCID,array('LitId' => $this->LitId,
			'LocId' => $arg_locId));
	}

	public function removeTaxLink($arg_taxId)
	{
		if (!Record::isIdValid($arg_taxId)) {
			throw new GonInvalidArgumentException;
		}

		$db = Database::getDatabase();
		$db->query(SQL_DELETE_LIT_TAX,array('LitId' => $this->LitId,
			'TaxId' => $arg_taxId));
	}

	public function removeLocLink($arg_locId)
	{
		if (!Record::isIdValid($arg_locId)) {
			throw new GonInvalidArgumentException;
		}

		$db = Database::getDatabase();
		$db->query(SQL_DELETE_LIT_LOC,array('LitId' => $this->LitId,
			'LocId' => $arg_locId));
	}

	public function isDeletable()
	{
		return $this->isEditable();
	}

}