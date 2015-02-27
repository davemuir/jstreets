<?php 

include 'FileMaker.php';
$fm = new FileMaker("jordan_streets.fmp12","192.168.128.136","Admin","jordan_streets");
$rec = $fm->newFindAllCommand("jordan_beacons");
$result = $rec->execute();
$records = $result->getRecords();
$data = [];
$count = 0;
foreach($records as $record){
	$data[$count]["beaconUUID"] = $record->getField('uuid');
	$data[$count]["beaconMajor"] = $record->getField('major');
	$data[$count]["beaconMinor"] = $record->getField('minor');
	$data[$count]["name"] = $record->getField('jordan_locations::name');
	$data[$count]["locationID"] = $record->getField('location_fk');
	$count++;
}
//$data = array_values(array_unique($data));
echo json_encode($data);

?>
