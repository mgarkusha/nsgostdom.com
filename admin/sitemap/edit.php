<?php if (!defined('SCRIPTACCESS')) exit; ?>
<script type="text/javascript">
function JSfunc()
{
		this.strTranslit = function(el)
		{
			new_el = document.getElementById('out');
			A = new Array();
			A["Ё"]="Yo";A["Й"]="I";A["Ц"]="Ts";A["У"]="U";A["К"]="K";A["Е"]="E";A["Н"]="N";A["Г"]="G";A["Ш"]="Sh";A["Щ"]="Sch";A["З"]="Z";A["Х"]="H";A["Ъ"]="";
			A["ё"]="yo";A["й"]="i";A["ц"]="ts";A["у"]="u";A["к"]="k";A["е"]="e";A["н"]="n";A["г"]="g";A["ш"]="sh";A["щ"]="sch";A["з"]="z";A["х"]="h";A["ъ"]="";
			A["Ф"]="F";A["Ы"]="I";A["В"]="V";A["А"]="A";A["П"]="P";A["Р"]="R";A["О"]="O";A["Л"]="L";A["Д"]="D";A["Ж"]="Zh";A["Э"]="E";
			A["ф"]="f";A["ы"]="i";A["в"]="v";A["а"]="a";A["п"]="p";A["р"]="r";A["о"]="o";A["л"]="l";A["д"]="d";A["ж"]="zh";A["э"]="e";
			A["Я"]="Ya";A["Ч"]="Ch";A["С"]="S";A["М"]="M";A["И"]="I";A["Т"]="T";A["Ь"]="";A["Б"]="B";A["Ю"]="Yu";
			A["я"]="ya";A["ч"]="ch";A["с"]="s";A["м"]="m";A["и"]="i";A["т"]="t";A["ь"]="";A["б"]="b";A["ю"]="yu";
			A[" "]="_";A["#"]="";
			new_el.value = el.value.replace(/([\u0410-\u0451 ])/g,
				function (str,p1,offset,s) {
					if (A[str] != 'undefined'){return A[str];}
				}
			);
		}
		this.strNormalize = function(el)
		{
                        if (!el) { return; } 
                        
                        
//                       if(document.getElementById('name_alias').checked){
                            this.strTranslit(el);
//                        }
		}
       
}
var oJS = new JSfunc();
function check() {
    var checkbox = document.getElementById('name_alias');
    if(checkbox.checked) {
        oJS.strNormalize(document.getElementById('header'));
    }
}
</script>
<? a_message($t); ?>
<? a_header(cms::module_name(MODULE).': редактирование'); ?>
<? a_edit_controls($e1); ?>
<?
	$_s = 'echo \'<input type="checkbox" onclick="check();" id="name_alias">\';';
	$first->display();
	a_edit(
		$e1,
		'Раздел сайта|Заголовок страницы|Заголовок в качестве пути|Родитель|Отображать|Путь|Текст|TITLE|KEYWORDS|DESCRIPTION',
		'name|header|::'.$_s.'|parent|display|alias|text|title|keywords|description'
	); 
?>