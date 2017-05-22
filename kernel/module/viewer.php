<?php if (!defined('SCRIPTACCESS')) exit;
	function viewcode(){
		?>
		<script language='JavaScript'>
			var height=0;
			var width=0;
			if (self.screen) {     // for NN4 and IE4
		        width = screen.width
		        height = screen.height
			}else if (self.java) {   // for NN3 with enabled Java
		       var jkit = java.awt.Toolkit.getDefaultToolkit();
		       var scrsize = jkit.getScreenSize();      
		       width = scrsize.width;
		       height = scrsize.height;
			}
			function popup_open(pic,w,h,d,n){
				mywin=open('<?php echo KPATH.ROOT; ?>popup_view.php/?f='+pic+'&d='+d+'&n='+n, 'displaywindow', 'width='+w+', height='+h+',left='+Math.round((width-w)/2)+',top='+Math.round((height-h)/2-30)+',resizable=no');
			};
		</script>
		<?
	};
	function cr_href($pic,$d='',$n=''){
		if($d!='') $dh=30;
		if(is_file(ROOT.KPATH.$pic)) $size1=getimagesize(ROOT.KPATH.$pic); else { $size1[0]=200; $size1[1]=50; };
		return "popup_open(\"".$pic."\",".($size1[0]+60).",".($size1[1]+90+$dh).",\"".$d."\",\"".$size1[0]."\");";
	};
?>