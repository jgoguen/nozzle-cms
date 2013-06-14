<?php

$xml_file = 'collection.xml';

$xsl_file = 'collection.xsl';

$doc = new DOMDocument();
$xsl = new XSLTProcessor();

$doc->load($xsl_file);
$xsl->importStyleSheet($doc);

$doc->load($xml_file);
echo $xsl->transformToXML($doc);

?>