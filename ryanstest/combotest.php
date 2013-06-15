<?php
$xml_file = 'selectexample.xml';

$xsl_file = 'mainstyle.xsl';

$doc = new DOMDocument();
$xsl = new XSLTProcessor();

$doc->load($xsl_file);
$xsl->importStyleSheet($doc);

$doc->load($xml_file);
echo $xsl->transformToXML($doc);
?>
