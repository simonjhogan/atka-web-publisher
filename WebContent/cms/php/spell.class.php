<?php
	class CmsSpell
	{
		private $currentDirectory;
		public $user;	
					
		function __construct($currentDirectory) 
		{
			$this->currentDirectory = $currentDirectory;		
		}
		
		function Check($words)
		{
			$pspell = pspell_new(CMS_SPELL_LANGUAGE, "", "", "", PSPELL_FAST);
			$return = array();
			
			$words = str_replace(">", "> ", $words);
			$words = strip_tags($words);
			$words = preg_replace("/([^\'\w\s]|\d)/", " ", $words);
			$wordList = explode(" ", $words);
			$wordList = array_unique($wordList);
			$wordList = array_filter($wordList);
			
			foreach($wordList as $word) {
				if (!pspell_check($pspell, $word)) {
				    $return[] = new CmsSpellSuggestion($word, pspell_suggest($pspell, $word));
				}
			}
			
			return $return; 
		}
		
		function AddWord($word)
		{
		
		}
	}

	class CmsSpellSuggestion
	{
		function __construct($word, $suggestions) 
		{
			$this->word = $word;
			$this->suggestions = $suggestions;	
		}
	
		public $word;
		public $suggestions;
	}
?>