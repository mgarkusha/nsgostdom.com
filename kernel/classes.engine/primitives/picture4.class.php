<?php if (!defined('SCRIPTACCESS')) exit;
class picture4
{
	// required
	var $name;
	var $path;
	// optional
  	var $BigMaxWidth		= 400;
	var $BigMaxHeight		= 375;
  	var $SmallMaxWidth		= 244;
	var $SmallMaxHeight		= 85;
	var $previewSide		= 85;
	var $previewLongSide	= 120;
	var $previewShortSide	= 90;
	//
	var $inner;
	var $size			= 64;
	var $max_size		= 2000000;
	var $display_pic	= true;
	var $rule	= array
	(
		'size0'	=> 'Ошибка! Размер файла загруженного изображения 0 байт.',
		'size'	=> 'Размер файла изображения не должен превышать 2 мб.',
		'ext'	=> 'Расширение файла изображения должно быть jpg, png или gif'
	);
	
	var $error			= 'none';
	var $MySQLType		= 'VARCHAR(255)';
	//
	function work ()
	{
		global $_FILES;
		
		if (empty ($this->rule))
			return true;
			
		if ($_FILES [$this->name] ["name"] == '')
			return true;
			
		foreach ($this->rule as $name => $value)
		{
			if ($name == 'size0')
			{
				if ($_FILES [$this->name] ["size"] == 0)
				{
					$this->error	= $name;
					return false;
				}
			}
			
			if ($name == 'size')
			{
				if ($_FILES [$this->name] ["size"] > $this->max_size)
				{
					$this->error	= $name;
					return false;
				}
			}
			
			if ($name == 'ext')
			{
				$t		= explode ('.', $_FILES [$this->name] ['name']);
				$ext	= $t [count ($t) - 1];
				
				if (strtolower ($ext) != 'jpg' && strtolower ($ext) != 'gif' && strtolower ($ext) != 'png')
				{ 
					$this->error	= $name; 
					return false;
				}
			}
		}
		
		setvar ($this->name, 'replace');
		return true;
	}
	//
	function error_text ()
	{
		return $this->rule [$this->error];
	}
	//
	function display ()
	{
		echo '<input type="file" name="'.$this->name.'"';
		if ($this->size!='')
			echo ' ';
		if ($this->inner!='')
			echo " ".$this->inner;
		echo ' />';
	}
	
	function display2 ()
	{
		$this->select_sql	= "SELECT `".$this->name."` FROM `".$this->table."` WHERE `id`=#1";
		$this->delete_sql	= "UPDATE `".$this->table."` SET `".$this->name."`='' WHERE `id`=".vars('e');
		
		if (vars ('e') != 'n')
			$row	= mysql_fetch_array (mysql_query (ereg_replace ("#1", vars ('e'), $this->select_sql)));
			
		if ($row [$this->name] == '' || vars ('e') == 'n')
		{
			echo '<font class="text">фотография отсутствует</font>';
		}
		else
		{
			echo '<a href="?e='.vars('e').'&rempic='.$this->name.'" class="link">удалить</a>';
			
			if ($this->display_pic)
			{
				echo "<br />";
				echo '<a href="javascript: '.cr_href ($this->path.$row[$this->name].'.jpg').'" class="link"><img src="/'.$this->path.$row [$this->name].'small.jpg'.'" hspace="0" vspace="0" border="0"></a>';
			}
			else
			{
				echo '&nbsp;<a href="javascript: '.cr_href ($this->path.$row [$this->name].'.jpg').'" class="link">увеличить</a>';
			}
		}
	}
	//
	function write_file ()
	{
		if (vars ($this->name) == 'replace')
		{
			if (vars ('e') != 'n')
			{
				$row	= mysql_fetch_array (mysql_query (ereg_replace ("#1", vars ('e'), $this->select_sql)));
				
				if (!empty ($row [$this->name]))
					unlink (conf::$bpath.$this->path.$row [$this->name].'small.jpg');
					
				if (!empty ($row [$this->name]))
					unlink (conf::$bpath.$this->path.$row [$this->name].'preview.jpg');
				if (!empty ($row [$this->name]))
					unlink (conf::$bpath.$this->path.$row [$this->name].'prev3x4.jpg');
					
				if (!empty ($row [$this->name]))
					unlink (conf::$bpath.$this->path.$row [$this->name].'.jpg');
			}
			
			$t		= explode ('.',$_FILES [$this->name] ['name']);
			$ext	= $t [count ($t) - 1];
			//
			if (file_exists (conf::$bpath.$this->path.'name.php'))
			{
				$f		= fopen (conf::$bpath.$this->path.'name.php', 'rb+');
				$uid	= fgets ($f);
				fclose ($f);
			}
			else
			{
				$f		= fopen (conf::$bpath.$this->path.'name.php', 'wb+');
				fwrite ($f, '1');
				fclose ($f);
				$uid	= 1;
			}
			
			while (true)
			{
				if (file_exists (conf::$bpath.$this->path.($uid + 1).".jpg"))
				{
					$uid ++;
					continue;
				}
				else
				{
					$uid ++;
					$f		= fopen (conf::$bpath.$this->path.'name.php', 'wb+');
					fwrite ($f, (string) $uid);
					fclose ($f);
					break;
				}
			}
			//
			$this->resize_write		($_FILES [$this->name] ['tmp_name'], conf::$bpath.$this->path.$uid, '');
			$this->resize_write		($_FILES [$this->name] ['tmp_name'], conf::$bpath.$this->path.$uid, 'small');
			$this->preview_write	($_FILES [$this->name] ['tmp_name'], conf::$bpath.$this->path.$uid);
			$this->prev3x4_write	($_FILES [$this->name] ['tmp_name'], conf::$bpath.$this->path.$uid);
			
			setvar ($this->name, $uid);
		}
		else
		{
			if (vars ('e') != 'n')
			{
				$row	= mysql_fetch_array (mysql_query (ereg_replace ("#1", vars('e'), $this->select_sql)));
				setvar ($this->name, $row [$this->name]);
			}
		}
	}
	//
	function rempic ()
	{
		$this->select_sql	= "SELECT `".$this->name."` FROM `".$this->table."` WHERE `id`=#1";
		$this->delete_sql	= "UPDATE `".$this->table."` SET `".$this->name."`='' WHERE `id`=".vars ('e');
		
		if (vars ('rempic') == $this->name)
		{
			$row	= mysql_fetch_array (mysql_query (ereg_replace ("#1", vars ('e'), $this->select_sql)));
			
			if (!empty ($row [$this->name]))
				unlink (conf::$bpath.$this->path.$row [$this->name].'small.jpg');
			if (!empty ($row [$this->name]))
				unlink (conf::$bpath.$this->path.$row [$this->name].'preview.jpg');
			if (!empty ($row [$this->name]))
				unlink (conf::$bpath.$this->path.$row [$this->name].'prev3x4.jpg');
			if (!empty ($row [$this->name]))
				unlink (conf::$bpath.$this->path.$row [$this->name].'.jpg');
				
			mysql_query ($this->delete_sql);
		}
	}
	//
	function delself ($id)
	{
		$this->select_sql	= "SELECT `".$this->name."` FROM `".$this->table."` WHERE `id`=#1";
		$row	= mysql_fetch_array (mysql_query (str_replace ("#1", $id,$this->select_sql)));
		
		if (!empty ($row [$this->name]))
			unlink (conf::$bpath.$this->path.$row [$this->name].'small.jpg');
		if (!empty ($row [$this->name]))
			unlink (conf::$bpath.$this->path.$row [$this->name].'preview.jpg');
		if (!empty ($row [$this->name]))
			unlink (conf::$bpath.$this->path.$row [$this->name].'prev3x4.jpg');
		if (!empty ($row [$this->name]))
			unlink (conf::$bpath.$this->path.$row [$this->name].'.jpg');
	}
	// 
	function resize_write ($fin, $fout, $type)
	{
		if ($type == '')
		{
  			$maxw	= $this->BigMaxWidth;
		  	$maxh	= $this->BigMaxHeight;
		  	$ss		= '';
		}
		else
		{
  			$maxw	= $this->SmallMaxWidth;
		  	$maxh	= $this->SmallMaxHeight;
		  	$ss		= 'small';
		}
		
	  	$size		= getimagesize ($fin);
	  	$width		= $size [0]; 
		$height		= $size [1];
		  	// resize image if needed
	  	$kw			= $width / $maxw;
	  	$kh			= $height / $maxh;
	  	if ($kw >= $kh && $kw > 1)
	  	{
			$new_width	= $width / $kw;
			$new_height	= $height / $kw;
	  	}
	  	elseif ($kh > $kw && $kh > 1)
	  	{
			$new_width	= $width / $kh;
	  		$new_height	= $height / $kh;
		}
		else
		{
			$new_width	= $width;
			$new_height	= $height;
		}
		
		$format	= strtolower (substr ($size ['mime'], strpos ($size ['mime'], '/') + 1));
		$icfunc	= "imagecreatefrom".$format;
		$isrc	= $icfunc ($fin);
	  	$idest	= imagecreatetruecolor ($new_width, $new_height);
	  	
	  	imagefill 			($idest, 0, 0, 0xFFFFFF);
		imagecopyresampled	($idest, $isrc, 0, 0, 0, 0, $new_width, $new_height, $width, $height);  	
		imagejpeg 			($idest, $fout.$ss.'.jpg', $quality = 85);
		imagedestroy		($isrc);
		imagedestroy		($idest);	
	}
	
	function preview_write ($fin, $fout)
	{
	  	$size		= getimagesize ($fin);
	  	$ss			= 'preview';
	  	
	  	$width		= $size [0]; 
		$height		= $size [1];
		
		if ($width > $height)
		{
			$srcStartX	= $width / 2 - $height / 2;
			$srcStartY	= 0;
			$srcEndX	= $width / 2 + $height / 2;
			$srcEndY	= $height;
		}
		else if ($width < $height)
		{
			$srcStartX	= 0;
			$srcStartY	= $height / 2 - $width / 2;
			$srcEndX	= $width;
			$srcEndY	= $height / 2 + $width / 2;
		}
		else
		{
			$srcStartX	= 0;
			$srcStartY	= 0;
			$srcEndX	= $width;
			$srcEndY	= $height;
		}
		
		
		$format	= strtolower (substr ($size ['mime'], strpos ($size ['mime'], '/') + 1));
		$icfunc	= "imagecreatefrom".$format;
		$isrc	= $icfunc ($fin);
	  	$idest	= imagecreatetruecolor ($this->previewSide, $this->previewSide);
	  	
	  	imagefill 			($idest, 0, 0, 0xFFFFFF);
		imagecopyresampled	($idest, $isrc, 0, 0, $srcStartX, $srcStartY, $this->previewSide, $this->previewSide, $srcEndX - $srcStartX, $srcEndY - $srcStartY);  	
		imagejpeg 			($idest, $fout.$ss.'.jpg', $quality = 85);
		imagedestroy		($isrc);
		imagedestroy		($idest);
	}
	
	function prev3x4_write ($fin, $fout)
	{
	  	$size		= getimagesize ($fin);
	  	$ss			= 'prev3x4';
	  	
	  	$width		= $size [0]; 
		$height		= $size [1];
		
//		if ($width > $height)
		if (1)
		{
			if (($width / $height) > ($this->previewLongSide / $this->previewShortSide))
			{
				$dh			= $height / $this->previewShortSide;
				
				$dstEndX	= $this->previewLongSide;
				$dstEndY	= $this->previewShortSide;
				
				$tmp		= $this->previewLongSide * $dh;
				
				$srcStartX	= $width / 2 - $tmp / 2;
				$srcStartY	= 0;
				$srcEndX	= $width / 2 + $tmp / 2;
				$srcEndY	= $height;
			}
			else
			{
				$dw			= $width / $this->previewLongSide;
				
				$dstEndX	= $this->previewLongSide;
				$dstEndY	= $this->previewShortSide;
				
				$tmp		= $this->previewShortSide * $dw;
				$srcStartX	= 0;
				$srcStartY	= $height / 2 - $tmp / 2;
				$srcEndX	= $width;
				$srcEndY	= $height / 2 + $tmp / 2;
			}
		}
		else
		{
			if (($height / $width) > ($this->previewLongSide / $this->previewShortSide))
			{
				$dw			= $width / $this->previewShortSide;
				
				$dstEndX	= $this->previewShortSide;
				$dstEndY	= $this->previewLongSide;
				
				$tmp		= $this->previewLongSide * $dw;
				$srcStartX	= 0;
				$srcStartY	= $height / 2 - $tmp / 2;
				$srcEndX	= $width;
				$srcEndY	= $height / 2 + $tmp / 2;
			}
			else
			{
				$dh			= $height / $this->previewLongSide;
				
				$dstEndX	= $this->previewShortSide;
				$dstEndY	= $this->previewLongSide;
				
				$tmp		= $this->previewShortSide * $dh;
				$srcStartX	= $width / 2 - $tmp / 2;
				$srcStartY	= 0;
				$srcEndX	= $width / 2 + $tmp / 2;
				$srcEndY	= $height;
			}
		}
		
		
		$format	= strtolower (substr ($size ['mime'], strpos ($size ['mime'], '/') + 1));
		$icfunc	= "imagecreatefrom".$format;
		$isrc	= $icfunc ($fin);
	  	$idest	= imagecreatetruecolor ($dstEndX, $dstEndY);
	  	
	  	imagefill 			($idest, 0, 0, 0xFFFFFF);
		imagecopyresampled	($idest, $isrc, 0, 0, $srcStartX, $srcStartY, $dstEndX, $dstEndY, round ($srcEndX - $srcStartX), round ($srcEndY - $srcStartY));  	
		imagejpeg 			($idest, $fout.$ss.'.jpg', $quality = 85);
		imagedestroy		($isrc);
		imagedestroy		($idest);
	}
};
?>