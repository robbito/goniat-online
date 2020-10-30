<?php

/**
 * Tracing class.
 */
class Trace
{
	/**
	 * The one and only instance.
	 */
	protected static $trace = '';

	/**
	 * Adds a message to the trace. A time stamp is automatically added.
	 */
 	static public function add($arg_msg)
 	{
 		if (ENABLE_TRACE) {
			self::$trace .= "\n[".date(PLIFF_FMTDATETIME)."] ".$arg_msg;
 		}
	}

	/**
	 * Sends the current trace to the admin.
	 */
	static public function send()
	{
		if (ENABLE_TRACE) {
			if (ENABLE_MAIL) {
				mail(ADMIN_MAILTO,"GONIAT Trace",self::$trace);
			}
			self::$trace = '';
		}
	}

	/**
	 * Appends the current trace to a trace file.
	 */
	static public function save($arg_file)
	{
		if (ENABLE_TRACE) {
			file_put_contents($arg_file,"\n--(".date(DEFAULT_FMTDATETIME).")---------------------------------------------------".self::$trace, FILE_APPEND + FILE_USE_INCLUDE_PATH);
			self::$trace = '';
		}
	}

	/**
	 * Returns the trace object.
	 */
	static public function getTrace()
	{
		return self::$trace;
	}
}

?>