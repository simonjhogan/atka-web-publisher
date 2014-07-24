<?php
/**
ATKA Web Publisher

Copyright 2014 Simon J. Hogan (Sith'ari Consulting)

Licensed under the Apache License, Version 2.0 (the "License"); you may not use this 
file except in compliance with the License. You may obtain a copy of the License at

http://www.apache.org/licenses/LICENSE-2.0

Unless required by applicable law or agreed to in writing, software distributed under 
the License is distributed on an "AS IS" BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, 
either express or implied. See the License for the specific language governing permissions 
and limitations under the License.
**/

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