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
					$this->name=$_FILES[$this->file_name]['name'];
				}
				else if($this->name =='random' || $this->name==''){
					$temp=explode('.' , $_FILES[$this->file_name]['name']);
					$type=$temp[sizeof($temp) -1];
					$rnd_name=substr(md5(rand(0,999)) , 15 , 6);
					$this->name=$rnd_name . '.' . $type;
				}
				if($_FILES[$this->file_name]['error']==0 
						&& is_uploaded_file( $_FILES[$this->file_name]['tmp_name'])
						&& in_array($_FILES[$this->file_name]['type'], $this->allowed)){
					if($this->folder != ''){
						$path=VIEW . DS . 'upload' . DS . $this->folder; 
						if(!is_dir($path)){
							mkdir($path , 777);
						}						
						$path=VIEW . DS . 'upload' . DS . $this->folder. DS .$this->name;
					}
					else{
						$path=VIEW . DS . 'upload' . DS .$this->name;
					}
					move_uploaded_file($_FILES[$this->file_name]['tmp_name'], $path);
					return $path;
				}
				
			}
		}
	}
?>
