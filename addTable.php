<?php
include 'FileMaker.php';

	$fm = new FileMaker('jordan_streets.fmp12', '192.168.128.136', 'Admin', 'jordan_streets');
	$request = $fm->newFindAllCommand('jordan_locations'); 
	$result = $request->execute();
	$records = $result->getRecords();

	$super = [];
	
	foreach($records as $record){
		$super[$record->getField('id')] = ['name'=>$record->getField('name'),'blurb'=>$record->getField('blurb'),'hours'=>$record->getField('hours'),'phone'=>$record->getField('phone'), 'category'=>$record->getField('category'),]  ;
	}
	
	//write json to file 
	$file = fopen("location.json","w");
	fwrite($file,json_encode($super,JSON_UNESCAPED_UNICODE));
	fclose($file);  

	$fp = 'http://localhost:8888/jordan_streets/location.json';
	$sha1file = file_get_contents($fp);
	$test = file_get_contents("hash.txt");
	if ($test == sha1_file($fp)){
	  echo "The file is ok.";
	  }
	else
	  {
	  	 echo "The file has been changed.";
	  	 $sha1file = sha1_file($fp);
		 file_put_contents("hash.txt",$sha1file);
	  }
	echo sha1_file($fp);


	

?>
