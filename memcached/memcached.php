<?php
$mem = new Memcache;
$mem->connect("127.0.0.1", 11211);
//$mem->set('key', 'This is a test!\r\n', 0, 60);
//$content='Thisi';
$content='';
for($i=0;$i<100;$i++){
	$content.='Thisi';
	print 'NO:'.$i.',size:'.strlen($content).'  ';
	
	$mem->set('key'.$i, $content.$i, 0, 60);
	//$mem->get('key'.$i);
}
//$val = $mem->get('key');
//echo $val;
?>