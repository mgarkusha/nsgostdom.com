<?php if (!defined('SCRIPTACCESS')) exit;
	class pcategories {
		// required
		public $key='id';
		public $value='name';
		var $name;
		// optional
		var $inner;
		var $error='none';
		var $sql="SELECT * FROM #categories ORDER BY pos";
		var $sep=',';
		var $MySQLType='varchar(255)';
		var $default_checked=false;
		//
		function work(){
			$db=mysql::query($this->sql);
			while($row=mysql_fetch_array($db)){
				if (vars($this->name.$row[$this->key])==$row[$this->key]){
					$resch[]=vars($this->name.$row[$this->key]);
				}
			}
			if (count($resch)>0){
				$r=implode($this->sep,$resch);
			}
			setvar($this->name,$this->sep.$r.$this->sep);
			return true;
		}
		//
		function set_default_checked(){
			$this->default_checked=true;
			if(vars('e')=='n' && vars('s')=='') setvar($this->name,'1');
		}
		//
		function display(){
			$db=mysql::query($this->sql);
			$j=0;
			echo "<table cellpadding=0 cellspacing=0 border=0 style='margin-left:7px; margin-right:7px;'><tr><td><input type=checkbox id=".$this->name."all name=".$this->name."all onclick='javascript:catselectall2();'></td><td><a href='javascript:catselectall();'>Выделить все/сбросить все</a></td></tr></table>";
			echo "<div>".html::ispace(5,4)."</div>";
			?>
				<script>
					function catselectall(){
						if(document.one.<?=$this->name?>all.checked) document.one.<?=$this->name?>all.checked=false; else document.one.<?=$this->name?>all.checked=true;
						catselectall2();
					}
					function catselectall2(){
						if(document.one.<?=$this->name?>all.checked) c=true; else c=false;
						<?
							while($row=mysql_fetch_array($db)) echo "document.one.".$this->name.$row['id'].'.checked=c;'."\n"
						?>
					}
				</script>
			<?
			echo "<table cellpadding=0 cellspacing=0 border=0 style='margin-left:7px; margin-right:7px;'><tr>";
			$db=mysql::query($this->sql);
			while($row=mysql_fetch_array($db)){
				if($j==0){
					echo "<td valign=top>";
					echo '<table cellpadding=0 cellspacing=0 border=0>';
				}
				if(ereg($row[$this->key],vars($this->name))) $ch='checked'; else $ch='';
				//echo "<td class=text valign=top style='font-size:12px;'>";
				echo '<tr><td valign=top>';
				echo "<input type=checkbox name=".$this->name.$row[$this->key]." value=".$row[$this->key]." ".$ch.">";
				echo "</td><td class=text valign=top style='font-size:12px; padding-top:3px;'>".$row[$this->value]."</td></tr>";
				$j++;
				if ($j==12){
					echo "</table></td>";
					$j=0;
				}
			}
			if($j!=12 && $j!=0) echo "</table></td>";
			echo "</tr></table>";
		}
		function display2(){
			$intr=explode(",",vars(vars($this->name)));
			$db=mysql_query($this->sql);
			$j=0;
			echo "<input type=hidden name='".$this->name."' value='".vars($this->name)."'>";
			while($row=mysql_fetch_array($db)){
				if(ereg($row[$this->key],vars($this->name))) $ch=$row[$this->key]; else $ch='';
				echo "<input type=hidden name=".$this->name.$row['id']." value=".$ch." > ";
				$j++;
			}
		}
		
	};
?>