<?php

/**
 * NestedSetBuilder
 *
 * @version $Id$
 * @copyright 2007
 */

require 'inc/gon.inc.php5';

function resetSet($arg_table)
{
		$db = Database::getDatabase();
		$db->Query(	SQL_SET_RESET, array('Table' => $arg_table ));
}

function fetchChildren($arg_table,$arg_parentId)
{
		$children = array();
		$db = Database::getDatabase();
		$result = null;

		if (is_null($arg_parentId)) {
			$result = $db->Query(	SQL_SET_SELECT_ROOT,
									array(	'Table' => $arg_table ));
		}
		else {
			$result = $db->Query(	SQL_SET_SELECT_CHILDREN,
									array(	'Table' => $arg_table,
											'ParentId' => $arg_parentId ));
		}

		for ($i = 0; $i < $result->num_rows; $i++) {
			$row = $result->fetch_row();
			$children[] = $row[0];
		}

		return $children;
}

function insertChildren($arg_table,$arg_parentId,$arg_children)
{
	$left = 0;
	$right = 1;
	$db = Database::getDatabase();

	if (!is_null($arg_parentId)) {
		$result = $db->Query(	SQL_SET_SELECT_FROM_ID,
								array(	'Table' => $arg_table,
										'Id' => $arg_parentId ));
		if ($result->num_rows) {
			$row = $result->fetch_row();
			$left = $row[0];
			$right = $row[1];
		}
	}

	$offset = count($arg_children) * 2;

	$result = $db->Query(	SQL_SET_UPDATE_RGT,
							array(	'Table' => $arg_table,
									'Offset' => $offset,
									'Right' => $right ));

	if (!is_null($arg_parentId)) {
		$db->Query(	SQL_SET_UPDATE_ANC,
							array(	'Table' => $arg_table,
									'Offset' => $offset,
									'Left' => $left,
									'Right' => $right ));
	}

	$left += 1;
	foreach ($arg_children as $child) {
		$db->Query(	SQL_SET_UPDATE_SET,
							array(	'Table' => $arg_table,
									'Left' => $left,
									'Right' => $left + 1,
									'Id' => $child ));
		$left += 2;
	}
}

function buildNestedSet($arg_table)
{
	$recQueue = array(null);

	resetSet($arg_table);
	$i = 1;
	$count = Cat::getRecordCount();

	while (count($recQueue) && $i <= $count + 1) {
		// fetch children
		$id = array_shift($recQueue);

		echo $i.": id: ".$id."\n";

		$children = fetchChildren($arg_table,$id);

		if (count($children)) {
			// insert chilren
			insertChildren($arg_table,$id,$children);
			// add to queue
			foreach ($children as $child)
				$recQueue[] = $child;

			echo "Added ".count($children)." records\n";
		}

		$i++;
	} // while
}

try {
/*	echo "Started building CAT";
	buildNestedSet('Cat');
	echo "Finished building CAT";
	echo "Started building GEO";
	buildNestedSet('Geo');
	echo "Finished building GEO"; */
}
catch (GonException $e) {
	echo $e->getCompleteMessage();
}


?>