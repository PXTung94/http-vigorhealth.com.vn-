<? include("check.php");
include("../config/config.php");
include("../config/sql.php");
if($getkind=="productl1"){ 
	$box2= "<select size='1' id='subcatalogid' name='subcatalogid'  onchange=\"ReturnCatalogL2('1')\" style='width:30%'>";
	$abc2 = mysql_query("select * from cat_sp WHERE c_parent='$catalogid' order by c_sort,c_id");
		while($rowcata2 = mysql_fetch_array($abc2)){
			$c_id1 = $rowcata2[c_id];if(!$subcatalogid) $subcatalogid=$c_id1;
			$c_name1 = trim($rowcata2[c_name]);
			$box2.="<option value='$c_id1'><b>$c_name1</b></option>";
		}	
	$box2.="</select>";
	echo $box2;
	exit();
}
if($getkind=="search_productl1"){ 
	$box2= "<select size='1' id='subcatalogid_search' name='subcatalogid_search'  onchange=\"ReturnCatalogL2('1')\" style='width:100%'>
	<option value='0'>All Catalog Level 2</option>";
	$abc2 = mysql_query("select * from cat_sp WHERE c_parent='$catalogid_search' order by c_sort,c_id");
		while($rowcata2 = mysql_fetch_array($abc2)){
			$c_id1 = $rowcata2[c_id];if(!$subcatalogid) $subcatalogid=$c_id1;
			$c_name1 = trim($rowcata2[c_name]);
			$box2.="<option value='$c_id1'><b>$c_name1</b></option>";
		}	
	$box2.="</select>";
	echo $box2;
	exit();
}
?>