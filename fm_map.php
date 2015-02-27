<?php 
	//MAP
	include 'FileMaker.php';
	$fm = new FileMaker('jordan_streets.fmp12', '192.168.128.136', 'Admin', 'jordan_streets');
	$request = $fm->newFindAllCommand('jordan_locations'); 
	$result = $request->execute();
	$records = $result->getRecords();
	$co = [];
	$count = 0;
	foreach($records as $record){
			$co[$count] = ['lat'=>$record->getField('lat'),'long'=>$record->getField('long'),'addr'=>$record->getField('address1')];
			$count++;
	}
	$co = array_map("unserialize", array_unique(array_map("serialize", $co)));
	echo json_encode($co);
?>