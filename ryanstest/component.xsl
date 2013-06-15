<?xml version="1.0" encoding="UTF-8"?>

<!--
	Document   : component.xsl
	Created on : June 15, 2013, 3:49 PM
	Author     : nightfyr
	Description:
		Purpose of transformation follows.
-->

<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0">
	<xsl:output method="html"/>

	<!-- TODO customize transformation rules 
		 syntax recommendation http://www.w3.org/TR/xslt 
	-->
	<xsl:template match="nozzle-component">
		<xsl:param name="nozzle-id" select="nozzle-component-id" />
		<xsl:param name="nozzle-type" select="nozzle-component-type" />
		<xsl:param name="nozzle-text" select="nozzle-component-text" />
		<xsl:if test="$nozzle-type = 'select'">
			<select id="{$nozzle-id}">
				<xsl:for-each select="option">
					<xsl:variable name="option-value" select="value"/>
					<option value="{$option-value}"><xsl:value-of select="text"/></option>
				</xsl:for-each>
			</select>
		</xsl:if>
		<xsl:if test="$nozzle-type = 'button'">
			<input id="{$nozzle-id}" type="button" value="{$nozzle-text}" />
		</xsl:if>
	</xsl:template>

</xsl:stylesheet>
