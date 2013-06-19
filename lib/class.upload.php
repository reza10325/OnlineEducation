<?php
	class upload{
		var $file;
		var $name;
		var $file_name; // part a of $_FILES[a][b]
		var $submit_name;
		var $folder;
		var $allowed=array();
		function save(){
			if(isset($_POST[$this->submit_name])){
				if($this->name== 'orgin'){
					$name=$_FILES[$file_name]['name'];
				}
				else if($this->name =='random'){
					$name=$_FILES[$file_name]['tmp_name'];
				}
				$k=$this->file_name;
				if($_FILES[$k]['error']==0 && is_uploaded_file( $_FILES[$k]['tmp_name'])
						&& in_array($_FILES[$k]['type'], $this->allowed)){
					if($this->folder != ''){
						$path=VIEW . DS . 'upload' . DS . $this->folder; 
						if(!is_dir($path)){
							mkdir($path , 777);
						}						
						$path=VIEW . DS . 'upload' . DS . $this->folder. DS .$_FILES[$k]['name'];
					}
					else{
						$path=VIEW . DS . 'upload' . DS .$_FILES[$k]['name'];
					}
					move_uploaded_file($_FILES[$k]['tmp_name'], $path);
					return $path;
				}
				
			}
		}
	}
?>
