<?php
	$dir = getcwd().'/';
	
	if (file_exists($dir.'cache.xml')) {
	    $xml = simplexml_load_file($dir.'cache.xml');
 		foreach ($xml->channel->item as $item) {
   			$rss = file_get_contents($item->link);
   			echo $item->filename;
   			echo " [".file_put_contents($dir.$item->filename, $rss)."]\n";
		}
} else {
    exit('Failed to open cache.xml.');
}
?>
