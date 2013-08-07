<?php
	class upload{
		var $file;
		var $name ='';
		var $type;
		var $folder;
		var $allowed=array();
		function set_name($n){
			$temp=explode('.' , $this -> file['name']);
			$this -> type = $temp[count($temp) -1];
			if($n == 'orgin'){
				$this -> name = $this -> file['name'];
			}
			else if($n == 'random'){
				$this -> name = encrypt::md5(microtime()) . '.' . $this -> type;
			}
			return $this -> name;
		}
		function save(){
			$path='';
			if($this -> file['error'] == 0 
					&& is_uploaded_file( $this -> file['tmp_name'])
					&& in_array($this -> type , $this->allowed)){				
					$path= $this -> folder != '' ? VIEW . DS . 'upload' . DS . $this->folder. DS .$this -> name :
											VIEW . DS . 'upload' . DS . $this -> name; 
			}
			if(file_existst ($path){
				if (move_uploaded_file($this -> file['tmp_name'], $path)){
					return $path;
				}
			}
			return false; 
		}
	}
?>
