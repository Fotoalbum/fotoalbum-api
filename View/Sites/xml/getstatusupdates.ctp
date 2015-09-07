<?php 
if (!isset($albums))
{
	$albums = array();
}
$xml = Xml::fromArray($albums);
echo $xml->asXML();

?>