<?php

require 'inc/gon.inc.php5';

try {
	Page::init(false);
	if (!Page::isEditor())
		throw new GonOperationFailedException;
	
	$urls = array();
	$uploadId = Page::postString('liteUploader_id');
	$locId = Page::postString('LocId');

	if (!Record::isIdValid($locId))
		throw New GonInvalidArgumentException;

	$loc = Loc::loadFromLocId($locId);

	if (!isset($loc))
		Page::error('Specified LocId does not exist');
	
	if ($uploadId == 'upload') {
		
		foreach ($_FILES[$uploadId]['error'] as $key => $error) {
			if ($error == UPLOAD_ERR_OK) {
				$ext = pathinfo($_FILES[$uploadId]['name'][$key], PATHINFO_EXTENSION);
				$fileName = Loc::getFigName($loc->LocNo).'.'.$ext;
				$uploadedUrl = 'fig/'.$fileName;
				move_uploaded_file( $_FILES[$uploadId]['tmp_name'][$key], $uploadedUrl);
				$urls[] = $uploadedUrl;
				Log::logImageAdd($locId, "Loc", $fileName);
			}
		}

		$message = 'Successfully Uploaded Image(s)';
		
	}
	echo json_encode(
		array(
			'message' => $message,
			'urls' => $urls,
		)
	);	
}
catch (GonException $e) {
	HandleException($e,'uploadLocFig');
}
?>
