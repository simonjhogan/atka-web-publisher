<?php
	function rss($xml, $xsl, $count)
	{
		try {
			$xslDoc = new DOMDocument();
			$xslDoc->load($xsl);
			
			$xmlDoc = new DOMDocument();
			$xmlDoc->load($xml);
			
			$proc = new XSLTProcessor();
			$proc->importStylesheet($xslDoc);
			$proc->setParameter('', 'count', $count);
			
			echo $proc->transformToXML($xmlDoc);
		} catch (Exception $e) {
			echo "";
		}
	}
?>