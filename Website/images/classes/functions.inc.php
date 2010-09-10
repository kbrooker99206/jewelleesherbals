<?php
/*
***************************************************
* DD-CCMS 2.5.2 Beta        01-07-2005       	  * 
* Written Kevin Brooker                           *
* DemonDezigns Copyright 2004-Present             *
***************************************************
*/
class funcs{

	function funcs(){
	}
///////////////////// SITE FUNCTIONS \\\\\\\\\\\\\\\\\\\\\\\\\\

///////////////////// RETRIEVE MAIN CONFIG \\\\\\\\\\\\\\\\\\\\\\\\\\
function config($site){
	include_once("db.inc.php");
	$db=new DB();
	$db->open();
		$query = "SELECT * FROM siteconfig";
		$result = $db->query($query);
		$num_results = $db->numRows($result);
			$site = $db->fetchArray($result);
			return $site;
	}
	
///////////////////// RETRIEVE SITEWIDE LINKS \\\\\\\\\\\\\\\\\\\\\\\\\\	
		function links($links){
	include_once("db.inc.php");
	$db=new DB();
	$db->open();
		$query = "SELECT * FROM SiteLinks";
		$result = $db->query($query);
		$num_results = $db->numRows($result);
			$links = $db->fetchArray($result);
			return $links;
	}

///////////////////// GET CSS VALUES \\\\\\\\\\\\\\\\\\\\\\\\\\
	
	function display($display) {
			include_once("db.inc.php");
	$db=new DB();
	$db->open();
		$query = "SELECT * FROM sitedisplay";
		$result = $db->query($query);
		$num_results = $db->numRows($result);
			$display = $db->fetchArray($result);
			return $display;
			
	}	 
///////////////////// Search pages \\\\\\\\\\\\\\\\\\\\\\\\\\
 function page_search($keywords,$s){	 
	 $limit=5; 
	 	include_once("db.inc.php");
	$db=new DB();
	$db->open();
	if (empty($s)) {
  $s=0;
  }
$query .= "SELECT title,content FROM pages " . "WHERE content LIKE '%".$keywords['0']."%' limit $s,$limit";
$num_results = $db->numRows($result);
$numresults = $db->query($query);
$numrows = $db->numRows($numresult);

echo "Results<BR>";
$count = 1 + $s ;
while($row=$db->fetchArray($result))
{
echo "$count.)<a href=".$stcfg[RootDir]."/?loc=".$row['title'].">".$row['title']."</a><BR>";
$count++ ;
}
$currPage = (($s/$limit) + 1);

  echo "<br />";
  if ($s>=1) { // bypass PREV link if s is 0
  $prevs=($s-$limit);
  print "&nbsp;<a href=\"$PHP_SELF?s=$prevs&search=$keywords\">&lt;&lt; 
  Prev 10</a>&nbsp&nbsp;";
  }
  $pages=intval($numrows/$limit);

  if ($numrows%$limit) {
  $pages++;
  }
  if (!((($s+$limit)/$limit)==$pages) && $pages!=1) {
  $news=$s+$limit;
echo "&nbsp;<a href=\"$PHP_SELF?s=$news&q=$var\">Next 10 &gt;&gt;</a>";
  }
$a = $s + ($limit) ;
  if ($a > $numrows) { $a = $numrows ; }
  $b = $s + 1 ;
  echo "<p>Showing results $b to $a of $numrows</p>";
}
 
///////////////////// Retrieve Selected Page \\\\\\\\\\\\\\\\\\\\\\\\\\

	function get_page($group, $page, $pgcontent){
	include_once("db.inc.php");
	$db=new DB();
	$db->open();
		$query = "SELECT * from pages where title = '$page'";
		$result = $db->query($query);
		$pgcontent = $db->fetchArray($result);
		
				if ($pgcontent[content] ==''){
			$pgcontent['content'] = 'The page you are trying to access doesnt exist!';
			include './skin/site/page.html';
		exit; }
		$value_array = explode(',',$pgcontent[usergroup]);
while(list(,$value) = each($value_array)) {
	if($value == $_SESSION[group] || $value == '5'){
		$permission = '1';}
		else {$permission = '0';}
}
if ($permission == '1' || $_SESSION['group'] == '1'){
			include './skin/site/page.html';
		}
		elseif ($permission != '1' || $_SESSION['group'] != '1'){
			$pgcontent['content'] = 'You do not have Authorization to View this page!';
			include './skin/site/page.html';
			}
		}

	///////////////////// GET TEMPLATE \\\\\\\\\\\\\\\\\\\\\\\\\\
	function get_template($templatename)

	{
	}

///////////////////// RETRIEVE SIDE BLOCKS \\\\\\\\\\\\\\\\\\\\\\\\\\

///////////////////// get left blocks  \\\\\\\\\\\\\\\\\\\\\\\\\\
	function get_left_blocks($group) {
			include_once("db.inc.php");
	$db=new DB();
	$db->open();
		$query = "SELECT * FROM blocks where side='lft' ORDER BY ordr";
		$result = $db->query($query);
		$num_results = $db->numRows($result);
for ($i=0; $i <$num_results; $i++)
		{
			$row = $db->fetchArray($result);
			
			$value_array = explode(',',$row[usergroup]);
while(list(,$value) = each($value_array)) {
	if($value == $_SESSION[group] || $value == '5'){
		$permission = '1';}
		else {$permission = '0';}
}
if ($permission == '1' || $_SESSION['group'] == '1'){				
include './skin/blocks/blocks.html';
			}
			elseif ($permission != '1' || $_SESSION['group'] != '1'){
				echo'';
			}
		}
	}
///////////////////// get right blocks  \\\\\\\\\\\\\\\\\\\\\\\\\\
	function get_right_blocks($group) {
			include_once("db.inc.php");
	$db=new DB();
	$db->open();
		$query = "SELECT * FROM blocks where side='rght' ORDER BY ordr";
		$result = $db->query($query);
		$num_results = $db->numRows($result);

		for ($i=0; $i <$num_results; $i++)
		{
			$row = $db->fetchArray($result);
			$value_array = explode(',',$row[usergroup]);
while(list(,$value) = each($value_array)) {
	if($value == $_SESSION[group] || $value == '5'){
		$permission = '1';}
		else {$permission = '0';}
}
		if ($permission == '1' || $_SESSION['group'] == '1'){
			include './skin/blocks/blocks.html';
			}
			elseif ($permission != '1' || $_SESSION['group'] != '1'){
				echo'';
			}

		}
	}
///////////////////// get right blocks  \\\\\\\\\\\\\\\\\\\\\\\\\\
	function get_topcenter_blocks($group) {
			include_once("db.inc.php");
	$db=new DB();
	$db->open();
		$query = "SELECT * FROM blocks where side='topcenter' ORDER BY ordr";
		$result = $db->query($query);
		$num_results = $db->numRows($result);

		for ($i=0; $i <$num_results; $i++)
		{
			$row = $db->fetchArray($result);
			$value_array = explode(',',$row[usergroup]);
while(list(,$value) = each($value_array)) {
	if($value == $_SESSION[group] || $value == '5'){
		$permission = '1';}
		else {$permission = '0';}
}
		if ($permission == '1' || $_SESSION['group'] == '1'){
			include './skin/blocks/blocks.html';
			}
			elseif ($permission != '1' || $_SESSION['group'] != '1'){
				echo'';
			}

		}
	}
	
	///////////////////// get right blocks  \\\\\\\\\\\\\\\\\\\\\\\\\\
	function get_bottomcenter_blocks($group) {
			include_once("db.inc.php");
	$db=new DB();
	$db->open();
		$query = "SELECT * FROM blocks where side='bottomcenter' ORDER BY ordr";
		$result = $db->query($query);
		$num_results = $db->numRows($result);

		for ($i=0; $i <$num_results; $i++)
		{
			$row = $db->fetchArray($result);
			$value_array = explode(',',$row[usergroup]);
while(list(,$value) = each($value_array)) {
	if($value == $_SESSION[group] || $value == '5'){
		$permission = '1';}
		else {$permission = '0';}
}
		if ($permission == '1' || $_SESSION['group'] == '1'){
			include './skin/blocks/blocks.html';
			}
			elseif ($permission != '1' || $_SESSION['group'] != '1'){
				echo'';
			}

		}
	}
		///////////////////// RETRIEVEEQEmu Server Stats\\\\\\\\\\\\\\\\\\\\\\\\\\
	function get_emustats() {
			include_once("db.inc.php");
	$db=new DB();
	$db->open();
		$query = "SELECT * FROM stats_worldservers";
		$result = $db->query($query);
		$num_results = $db->numRows($result);
		if ($DEBUG) echo $query . "<br>\n";
		if ($DEBUG) echo('Invalid query: ' . mysql_error() . "<br>\n");
		for ($i=0; $i <$num_results; $i++)
		{
			$row = $db->fetchArray($result);
			include './skin/site/emustats.html';

		}
	}
///////////////////// NEWS STUFF  \\\\\\\\\\\\\\\\\\\\\\\\\\

///////////////////// RETRIEVE NEWS \\\\\\\\\\\\\\\\\\\\\\\\\\
	function get_news() {
			include_once("db.inc.php");
	$db=new DB();
	$db->open();
		$query = "SELECT * FROM posts where forumname = '1' and parentpost = '0'  order by postid DESC LIMIT 5";
		$result = $db->query($query);
		$num_results = $db->numRows($result);
		if ($DEBUG) echo $query . "<br>\n";
		if ($DEBUG) echo('Invalid query: ' . mysql_error() . "<br>\n");
		for ($i=0; $i <$num_results; $i++)
		{
			$row = $db->fetchArray($result);
$data=$row[content];
			include './skin/site/news.html';

		}
	}
	
	function get_products($category) {
		
			include_once("db.inc.php");
	$db=new DB();
	$db->open();
		$query = "SELECT * FROM products WHERE category = $category order by product_name";
		$result = $db->query($query);
		$num_results = $db->numRows($result);
		if ($DEBUG) echo $query . "<br>\n";
		if ($DEBUG) echo('Invalid query: ' . mysql_error() . "<br>\n");
		for ($i=0; $i <$num_results; $i++)
		{
			$row = $db->fetchArray($result);
$data=$row[content];
			include './skin/site/product.html';

		}
	}
function get_product($product) {
		
			include_once("db.inc.php");
	$db=new DB();
	$db->open();
		$query = "SELECT * FROM products WHERE id = $product";
		$result = $db->query($query);
		$num_results = $db->numRows($result);
		if ($DEBUG) echo $query . "<br>\n";
		if ($DEBUG) echo('Invalid query: ' . mysql_error() . "<br>\n");
		for ($i=0; $i <$num_results; $i++)
		{
			$row = $db->fetchArray($result);
$data=$row[content];
			include './skin/site/product.html';

		}
	}	
function get_product_cats() {
		
			include_once("db.inc.php");
	$db=new DB();
	$db->open();
		$query = "SELECT * FROM product_category order by id";
		$result = $db->query($query);
		$num_results = $db->numRows($result);
		if ($DEBUG) echo $query . "<br>\n";
		if ($DEBUG) echo('Invalid query: ' . mysql_error() . "<br>\n");
		for ($i=0; $i <$num_results; $i++)
		{
			$row = $db->fetchArray($result);
			$data=$row[content];
			include './skin/site/product_cat.html';

		}
	}
///////////////////// NEWS BANNER AND ROTATING BANNERS \\\\\\\\\\\\\\\\\\\\\\\\\\	
	function get_chatnews(){
			include_once("db.inc.php");
	$db=new DB();
	$db->open();
		$query = "SELECT * FROM News";
		$result = $db->query($query);
		$num_results = $db->numRows($result);
		if ($DEBUG) echo $query . "<br>\n";
if ($DEBUG) echo('Invalid query: ' . mysql_error() . "<br>\n");
			$row = $db->fetchArray($result);	
	}

///////////////////// BANNING  \\\\\\\\\\\\\\\\\\\\\\\\\\
	

function get_banners(){
		include_once("db.inc.php");
	$db=new DB();
	$db->open(); 
$query = "SELECT content FROM banners"; 
$result = $db->query($query); 
while($quotes = $db->fetchArray($result)) {  
    $row_array[] = $quotes['content']; 
} 
$random_row = $row_array[rand(0, count($row_array) - 1)]; 
echo $random_row; 

	}

///////////////////// BANNING  \\\\\\\\\\\\\\\\\\\\\\\\\\
///////////////////// insert a global ban  \\\\\\\\\\\\\\\\\\\\\\\\\\	
	function insert_global_ban($banip)
	{	include_once("db.inc.php");
	$db=new DB();
	$db->open();
			$query= "INSERT INTO banned (bannedip) VALUES ('$banip') LIMIT 1;";
			$result = $db->query($query);
	}	
	
	function insert_global_gag($banip)
	{	
	include_once("db.inc.php");
	$db=new DB();
	$db->open();
	$query= "INSERT INTO sitesilence (silencedip) VALUES ('$banip');";
	$result = $db->query($query);
	}	
///////////////////// Site Bans  \\\\\\\\\\\\\\\\\\\\\\\\\\	
	function globalbanned($ip) {
			include_once("db.inc.php");
	$db=new DB();
	$db->open();
				$query = "SELECT * from banned";
				$result = $db->query($query);
		$num_results = $db->numRows($result);
		if ($DEBUG) echo $query . "<br>\n";
		if ($DEBUG) echo('Invalid query: ' . mysql_error() . "<br>\n");
		for ($i=0; $i <$num_results; $i++)
		{
			$row = $db->fetchArray($result);


			if(strstr($ip, $row[bannedip])){ 
    include './skin/banned.html';
    exit; 
}
}
	if ($group == '6') 
{ 
    include './skin/banned.html';
    exit; 
}
	}
	///////////////////// Room banning  \\\\\\\\\\\\\\\\\\\\\\\\\\	
	function getbanned($roomname,$ip,$username) {
			include_once("db.inc.php");
	$db=new DB();
	$db->open();
				$query = "SELECT * from roomban WHERE Roomname = '$roomname'";
				$result = $db->query($query);
		$num_results = $db->numRows($result);
		if ($DEBUG) echo $query . "<br>\n";
		if ($DEBUG) echo('Invalid query: ' . mysql_error() . "<br>\n");
		for ($i=0; $i <$num_results; $i++)
		{
			$row = $db->fetchArray($result);
			if($ip == $row[ip]){
				$query = "delete from online where username = '$username';";
				echo'<META HTTP-EQUIV=Refresh CONTENT="01; URL=http://quadroplex.com/roomban.php">';
				exit;
			}
			
	}
	}
///////////////////// Insert a room ban  \\\\\\\\\\\\\\\\\\\\\\\\\\	
		function insert_room_ban($ip,$room)
	{	include_once("db.inc.php");
	$db=new DB();
	$db->open();
		$chtnme = addslashes($chatname);
		$tag = addslashes($tags);
			$query= "INSERT INTO roomban (Roomname, ip) VALUES ('$room', '$ip');";
			$result = $db->query($query);
			$DEBUG = 0;
					if ($DEBUG) echo $query . "<br>\n";
if ($DEBUG) echo('Invalid query: ' . mysql_error() . "<br>\n");
	}
function getsilenced($roomname,$ip,$sitesilence) {
			include_once("db.inc.php");
	$db=new DB();
	$db->open();
				$query = "SELECT * from sitesilence";
				$result = $db->query($query);
		$num_results = $db->numRows($result);
		if ($DEBUG) echo $query . "<br>\n";
		if ($DEBUG) echo('Invalid query: ' . mysql_error() . "<br>\n");
		for ($i=0; $i <$num_results; $i++)
		{
			$row = $db->fetchArray($result);
			if(strstr($ip, $row[silencedip])){
$sitesilence = '1';
			}
			
	}
	return $sitesilence;
	}	
///////////////////// Print site footer  \\\\\\\\\\\\\\\\\\\\\\\\\\	
	function footer()
	{
		echo '<center><strong>Powered By: Samas CCMS Version 1.0</a><BR> &copy; 2008 Samas Designs</font><BR>';
		while (ob_get_level() > 0) {
   ob_end_flush();
}

	}
}
?>