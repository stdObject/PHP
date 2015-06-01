<?php
	class SafeSQL
	{
		private $lnk; // MySQLi object 
		public $errcode=0; // Error code
		public $error=''; // Error text
		private $con = true; // Connection status
		private $pref = ''; // Tables prefix
		
		// Creating connection 
		function __construct($host,$user,$pass,$base,$prefix = ''){
			$lnk = new mysqli($host,$user,$pass,$base);
			if ($this->errcode = $lnk->connect_errno()){
				$this->error = $lnk->connect_error();
				$this->con = false;
			}else{ 
				$this->lnk = $lnk;
				$this->pref = $prefix;
			}
		}
		
		// Change prefix to new one
		function prefix($prefix){
			$this->pref = $prefix;
		}
		
		// Close connection
		function __destruct(){ 
			$this->lnk->close();
		}
		
		// Parse query string and replace with placeholders
		function parse(){
			$args = func_get_args(); 
			if(!sizeof($args)){
				return false;
			}elseif(sizeof($args)==1){
				return $args[0];
			}else{
				return '';
			}
		}
	}