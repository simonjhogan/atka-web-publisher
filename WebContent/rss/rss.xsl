<?xml version="1.0" encoding="utf-8" ?>

<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
<xsl:output method="html" omit-xml-declaration="yes" indent="yes"/>
<xsl:param name="count" select="5"/>

<xsl:template match="/">
	<dl class="rss">
		<xsl:for-each select="/rss/channel/item[position() &lt; $count]">
			<dt><a target="_new" href="{link}"><xsl:value-of select="title"/></a></dt>
			<dd><xsl:value-of disable-output-escaping="yes" select="description"/></dd>
		</xsl:for-each>
	</dl>
</xsl:template>

</xsl:stylesheet>