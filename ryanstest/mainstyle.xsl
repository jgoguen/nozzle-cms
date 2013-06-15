<?xml version="1.0" encoding="UTF-8"?>

<!--
	Document   : mainstyle.xsl
	Created on : June 15, 2013, 1:48 PM
	Author     : nightfyr
	Description:
		Purpose of transformation follows.
-->

<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0">
	<xsl:include href="component.xsl"/>
	<xsl:output method="html" encoding="iso-8859-1" indent="yes" />
	<!-- TODO customize transformation rules 
		 syntax recommendation http://www.w3.org/TR/xslt 
	-->
	<xsl:template match="/">
	<xsl:text disable-output-escaping='yes'>&lt;!DOCTYPE html></xsl:text>	
		<html>
			<head>
				<title>mainstyle.xsl</title>
			</head>
			<body>
				<xsl:apply-templates/>
			</body>
		</html>
	</xsl:template>
</xsl:stylesheet>
