<?php
function CoolSize($size) {
    $mb = 1024*1024;
    if ( $size > $mb ) {
        $mysize = sprintf ("%01.2f",$size/$mb) . " Mb";
    } elseif ( $size >= 1024 ) {
        $mysize = sprintf ("%01.2f",$size/1024) . " Kb";
    } else {
        $mysize = $size . " b";
    }
    return $mysize;
}

function spacer($w,$h){
    return "<img width=$w height=$h src='images/empty.gif' border=0>";
}

function rus2lat($str)
{
	$chars = array(
			'й'=>'j','Й'=>'J',
			'ц'=>'c','Ц'=>'C',
			'у'=>'u','У'=>'U',
			'к'=>'k','К'=>'K',
			'е'=>'e','Е'=>'E',
			'н'=>'n','Н'=>'N',
			'г'=>'g','Г'=>'G',
			'ш'=>'sh','Ш'=>'Sh',
			'щ'=>'csh','Щ'=>'CSH',
			'з'=>'z','З'=>'Z',
			'х'=>'h','Х'=>'H',
			'ъ'=>'_','Ъ'=>'_',
			'ф'=>'f','Ф'=>'F',
			'ы'=>'y','Ы'=>'Y',
			'в'=>'v','В'=>'V',
			'а'=>'a','А'=>'A',
			'п'=>'p','П'=>'P',
			'р'=>'r','Р'=>'R',
			'о'=>'o','О'=>'O',
			'л'=>'l','Л'=>'L',
			'д'=>'d','Д'=>'D',
			'ж'=>'j','Ж'=>'J',
			'э'=>'e','Э'=>'E',
			'я'=>'ya','Я'=>'YA',
			'ч'=>'ch','Ч'=>'CH',
			'с'=>'s','С'=>'s',
			'м'=>'m','М'=>'M',
			'и'=>'i','И'=>'I',
			'т'=>'t','Т'=>'T',
			'ь'=>'_','Ь'=>'_',
			'б'=>'b','Б'=>'B',
			'ю'=>'u','Ю'=>'U',
			'ё'=>'e','Ё'=>'E',
			' '=>'_'
	);

	for ($i=0;$i<mb_strlen($str,'utf-8');$i++){
            if($chars[mb_substr($str, $i, 1, 'utf-8')]!='') $res .= $chars[mb_substr($str, $i, 1, 'utf-8')];
            else  $res .= mb_substr($str, $i, 1, 'utf-8');
	}
	return $res;
}

// Удаление непустого каталога
function xrmdir($path)
{
  $result=true;
  if ($dir = opendir($path))
  {
    while (($file = @readdir($dir)) !== false)
    {
      $tmp = $path.DIRECTORY_SEPARATOR.$file;
      if (is_dir($tmp) && $file!="." && $file!="..")
      {
        if (!xrmdir($tmp))
          $result=false;
      }
      else if (is_file($tmp))
        if (!@unlink($tmp))
          $result=false;
    }
   closedir($dir);
  }
  else 
	$result=false;  
  if (!rmdir($path))
      $result=false;  
  return $result;
}
?>