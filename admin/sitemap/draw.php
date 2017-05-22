<? 

session_start();
if ($_SESSION['user_id'] == 0) exit;
$text=$_GET['text'];
$src = imagecreatetruecolor(150,50);
$fon = imagecolorallocate($src,202,220,241);
$color = imagecolorallocate($src,29,66,132);
$color2 = imagecolorallocate($src,42,120,186);
$color3 = imagecolorallocate($src,255,0,0);
imagefill($src,0,0,$fon);

imagettftext($src, 11, 0, 4, 17, $color2, '../../kernel/arial.ttf', 'Модуль');
imagettftext($src, 10, 0, 62, 17, $color3, '../../kernel/arial.ttf', 'НЕ УДАЛЯТЬ!:'); 
imagettftext($src, 10, 0, 4, 35, $color, '../../kernel/arial.ttf', $text);

header("Content-type: image/jpg");
imagejpeg($src,null,100);
exit;