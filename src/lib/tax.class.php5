<?php

/**
 * The Tax record class
 *
 */
class Tax extends Record
{

	/**
	 * The database table name.
	 * It is used for constructing some of the SQL statements.
	 */
	protected static $table = "tax";

	/**
	 * The table columns with type.
	 */
	protected static $columns = array('TaxId' => 0,'TaxNo' => 1,'CatId' => 0,'AutId' => 0,'Pages' => 0,'BndLoId' => 0,'BndUpId' => 0,'Qualifier' => 1,'Valid' => 0,'Status' => 1);

	/**
	 * For decoding the qualifier.
	 */
	protected static $qualifiers = array('-','ss','sy','sn','sh','af','cf','of','in','ge','gs','gy','gn','gh','gx','fa','fs','fy');
	protected static $qualifiersDesc = array(	'',				// -
												's.str. (species or subspecies)',		// ss
												'synonym (species)', // sy
												'nomen nudum or not fully recognizable', // sn
												'homonym (species)', // sh
												'aff., ex gr.',	// af
												'cf.',			// cf
												'open nomenclature', // of
												'sp. (species indeterminable)',	// in
												'genus',		// ge
												'subgenus',		// gs
												'synonym (genus)',	// gy
												'nomen nudum or not fully recognizable', // gn
												'homonym (genus)',	// gh
												'species differing considerably from type species',	// gx
												'family',		// fa
												'subfamily',	// fs
												'synonym (family)'); // fy
												
	/**
	 * Morph records
	 */
	protected $morphALoaded = false;
	protected $morphA = null;
	protected $morphBLoaded = false;
	protected $morphB = null;
	protected static $featureLengthA = array('A29' => 14,
		'B35' => 10,
		'C40' => 16,
		'D48' => 10,
		'F53' => 8,
		'G57' => 26);
	protected static $featureMapA = array('A22' => array('A29',0),
		'A29' => array('A29',2),
		'A30' => array('A29',4),
		'A31' => array('A29',6),
		'A32' => array('A29',8),
		'A33' => array('A29',10),
		'A34' => array('A29',12),
		'B35' => array('B35',0),
		'B36' => array('B35',2),
		'B37' => array('B35',4),
		'B38' => array('B35',6),
		'B39' => array('B35',8),
		'C40' => array('C40',0),
		'C41' => array('C40',2),
		'C42' => array('C40',4),
		'C43' => array('C40',6),
		'C44' => array('C40',8),
		'C45' => array('C40',10),
		'C46' => array('C40',12),
		'C47' => array('C40',14),
		'D48' => array('D48',0),
		'D49' => array('D48',2),
		'D50' => array('D48',4),
		'D51' => array('D48',6),
		'E52' => array('D48',8),
		'F53' => array('F53',0),
		'F54' => array('F53',2),
		'F55' => array('F53',4),
		'F56' => array('F53',6),
		'G57' => array('G57',0),
		'G58' => array('G57',2),
		'G59' => array('G57',2),
		'G60' => array('G57',4),
		'G61' => array('G57',6),
		'G62' => array('G57',8),
		'G63' => array('G57',10),
		'G64' => array('G57',12),
		'G65' => array('G57',14),
		'G66' => array('G57',16),
		'G67' => array('G57',18),
		'G68' => array('G57',20),
		'G69' => array('G57',22),
		'G70' => array('G57',24));
	protected static $featureLengthB = array('A22' => 28,
		'B35' => 20,
		'C41' => 28,
		'D49' => 16,
		'F54' => 12);
	protected static $featureMapB = array('A22' => array('A22',0),
		'A29' => array('A22',4),
		'A30' => array('A22',8),
		'A31' => array('A22',12),
		'A32' => array('A22',16),
		'A33' => array('A22',20),
		'A34' => array('A22',24),
		'B35' => array('B35',0),
		'B36' => array('B35',4),
		'B37' => array('B35',8),
		'B38' => array('B35',12),
		'B39' => array('B35',16),
		'C41' => array('C41',0),
		'C42' => array('C41',4),
		'C43' => array('C41',8),
		'C44' => array('C41',12),
		'C45' => array('C41',16),
		'C46' => array('C41',20),
		'C47' => array('C41',24),
		'D49' => array('D49',8),
		'D50' => array('D49',4),
		'D51' => array('D49',8),
		'E52' => array('D49',12),
		'F54' => array('F54',0),
		'F55' => array('F54',4),
		'F56' => array('F54',8));
	protected static $featureTxt = array('A22' => array('ad' => 'advolute',
			'pe' => 'perforate, spiral coiling',
			'ts' => 'imperforate, spiral coiling',
			'tr' => 'triangular coiling',
			'te' => 'tetrangular (or irregular) coiling'),
		'A29' => array('di' => 'discoidal (Ww/D: <0.35',
			'dl' => 'discoidal/lenticular (Ww/D: 0.35-0.6)',
			'pa' => 'pachycone (Ww/D: 0.6-0.85)',
			'pg' => 'pachycone/globular (Ww/D: 0.85-1.1)',
			'pb' => 'pachycone/depressed (Ww/D: >1.1)'),
		'A30' => array('ox' => 'oxycone',
			'as' => 'subacute',
			'rn' => 'rounded [narrowly]',
			'rb' => 'rounded [broadly]',
			'fl' => 'flattened',
			'cv' => 'concave'),
		'A31' => array('no' => 'none',
			'on' => 'one furrow',
			'bi' => 'bisculate',
			'km' => 'keel [smooth]',
			'ke' => 'keel [serrate]',
			'kt' => 'two keels'),
		'A32' => array('pl' => 'plane',
			'cx' => 'convex',
			'cv' => 'concave',
			'an' => 'angular'),
		'A33' => array('np' => 'narrow [punctiforme] (U/D: 0)',
			'ne' => 'narrow [extremely] (U/D: 0.01-0.15)',
			'na' => 'narrow (U/D: 0.15-0.3)',
			'wm' => 'wide/moderate (U/D: 0.3-0.45)',
			'wi' => 'wide (U/D: 0.45-0.6)',
			'we' => 'wide [extremely] (U/D > 0.6)'),
		'A34' => array('no' => 'none',
			'ro' => 'rounded',
			'an' => 'angular',
			'ri' => 'rim or wall'),
		'B35' => array('fi' => 'fine',
			'fc' => 'fine crenulate',
			'fr' => 'fine rough (or lamellate)',
			'co' => 'coarse',
			'cc' => 'coarse crenulate',
			'cr' => 'coarse rough'),
		'B36' => array('pr' => 'prorsiradiate',
			're' => 'rectiradiate',
			'ru' => 'rursiradiate'),
		'B37' => array('bi' => 'biconvex',
			'vx' => 'concave-convex',
			'xv' => 'convex-concave',
			'cx' => 'convex',
			'cv' => 'concave',
			'li' => 'linear'),
		'B38' => array('no' => 'none',
			'we' => 'weak',
			'lo' => 'long as wide',
			'lw' => 'longer than wide'),
		'B39' => array('li' => 'linear',
			'hs' => 'hyponomic sinus [shallow]',
			'hd' => 'hyponomic sinus [deep]',
			'sw' => 'salient [weak]',
			'sh' => 'salient [high]'),
		'C40' => array('no' => 'none',
			'ys' => 'yes, present',
			'te' => '1 - 10',
			'tw' => '> 10',
			'th' => '> 20',
			'fi' => '> 30',
			'fs' => '> 50',
			'fh' => '> 75'),
		'C41' => array('im' => 'simple',
			'su' => 'split: close to umbilicus',
			'sm' => 'split: middle of flanks',
			'sv' => 'split: ventrolateral',
			'fa' => 'fasciculate'),
		'C42' => array('fs' => 'fine sharp',
			'fr' => 'rounded',
			'fl' => 'lamellose',
			'cs' => 'coarse sharp',
			'cr' => 'rounded',
			'cl' => 'lamellose'),
		'C43' => array('en' => 'entire',
			'um' => 'umbilical edge',
			'fl' => 'flanks',
			've' => 'venter'),
		'C44' => array('pr' => 'prorsiradiate',
			're' => 'rectiradiate, linear',
			'ru' => 'rursiradiate'),
		'C45' => array('bi' => 'biconvex',
			'vx' => 'concave-convex',
			'xv' => 'convex-concave',
			'cx' => 'convex',
			'cv' => 'concave',
			'li' => 'linear'),
		'C46' => array('no' => 'none',
			'tw' => 'tubercles [weak]',
			'ts' => 'tubercles [strong]',
			'tp' => 'parabolic tubercles',
			'sp' => 'spines'),
		'C47' => array('um' => 'umbilical edge',
			'fl' => 'flanks',
			'vl' => 'ventro-lateral',
			've' => 'ventral'),
		'D48' => array('no' => 'none',
			'ys' => 'yes, number unknown',
			'c1' => 'constantly one',
			'c2' => 'constantly two',
			'c3' => 'constantly three',
			'c4' => 'constantly four',
			'cm' => 'constantly many',
			'cv' => 'number variable'),
		'D49' => array('mo' => 'only mold',
			'ms' => 'mold and surface, without wall',
			'mc' => 'combined with wall'),
		'D50' => array('we' => 'weak',
			'st' => 'strong',
			't1' => 'strong, one',
			't2' => 'strong, two',
			't3' => 'strong, three'),
		'D51' => array('en' => 'entire',
			'fl' => 'flank',
			've' => 'venter'),
		'E52' => array('no' => 'none',
			'ov' => 'one on venter',
			'tv' => 'two on venter',
			'ol' => 'one ventrolateral',
			'tl' => 'two ventrolateral',
			'la' => 'lateral'),
		'F53' => array('no' => 'none',
			'ys' => 'yes',
			'te' => '1-10',
			'tw' => '>10',
			'th' => '>20',
			'fi' => '>30',
			'fs' => '>50',
			'fh' => '>75',
			'hf' => '>100',
			'ht' => '>150',
			'he' => '>250 or frequent'),
		'F54' => array('in' => 'indistinct',
			'si' => 'simple',
			'su' => '+ umbilical cord',
			'sm' => '+ multiple threads',
			'gr' => 'granose'),
		'F55' => array('in' => 'indistinct',
			'si' => 'simple',
			'su' => '+ umbilical cord',
			'sm' => '+ multiple threads',
			'gr' => 'granose'),
		'F56' => array('en' => 'entire',
			'fl' => 'flank',
			've' => 'venter',
			'vu' => 'venter and umbilical',
			'um' => 'umbilical'),
		'G57' => array('no' => 'none',
			'si' => 'simple',
			'di' => 'divided'),
		'G58' => array('sr' => 'shallow, rounded',
			'sa' => 'shallow, acute',
			'ps' => 'parallel-sided',
			'po' => 'pouched',
			'vs' => 'V-shaped',
			'fs' => 'funnel-shaped'),
		'G59' => array('le' => 'low [extremely] (<0.2)',
			'lm' => 'low [moderately] (0.2-0.35)',
			'mo' => 'moderate (0.35-0.5)',
			'mh' => 'moderately high (0.5-0.65)',
			'hi' => 'high (0.65-0.8)',
			'he' => 'high [extremely] (>0.8)'),
		'G60' => array('ro' => 'rounded',
			'ps' => 'parallel-sided',
			'po' => 'pouched',
			'vs' => 'V-shaped',
			'ys' => 'Y-shaped',
			'iv' => 'subdivided',
			'ic' => 'denticulate',
			'ig' => 'digitate'),
		'G61' => array('vs' => 'V-shaped',
			'la' => 'lanceolate',
			'po' => 'pouched',
			'tr' => 'trifid',
			'iv' => 'subdivided',
			'ic' => 'denticulate',
			'ig' => 'digitate'),
		'G62' => array('sy' => 'symmetric',
			'as' => 'assymmetric'),
		'G63' => array('rb' => 'rounded [broadly]',
			'ro' => 'rounded',
			'rn' => 'rounded [narrowly]',
			'rs' => 'rounded balloon-shaped',
			'as' => 'subacute',
			'ac' => 'acute',
			'iv' => 'subdivided',
			'ic' => 'denticulate',
			'ig' => 'digitate'),
		'G64' => array('sy' => 'symmetric',
			'as' => 'asymmetric',
			'do' => 'dorsally inflexed'),
		'G65' => array('sr' => 'shallow, rounded',
			'sa' => 'shallow, acute',
			'dr' => 'deep, rounded',
			'ds' => 'deep, subacute',
			'dv' => 'deep, acute, V-shaped, straight or sinuous sides',
			'dl' => 'deep, acute, lanceolate or bell-shaped',
			'dw' => 'deep, acute, angular sides',
			'dp' => 'deep, acute, pouched',
			'iv' => 'subdivided (bifid, trifid or irregular)',
			'ic' => 'denticulate (more or less regular)',
			'ig' => 'digitate',
			'ip' => 'subdivided and denticulate'),
		'G66' => array('we' => 'wide [extremely] (>1.75)',
			'wi' => 'wide (1.50-1.75)',
			'es' => 'subequal (1.25-1.50)',
			'eq' => 'equal (1.00-1.25)',
			'nm' => 'narrow [moderate] (0.75-1.00)',
			'na' => 'narrow (0.50-0.75)',
			'ne' => 'narrow [extremely] (<0.5)'),
		'G67' => array('ro' => 'rounded',
			'as' => 'subacute',
			'ac' => 'acute',
			'ig' => 'digitate'),
		'G68' => array('no' => 'none',
			'ro' => 'rounded',
			'as' => 'subacute',
			'ac' => 'acute',
			'iv' => 'subdivided',
			'ic' => 'denticulate',
			'ig' => 'digitate'),
		'G69' => array('on' => 'one',
			'tw' => 'two',
			'th' => 'three',
			'fo' => 'four',
			'fi' => 'five',
			'ma' => 'many'),
		'G70' => array('no' => 'none',
			'sr' => 'simple, rounded',
			'sa' => 'simple, acute',
			'bi' => 'bifid',
			'tr' => 'trifid or subdivided'));

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
		return new Tax;
	}

	public function save()
	{
		if ($this->TaxNo == 0) {
			$this->TaxNo = parent::getMaxGeneric(self::$table,'TaxNo') + 1;
		}
		parent::saveGeneric(self::$columns,self::$table);
	}
	
	public function saveMorph()
	{
		if (isset($this->morphA)) {
			$this->morphA->update($this->TaxId);
		}
		if (isset($this->morphB)) {
			$this->morphB->update($this->TaxId);
		}
	}

	public function copy()
	{
		return parent::copyGeneric(self::$columns,self::create());
	}

	public function delete()
	{
		$this->Status = 1;
		$this->save();
	}

	/**
	 * Tax::deleteFinal()
	 *
	 */
	public static function deleteFinal($arg_id)
	{
		MorphA::deleteFinal($arg_id);
		MorphB::deleteFinal($arg_id);
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

	public function createArchiveMorph($arg_archiveId,$arg_removeA = false,$arg_removeB = false)
	{
		if ($this->morphALoaded == false) {
			$this->morphA = MorphA::loadFromTaxId($this->TaxId);
			$this->morphALoaded = true;
		}
		if ($this->morphBLoaded == false) {
			$this->morphB = MorphB::loadFromTaxId($this->TaxId);
			$this->morphBLoaded = true;
		}
		if (isset($this->morphA)) {
			if ($arg_removeA) {
				$this->morphA->TaxId = $arg_archiveId;
				$this->morphA->update($this->TaxId);
				$this->morphA = null;
			}
			else {
				$archive = $this->morphA->copy();
				$archive->TaxId = $arg_archiveId;
				$archive->insert();
			}
		}
		if (isset($this->morphB)) {
			if ($arg_removeB) {
				$this->morphB->TaxId = $arg_archiveId;
				$this->morphB->update($this->TaxId);
				$this->morphB = null;
			}
			else {
				$archive = $this->morphB->copy();
				$archive->TaxId = $arg_archiveId;
				$archive->insert();
			}
		}
	}

	public static function loadFromTaxId($arg_id)
	{
		if (!isset($arg_id)) {
			return null;
		}

		$result = parent::loadFromId($arg_id,self::$columns,self::$table);
		$record = null;

		if ($result->num_rows) {
			$record = new Tax($result->fetch_row());
		}

		return $record;
	}

	public static function getRecordCount()
	{
		return Database::getRecordCount(self::$table);
	}

	static public function loadAllIds()
	{
		$db = Database::getDatabase();
		$result = $db->Query(SQL_SELECT_ALL,array('columns' => 'TaxId',
			'Table' => self::$table));
		$ids = array();

		for ($i = 0; $i < $result->num_rows; $i++) {
			$row = $result->fetch_row();
			$ids[] = $row[0];
		}

		return $ids;
	}

	static public function loadFromTaxNo($arg_taxNo)
	{
		if (!isset($arg_taxNo)) {
			return null;
		}

		$db = Database::getDatabase();
		$result = $db->Query(SQL_SELECT_TAX_FROM_TAXNO,array('columns' => self::getColumns(),
			'TaxNo' => $arg_taxNo));
		$record = null;

		if ($result->num_rows) {
			$record = new Tax($result->fetch_row());
		}

		return $record;
	}

	static public function loadFromCatId($arg_catId)
	{
		if (!Record::isIdValid($arg_catId)) {
			return null;
		}

		$db = Database::getDatabase();
		$result = $db->Query(SQL_SELECT_TAX_FROM_CATID,array('columns' => self::getColumns(),
			'CatId' => $arg_catId));
		$record = null;

		if ($result->num_rows) {
			$record = new Tax($result->fetch_row());
		}

		return $record;
	}

	static public function loadSorted($arg_records)
	{
		$sel = array();
		
		if (count($arg_records)) {
			$catSet = array();
			$taxa = array();

			foreach ($arg_records as $record) {
				$catSet[] = $record->CatId;
				$taxa[$record->CatId] = $record;
			}

			$taxonomies = Cat::loadPathsFromCatSet($catSet,3);

			foreach ($taxonomies as $taxonomy => $catId) {
				$sel[$taxonomy] = $taxa[$catId];
			}
		}

		return $sel;
	}	

	static public function loadFromLitId($arg_litId)
	{
		if (!Record::isIdValid($arg_litId)) {
			return null;
		}

		$db = Database::getDatabase();
		$result = $db->Query(SQL_SELECT_TAX_FROM_LITID,array('columns' => self::getColumns('a'),
			'LitId' => $arg_litId));
		$records = array();

		for ($i = 0; $i < $result->num_rows; $i++) {
			$records[] = new Tax($result->fetch_row());
		}

		return $records;
	}

	static public function loadFromLitIdSorted($arg_litId)
	{
		return self::loadSorted(self::loadFromLitId($arg_litId));
	}

	static public function loadFromLocId($arg_locId)
	{
		if (!Record::isIdValid($arg_locId)) {
			return null;
		}

		$db = Database::getDatabase();
		$result = $db->Query(SQL_SELECT_TAX_FROM_LOCID,array('columns' => self::getColumns('a'),
			'LocId' => $arg_locId));
		$records = array();

		for ($i = 0; $i < $result->num_rows; $i++) {
			$records[] = new Tax($result->fetch_row());
		}

		return $records;
	}

	static public function loadFromLocIdSorted($arg_locId)
	{
		return self::loadSorted(self::loadFromLocId($arg_locId));
	}

	static public function loadFromAutId($arg_autId)
	{
		if (!Record::isIdValid($arg_autId)) {
			return null;
		}

		$db = Database::getDatabase();
		$result = $db->Query(SQL_SELECT_TAX_FROM_AUTID,array('columns' => self::getColumns(),
			'AutId' => $arg_autId));
		$records = array();

		for ($i = 0; $i < $result->num_rows; $i++) {
			$records[] = new Tax($result->fetch_row());
		}

		return $records;
	}

	static public function loadFromAutIdSorted($arg_autId)
	{
		return self::loadSorted(self::loadFromAutId($arg_autId));
	}	

	static public function loadFromBndId($arg_bndId)
	{
		if (!Record::isIdValid($arg_bndId)) {
			return null;
		}

		$db = Database::getDatabase();
		$result = $db->Query(SQL_SELECT_TAX_FROM_BNDID,array('columns' => self::getColumns(),
			'BndId' => $arg_bndId));
		$records = array();

		for ($i = 0; $i < $result->num_rows; $i++) {
			$records[] = new Tax($result->fetch_row());
		}

		return $records;
	}

	static public function loadFromBndIdSorted($arg_bndId)
	{
		return self::loadSorted(self::loadFromBndId($arg_bndId));
	}

	static public function loadFromAncestorId($arg_catId,$arg_type = 0)
	{
		if (!Record::isIdValid($arg_catId)) {
			return null;
		}

		$db = Database::getDatabase();
		$result = $db->Query(SQL_SELECT_TAX_FROM_ANCESTORID,array('columns' => self::getColumns('a'),
			'CatId' => $arg_catId,
			'Type' => $arg_type));
		$records = array();

		for ($i = 0; $i < $result->num_rows; $i++) {
			$records[] = new Tax($result->fetch_row());
		}

		return $records;
	}

	static public function loadQualifiersFromCatSet($arg_catSet)
	{
		if (count($arg_catSet) == 0) {
			return null;
		}

		$db = Database::getDatabase();
		$result = $db->Query(SQL_SELECT_QUAL_FROM_CATSET,array('values' => "'" . join("','",$arg_catSet) . "'"));
		$records = array();

		for ($i = 0; $i < $result->num_rows; $i++) {
			$row = $result->fetch_row();
			$records[$row[0]] = $row[1];
		}

		return $records;
	}

	static public function loadFromTaxon($arg_taxon)
	{
		if (strlen($arg_taxon) == 0) {
			throw new GonInvalidArgumentException;
		}

		$db = Database::getDatabase();
		$result = $db->Query(SQL_SELECT_TAX_FROM_TAXON,array('columns' => self::getColumns('a'),
			'Taxon' => $arg_taxon));
		$records = array();

		for ($i = 0; $i < $result->num_rows; $i++) {
			$records[] = new Tax($result->fetch_row());
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
		$records = array();
		$catSet = array();

		for ($i = 0; $i < $result->num_rows; $i++) {
			$record = new Tax($result->fetch_row());
			$records[$record->CatId] = $record;
			$catSet[] = $record->CatId;
		}

		$taxonomies = Cat::loadPathsFromCatSet($catSet,3);

		foreach ($taxonomies as $taxonomy => $catId) {
			$sel[$taxonomy] = array($catId,$records[$catId]);
		}

		return $sel;
	}

	static public function getSelectionList($arg_cat)
	{
		$sel = array();
		$catSet = array();

		foreach ($arg_cat as $cat) {
			$catSet[] = $cat->CatId;
		}

		$taxonomies = Cat::loadPathsFromCatSet($catSet,3);

		foreach ($taxonomies as $taxonomy => $catId) {
			$sel[$taxonomy] = array($catId,self::loadFromCatId($catId));
		}

		return $sel;
	}

	public function getTaxonomyShortString()
	{
		$cat = Cat::loadFromCatId($this->CatId);

		if ($cat->Type == 0) {
			$taxonomy = self::getTaxonomyShort($this->CatId);
			return self::getTaxonomyString($taxonomy);
		}

		return $cat->getTypeText() . ' ' . $cat->Name;
	}

	static public function getTaxonomyShortStringSmart($arg_taxonomy)
	{
		$cat = end($arg_taxonomy);
		$string = $cat->getTypeText() . " ";
		switch ($cat->Type) {
			case 0:
				foreach ($arg_taxonomy as $cat1) {
					if ($cat1->Type == 2) {
						$string .= "(" . $cat1->Name . ") ";
					}
					else if ($cat1->Type < 4) {
						$string .= $cat1->Name . " ";
					}
				}
				break;
			case 1:
				foreach ($arg_taxonomy as $cat1) {
					if ($cat1->Type < 4) {
						$string .= $cat1->Name . " ";
					}
				}
				break;
			default:
				$string .= $cat->Name;
		}
		rtrim($string);
		return $string;
	}

	static public function getTaxonomyString($arg_taxonomy)
	{
		$string = "";
		foreach ($arg_taxonomy as $cat) {
			if ($cat->Type == 2) {
				$string .= "(" . $cat->Name . ") ";
			}
			else {
				$string .= $cat->Name . " ";
			}
		}
		rtrim($string);
		return $string;
	}

	static public function getTaxonomyStringHierarchy($arg_taxonomy)
	{
		$string = "";
		foreach ($arg_taxonomy as $cat) {
			if (strlen($string)) {
				$string .="<rb />";
			}
			$string .= $cat->getTypeText() . " " . $cat->Name;
		}
		return $string;
	}

	static public function getTaxonomyShort($arg_catId)
	{
		$taxonomy = Cat::loadPathFromCatId($arg_catId,3);
		return $taxonomy;
	}

	public function getTaxonomy()
	{
		$taxonomy = Cat::loadPathFromCatId($this->CatId);
		if (end($taxonomy)->CatId != $this->CatId) {
			// This can happen if $this is an archive record
			array_pop($taxonomy);
			$taxonomy[] = Cat::loadFromCatId($this->CatId);
		}
		return $taxonomy;
	}

	public function getNotes()
	{
		$db = Database::getDatabase();
		$result = $db->Query(SQL_SELECT_NOTES_TAX_FROM_TAXID,array('TaxId' => $this->TaxId));
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
		$db->query(SQL_UPDATE_NOTES_TAX_FROM_TAXID,array('TaxId' => $this->TaxId, 'Notes' => $notes));
	}

	public function getAuthor()
	{
		return Aut::loadFromAutId($this->AutId);
	}

	public function getLowerBoundary()
	{
		return Bnd::loadFromBndId($this->BndLoId);
	}

	public function getUpperBoundary()
	{
		return Bnd::loadFromBndId($this->BndUpId);
	}

	public function getQualifierText()
	{
		return self::$qualifiers[$this->Qualifier];
	}

	public function getQualifierDesc()
	{
		return self::$qualifiersDesc[$this->Qualifier];
	}

	public static function _getQualifierText($arg_qual)
	{
		return self::$qualifiers[$arg_qual];
	}

	public static function _getQualifierDesc($arg_qual)
	{
		return self::$qualifiersDesc[$arg_qual];
	}

	public static function getQualifiers()
	{
		return self::$qualifiers;
	}

	public static function isValid($arg_qualifier)
	{
		if (isset($arg_qualifier) && array_search($arg_qualifier,array(1,9,10,15,16)) === false) {
			return false;
		}
		return true;
	}

	public function getLitCount()
	{
		$count = 0;
		$db = Database::getDatabase();
		$result = $db->Query(SQL_COUNT_TAX_LIT,array('TaxId' => $this->TaxId));

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
		$result = $db->Query(SQL_COUNT_TAX_LOC,array('TaxId' => $this->TaxId));

		if ($result->num_rows == 1) {
			$row = $result->fetch_row();
			$count = $row[0];
		}

		return $count;
	}
	
	public function addMorph()
	{
		if (isset($this->morphA))
			return;
		$this->morphA = MorphA::create();
		$this->morphA->TaxId = $this->TaxId;
		$this->morphA->insert();
	}

	public function addMorphB()
	{
		if (isset($this->morphB))
			return;
		$this->morphB = MorphB::create();
		$this->morphB->TaxId = $this->TaxId;
		$this->morphB->insert();
	}

	public function hasMorph()
	{
		// If there is a morphb, there must be a morpha,
		// so checking for morpha is enough.
		if ($this->morphALoaded == false) {
			$this->morphA = MorphA::loadFromTaxId($this->TaxId);
			$this->morphALoaded = true;
		}
		if (isset($this->morphA)) {
			return true;
		}
		return false;
	}

	public function hasMorphB()
	{
		if ($this->morphBLoaded == false) {
			$this->morphB = MorphB::loadFromTaxId($this->TaxId);
			$this->morphBLoaded = true;
		}
		if (isset($this->morphB)) {
			return true;
		}
		return false;
	}

	public function getFeatureA($arg_feature)
	{
		if ($this->morphALoaded == false) {
			$this->morphA = MorphA::loadFromTaxId($this->TaxId);
			$this->morphALoaded = true;
		}
		if (isset($this->morphA)) {
			// Handle special cases
			if ($arg_feature == 'G58') {
				if ($this->getFeatureA('G57') !== 'si') {
					return null;
				}
			}
			else if ($arg_feature == 'G59') {
				if ($this->getFeatureA('G57') !== 'di') {
					return null;
				}
			}

			$feature = '';

			if (array_key_exists($arg_feature,self::$featureMapA)) {
				$feature = substr($this->morphA->getAttrib(self::$featureMapA[$arg_feature][0]),self::$featureMapA[$arg_feature][1],2);
			}
			else {
				$feature = $this->morphA->getAttrib($arg_feature);
			}
			
			return rtrim($feature);
		}
		return null;
	}

	public function getFeatureB($arg_feature,$arg_stage)
	{
		if ($this->morphBLoaded == false) {
			$this->morphB = MorphB::loadFromTaxId($this->TaxId);
			$this->morphBLoaded = true;
		}
		if (isset($this->morphB)) {
			$feature = '';

			if (array_key_exists($arg_feature,self::$featureMapB)) {
				$start = self::$featureMapB[$arg_feature][1] + ($arg_stage * 2);
				$feature = substr($this->morphB->getAttrib(self::$featureMapB[$arg_feature][0]),$start,2);
			}
			else {
				$feature = $this->morphB->getAttrib($arg_feature);
			}

			return rtrim($feature);
		}
		return null;
	}

	public function getFeature($arg_feature,$arg_class = 0)
	{
		if ($arg_class == 0) {
			return $this->getFeatureA($arg_feature);
		}

		return $this->getFeatureB($arg_feature,$arg_class - 1);
	}
	
	public function isFeatureEqual($arg_feature,$arg_value0,$arg_value1 = null,$arg_value2 = null)
	{
		if ($this->getFeature($arg_feature) != $arg_value0) {
			return false;
		}
		if (isset($arg_value1) && $this->getFeature($arg_feature,1) != $arg_value1) {
			return false;
		}
		if (isset($arg_value2) && $this->getFeature($arg_feature,2) != $arg_value2) {
			return false;
		}
		return true;
	}
	
	public function setFeatureA($arg_feature,$arg_value)
	{
		if (!isset($this->morphA)) {
			return;
		}
		if (array_key_exists($arg_feature,self::$featureMapA)) {
			// Handle feature string
			$attrib = self::$featureMapA[$arg_feature][0];
			// Get the attribute value.
			$valueOld = $this->morphA->getAttrib($attrib);
			// First check if attribute is empty string
			if (strlen($valueOld) === 0) {
				// Initialize attribute with blanks
				$valueOld = str_pad("",self::$featureLengthA[$attrib]);
			}
			// Fix value if necessary
			switch (strlen($arg_value)) {
				case 0:
					$arg_value = "  ";
					break;
				case 1:
					$arg_value .= " ";
					break;
				case 2:
					break;
				default:
					$arg_value = substr($arg_value,0,2);
			}
			$valueNew = substr_replace($valueOld, $arg_value, self::$featureMapA[$arg_feature][1],2);
			$this->morphA->setAttrib($attrib,$valueNew);
		}
		else {
			$this->morphA->setAttrib($arg_feature,$arg_value);
		}
	}

	public function setFeatureB($arg_feature,$arg_stage,$arg_value)
	{
		if (!isset($this->morphB)) {
			return;
		}
		if (array_key_exists($arg_feature,self::$featureMapB)) {
			$attrib = self::$featureMapB[$arg_feature][0];
			$start = self::$featureMapB[$arg_feature][1] + ($arg_stage * 2);
			// Get the attribute value.
			$valueOld = $this->morphB->getAttrib($attrib);
			// First check if attribute is empty string
			if (strlen($valueOld) === 0) {
				// Initialize attribute with blanks
				$valueOld = str_pad("",self::$featureLengthB[$attrib]);
			}
			// Fix value if necessary
			switch (strlen($arg_value)) {
				case 0:
					$arg_value = "  ";
					break;
				case 1:
					$arg_value .= " ";
					break;
				case 2:
					break;
				default:
					$arg_value = substr($arg_value,0,2);
			}
			$valueNew = substr_replace($valueOld, $arg_value, $start,2);
			$this->morphB->setAttrib($attrib,$valueNew);
		}
		else {
			$this->morphB->setAttrib($arg_feature,$arg_value);
		}
	}

	public function setFeature($arg_feature,$arg_value0,$arg_value1 = null,$arg_value2 = null)
	{
		$this->setFeatureA($arg_feature,$arg_value0);
		
		if (isset($arg_value1)) {
			$this->setFeatureB($arg_feature,0,$arg_value1);
		}
		if (isset($arg_value2)) {
			$this->setFeatureB($arg_feature,1,$arg_value2);
		}
	}

	public function getFeatureText($arg_feature,$arg_class)
	{
		$feature = $this->getFeature($arg_feature,$arg_class);

		if (is_null($feature)) {
			return null;
		}
		if ($feature === '') {
			return $feature;
		}

		return self::_getFeatureText($arg_feature,$feature);
	}

	public static function _getFeatureText($arg_feature,$arg_value)
	{
		if (!array_key_exists($arg_feature,self::$featureTxt)) {
			return null;
		}

		$featureTexts = self::$featureTxt[$arg_feature];

		if (!array_key_exists($arg_value,$featureTexts)) {
			return null;
		}

		return $featureTexts[$arg_value];
	}

	public static function getFeatureOptions($arg_feature)
	{
		if (!array_key_exists($arg_feature,self::$featureTxt)) {
			return null;
		}

		return self::$featureTxt[$arg_feature];
	}
	
	public function getFigureCount()
	{
		$files = glob("fig/TAX" . $this->TaxNo . "*.*");
		$pattern = "/fig\/TAX" . $this->TaxNo . "[A-Z]?\.[BMP|GIF|PNG|JPG|JPEG]/i";
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
		$files = glob("fig/TAX" . $this->TaxNo . "*.*");
		$pattern = "/fig\/TAX" . $this->TaxNo . "[A-Z]?\.[BMP|GIF|PNG|JPG|JPEG]/i";
		$figures = array();

		foreach ($files as $file) {
			if (preg_match($pattern,$file)) {
				$figures[] = pathinfo($file,PATHINFO_BASENAME);
			}
		}

		return $figures;
	}

	public static function getFigName($arg_taxNo)
	{
		return self::getFigNameGeneric($arg_taxNo,"TAX");
	}

	public function isLitLinkExist($arg_litId)
	{
		$db = Database::getDatabase();
		$result = $db->query(SQL_COUNT_LIT_TAX_FROM_LITID_TAXID,array('TaxId' => $this->TaxId,
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
		$db->query(SQL_CREATE_LIT_TAX_FROM_LITID_TAXID,array('TaxId' => $this->TaxId,
			'LitId' => $arg_litId));
	}

	public function removeLitLink($arg_litId)
	{
		if (!Record::isIdValid($arg_litId)) {
			throw new GonInvalidArgumentException;
		}

		$db = Database::getDatabase();
		$db->query(SQL_DELETE_LIT_TAX,array('TaxId' => $this->TaxId,
			'LitId' => $arg_litId));
	}

}
