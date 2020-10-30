<?php

/**
 * The Log record class
 *
 */
class Log extends Record
{
	/**
	 * The database table name.
	 * It is used for constructing some of the SQL statements.
	 */
	protected static $table = "log";

	/**
	 * The table columns with type.
	 */
	protected static $columns = array('LogId' => 0,'AccountId' => 0,'RecordId' => 0,'RecordClass' => 0,'OtherId' => 0,'OtherClass' => 0,'Timestamp' => 0,'Type' => 1);
	
	const TypeRcdCreated = 10;
	const TypeRcdModified = 11;
	const TypeRcdDeleted = 12;
	const TypeRelCreated = 20;
	const TypeRelDeleted = 21;
	const TypeImageAdded = 30;
	const TypeImageDeleted = 31;

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
		return new Log;
	}
	
	public function save()
	{
		parent::saveGeneric(self::$columns,self::$table);
	}
	
	public function copy()
	{
		return parent::copyGeneric(self::$columns, self::create());
	}
	
	public static function delete($arg_id)
	{
		$log = self::loadFromLogId($arg_id);
		if (!is_null($log)) {
			if ($log->isRecord()) {
				$class = $log->OtherClass;
				$class::deleteFinal($log->OtherId);
			}
			else if ($log->IsImage()) {
				$class = $log->RecordClass;
				if (self::getFigRefCount($log->OtherId) == 1)
					$class::deleteFigFinal($log->OtherId);
			}
		}
		parent::deleteGeneric(self::$columns, self::$table, $arg_id);
	}

	public static function getRecordCount()
	{
		return Database::getRecordCount(self::$table);
	}
	
	public static function loadAll($limit = 100)
	{
		$db = Database::getDatabase();
		$result = $db->Query(	SQL_SELECT_LOG_ALL,
								array(	'columns' => self::getColumns(),
										'limit'	=> $limit));
		$records = array();

		for ($i = 0; $i < $result->num_rows; $i++) {
			$records[] = new Log($result->fetch_row());
		}

		return $records;
	}

	public static function loadFromLogId($arg_id)
	{
		if (!isset($arg_id))
			return null;

		$result = parent::loadFromId($arg_id,self::$columns,self::$table);
		$record = null;

		if ($result->num_rows)
			$record = new Log($result->fetch_row());

		return $record;
	}
	
	static public function loadFromRecordId($arg_rcdId)
	{
		if (!Record::isIdValid($arg_rcdId))
			return null;

		$db = Database::getDatabase();
		$result = $db->Query(	SQL_SELECT_LOG_FROM_RECORDID,
								array(	'columns' => self::getColumns(),
										'RecordId' => $arg_rcdId));
		$records = array();

		for ($i = 0; $i < $result->num_rows; $i++)
			$records[] = new Log($result->fetch_row());

		return $records;
	}

	public function getNotes()
	{
		$db = Database::getDatabase();
		$result = $db->query(	SQL_SELECT_NOTES_LOG_FROM_LOGID,
								array(	'LogId' => $this->LogId ));
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
		$result = $db->query(	SQL_UPDATE_NOTES_LOG_FROM_LOGID,
								array(	'LogId' => $this->LogId,
										'Notes' => $notes));
	}
	
	static public function logRecordCreate($arg_recordId,$arg_class)
	{
		$log = self::create();
		$log->Timestamp = date("Y-m-d H:i:s",time());
		$log->Type = self::TypeRcdCreated;
		$log->AccountId = Account::getCurrentAccount()->AccountId;
		$log->RecordId = $arg_recordId;
		$log->RecordClass = $arg_class;
		$log->OtherId = $arg_recordId;
		$log->OtherClass = $arg_class;
		$log->save();
	}

	static public function logRecordModify($arg_recordId,$arg_archiveId,$arg_class)
	{
		$log = self::create();
		$log->Timestamp = date("Y-m-d H:i:s",time());
		$log->Type = self::TypeRcdModified;
		$log->AccountId = Account::getCurrentAccount()->AccountId;
		$log->RecordId = $arg_recordId;
		$log->RecordClass = $arg_class;
		$log->OtherId = $arg_archiveId;
		$log->OtherClass = $arg_class;
		$log->save();
	}

	static public function logRecordDelete($arg_recordId,$arg_class)
	{
		$log = self::create();
		$log->Timestamp = date("Y-m-d H:i:s",time());
		$log->Type = self::TypeRcdDeleted;
		$log->AccountId = Account::getCurrentAccount()->AccountId;
		$log->RecordId = $arg_recordId;
		$log->RecordClass = $arg_class;
		$log->OtherId = $arg_recordId;
		$log->OtherClass = $arg_class;
		$log->save();
	}

	static public function logRelationCreate($arg_recordId,$arg_class,$arg_linkId,$arg_linkClass)
	{
		$log = self::create();
		$log->Timestamp = date("Y-m-d H:i:s",time());
		$log->Type = self::TypeRelCreated;
		$log->AccountId = Account::getCurrentAccount()->AccountId;
		$log->RecordId = $arg_recordId;
		$log->RecordClass = $arg_class;
		$log->OtherId = $arg_linkId;
		$log->OtherClass = $arg_linkClass;
		$log->save();
	}

	static public function logRelationDelete($arg_recordId,$arg_class,$arg_linkId,$arg_linkClass)
	{
		$log = self::create();
		$log->Timestamp = date("Y-m-d H:i:s",time());
		$log->Type = self::TypeRelDeleted;
		$log->AccountId = Account::getCurrentAccount()->AccountId;
		$log->RecordId = $arg_recordId;
		$log->RecordClass = $arg_class;
		$log->OtherId = $arg_linkId;
		$log->OtherClass = $arg_linkClass;
		$log->save();
	}

	static public function logImageAdd($arg_recordId,$arg_class,$arg_fig)
	{
		$log = self::create();
		$log->Timestamp = date("Y-m-d H:i:s",time());
		$log->Type = self::TypeImageAdded;
		$log->AccountId = Account::getCurrentAccount()->AccountId;
		$log->RecordId = $arg_recordId;
		$log->RecordClass = $arg_class;
		$log->OtherId = $arg_fig;
		$log->OtherClass = "Fig";
		$log->save();
	}

	static public function logImageDelete($arg_recordId,$arg_class,$arg_fig)
	{
		$log = self::create();
		$log->Timestamp = date("Y-m-d H:i:s",time());
		$log->Type = self::TypeImageDeleted;
		$log->AccountId = Account::getCurrentAccount()->AccountId;
		$log->RecordId = $arg_recordId;
		$log->RecordClass = $arg_class;
		$log->OtherId = $arg_fig;
		$log->OtherClass = "Arc";
		$log->save();
	}
	
	static public function updateImageAdd($arg_recordId,$arg_fig,$arg_archive)
	{
		$db = Database::getDatabase();
		$result = $db->query(	SQL_UPDATE_LOG_FROM_RECID_FIG,
								array(	'RecordId' => $arg_recordId,
										'Fig' => $arg_fig,
										'Archive' => $arg_archive));
	}
	
	static public function getFigRefCount($arg_fig)
	{
		$db = Database::getDatabase();
		$result = $db->query(	SQL_LOG_COUNT_REF_FROM_FIG,
								array(	'Fig' => $arg_fig));
		
		$count = 0;
		if ($result->num_rows) {
			$row = $result->fetch_row();
			$count = $row[0];
		}
		return $count;
	}

	public function getTypeString()
	{
		switch ($this->Type) {
			case self::TypeRcdCreated :
				return "Created";
			case self::TypeRcdModified :
				return "Modified";
			case self::TypeRcdDeleted :
				return "Deleted";
			case self::TypeRelCreated :
				return "Link added";
			case self::TypeRelDeleted :
				return "Link removed";
			case self::TypeImageAdded :
				return "Image added";
			case self::TypeImageDeleted :
				return "Image deleted";
		}
		return "Undefined";
	}
	
	public function getTimestampString()
	{
		$time = new DateTime($this->Timestamp);
		return $time->format('Y-m-d');
	}
	
	public function getUserName()
	{
		$account = Account::loadFromAccountId($this->AccountId);
		return $account->User;
	}
	
	public function isRecord()
	{
		return $this->Type >=10 && $this->Type < 20;
	}

	public function isRelation()
	{
		return $this->Type >=20 && $this->Type < 30;
	}

	public function isImage()
	{
		return $this->Type >=30 && $this->Type < 40;
	}

	public function getTableInfo()
	{
		if ($this->isRelation()) {
			return $this->RecordClass . " - " . $this->OtherClass;
		}

		return $this->RecordClass;
	}
}

?>