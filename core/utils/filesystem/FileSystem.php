<?php

class FileSystem
{
	public static function move($src, $dst, $override=false)
	{						
		$preamble = 'Unable to move file from '.$src.' to '.$dst.': ';
		if(!is_file($src))
		{
			throw new Exception($preamble.$src.' does not exist');
		}
		
		if(is_file($dst))
		{
			// Do not override
			if(!$override)
			{
				throw new Exception($preamble.'destination file '.$dst.' exists and override is not allowed');
			}
			
			if((fileperms($dst) & 0777) != 0777)
			{
				if(!chmod($dst, 0777))
				{
					throw new Exception($preamble.'unable to change permissions of file '.$dst);
				}
			}
			
			if(!unlink($dst))
			{
				throw new Exception($preamble.'unable to unlink file '.$dst);
			}
		}
		if(!rename($src, $dst))
		{
			throw new Exception($preamble.'unable to rename file from '.$src.' to '.$dst);
		}
	}
	
	/* Remove a file. If this file is a directory, and $recursive flag is set to false, this directory should be empty to get deleted */
	public static function remove($src, $recursive=false)
	{						
		if(!file_exists($src))
		{
			throw new Exception($src.' does not exist');
		}
			
		if(!is_dir($src))
		{
			/* Case of a single file */
			if(!unlink($src))
			{
				throw new Exception('Unable to unlink file '.$src);
			}
		}
		else
		{
			/* Case of a repository */
			$objects = scandir($src);
			if(count($objects) <= 2)
			{
				/* Empty directory (excluded . and ..) */
				if(!rmdir($src))
				{
					throw new Exception('Unable to remove directory '.$src);
				}
			}
			else
			{
				/* Non empty directory (excluded . and ..) */
				if(!$recursive)
				{
					throw new Exception('Trying to remove a non-empty directory : '.$src);
				}
				else
				{
					foreach($objects as $object)
					{
						if(($object != ".") && ($object != "..")) 
						{
							FileSystem::remove($src."/".$object, true);
						}
					}
					FileSystem::remove($src);
				}				
			}
		}		
	}
}
?>
