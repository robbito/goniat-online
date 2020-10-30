<?php

/**
 * The Loc record class
 *
 */
class Loc extends Record
{

	/**
	 * The database table name.
	 * It is used for constructing some of the SQL statements.
	 */
	protected static $table = "loc";

	/**
	 * The table columns with type.
	 */
	protected static $columns = array('LocId' => 0,'LocNo' => 1,'GeoId' => 0,'BndLoId' => 0,'BndUpId' => 0,'Continent' => 0,'Code' => 0,'GeoRef' => 0,'Status' => 1);

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
		return new Loc;
	}

	public function save()
	{
		if ($this->LocNo == 0) {
			$this->LocNo = parent::getMaxGeneric(self::$table,'LocNo') + 1;
		}
		parent::saveGeneric(self::$columns,self::$table);
	}

	public function copy()
	{
		return parent::copyGeneric(self::$columns,self::create());
	}

	/**
	 * Loc::delete()
	 *
	 * Doesn't really delete, but changes the status to 1
	 */
	public function delete()
	{
		$this->Status = 1;
		$this->save();
	}

	/**
	 * Loc::deleteFinal()
	 *
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
		if (!is_null($notes)) {
			$archive->saveNotes($notes);
		}
		return $archive;
	}

	public static function loadFromLocId($arg_id)
	{
		if (!isset($arg_id)) {
			return null;
		}

		$result = parent::loadFromId($arg_id,self::$columns,self::$table);
		$record = null;

		if ($result->num_rows) {
			$record = new Loc($result->fetch_row());
		}

		return $record;
	}

	static public function loadFromLocNo($arg_locNo)
	{
		if (!isset($arg_locNo)) {
			return null;
		}

		$db = Database::getDatabase();
		$result = $db->Query(SQL_SELECT_LOC_FROM_LOCNO,array('columns' => self::getColumns(),
			'LocNo' => $arg_locNo));
		$record = null;

		if ($result->num_rows) {
			$record = new Loc($result->fetch_row());
		}

		return $record;
	}

	static public function loadFromGeoId($arg_geoId)
	{
		if (!isset($arg_geoId)) {
			return null;
		}

		$db = Database::getDatabase();
		$result = $db->Query(SQL_SELECT_LOC_FROM_GEOID,array('columns' => self::getColumns(),
			'GeoId' => $arg_geoId));
		$record = null;

		if ($result->num_rows) {
			$record = new Loc($result->fetch_row());
		}

		return $record;
	}

	public static function getRecordCount()
	{
		return Database::getRecordCount(self::$table);
	}

	static public function loadFromTaxId($arg_taxId)
	{
		if (!isset($arg_taxId) || strlen($arg_taxId) != 32) {
			return null;
		}

		$db = Database::getDatabase();
		$result = $db->Query(SQL_SELECT_LOC_FROM_TAXID,array('columns' => self::getColumns('a'),
			'TaxId' => $arg_taxId));
		$records = array();

		for ($i = 0; $i < $result->num_rows; $i++) {
			$records[] = new Loc($result->fetch_row());
		}

		return $records;
	}

	static public function loadFromLitId($arg_litId)
	{
		if (!isset($arg_litId) || strlen($arg_litId) != 32) {
			return null;
		}

		$db = Database::getDatabase();
		$result = $db->Query(SQL_SELECT_LOC_FROM_LITID,array('columns' => self::getColumns('a'),
			'LitId' => $arg_litId));
		$records = array();

		for ($i = 0; $i < $result->num_rows; $i++) {
			$records[] = new Loc($result->fetch_row());
		}

		return $records;
	}

	static public function loadFromBndId($arg_bndId)
	{
		if (!Record::isIdValid($arg_bndId)) {
			return null;
		}

		$db = Database::getDatabase();
		$result = $db->Query(SQL_SELECT_LOC_FROM_BNDID,array('columns' => self::getColumns(),
			'BndId' => $arg_bndId));
		$records = array();

		for ($i = 0; $i < $result->num_rows; $i++) {
			$records[] = new Loc($result->fetch_row());
		}

		return $records;
	}

	static public function loadFromLocality($arg_locality)
	{
		if (strlen($arg_locality) == 0) {
			throw new GonInvalidArgumentException;
		}

		$db = Database::getDatabase();
		$result = $db->Query(SQL_SELECT_LOC_FROM_LOCALITY,array('columns' => self::getColumns('a'),
			'Locality' => $arg_locality));
		$records = array();

		for ($i = 0; $i < $result->num_rows; $i++) {
			$records[] = new Loc($result->fetch_row());
		}

		return $records;
	}

	static public function sortByGeography($arg_records)
	{
		$sel = array();

		foreach ($arg_records as $loc) {
			$sel[$loc->getGeographyString(null,false)] = $loc;
		}

		ksort($sel);
		return array_values($sel);
	}

	public function getLocalityString()
	{
		$string = "";
		$geography = $this->getGeography();
		array_pop($geography);

		foreach ($geography as $geo) {
			$string .= $geo->Name . ", ";
		}

		return rtrim($string," ,");
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
			$loc = new Loc($result->fetch_row());
			$geography = $loc->getGeography();
			$sel[$loc->getGeographyString($geography,false)] = array(end($geography),$loc);
		}

		ksort($sel);
		return $sel;
	}

	static public function getSelectionList($arg_geo)
	{
		$sel = array();

		foreach ($arg_geo as $geo) {
			$geography = $geo->getGeography();
			$sel[$geo->getGeographyString($geography,false)] = array(end($geography),self::loadFromGeoId($geo->GeoId));
		}

		ksort($sel);
		return $sel;
	}

	public function getGeographyString($arg_geography = null,$arg_exceptLast = true)
	{
		$string = "";

		if (!isset($arg_geography)) {
			$arg_geography = $this->getGeography();
		}

		if ($arg_exceptLast)
			array_pop($arg_geography);

		foreach ($arg_geography as $geo) {
			$string .= $geo->Name . ", ";
		}

		return rtrim($string," ,");
	}

	static public function getGeographyShortStringSmart($arg_geography)
	{
		$geo = end($arg_geography);
		$string = $geo->getTypeText() . " " . $geo->Name;
		if ($geo->Type == 0) {
			foreach ($arg_geography as $geo1) {
				if ($geo1->Type == 1) {
					$string .= ", " . $geo1->Name;
				}
			}
		}
		return $string;
	}

	public function getGeography()
	{
		$geography = Geo::loadPathFromGeoId($this->GeoId);
		if (end($geography)->GeoId != $this->GeoId) {
			// This can happen if $this is an archive record
			array_pop($geography);
			$geography[] = Geo::loadFromGeoId($this->GeoId);
		}
		return $geography;
	}

	public function getLayerString()
	{
		$layer = Geo::loadFromGeoId($this->GeoId);
		return $layer->Name;
	}

	public function getNotes()
	{
		$db = Database::getDatabase();
		$result = $db->query(SQL_SELECT_NOTES_LOC_FROM_LOCID,array('LocId' => $this->LocId));
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
		$result = $db->query(SQL_UPDATE_NOTES_LOC_FROM_LOCID,array('LocId' => $this->LocId,
			'Notes' => $notes));
	}

	public function getLowerBoundary()
	{
		return Bnd::loadFromBndId($this->BndLoId);
	}

	public function getUpperBoundary()
	{
		return Bnd::loadFromBndId($this->BndUpId);
	}

	public function getTaxCount()
	{
		$count = 0;
		$db = Database::getDatabase();
		$result = $db->Query(SQL_COUNT_LOC_TAX,array('LocId' => $this->LocId));

		if ($result->num_rows == 1) {
			$row = $result->fetch_row();
			$count = $row[0];
		}

		return $count;
	}

	public function getLitCount()
	{
		$count = 0;
		$db = Database::getDatabase();
		$result = $db->Query(SQL_COUNT_LOC_LIT,array('LocId' => $this->LocId));

		if ($result->num_rows == 1) {
			$row = $result->fetch_row();
			$count = $row[0];
		}

		return $count;
	}

	public function getFigureCount()
	{
		$files = glob("fig/LOC" . $this->LocNo . "*.*");
		$pattern = "/fig\/LOC" . $this->LocNo . "[A-Z]?\.[BMP|GIF|PNG|JPG|JPEG]/i";
		$count = 0;

		foreach ($files as $file) {
			if (preg_match($pattern,$file)) {
				$count++;
			}
		}

		return $count;
	}

	public function getFigures()
	{
		$files = glob("fig/LOC" . $this->LocNo . "*.*");
		$pattern = "/fig\/LOC" . $this->LocNo . "[A-Z]?\.[BMP|GIF|PNG|JPG|JPEG]/i";
		$figures = array();

		foreach ($files as $file) {
			if (preg_match($pattern,$file)) {
				$figures[] = pathinfo($file,PATHINFO_BASENAME);
			}
		}

		return $figures;
	}

	public static function getFigName($arg_locNo)
	{
		return self::getFigNameGeneric($arg_locNo,"LOC");
	}

	public function isTaxLinkExist($arg_taxId)
	{
		$db = Database::getDatabase();
		$result = $db->query(SQL_COUNT_TAX_LOC_FROM_TAXID_LOCID,array('LocId' => $this->LocId,
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

	public function isLitLinkExist($arg_litId)
	{
		$db = Database::getDatabase();
		$result = $db->query(SQL_COUNT_LIT_LOC_FROM_LITID_LOCID,array('LocId' => $this->LocId,
			'LitId' => $arg_litId));
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
		$result = $db->query(SQL_CREATE_TAX_LOC_FROM_TAXID_LOCID,array('LocId' => $this->LocId,
			'TaxId' => $arg_taxId));
	}

	public function addLitLink($arg_litId)
	{
		$lit = Lit::loadFromLitId($arg_litId);

		if (is_null($lit)) {
			throw new GonInvalidArgumentException;
		}

		if ($this->isLitLinkExist($arg_litId)) {
			throw new GonInvalidArgumentException;
		}

		$db = Database::getDatabase();
		$result = $db->query(SQL_CREATE_LIT_LOC_FROM_LITID_LOCID,array('LocId' => $this->LocId,
			'LitId' => $arg_litId));
	}

	public function removeTaxLink($arg_taxId)
	{
		if (!Record::isIdValid($arg_taxId)) {
			throw new GonInvalidArgumentException;
		}

		$db = Database::getDatabase();
		$result = $db->query(SQL_DELETE_TAX_LOC,array('LocId' => $this->LocId,
			'TaxId' => $arg_taxId));
	}

	public function removeLitLink($arg_litId)
	{
		if (!Record::isIdValid($arg_litId)) {
			throw new GonInvalidArgumentException;
		}

		$db = Database::getDatabase();
		$result = $db->query(SQL_DELETE_LIT_LOC,array('LocId' => $this->LocId,
			'LitId' => $arg_litId));
	}

}

?>