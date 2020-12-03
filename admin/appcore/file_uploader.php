<?php 

class Uploader
{
	private const MAX_UPLOAD_SIZE=1500000000;
	private $allowed_ext;
	private $target_dir;
	
	private $errors=array();
	
	function __construct()
	{
		
	}
	
	function uploadFile($file, $target_name)
	{				
		if(in_array(pathinfo($file['name'])['extension'], $this->allowed_ext)==1)
		{
			if ($file["size"] < $this::MAX_UPLOAD_SIZE )
			{
				if (move_uploaded_file($file["tmp_name"],($this->target_dir).$target_name))
				{
					return true;
				} 
				else 
				{
					$this->addError("File Upload Failed: Move method failed");
				}
			}
			else
			{
				$this->addError("Max Allowed File Size: ".($this::MAX_UPLOAD_SIZE/1000000)." MB");
			}
		}
		else
		{
			$this->addError("Invalid File Type");
		}
		
		return false;
	}
	
	function setUploadDir($dir)
	{
		$this->target_dir=$dir;
	}

	function setAllowedExt($extensions)
	{
		$this->allowed_ext=$extensions;
	}
	
	function addError($err)
	{
		array_push($this->errors,$err);
	}
}
?>