<?php

/**
 * SQL query templates
 *
 * @author Peter Kullmann
 * @copyright 2007
 */

/*
 * Generic queries
 */


/**
 * Counts the number of rows in a table
 */

define (	'SQL_COUNT',
			"SELECT COUNT(*) ".
			"FROM {Table} WHERE Status=0");

/**
 * Inserts a new table row
 */

define (	'SQL_INSERT',
			"INSERT INTO {Table} ({columns}) VALUES ({values})");

/**
 * Updates a table row
 */

define (	'SQL_UPDATE',
			"UPDATE {Table} SET {values} WHERE {AttribId}='{Id}'");

/**
 * Deletes a table row
 */

define (	'SQL_DELETE',
			"DELETE FROM {Table} WHERE {AttribId}='{Id}'");

/**
 * Selects all records
 */

define (	'SQL_SELECT_ALL',
			"SELECT {columns} FROM {Table} WHERE Status=0");

/**
 * Selects maximum for a numeric column
 */

define (	'SQL_SELECT_MAX',
			"SELECT MAX({AttribId}) ".
			"FROM {Table}");

/**
 * Selects a record by its unique record id
 */

define (	'SQL_SELECT_FROM_ID',
			"SELECT {columns} FROM {Table} WHERE {AttribId}='{Id}'");
/**
 * Resets the nested set field Lft and Rgt of a table (cat or geo)
 */

define (	'SQL_SET_RESET',
			"UPDATE {Table} SET Lft=0,Rgt=0");
/**
 * Selects root entries in a hierarchical table (cat or geo)
 */

define (	'SQL_SET_SELECT_ROOT',
			"SELECT {Table}Id FROM {Table} WHERE ParentId IS NULL AND Status=0");

/**
 * Selects children entries in a hierarchical table (cat or geo)
 */

define (	'SQL_SET_SELECT_CHILDREN',
			"SELECT {Table}Id FROM {Table} WHERE ParentId='{ParentId}' AND Status=0");

/**
 * Selects the nested set information (Lft and Rgt) from a hierarchical table (cat or geo)
 */

define (	'SQL_SET_SELECT_FROM_ID',
			"SELECT Lft,Rgt FROM {Table} WHERE {Table}Id='{Id}'");

/**
 * Updates the nested set information (Lft and Rgt) in a hierarchical table (cat or geo)
 * for all ancestors after inserting a new entry
 */

define (	'SQL_SET_UPDATE_ANC',
			"UPDATE {Table} SET Rgt=Rgt+{Offset} WHERE Lft<={Left} AND Rgt>={Right}");

/**
 * Shifts the nested set information (Rgt) in a hierarchical table (cat or geo)
 */

define (	'SQL_SET_UPDATE_RGT',
			"UPDATE {Table} SET Lft=Lft+{Offset},Rgt=Rgt+{Offset} WHERE Lft>{Right}");

/**
 * Sets the nested set information (Lft and Rgt) in a hierarchical table (cat or geo)
 */

define (	'SQL_SET_UPDATE_SET',
			"UPDATE {Table} SET Lft={Left},Rgt={Right} WHERE {Table}Id='{Id}'");

/**
 * Updates the nested set information (Lft and Rgt) in a hierarchical table (cat or geo) when moving nodes
 */

define (	'SQL_SET_UPDATE_LFT_FOR_MOVE',
			"UPDATE {Table} SET Lft=Lft{Op}{Width} ".
			"WHERE Lft{Cmp}{Pos}");

define (	'SQL_SET_UPDATE_RGT_FOR_MOVE',
			"UPDATE {Table} SET Rgt=Rgt{Op}{Width} ".
			"WHERE Rgt{Cmp}{Pos}");

define (	'SQL_SET_UPDATE_LFTRGT_FOR_MOVE',
			"UPDATE {Table} SET Lft=Lft+{Distance},Rgt=Rgt+{Distance} ".
			"WHERE Lft>={TmpPos} ".
			"AND Rgt<{TmpPos}+{Width}");

/**
 * Tax
 */

/**
 * Select a record from its taxno
 */

define (	'SQL_SELECT_TAX_FROM_TAXNO',
			"SELECT {columns} FROM tax WHERE TaxNo={TaxNo} AND Status=0");

/**
 * Select a record from its cat reference
 */

define (	'SQL_SELECT_TAX_FROM_CATID',
			"SELECT {columns} FROM tax WHERE CatId='{CatId}' ".
			"AND Status=0");

/**
 * Selects the notes field from a tax id
 */

define (	'SQL_SELECT_NOTES_TAX_FROM_TAXID',
			"SELECT Notes FROM tax WHERE TaxId='{TaxId}'");

/**
 * Selects all records from an ancestor in the hierarchy
 */

define (	'SQL_SELECT_TAX_FROM_ANCESTORID',
			"SELECT {columns} ".
			"FROM tax a,cat c,cat b ".
			"WHERE c.CatId='{CatId}' ".
			"AND b.Lft BETWEEN c.Lft AND c.Rgt ".
			"AND b.Type={Type} ".
			"AND b.Status=0 ".
			"AND b.CatId=a.CatId ".
			"AND a.Status=0 ".
			"ORDER BY b.Name");

/**
 * Selects the qualifiers from a categorxy set
 */

define (	'SQL_SELECT_QUAL_FROM_CATSET',
			"SELECT CatId,Qualifier ".
			"FROM tax ".
			"WHERE CatId IN ({values})");

/**
 * Counts associated lit records
 */

define (	'SQL_COUNT_TAX_LIT',
			"SELECT COUNT(*) ".
			"FROM taxlit ".
			"WHERE TaxId='{TaxId}'");

/**
 * Counts associated loc records
 */

define (	'SQL_COUNT_TAX_LOC',
			"SELECT COUNT(*) ".
			"FROM taxloc ".
			"WHERE TaxId='{TaxId}'");

/**
 * Selects tax records associated with a lit id
 */

define(		'SQL_SELECT_TAX_FROM_LITID',
			"SELECT {columns} ".
			"FROM tax a,taxlit b ".
			"WHERE b.LitId='{LitId}' ".
			"AND b.TaxId=a.TaxId ".
			"AND a.Status=0");

/**
 * Selects tax records associated with a loc id
 */

define(		'SQL_SELECT_TAX_FROM_LOCID',
			"SELECT {columns} ".
			"FROM tax a,taxloc b ".
			"WHERE b.LocId='{LocId}' ".
			"AND b.TaxId=a.TaxId ".
			"AND a.Status=0");

/**
 * Selects tax records associated with a aut id
 */

define(		'SQL_SELECT_TAX_FROM_AUTID',
			"SELECT {columns} ".
			"FROM tax ".
			"WHERE AutId='{AutId}' ".
			"AND Status=0");

/**
 * Selects tax records associated with a bnd id
 */

define(		'SQL_SELECT_TAX_FROM_BNDID',
			"SELECT {columns} ".
			"FROM tax ".
			"WHERE (BndUpId='{BndId}' OR BndLoId='{BndId}') ".
			"AND Status=0");

/**
 * Selects tax records by taxon
 */

define(		'SQL_SELECT_TAX_FROM_TAXON',
			"SELECT {columns} ".
			"FROM tax a,cat b ".
			"WHERE a.CatId=b.CatId ".
			"AND b.Name LIKE '{Taxon}%' ".
			"AND a.Status=0 ".
			"ORDER BY b.Type,b.Name");

/**
 * Checks existence of a record link
 */

define (	'SQL_COUNT_TAX_LOC_FROM_TAXID_LOCID',
			"SELECT COUNT(*) ".
			"FROM taxloc ".
			"WHERE TaxId='{TaxId}' AND LocId='{LocId}'");

/**
 * Create a link
 */

define (	'SQL_CREATE_TAX_LOC_FROM_TAXID_LOCID',
			"INSERT INTO taxloc (TaxId,LocId) VALUES('{TaxId}','{LocId}')");

/**
 * Delete a link
 */

define (	'SQL_DELETE_TAX_LOC',
			"DELETE FROM taxloc ".
			"WHERE TaxId='{TaxId}' AND LocId='{LocId}'");

/**
 * Update the Notes field form a tax id
 */

define (	'SQL_UPDATE_NOTES_TAX_FROM_TAXID',
			"UPDATE tax SET Notes='{Notes}' WHERE TaxId='{TaxId}'");

/*
 * Cat
 */

/**
 * Selects children for a category
 */

define (	'SQL_SELECT_CAT_FROM_PARENTID',
			"SELECT {columns} ".
			"FROM cat ".
			"WHERE ParentId='{CatId}' ".
			"AND Status=0 ".
			"ORDER BY Type DESC,Name");

/**
 * Selects descendents for a category of a certain type
 */

define (	'SQL_SELECT_CAT_FROM_ANCESTORID',
			"SELECT {columns} ".
			"FROM cat a,cat b ".
			"WHERE a.CatId='{CatId}' ".
			"AND b.Lft BETWEEN a.Lft AND a.Rgt ".
			"AND b.Type={Type} ".
			"AND b.Status=0 ".
			"ORDER BY b.Name");

/**
 * Selects categories of a certain type and a given name prefix
 */

define (	'SQL_SELECT_CAT_FROM_NAMEANDTYPE',
			"SELECT {columns} ".
			"FROM cat ".
			"WHERE Name LIKE '{Name}%' ".
			"AND Type={Type} ".
			"AND Status=0 ".
			"ORDER BY Name");

/**
 * Selects descendents of a certain type of a categories with a given name prefix
 */

define (	'SQL_SELECT_CAT_SPC_FROM_NAMEANDTYPE',
			"SELECT {columns} ".
			"FROM cat a,cat b ".
			"WHERE a.Name LIKE '{Name}%' ".
			"AND a.Type={Type} ".
			"AND a.Status=0 ".
			"AND b.Lft BETWEEN a.Lft AND a.Rgt ".
			"AND b.Type=0 ".
			"AND b.Status=0 ".
			"ORDER BY b.Name");

/**
 * Selects descendents of a certain type  with a given name prefix of a categories with a given name prefix
 */

define (	'SQL_SELECT_CAT_FROM_NAMEANDTYPE_WITH_PARENT',
			"SELECT {columns} ".
			"FROM cat a,cat b ".
			"WHERE a.Name LIKE '{Name}%' ".
			"AND a.Type={Type} ".
			"AND a.Status=0 ".
			"AND b.Name LIKE '{ParentName}%' ".
			"AND b.Type={ParentType} ".
			"AND b.Status=0 ".
			"AND a.Lft BETWEEN b.Lft AND b.Rgt ".
			"ORDER BY a.Name");

/**
 * Selects species for descendents of a certain type with a given name prefix of a categories with a given name prefix
 */

define (	'SQL_SELECT_CAT_SPC_FROM_NAMEANDTYPE_WITH_PARENT',
			"SELECT {columns} ".
			"FROM cat a,cat b,cat c ".
			"WHERE a.Name LIKE '{Name}%' ".
			"AND a.Type={Type} ".
			"AND a.Status=0 ".
			"AND b.Name LIKE '{ParentName}%' ".
			"AND b.Type={ParentType} ".
			"AND b.Status=0 ".
			"AND a.Lft BETWEEN b.Lft AND b.Rgt ".
			"AND c.Lft BETWEEN a.Lft AND a.Rgt ".
			"AND c.Type=0 ".
			"AND c.Status=0 ".
			"ORDER BY c.Name");

/**
 * Selects all ancestors for a category, which constitute the path in the hierarchy
 */

define (	'SQL_SELECT_CAT_PATH_FROM_CATID',
			"SELECT {columns} ".
			"FROM cat a,cat b ".
			"WHERE a.CatId='{Id}' ".
			"AND a.Lft BETWEEN b.Lft AND b.Rgt ".
			"AND b.Type<={Type} ".
			"AND b.Status=0 ".
			"ORDER BY b.Lft");

/**
 * Selects pathes for species of a given ancestor category
 */

define (	'SQL_SELECT_CAT_PATHS_FROM_ANCESTORID',
			"SELECT {columns} ".
			"FROM cat a,cat b ".
			"WHERE a.CatId IN (".
				"SELECT d.CatId ".
				"FROM cat c,cat d ".
				"WHERE c.CatId='{CatId}' ".
				"AND d.Lft BETWEEN c.Lft AND c.Rgt ".
				"AND d.Type=0 AND d.Status=0) ".
			"AND a.Lft BETWEEN b.Lft AND b.Rgt ".
			"AND b.Type<={Type} ".
			"AND b.Status=0 ".
			"ORDER BY a.CatId,b.Lft");

/**
 * Selects pathes for set of categories
 */

define (	'SQL_SELECT_CAT_PATHS_FROM_CATSET',
			"SELECT {columns} ".
			"FROM cat a,cat b ".
			"WHERE a.CatId IN ({values}) ".
			"AND a.Lft BETWEEN b.Lft AND b.Rgt ".
			"AND b.Type<={Type} ".
			"AND b.Status=0 ".
			"ORDER BY a.CatId,b.Lft");

/**
 * Selects notes for a category
 */

define (	'SQL_SELECT_NOTES_CAT_FROM_CATID',
			"SELECT Notes FROM cat WHERE CatId='{CatId}'");

/**
 * Counts the children of a category
 */

define (	'SQL_COUNT_CAT_FROM_PARENTID',
			"SELECT COUNT(*) ".
			"FROM cat ".
			"WHERE ParentId='{CatId}' AND Status=0");

/**
 * Counts descendents of a given type of a category
 */

define (	'SQL_COUNT_CAT_FROM_ANCESTORID',
			"SELECT COUNT(*) ".
			"FROM cat a,cat b ".
			"WHERE a.CatId='{CatId}' ".
			"AND b.Lft BETWEEN a.Lft AND a.Rgt ".
			"AND b.Type={Type} ".
			"AND b.Status=0");

/**
 * Counts descendents of a given type with a given qualifier of a category
 */

define (	'SQL_COUNT_CAT_QUAL_FROM_ANCESTORID',
			"SELECT COUNT(*) ".
			"FROM cat a,cat b,tax c ".
			"WHERE a.CatId='{CatId}' ".
			"AND b.Lft BETWEEN a.Lft AND a.Rgt ".
			"AND b.Type={Type} ".
			"AND b.Status=0 ".
			"AND b.CatId=c.CatId ".
			"AND c.Status=0 ".
			"AND c.Qualifier IN ({values})");

/**
 * Selects the root entries in the hierarchy
 */

define (	'SQL_SELECT_CAT_ROOTS',
			"SELECT {columns} ".
			"FROM cat ".
			"WHERE ParentId IS NULL AND Status=0 ".
			"ORDER BY Type DESC,Name");

/**
 * Update the Notes field form a cat id
 */

define (	'SQL_UPDATE_NOTES_CAT_FROM_CATID',
			"UPDATE cat SET Notes='{Notes}' WHERE CatId='{CatId}'");


/*
 * Lit
 */

/**
 * Selects literature associated with a tax id
 */

define(		'SQL_SELECT_LIT_FROM_TAXID',
			"SELECT {columns} ".
			"FROM lit a,taxlit b,aut c ".
			"WHERE b.TaxId='{TaxId}' ".
			"AND b.LitId=a.LitId ".
			"AND a.Author1Id=c.AutId ".
			"AND c.Status=0 AND a.Status=0 ".
			"ORDER BY c.LastName,a.Year");

/**
 * Selects literature associated with a loc id
 */

define(		'SQL_SELECT_LIT_FROM_LOCID',
			"SELECT {columns} ".
			"FROM lit a,litloc b,aut c ".
			"WHERE b.LocId='{LocId}' ".
			"AND b.LitId=a.LitId ".
			"AND a.Author1Id=c.AutId ".
			"AND c.Status=0 AND a.Status=0 ".
			"ORDER BY c.LastName,a.Year");

/**
 * Selects literature associated with an aut id
 */

define(		'SQL_SELECT_LIT_FROM_AUTID',
			"SELECT {columns} ".
			"FROM lit a,aut b ".
			"WHERE (a.Author1Id='{AutId}' ".
			"OR a.Author2Id='{AutId}' ".
			"OR a.Author3Id='{AutId}') ".
			"AND a.Author1Id=b.AutId ".
			"AND a.Status=0 ".
			"AND b.Status=0 ".
			"ORDER BY b.LastName,a.Year");

/**
 * Selects a record for a litno
 */

define (	'SQL_SELECT_LIT_FROM_LITNO',
			"SELECT {columns} FROM lit WHERE LitNo={LitNo} AND Status=0");

/**
 * Selects a record for a partial author name
 */

define (	'SQL_SELECT_LIT_FROM_AUT',
			"SELECT {columns} ".
			"FROM lit a,aut b ".
			"WHERE b.LastName LIKE '{Author}%' ".
			"AND (a.Author1Id=b.AutId OR a.Author2Id=b.AutId OR a.Author3Id=b.AutId) ".
			"ORDER BY a.Year");

/**
 * Selects a record for a partial Title
 */

define (	'SQL_SELECT_LIT_FROM_TITLE',
			"SELECT {columns} ".
			"FROM lit ".
			"WHERE Title LIKE '%{Title}%' ".
			"ORDER BY Year");

/**
 * Selects a record for a partial Reference
 */

define (	'SQL_SELECT_LIT_FROM_REFERENCE',
			"SELECT {columns} ".
			"FROM lit ".
			"WHERE Reference LIKE '%{Reference}%' ".
			"ORDER BY Year");

/**
 * Selects the notes field for a lit id
 */

define (	'SQL_SELECT_NOTES_LIT_FROM_LITID',
			"SELECT Notes FROM lit WHERE LitId='{LitId}'");

/**
 * Update the Notes field form a loc id
 */

define (	'SQL_UPDATE_NOTES_LIT_FROM_LITID',
			"UPDATE lit SET Notes='{Notes}' WHERE LitId='{LitId}'");

/**
 * Counts the associated tax records
 */

define (	'SQL_COUNT_LIT_TAX',
			"SELECT COUNT(*) ".
			"FROM taxlit ".
			"WHERE LitId='{LitId}'");

/**
 * Counts the associated loc records
 */

define (	'SQL_COUNT_LIT_LOC',
			"SELECT COUNT(*) ".
			"FROM litloc ".
			"WHERE LitId='{LitId}'");

/**
 * Checks existence of a record link
 */

define (	'SQL_COUNT_LIT_LOC_FROM_LITID_LOCID',
			"SELECT COUNT(*) ".
			"FROM litloc ".
			"WHERE LitId='{LitId}' AND LocId='{LocId}'");

/**
 * Create a link
 */

define (	'SQL_CREATE_LIT_LOC_FROM_LITID_LOCID',
			"INSERT INTO litloc (LitId,LocId) VALUES('{LitId}','{LocId}')");

/**
 * Delete a link
 */

define (	'SQL_DELETE_LIT_LOC',
			"DELETE FROM litloc ".
			"WHERE LitId='{LitId}' AND LocId='{LocId}'");

/**
 * Checks existence of a record link
 */

define (	'SQL_COUNT_LIT_TAX_FROM_LITID_TAXID',
			"SELECT COUNT(*) ".
			"FROM taxlit ".
			"WHERE LitId='{LitId}' AND TaxId='{TaxId}'");

/**
 * Create a link
 */

define (	'SQL_CREATE_LIT_TAX_FROM_LITID_TAXID',
			"INSERT INTO taxlit (LitId,TaxId) VALUES('{LitId}','{TaxId}')");

/**
 * Delete a link
 */

define (	'SQL_DELETE_LIT_TAX',
			"DELETE FROM taxlit ".
			"WHERE LitId='{LitId}' AND TaxId='{TaxId}'");

/*
 * Loc
 */

/**
 * Selects localities associated with a tax id
 */

define(		'SQL_SELECT_LOC_FROM_TAXID',
			"SELECT {columns} ".
			"FROM loc a,taxloc b ".
			"WHERE b.TaxId='{TaxId}' ".
			"AND b.LocId=a.LocId ".
			"AND a.Status=0");


/**
 * Selects localities associated with a lit id
 */

define(		'SQL_SELECT_LOC_FROM_LITID',
			"SELECT {columns} ".
			"FROM loc a,litloc b ".
			"WHERE b.LitId='{LitId}' ".
			"AND b.LocId=a.LocId ".
			"AND a.Status=0");

/**
 * Selects localities associated with a bnd id
 */

define(		'SQL_SELECT_LOC_FROM_BNDID',
			"SELECT {columns} ".
			"FROM loc ".
			"WHERE (BndUpId='{BndId}' OR BndLoId='{BndId}') ".
			"AND Status=0");

/**
 * Selects a locality from a locno
 */

define (	'SQL_SELECT_LOC_FROM_LOCNO',
			"SELECT {columns} FROM loc WHERE LocNo={LocNo} AND Status=0");

/**
 * Selects loc records by locality name
 */

define(		'SQL_SELECT_LOC_FROM_LOCALITY',
			"SELECT {columns} ".
			"FROM loc a,geo b ".
			"WHERE a.GeoId=b.GeoId ".
			"AND b.Name LIKE '{Locality}%' ".
			"AND a.Status=0 ".
			"ORDER BY b.Type,b.Name");

/**
 * Selects the Notes field form a loc id
 */

define (	'SQL_SELECT_NOTES_LOC_FROM_LOCID',
			"SELECT Notes FROM loc WHERE LocId='{LocId}'");

/**
 * Selects a locality from  a geo reference
 */

define (	'SQL_SELECT_LOC_FROM_GEOID',
			"SELECT {columns} FROM loc ".
			"WHERE GeoId='{GeoId}' ".
			"AND Status=0");

/**
 * Counts tax records associated with a loc id
 */

define (	'SQL_COUNT_LOC_TAX',
			"SELECT COUNT(*) ".
			"FROM taxloc ".
			"WHERE LocId='{LocId}'");

/**
 * Counts tax records associated with a lit id
 */

define (	'SQL_COUNT_LOC_LIT',
			"SELECT COUNT(*) ".
			"FROM litloc ".
			"WHERE LocId='{LocId}'");

/**
 * Update the Notes field form a loc id
 */

define (	'SQL_UPDATE_NOTES_LOC_FROM_LOCID',
			"UPDATE loc SET Notes='{Notes}' WHERE LocId='{LocId}'");

/*
 * Geo
 */

/**
 * Selects children of a geo id
 */

define (	'SQL_SELECT_GEO_FROM_PARENTID',
			"SELECT {columns} ".
			"FROM geo ".
			"WHERE ParentId='{GeoId}' ".
			"AND Status=0 ".
			"ORDER BY Type DESC,Name");

/**
 * Selects pathes for geos of a given ancestor geo
 */

define (	'SQL_SELECT_GEO_PATHS_FROM_ANCESTORID',
			"SELECT {columns} ".
			"FROM geo a,geo b ".
			"WHERE a.GeoId IN (".
				"SELECT d.GeoId ".
				"FROM geo c,geo d ".
				"WHERE c.GeoId='{GeoId}' ".
				"AND d.Lft BETWEEN c.Lft AND c.Rgt ".
				"AND d.Type=0 AND d.Status=0) ".
			"AND a.Lft BETWEEN b.Lft AND b.Rgt ".
			"AND b.Type<={Type} ".
			"AND b.Status=0 ".
			"ORDER BY a.GeoId,b.Lft");

/**
 * Selects regions of a given type from a name prefix
 */

define (	'SQL_SELECT_GEO_FROM_NAMEANDTYPE',
			"SELECT {columns} ".
			"FROM geo ".
			"WHERE Name LIKE '{Name}%' ".
			"AND Type={Type} ".
			"AND Status=0 ".
			"ORDER BY Name");

/**
 * Selects layers for regions of a given type from a name prefix
 */

define (	'SQL_SELECT_GEO_LAY_FROM_NAMEANDTYPE',
			"SELECT {columns} ".
			"FROM geo a,geo b ".
			"WHERE a.Name LIKE '{Name}%' ".
			"AND a.Type={Type} ".
			"AND a.Status=0 ".
			"AND b.Lft BETWEEN a.Lft AND a.Rgt ".
			"AND b.Type=0 ".
			"AND b.Status=0 ".
			"ORDER BY b.Name");

/**
 * Selects regions of a given type and a name prefix of ancestors with a given name prefix
 */

define (	'SQL_SELECT_GEO_FROM_NAMEANDTYPE_WITH_PARENT',
			"SELECT {columns} ".
			"FROM geo a,geo b ".
			"WHERE a.Name LIKE '{Name}%' ".
			"AND a.Type={Type} ".
			"AND a.Status=0 ".
			"AND b.Name LIKE '{ParentName}%' ".
			"AND b.Type={ParentType} ".
			"AND b.Status=0 ".
			"AND a.Lft BETWEEN b.Lft AND b.Rgt ".
			"ORDER BY a.Name");

/**
 * Selects layers for regions of a given type and a name prefix of ancestors with a given name prefix
 */

define (	'SQL_SELECT_GEO_LAY_FROM_NAMEANDTYPE_WITH_PARENT',
			"SELECT {columns} ".
			"FROM geo a,geo b,geo c ".
			"WHERE a.Name LIKE '{Name}%' ".
			"AND a.Type={Type} ".
			"AND a.Status=0 ".
			"AND b.Name LIKE '{ParentName}%' ".
			"AND b.Type={ParentType} ".
			"AND b.Status=0 ".
			"AND a.Lft BETWEEN b.Lft AND b.Rgt ".
			"AND c.Lft BETWEEN a.Lft AND a.Rgt ".
			"AND c.Type=0 ".
			"AND c.Status=0 ".
			"ORDER BY c.Name");

/**
 * Selects ancestors for a region, which constitute the path in the hierarchy
 */

define (	'SQL_SELECT_GEO_PATH_FROM_GEOID',
			"SELECT {columns} ".
			"FROM geo a,geo b ".
			"WHERE a.GeoId='{Id}' ".
			"AND a.Lft BETWEEN b.Lft AND b.Rgt ".
			"AND b.Type<={Type} ".
			"AND b.Status=0 ".
			"ORDER BY b.Lft");

/**
 * Counts children of a region
 */

define(		'SQL_COUNT_GEO_SUB',
			"SELECT COUNT(*) ".
			"FROM geo ".
			"WHERE ParentId='{GeoId}' AND Status=0");

/**
 * Counts descendents for a geo of a certain type
 */

define (	'SQL_COUNT_GEO_FROM_ANCESTORID',
			"SELECT COUNT(*) ".
			"FROM geo a,geo b ".
			"WHERE a.GeoId='{GeoId}' ".
			"AND b.Lft BETWEEN a.Lft AND a.Rgt ".
			"AND b.Type={Type} ".
			"AND b.Status=0");


/**
 * Selects the Notes field for a region
 */

define (	'SQL_SELECT_NOTES_GEO_FROM_GEOID',
			"SELECT Notes FROM geo WHERE GeoId='{GeoId}'");


/**
 * Update the Notes field form a geo id
 */

define (	'SQL_UPDATE_NOTES_GEO_FROM_GEOID',
			"UPDATE geo SET Notes='{Notes}' WHERE GeoId='{GeoId}'");


/**
 * Selects the root entries in the hierarchy
 */

define (	'SQL_SELECT_GEO_ROOTS',
			"SELECT {columns} ".
			"FROM geo ".
			"WHERE ParentId IS NULL AND Status=0 ".
			"ORDER BY Type DESC,Name");

/*
 * Bnd
 */

/**
 * Select boundaries from a year prefix
 */

define (	'SQL_SELECT_BND_ALL',
			"SELECT {columns} ".
			"FROM bnd ".
			"WHERE Status=0 ".
			"ORDER BY MillYears,Name");

/**
 * Select boundaries from a year prefix
 */

define (	'SQL_SELECT_BND_FROM_YEARS',
			"SELECT {columns} ".
			"FROM bnd ".
			"WHERE CAST(MillYears AS CHAR) LIKE '{MillYears}%' ".
			"AND MillYears<{LoBound} ".
			"AND Status=0 ".
			"ORDER BY MillYears,Name");
/**
 * Select boundaries from a year prefix
 */

define (	'SQL_SELECT_BND_FROM_NAME',
			"SELECT {columns} ".
			"FROM bnd ".
			"WHERE Name LIKE '%{Name}%' ".
			"AND MillYears<{LoBound} ".
			"AND Status=0 ".
			"ORDER BY MillYears, Name");

/**
 * Counts taxa for a specific locality
 */

define (	'SQL_COUNT_BND_LOC',
			"SELECT COUNT(*) ".
			"FROM loc ".
			"WHERE (BndLoId='{BndId}' OR BndUpId='{BndId}') ".
			"AND Status=0");

/**
 * Counts taxa for a specific boundary
 */

define (	'SQL_COUNT_BND_TAX',
			"SELECT COUNT(*) ".
			"FROM tax ".
			"WHERE (BndLoId='{BndId}' OR BndUpId='{BndId}') ".
			"AND Status=0");

/*
 * Aut
 */

/**
 * Selects authors for a name prefix
 */

define (	'SQL_SELECT_AUT_ALL',
			"SELECT {columns} ".
			"FROM aut ".
			"WHERE Status=0 ".
			"ORDER BY LastName,FirstName");

/**
 * Selects authors for a name prefix
 */

define (	'SQL_SELECT_AUT_FROM_NAME',
			"SELECT {columns} ".
			"FROM aut ".
			"WHERE LastName LIKE '{Name}%' ".
			"AND LastName NOT LIKE '%\_%' ".
			"AND Status=0 ".
			"ORDER BY LastName,FirstName");

/**
 * Selects authors for a name prefix
 */

define (	'SQL_SELECT_AUT_FROM_NAME_ALL',
			"SELECT {columns} ".
			"FROM aut ".
			"WHERE (LastName LIKE '{Name}%' ".
			"OR LastName LIKE '%\_{Name}%') ".
			"AND Status=0 ".
			"ORDER BY LastName,FirstName");

/**
 * Counts literature for a specific author
 */

define (	'SQL_COUNT_AUT_LIT',
			"SELECT COUNT(*) ".
			"FROM lit ".
			"WHERE (Author1Id='{AutId}' ".
			"OR Author2Id='{AutId}' ".
			"OR Author3Id='{AutId}') ".
			"AND Status=0");

/**
 * Counts taxa for a specific author
 */

define (	'SQL_COUNT_AUT_TAX',
			"SELECT COUNT(*) ".
			"FROM tax ".
			"WHERE AutId='{AutId}' ".
			"AND Status=0");

/**
 * Selects the notes field for a aut id
 */

define (	'SQL_SELECT_NOTES_AUT_FROM_AUTID',
			"SELECT Notes FROM aut WHERE AutId='{AutId}'");

/**
 * Update the Notes field form a aut id
 */

define (	'SQL_UPDATE_NOTES_AUT_FROM_AUTID',
			"UPDATE aut SET Notes='{Notes}' WHERE AutId='{AutId}'");


/*
 * Acc
 */

/**
 * Selects accounts for a user name
 */

define (	'SQL_SELECT_ACC_FROM_USER',
			"SELECT {columns} ".
			"FROM account ".
			"WHERE User='{User}' AND Status=0");

/**
 * Selects all accounts sorted by user name
 */

define (	'SQL_SELECT_ACC_ALL',
			"SELECT {columns} ".
			"FROM account ".
			"ORDER BY User");

/*
 * Log
 */

/**
 * Selects log entries
 */

define (	'SQL_SELECT_LOG_ALL',
			"SELECT {columns} ".
			"FROM log ".
			"ORDER BY Timestamp DESC ".
			"LIMIT {limit}");

/**
 * Selects the Notes field for a region
 */

define (	'SQL_SELECT_NOTES_LOG_FROM_LOGID',
			"SELECT Notes FROM log WHERE LogId='{LogId}'");

/**
 * Update the Notes field form a log id
 */

define (	'SQL_UPDATE_NOTES_LOG_FROM_LOGID',
			"UPDATE log SET Notes='{Notes}' WHERE LogId='{LogId}'");

/**
 * Selects log entries from a record id
 */

define (	'SQL_SELECT_LOG_FROM_RECORDID',
			"SELECT {columns} ".
			"FROM log ".
			"WHERE RecordId='{RecordId}' OR ".
			"OtherId='{RecordId}' ".
			"ORDER BY Timestamp DESC");

/**
 * Selects log entries from a record id
 */
 
define (	'SQL_UPDATE_LOG_FROM_RECID_FIG',
			"UPDATE log SET OtherId='{Archive}',OtherClass='Arc' ".
			"WHERE RecordId='{RecordId}' ".
			"AND Type=30 ".
			"AND OtherId='{Fig}'");

/**
 * Count references to a figure
 */

define (	'SQL_LOG_COUNT_REF_FROM_FIG',
			"SELECT COUNT(*) FROM log ".
			"WHERE Type=30 OR Type=31 ".
			"AND OtherId='{Fig}' ".
			"AND OtherClass='Arc'");

/**
 * Fetch morphology record for a tax id
 */

define (	'SQL_SELECT_MORPH_FROM_TAXID',
			"SELECT {columns} ".
			"FROM {Table} ".
			"WHERE TaxId='{TaxId}' ".
			"AND Status=0");