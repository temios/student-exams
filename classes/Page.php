<?php
	class Page{
	
	function pageset($page1){
		if(isset($page1))$page = $page1;
		else $page = "students";
		$page = "pages/".$page.".php";
		return $page;
	}
	
	}