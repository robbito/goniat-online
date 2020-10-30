<?php

/**
 * Contains custom exception classes.
 */

/**
 * Base exception class.
 */

class GonException extends Exception
{
	/**
	 * Array with additional information concerning the error.
	 */
	private $info = array();

	/**
	 * Construktor for a GonException.
	 */
	public function __construct( $arg_message, $arg_info=array() ) {
		parent::__construct($arg_message);
		$this->info = $arg_info;
	}

	/**
     * Returns the error text.
     */
	public function getCompleteMessage() {
		$message = $this->message;
		if (count($this->info)) {
			$message .= '<br />';
			foreach( $this->info as $key => $value ) {
				$message .= '<br />'.$key.': ';
				if (is_array($value)) {
					$message .= '</br>';
					foreach( $value as $key2 => $value2 ) {
						$message .= '</br>&nbsp;&nbsp;'.$key2.': '.$value2;
					}
				}
				else
					$message .= $value;
			}
		}
		return $message;
	}
}

/**
 * General database exception class.
 */
class GonDatabaseException extends GonException
{
	private $databaseErrno = 0;

	public function __construct( $arg_info=array(), $arg_errno = 0  ) {
		parent::__construct("Database error",$arg_info);
		$this->databaseErrno = $arg_errno;
	}

	public function getDatabaseErrno() {
		return $this->databaseErrno;
	}
}

/**
 * Query exception class.
 */
class GonDatabaseQueryException extends GonException
{
	public function __construct( $arg_info=array()) {
		parent::__construct("Invalid database query",$arg_info);
	}
}

/**
 * Invalid argument exception class.
 */
class GonInvalidArgumentException extends GonException
{
	public function __construct( $arg_info=array() ) {
		parent::__construct("Invalid argument",$arg_info);
	}
}

/**
 * Operation failed exception class.
 */
 class GonOperationFailedException extends GonException
{
	public function __construct( $arg_info=array() ) {
		parent::__construct("Operation failed",$arg_info);
	}
}

?>