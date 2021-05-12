<?php 

// RossGoodliffe (2019) github.com. Northampton-News. [online] Available at: https:github.com/RossGoodliffe/Northampton-News/tree/master/public/images/banners [Accessed 25 March, 2021]

$files = [];
foreach (new DirectoryIterator('./') as $file) {
	if ($file->isDot()) {
		continue;
	}
	
	if (!strpos($file->getFileName(), '.jpg')) {
		continue;
	}

	$files[] = $file->getFileName();
}


header('Content-Type: image/jpeg');


$contents = load_file('./' . $files[rand(0,count($files)-1)]);
header('Content-Length: ' . strlen($contents));

echo $contents;


function load_file($name) {
	
	ob_start();
	include($name);
	$contents = ob_get_clean();
	
	return $contents;
}



