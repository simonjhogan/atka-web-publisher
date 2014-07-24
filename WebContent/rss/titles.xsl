<?xml version="1.0" encoding="utf-8" ?>

<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
<xsl:output method="html" omit-xml-declaration="yes" indent="yes"/>
<xsl:param name="count" select="5"/>

<xsl:template match="/">
	<ul class="rss">
		<xsl:for-each select="/rss/channel/item[position() &lt; $count]">
			<li><a target="_new" href="{link}"><xsl:value-of select="title"/></a></li>
		</xsl:for-each>
	</ul>
	<p class="rss-update">Updated: <xsl:value-of select="//lastBuildDate"/></p>
</xsl:template>

</xsl:stylesheet>