<?php if (!defined('SCRIPTACCESS')) exit;
	class mce_ {
		var $name;
		var $width=700;
		var $height=300;
		var $MySQLType='longtext';
		function set_permission(){
		}
		function display(){
			global $__tinymce_js_included;
			?>
				<? if(!$__tinymce_js_included) { ?>
					<script language="javascript" type="text/javascript" src="/kernel2/tiny_mce2/tiny_mce.js"></script>
				<? } ?>
				<script language="javascript" type="text/javascript">
					var imagefield=null;
					tinymce.create('tinymce.plugins.ExamplePlugin', {
						createControl: function(n, cm) {
							switch (n){
								case 'mymenubutton':
									var c = cm.createMenuButton('mymenubutton', {
										title : 'Вставить модуль',
										image : '/images/cms/module.gif',
										icons : false
									});
					
									c.onRenderMenu.add(function(c, m) {
										
										<?
											$db = mysql_query($sql="SELECT * FROM " . conf::$dbprefix . "cms_module WHERE `sitemapaccess` = '1' ORDER BY `pos`");
											//echo $sql; print_r(mysql_error());
											while ($row = mysql_fetch_array($db)) {
												?>
													m.add({title : '<?=$row['name']?>', onclick : function() {
														tinyMCE.activeEditor.execCommand('mceInsertContent', false, '<img src="../../admin/sitemap/draw.php?text=<?=$row['path']?>" width="150" height="50" class="cmsmodule" title="module:<?=$row['path']?>;">');
													}});												
												<?
											}
										?>
									});
					
									// Return the new menu button instance
									return c;
							}
					
							return null;
						}
					});
					
					// Register plugin with a short name
					tinymce.PluginManager.add('example', tinymce.plugins.ExamplePlugin);

					
					tinyMCE.init({
force_p_newlines : false,
						force_br_newlines : true,
						forced_root_block : '',
						language : "ru",
						mode : "exact",
						theme : "advanced",
						elements : "<? echo $this->name; ?>",
						//skin : "o2k7",
						plugins : "-example,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave",

						// Theme options
						theme_advanced_buttons1 : ",bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
						theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,bullist,numlist,|,outdent,indent,|,undo,redo,|,link,unlink,anchor,image,cleanup,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
						theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,|,print,|,fullscreen,|,mymenubutton",
						theme_advanced_buttons4 : "",
						theme_advanced_toolbar_location : "top",
						theme_advanced_toolbar_align : "left",
						theme_advanced_statusbar_location : "bottom",
						theme_advanced_resizing : true,

						content_css : "/css/styles.css",
						extended_valid_elements : "hr[class|width|size|noshade],font[face|size|color|style],span[class|align|style]",
						file_browser_callback : "fileBrowserCallBack",
						theme_advanced_resize_horizontal : true,
						theme_advanced_resizing : true,
						relative_urls : false
					});

					<? if(!$__tinymce_js_included) { ?>
					function fileBrowserCallBack(field_name, url, type, win) {
						mywin = open("/kernel2/filemanager/index.php", "filemanager", "resizable=yes,dialog=yes,modal=yes,width=750,height=550,status=no,toolbar=no,menubar=no");
						imagefield = win.document.forms[0].elements[field_name];
					}
					<? }?>
				</script>
			<?
			echo "<table border=0 cellpadding=0 cellspacing=0 width=".$this->width." height=".$this->height."><tr><td valign=top width=".$this->width." height=".$this->height.">";
			echo "<textarea name=".$this->name." style='width:".$this->width."; height:".$this->height.";' cols=90 rows=20>".vars::mixed($this->name,'string')."</textarea>";
			echo "</td></tr></table>";
			$__tinymce_js_included = true;
		}
		function work(){
			if(empty($this->rule)) return true;
			foreach($this->rule as $name => $value){
				if($name=='ne'){
					if(vars($this->name)==''){
						$this->error=$name;
						return false;
					};
				};
			}
			return true;
		}
		//
		function error_text(){
			return $this->rule[$this->error];
		}
	};
?>