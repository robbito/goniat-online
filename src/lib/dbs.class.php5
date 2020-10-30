<?php

/**
 * Contains definition of the class Database.
 */

/**
 * Class encapsulating database access.
 */

class Database
{
	/**
	 * Database handle.
	 */
	private $db = null;

	/**
	 * Static database object for database access.
	 */
	private static $singelton = null;

	/**
	 * Private constructor of the class, which is instantiated once for each
	 * type of connection in the system.
	 *
	 * @param String $arg_host      Name of the database server
	 * @param String $arg_username  User name for accessing the database
	 * @param String $arg_password  Pass word for the database access
	 * @param String $arg_dbname    Name of the database
	 */
	private function __construct($arg_host, $arg_username, $arg_password, $arg_dbname)
	{
		$this->db = mysql_pconnect($arg_host,$arg_username,$arg_password);
		if ($this->db === false) {
			throw new GonDatabaseException(array('MySQL error message' => 'mysql_pconnect failed'));
		}
		mysql_select_db($arg_dbname,$this->db);
		mysql_query("SET CHARACTER SET 'utf8'", $this->db);
	}

	/**
	 * Database reconnection.
	 *
	 * @param String $arg_host      Name of the database server
	 * @param String $arg_username  User name for accessing the database
	 * @param String $arg_password  Pass word for the database access
	 * @param String $arg_dbname    Name of the database
	 */
	private function reconnect($arg_host = DEFAULT_DBHOST, $arg_username = DEFAULT_DBUSER, $arg_password = DEFAULT_DBPASSWORD, $arg_dbname = DEFAULT_DBNAME)
	{
		mysql_close($this->db);
		$this->db = mysql_pconnect($arg_host,$arg_username,$arg_password);
		if ($this->db === false) {
			throw new GonDatabaseException(array('MySQL error message' => 'mysql_pconnect failed'));
		}
		mysql_select_db($arg_dbname,$this->db);
		mysql_query("SET CHARACTER SET 'utf8'", $this->db);
	}

	/**
	 * Query definition and parameter replacement.
	 *
	 * Since queries are defined as constants in a separate file, parameters must
	 * be inserted separately.
	 * This is done by calling {@link GetQueryString} which takes the query itself
	 * and an associative array containing parameter value pairs.
	 *
	 * @param String    $arg_query      Text with query constant
	 * @param String[]  $arg_paramList  Associative array with query parameters
	 * @return mysqli_result
	 * @see GetQueryString
	 * @throws {@link PliffException}
	 */
	public function query($arg_query, $arg_paramList=null)
	{
		$query = $arg_query;
		if (!is_null($arg_paramList)) {
			$query = $this->getQueryString($arg_query, $arg_paramList);
		}

		if (mysql_ping($this->db) == FALSE) {
			$this->Reconnect();
		}

		$result = mysql_query($query,$this->db);

		if ( $result===false || mysql_errno($this->db) ) {
			throw new GonDatabaseException(array(	'MySQL error code'	=> mysql_errno($this->db),
			                                 		'MySQL error text'	=> mysql_error($this->db),
			                               	   		'MySQL query'       => is_null($arg_paramList)
			                               	                             	? $arg_query
			                               	                             	: self::getQueryString($arg_query, $arg_paramList),
			                               	   		'query string'		=> $arg_query,
			                                   		'parameter list'	=> $arg_paramList ),mysql_errno($this->db) );
		} // if

		return new QueryResult($result);
	}


	/**
	 * Creates a valid database query by replacing variables.
	 *
	 * Returns the string of the query, where variables in $arg_query have been
	 * replaced by the values in the associative array $arg_paramList.
	 * Parameters are processed by mysql_real_escape_string to avoid SQL injection.
	 *
	 * @param String    $arg_query      Query string, variablen having the form {var}
	 * @param String[]  $arg_paramList  Associative array with pairs var=>value
	 * @return String
	 */
	public function getQueryString($arg_query, $arg_paramList)
	{
		// Split query at '{'
		$query = explode('{', $arg_query);
		// The first component
		$resQuery = $query[0];
		// Iterate through components
		for ($i = 1; $i < count($query); $i++) {
			// Extract variable name
			list($variable, $rest) = explode('}', $query[$i], 2);
			// Variable not found => Error
			if ( ! isset($arg_paramList[$variable]) ) {
				throw new GonDatabaseQueryException(array(	'query string'		=> $arg_query,
			                                	      		'parameter array'	=> join(',',$arg_paramList),
			                                  		   		'variable'			=> $variable ) );
			} // if
			// Construct resulting query
			if ($variable == 'values') {
				// Special treatment for a complex variable value, which already
				// has been preprocessed
				$resQuery .= $arg_paramList[$variable].$rest;
			}
			else {
				// Standard treatment for variable values.
				$resQuery .= $this->real_escape_string($arg_paramList[$variable]).$rest;
			}
		} // for

		return $resQuery;
	}

	/**
	 * Wrapper function for the database string escape function.
	 */
	public function real_escape_string($arg_string)
	{
		return mysql_real_escape_string($arg_string,$this->db);
	}

	/**
	 * Returns the database object.
	 *
	 * @param String	$arg_username		Optional database user name
	 * @param String	$arg_password		Optional database pass word
	 * @return Database
	 */
	public static function getDatabase( $arg_username = DEFAULT_DBUSER, $arg_password = DEFAULT_DBPASSWORD )
	{
		// If the database hasn't been opened yet, it will be created here.
		if ( is_null(self::$singelton) ) {
			self::$singelton = new Database(DEFAULT_DBHOST, $arg_username, $arg_password, DEFAULT_DBNAME);
			// Errors cause an exception.
			if ( mysql_errno(self::$singelton->db) ) {
				throw new GonDatabaseException(array(	'MySQL host'		=> DEFAULT_DBHOST,
				                              			'MySQL user'		=> $arg_username,
				                            	     	'MySQL database'	=> DEFAULT_DBNAME,
				                            	     	'MySQL error code'	=> mysql_errno(self::$singelton->db),
				                            	      	'MySQL error text'	=> mysql_error(self::$singelton->db) ),mysql_errno(self::$singelton->db) );
			} // if
		} // if
		// Everything is ok, database object is returned.
		return self::$singelton;
	}

	/**
	 * Returns the record count of the specified table.
	 */
	public static function getRecordCount($arg_table)
	{
		$db = self::getDatabase();
		$result = $db->query(SQL_COUNT,array('Table' => $arg_table));
		$count = 0;
		if ($result->num_rows) {
			$row = $result->fetch_row();
			$count = $row[0];
		}
		return $count;
	}
}

/** QueryResult
 *
 * This class encapsulates a query result handle.
 */
class QueryResult
{
	/**
	 * The query result handle.
	 */
	private $result = null;

	/**
	 * COnstructor taking a query result handle.
	 */
	public function __construct($arg_result)
	{
		$this->result = $arg_result;
	}

	/**
	 * Accessor for the row count.
	 */
	public function __get($arg_attribute)
	{
		if ($arg_attribute == 'num_rows')
			return mysql_num_rows($this->result);
		return null;
	}

	/**
	 * Wrapper for the fetch_row function.
	 */
	public function fetch_row()
	{
		return mysql_fetch_row($this->result);
	}
}

?>