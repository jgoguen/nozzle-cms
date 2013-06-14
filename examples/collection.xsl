<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
	
<xsl:param name="owner" select="'PHPRO.ORG'"/>
<xsl:output method="html" encoding="iso-8859-1" indent="yes" />
<xsl:template match="collection">
	<xsl:text disable-output-escaping='yes'>&lt;!DOCTYPE html></xsl:text>	
	<html>
	<head>
		<title><xsl:value-of select="$owner"/> book store</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	</head>
	<body>
		<h1><xsl:value-of select="$owner"/> book store</h1>
		<xsl:apply-templates/>
	</body>
	</html>
</xsl:template>

<xsl:template match="book">
	<h3><xsl:value-of select="title"/></h3>
	<h4>by <xsl:value-of select="author"/> - <xsl:value-of select="isbn"/></h4>
	<hr />
</xsl:template>
</xsl:stylesheet>