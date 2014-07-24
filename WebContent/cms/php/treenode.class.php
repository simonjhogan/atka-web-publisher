<?php
	class CmsTreeNode {
		public $data;
		public $children;
		public $state;
		public $attr;

		function __construct($label) {
			$this->data = $label;
			$this->children = array();
			$this->attr = array();
		}

		function addNode($label) {
			return $this->children[] = new CmsTreeNode($label);
		}
				
		function index($label) {
			$i = 0;
			foreach ($this->children as $n) {
				if ($n->data == $label) {
					return $i;
				}
				$i++;
			}
			return false;
		}		
	}
?>