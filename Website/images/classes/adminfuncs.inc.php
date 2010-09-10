<?php
/*
***************************************************
* DD-CCMS 2.5.2 Beta        01-07-2005       	  * 
* Written Kevin Brooker                           *
* DemonDezigns Copyright 2004-Present             *
***************************************************
*/
class adminfuncs{

function adminfuncs()
{

}
		 function admin_session_checker($group){ 
if($group != 1){ 
		echo'<table border="1" width="100%"><tr><td align="center" valign="top">';
				echo 'UNAUTHORIZED ACCESS';
				echo '</td></tr><tr><td align="center" valign="top">';
			echo 'We are sorry but you do not have permission to view this page';
			echo '</td></tr></table><BR>';
			exit();
		}
		}
		
//**************** DATA RETRIEVAL ******************
	function get_groups()
	{
include_once("db.inc.php");
$db=new DB();
$db->open();
		$query = "SELECT groupid,groupname from Membergroups";
		$result = $db->query($query);
		if($db->numRows($result)) {
			while($group = $db->fetchRow($result))
			{
				print("<option value=\"$group[0]\">$group[1]</option>");
			}
		} else {
			print("<option value=\"\">No Groups Available</option>");
		}
	}

	function get_banlist() {
include_once("db.inc.php");
$db=new DB();
$db->open();
	echo'<table width="100%" border="1" cellspacing="1" cellpadding="1">
  <tr> 
    <td width="59%"><div align="center">Banned IP</div></td>    
    <td colspan="2"><div align="center">Action</div></td>
  </tr>';
		$query = "SELECT * FROM banned ORDER BY ip";
		$result = $db->query($query);
		$num_results = $db->numRows($result);
		

		for ($i=0; $i <$num_results; $i++)
		{
			$row = $db->fetchArray($result);
echo'<tr> <td><li>';
			echo $row['ip'];
    		echo'</li></td>';				
				echo'<td width="16%">
				<a href="delban.php?ip=';
				echo $row['ip'];
				echo'">Delete<img src="../images/admin/delete.png" border="0" width="16" height="16"></a></td>';				
				echo '</tr>';
		}
		echo '</table>';
	}	
	
		function userinfo($user, $userinfo){
			include_once("db.inc.php");
$db=new DB();
$db->open();
		$query = "SELECT * from Memberships where username = '$user'";
		$result = $db->query($query);
		$userinfo = $db->fetchArray($result);
		return $userinfo;
	}
		
//**************** DELETION ******************	


	function delete_ban($ip)
	{
		include_once("db.inc.php");
$db=new DB();
$db->open();
		$query = "delete from banned where ip = '$ip';";
		$result = $db->query($query);
	}
	
///////////// GLOBAL STUFF ///////////////////
function update_stcfg($name, $url, $active, $webmaster)
	{
		include_once("db.inc.php");
$db=new DB();
$db->open();
		$query= "UPDATE `siteconfig` SET `SiteName`='$name', `SiteUrl`='$url', `Active`='$active', `webmaster_email`='$webmaster';";
		$result = $db->query($query);
		


	}
	function update_css($bgimage, $bgcolor, $text, $link, $visited, $active, $hover, $arrow, $track, $base, $shadow, $darkshadow, $highlight, $scroll3d, $face, $formbg, $buttop, $butbottom, $butleft, $butright){
		include_once("db.inc.php");
$db=new DB();
$db->open();
		$query= "UPDATE `sitedisplay` SET `background`='$bgimage', `text`='$text', `link`='$link', `active`='$active', `visited`='$visited', `backcolor`='$bgcolor', `scroll`='$highlight', `scroll3d`='$scroll3d', `arrow`='$arrow', `formbg`='$formbg', `buttop`='$buttop', `butbottom`='$butbottom', `butleft`='$butleft', `butright`='$butright';";
		$result = $db->query($query);
	}	

//////////////// BLOCK STUFF /////////////////
// Gets the list of Blocks for editing or deletion
	function get_leftblocklist() {
		include_once("db.inc.php");
$db=new DB();
$db->open();
		
		echo'<table width="100%" border="1" cellspacing="1" cellpadding="1">
  <tr> 
    <td width="59%"><div align="center">Name</div></td>    
    <td colspan="2"><div align="center">Action</div></td>
  </tr>';
		$query = "SELECT * FROM blocks where side='lft' ORDER BY ordr";
		$result = $db->query($query);
		$num_results = $db->numRows($result);
		
		
		for ($i=0; $i <$num_results; $i++)
		{
			$row = $db->fetchArray($result);
			echo'<tr> <td><li>';
			echo $row['title'];
			echo'</li></td>';
			echo'<td width="16%">
				<a href="delblock.php?block=';
			echo $row['title'];
			echo'">Delete<img src="../images/admin/delete.png" border="0" width="16" height="16"></a></td>';
			echo '<td width="25%">';
			echo'<a href="edblock.php?block=';
			echo $row['title'];
			echo '">Edit<img src="../images/admin/edit.png" border="0" width="16" height="16">';
			echo '</a></td></tr>';
		}
		
		echo '</table>';
	}
//////////////////////////////////////////////////////
//BANNING	
	function roomexileinfo($user, $banstuff)
	{
		include_once("db.inc.php");
$db=new DB();
$db->open();
		$query = "SELECT * from roomban where bannedname = '$user'";
		$result = $db->query($query);
		$banstuff = $db->fetchArray($result);
		
		
		
		return $banstuff;
	}
		function roomgaginfo($user, $banstuff){
			include_once("db.inc.php");
$db=new DB();
$db->open();
		$query = "SELECT * from roomgag where gaggedname = '$user'";
		$result = $db->query($query);
		$banstuff = $db->fetchArray($result);
		
		
		
		return $banstuff;
	}
		function roomexilelist() {
			include_once("db.inc.php");
$db=new DB();
$db->open();
		
		echo'<table width="100%" border="1" cellspacing="1" cellpadding="1">
  <tr> 
    <td width="59%"><div align="center">Room</div></td>
    <td width="59%"><div align="center">Name</div></td>    
    <td colspan="2"><div align="center">Action</div></td>
  </tr>';
		$query = "SELECT * FROM roomban ORDER BY bannedfrom";
		$result = $db->query($query);
		$num_results = $db->numRows($result);
		
		
		for ($i=0; $i <$num_results; $i++)
		{
			$row = $db->fetchArray($result);
			echo'<tr> <td><li>';
			echo $row['bannedfrom'];
			echo'</li></td>';
			echo'<td>';
			echo $row['bannedname'];
			echo'</li></td>';
			echo'<td width="16%">
				<a href="delrmban.php?user=';
			echo $row['bannedname'];
			echo'&room=';
			echo $row['bannedfrom'];
			echo'">Delete<img src="../images/admin/delete.png" border="0" width="16" height="16"></a></td>';
			echo '<td width="25%">';
			echo'<a href="edrmban.php?user=';
			echo $row['bannedname'];
			echo '">Edit<img src="../images/admin/edit.png" border="0" width="16" height="16">';
			echo '</a></td></tr>';
		}
		
		echo '</table>';
	}
	
	function update_roomexile($name, $ip, $room)
	{
		include_once("db.inc.php");
$db=new DB();
$db->open();
		$query= "UPDATE `roomban` SET `bannedip`='$ip' WHERE `bannedname`='$name';";
		$result = $db->query($query);
	}	
	
	function delete_roomexile($room, $user)
	{
		include_once("db.inc.php");
$db=new DB();
$db->open();
		$query = "delete from roomban where bannedfrom = '$room' and bannedname = '$user';";
		$result = $db->query($query);
	}	
		function update_roomgag($name, $ip, $room)
	{
		include_once("db.inc.php");
$db=new DB();
$db->open();
		$query= "UPDATE `roomgag` SET `gaggedip`='$ip' WHERE `gaggedname`='$name';";
		$result = $db->query($query);
	}	
	
	function delete_roomgag($room, $user)
	{
		include_once("db.inc.php");
$db=new DB();
$db->open();
		$query = "delete from roomgag where gaggedfrom = '$room' and gaggedname = '$user';";
		$result = $db->query($query);
	}	
////////////////////////////////////////////
//	ROOM MODERATOR STUFF
//////////////////////////////////////////////////////
//BANNING	
	function roommodexilelist($room) {
		include_once("db.inc.php");
$db=new DB();
$db->open();
		
		echo'<table width="100%" border="1" cellspacing="1" cellpadding="1">
  <tr> 
    <td width="59%"><div align="center">Name</div></td>    
    <td colspan="2"><div align="center">Action</div></td>
  </tr>';
		$query = "SELECT * FROM roomban WHERE bannedfrom ='$room'";
		$result = $db->query($query);
		$num_results = $db->numRows($result);
		
		
		for ($i=0; $i <$num_results; $i++)
		{
			$row = $db->fetchArray($result);
			echo'<tr> <td><li>';
			echo $row['bannedname'];
			echo'</li></td>';
			echo'<td width="16%">
				<a href="delrmban.php?user=';
			echo $row['bannedname'];
			echo'&room=';
			echo $row['bannedfrom'];
			echo'">Delete<img src="../images/admin/delete.png" border="0" width="16" height="16"></a></td>';
			echo '<td width="25%">';
			echo'<a href="edrmban.php?user=';
			echo $row['bannedname'];
			echo '">Edit<img src="../images/admin/edit.png" border="0" width="16" height="16">';
			echo '</a></td></tr>';
		}
		
		echo '</table>';
	}
	function roommodgaglist($room) {
		include_once("db.inc.php");
$db=new DB();
$db->open();
		
		echo'<table width="100%" border="1" cellspacing="1" cellpadding="1">
  <tr> 
    <td width="59%"><div align="center">Name</div></td>    
    <td colspan="2"><div align="center">Action</div></td>
  </tr>';
		$query = "SELECT * FROM roomgag WHERE gaggedfrom ='$room'";
		$result = $db->query($query);
		$num_results = $db->numRows($result);
		
		
		for ($i=0; $i <$num_results; $i++)
		{
			$row = $db->fetchArray($result);
			echo'<tr> <td><li>';
			echo $row['gaggedname'];
			echo'</li></td>';
			echo'<td width="16%">
				<a href="delrmgag.php?user=';
			echo $row['gaggedname'];
			echo'&room=';
			echo $row['gaggedfrom'];
			echo'">Delete<img src="../images/admin/delete.png" border="0" width="16" height="16"></a></td>';
			echo '<td width="25%">';
			echo'<a href="edrmgag.php?user=';
			echo $row['gaggedname'];
			echo '">Edit<img src="../images/admin/edit.png" border="0" width="16" height="16">';
			echo '</a></td></tr>';
		}
		
		echo '</table>';
	}
/////////////////////////////////////////////
		function get_roomlist() {
			include_once("db.inc.php");
$db=new DB();
$db->open();
		
		echo'<table width="100%" border="1" cellspacing="1" cellpadding="1">
  <tr> 
    <td width="59%"><div align="center">Name</div></td>    
    <td colspan="2"><div align="center">Action</div></td>
  </tr>';
		$query = "SELECT * FROM Roomcfg ORDER BY RoomName";
		$result = $db->query($query);
		$num_results = $db->numRows($result);
		
		
		for ($i=0; $i <$num_results; $i++)
		{
			$row = $db->fetchArray($result);
			echo'<tr> <td><li>';
			echo $row['RoomName'];
			echo'</li></td>';
			echo'<td width="16%">
				<a href="delbroom.php?room=';
			echo $row['RoomName'];
			echo'">Delete<img src="../images/admin/delete.png" border="0" width="16" height="16"></a></td>';
			echo '<td width="25%">';
			echo'<a href="roomedit.php?room=';
			echo $row['RoomName'];
			echo '">Edit<img src="../images/admin/edit.png" border="0" width="16" height="16">';
			echo '</a></td></tr>';
		}
		echo '</table>';
	}
	function get_rightblocklist() {
		include_once("db.inc.php");
$db=new DB();
$db->open();
		
		echo'<table width="100%" border="1" cellspacing="1" cellpadding="1">
  <tr> 
    <td width="59%"><div align="center">Name</div></td>    
    <td colspan="2"><div align="center">Action</div></td>
  </tr>';
		$query = "SELECT * FROM blocks where side='rght' ORDER BY ordr";
		$result = $db->query($query);
		$num_results = $db->numRows($result);
		
		
		for ($i=0; $i <$num_results; $i++)
		{
			$row = $db->fetchArray($result);
			echo'<tr> <td><li>';
			echo $row['title'];
			echo'</li></td>';
			echo'<td width="16%">
				<a href="delblock.php?block=';
			echo $row['title'];
			echo'">Delete<img src="../images/admin/delete.png" border="0" width="16" height="16"></a></td>';
			echo '<td width="25%">';
			echo'<a href="edblock.php?block=';
			echo $row['title'];
			echo '">Edit<img src="../images/admin/edit.png" border="0" width="16" height="16">';
			echo '</a></td></tr>';
		}
		echo '</table>';

	}

	function get_blocklist1() {
		include_once("db.inc.php");
$db=new DB();
$db->open();
		echo'<table width="100%" border="1" cellspacing="1" cellpadding="1">
  <tr> 
    <td width="59%"><div align="center">Name</div></td>    
    <td colspan="2"><div align="center">Action</div></td>
  </tr>';
		$query = "SELECT * FROM blocks";
		$result = $db->query($query);
		$num_results = $db->numRows($result);
		
		
		for ($i=0; $i <$num_results; $i++)
		{
			$row = $db->fetchArray($result);
			echo'<tr> <td><li>';
			echo $row['title'];
			echo'</li></td>';
			echo'<td width="16%">';
			echo '<td width="25%">';
			echo'<a href="blockperm.php?block=';
			echo $row['title'];
			echo '">Creat New Usergroup Permission<img src="../images/admin/edit.png" border="0" width="16" height="16">';
			echo '</a></td></tr>';
		}
		echo '</table>';
	}

	function blockinfo($blockname, $blockstuff)
	{
		include_once("db.inc.php");
$db=new DB();
$db->open();
		$query = "SELECT * from blocks where title = '$blockname'";
		$result = $db->query($query);
		$blockstuff = $db->fetchArray($result);
		return $blockstuff;
	}

	//insert block
	function insert_block($title, $content, $usergroup, $side, $ordr)
	{
		include_once("db.inc.php");
$db=new DB();
$db->open();
		$query = "INSERT INTO blocks (title, content, usergroup, side, ordr) VALUES ('$title', '$content', '$usergroup', '$side', '$ordr');";
		$result = $db->query($query);
	}

	function insert_block_permission($block, $usergroup, $access)
	{
		include_once("db.inc.php");
$db=new DB();
$db->open();
		$query = "INSERT INTO block_permissions (blockname, groupid, access) VALUES ('$block', '$usergroup', '$access');";
		$result = $db->query($query);
	}
	function insert_ban($ip)
	{
		include_once("db.inc.php");
$db=new DB();
$db->open();
		$query = "INSERT INTO banned (ip) VALUES ('$ip');";
		$result = $db->query($query);
	}

	function update_block($title, $content, $usergroup, $side, $order)
	{
		include_once("db.inc.php");
$db=new DB();
$db->open();
		$query= "UPDATE `blocks` SET `content`='$content', `usergroup`='$usergroup', `side`='$side', `ordr`='$order' WHERE `title`='$title';";
		$result = $db->query($query);
	}


	function delete_block($title)
	{
		include_once("db.inc.php");
$db=new DB();
$db->open();
		$query = "delete from blocks where title = '$title';";
		$result = $db->query($query);
		$query1 = "delete from block_permissions where blockname = '$title';";
		$result1 = $db->query($query1);
	}

///////////////// NEWS STUFF /////////////////
function get_newslist() {
	include_once("db.inc.php");
$db=new DB();
$db->open();
	echo'<table width="100%" border="1" cellspacing="1" cellpadding="1">
  <tr> 
    <td width="59%"><div align="center">Name</div></td>    
    <td colspan="2"><div align="center">Action</div></td>
  </tr>';
		$query = "SELECT * FROM Sitenews";
		$result = $db->query($query);
		$num_results = $db->numRows($result);
		

		for ($i=0; $i <$num_results; $i++)
		{
			$row = $db->fetchArray($result);
echo'<tr> <td><li>';
			echo $row['title'];
    		echo'</li></td>';				
				echo'<td width="16%">
				<a href="delnews.php?news=';
				echo $row['title'];
				echo'">Delete<img src="../images/admin/delete.png" border="0" width="16" height="16"></a></td>';				
				echo '<td width="25%">';
				echo'<a href="ednews.php?news=';
				echo $row['title'];
				echo '">Edit<img src="../images/admin/edit.png" border="0" width="16" height="16">';
				echo '</a></td></tr>';
		}
		echo '</table>';
	}
			function newsinfo($newsname, $newsstuff)
	{
		include_once("db.inc.php");
$db=new DB();
$db->open();
		$query = "SELECT * from Sitenews where title = '$newsname'";
		$result = $db->query($query);
		$newsstuff = $db->fetchArray($result);
		return $newsstuff;
	}
function insert_news($title, $content, $username)
	{
include_once("db.inc.php");
$db=new DB();
$db->open();
	$message_date = date('m-j-Y');
	$message_time = date('H:i A');
	$data=$content;
function bb_php($data){
$data = str_replace("]\n", "]", $data);
$match = array('#\[php\](.*?)\[\/php\]#se');
$replace = array("'<div>'.highlight_string(stripslashes('$1'), true).'</div>'");
return preg_replace($match, $replace, $data);
}

function bb_parse($data){
$data = bb_php($data);
return $data;
}
bb_parse($data);	
$query = "INSERT INTO Sitenews (title, content, newsdate, newstime, user) VALUES ('$title', '$data', '$message_date', '$message_time', '$username');";



$result = $db->query($query);
	}
	
		function update_news($title, $content)
	{
		include_once("db.inc.php");
$db=new DB();
$db->open();
		$query= "UPDATE `Sitenews` SET `content`='$content' WHERE `title`='$title';";
		$result = $db->query($query);
	}
	
			function delete_news($title)
	{
		include_once("db.inc.php");
$db=new DB();
$db->open();
		$query = "delete from Sitenews where title = '$title';";
		$result = $db->query($query);
	}

/////////////// PAGE STUFF ////////////////

function get_pagelist() {
	include_once("db.inc.php");
$db=new DB();
$db->open();
	
		echo'<table width="100%" border="1" cellspacing="1" cellpadding="1">
  <tr> 
    <td width="59%"><div align="center">Name</div></td>    
    <td colspan="2"><div align="center">Action</div></td>
  </tr>';
		$query = "SELECT * FROM pages";
		$result = $db->query($query);
		$num_results = $db->numRows($result);
		

		for ($i=0; $i <$num_results; $i++)
		{
			$row = $db->fetchArray($result);
echo'<tr> <td><li>';
			echo $row['title'];
    		echo'</li></td>';				
				echo'<td width="16%">
				<a href="delpage.php?page=';
				echo $row['title'];
				echo'">Delete<img src="../images/admin/delete.png" border="0" width="16" height="16"></a></td>';				
				echo '<td width="25%">';
				echo'<a href="edpage.php?page=';
				echo $row['title'];
				echo '">Edit<img src="../images/admin/edit.png" border="0" width="16" height="16">';
				echo '</a></td></tr>';
		}
		echo '</table>';
	}		
		function get_pagelist1() {
			include_once("db.inc.php");
$db=new DB();
$db->open();
	
		echo'<table width="100%" border="1" cellspacing="1" cellpadding="1">
  <tr> 
    <td width="59%"><div align="center">Name</div></td>    
    <td colspan="2"><div align="center">Action</div></td>
  </tr>';
		$query = "SELECT * FROM pages";
		$result = $db->query($query);
		$num_results = $db->numRows($result);
		

		for ($i=0; $i <$num_results; $i++)
		{
			$row = $db->fetchArray($result);
echo'<tr> <td><li>';
			echo $row['title'];
    		echo'</li></td>';				
				echo'<td width="16%">';				
				echo '<td width="25%">';
				echo'<a href="pageperm.php?page=';
				echo $row['title'];
				echo '">Creat New Permission for page<img src="../images/admin/edit.png" border="0" width="16" height="16">';
				echo '</a></td></tr>';
		}
		echo '</table>';
	}

		function pageinfo($pagename, $pageinfo)
	{
		include_once("db.inc.php");
$db=new DB();
$db->open();
		$query = "SELECT * from pages where title = '$pagename'";
		$result = $db->query($query);
		$pageinfo = $db->fetchArray($result);
		return $pageinfo;
	}
	
	function insert_page($title, $content, $usergroup)
	{
		include_once("db.inc.php");
$db=new DB();
$db->open();
$query = "INSERT INTO pages (title, content, usergroup) VALUES ('$title', '$content', '$usergroup');";
$result = $db->query($query);
	}
	
	function update_page($title, $content, $usergroup)
	{
		include_once("db.inc.php");
$db=new DB();
$db->open();
		$query= "UPDATE `pages` SET `content`='$content', `usergroup`='$usergroup' WHERE `title`='$title';";
		$result = $db->query($query);
	}
	
		function delete_page($title)
	{
		include_once("db.inc.php");
$db=new DB();
$db->open();
		$query = "delete from pages where title = '$title';";
		$result = $db->query($query);
		$query1 = "delete from page_permissions where pagename = '$title';";
		$result1 = $db->query($query1);
	}
	
// Inserts the room into the table
	function insert_room($name1, $mod1, $users1, $background1, $text1, $links1, $login1, $logout1, $header11, $intro1, $html11, $html21, $html31, $html41, $html51, $html61, $active)
	{
		include_once("db.inc.php");
$db=new DB();
$db->open();
		$name = $name1;
		$mod = $mod1;		
		$users = $users1;
		$background = $background1;		
		$text = $text1;
		$links = $link1;		
		$login = $login1;
		$logout = $logout1;		
		$header1 = $header11;
		$intro = $intro1;		
		$html1 = $html11;
		$html2 = $html21;		
		$html3 = $html31;
		$html4 = $html41;
		$html5 = $html51;
		$html6 = $html61;
		$query= "INSERT INTO `Roomcfg` ( `RoomName` , `Moderator` , `Numvalid` , `BG` , `Textcol` , `Linkcolor` , `Banner` , `Login` , `Logout` , `Entrance` , `Roomtxt` , `rmlink1` , `rmlink2` , `rmlink3` , `rmlink4` , `Ruleslink` , `Active` ) VALUES ('$name', '$mod', '$users', '$background', '$text', '$links1', '$header1', '$login', '$logout', '$intro', '$html1', '$html2', '$html3', '$html4', '$html5' , '$html6', '$active');";
		$result = $db->query($query);
					
					

	}

// UPDATES the room config
	function update_room_config($name1, $mod1, $users1, $background1, $text1, $links1, $login1, $logout1, $header11, $intro1, $html11, $html21, $html31, $html41, $html51, $html61, $active)
	{
		include_once("db.inc.php");
$db=new DB();
$db->open();
		$name = $name1;
		$mod = $mod1;		
		$users = $users1;
		$background = $background1;		
		$text = $text1;
		$links = $link1;		
		$login = $login1;
		$logout = $logout1;		
		$header1 = $header11;
		$intro = $intro1;		
		$html1 = $html11;
		$html2 = $html21;		
		$html3 = $html31;
		$html4 = $html41;
		$html5 = $html51;
		$html6 = $html61;
		
		$query= "UPDATE `Roomcfg` SET `RoomName`='$name' , `Moderator`='$mod' , `Numvalid`='$users' , `BG`='$background' , `Textcol`='$text' , `Linkcolor`='$links1' , `Banner`='$header1' , `Login`='$login' , `Logout`='$logout' , `Entrance`='$intro' , `Roomtxt`='$html1' , `rmlink1`='$html2' , `rmlink2`='$html3' , `rmlink3`='$html4' , `rmlink4`='$html5' , `Ruleslink`='$html6' , `Active`='$active' WHERE `RoomName`='$name';";
		$result = $db->query($query);
							
					

	}
	function mod_update_room_config($name1, $mod1, $users1, $background1, $text1, $links1, $login1, $logout1, $header11, $intro1, $html11, $html21, $html31, $html41, $html51, $html61, $active)
	{
		include_once("db.inc.php");
$db=new DB();
$db->open();
				$name = $name1;
		$mod = $mod1;		
		$users = $users1;
		$background = $background1;		
		$text = $text1;
		$links = $link1;		
		$login = $login1;
		$logout = $logout1;		
		$header1 = $header11;
		$intro = $intro1;		
		$html1 = $html11;
		$html2 = $html21;		
		$html3 = $html31;
		$html4 = $html41;
		$html5 = $html51;
		$html6 = $html61;
		
		$query= "UPDATE `Roomcfg` SET `Numvalid`='$users' , `BG`='$background' , `Textcol`='$text' , `Linkcolor`='$links1' , `Banner`='$header1' , `Login`='$login' , `Logout`='$logout' , `Entrance`='$intro' , `Roomtxt`='$html1' , `rmlink1`='$html2' , `rmlink2`='$html3' , `rmlink3`='$html4' , `rmlink4`='$html5' , `Ruleslink`='$html6' `Active`='$active' WHERE `RoomName`='$name';";
		$result = $db->query($query);
							
					

	}
// Retrieves user info for the Discpline
	function get_room_disciplined_user($roomname, $banned, $bannedinfo)
	{
		include_once("db.inc.php");
$db=new DB();
$db->open();
		$query = "SELECT * from online where Room = '$roomname' and username = '$banned'";
		$result = $db->query($query);
		if($db->numRows($result)) {
			$bannedinfo = $db->fetchArray($result);
			return $bannedinfo;
		}

	}
// Inserts a user who has been Discilined
	function insertbanneduser($banuser, $room, $ip, $type)
	{
				include_once("db.inc.php");
$db=new DB();
$db->open();
	$query= "INSERT INTO discipline (username, room, ip, type) VALUES ('$banuser', '$room', '$ip', '$type');";
	$result = $db->query($query);
	echo $query;

	}
	
	function main_log_insert($date,$time,$regusername,$unregusername,$ip,$agent,$requested,$querystring,$refering)
	{
// include_once("db.inc.php");
// 	$db=new DB();
// 	$db->open();
// $insert = "INSERT INTO sitelog (ip, referer, agent, query, name, guestname, room, date_time) VALUES ('$ip', '$refering', '$agent', '$querystring', '$regusername', '$unregusername', '$room', '$date,$time')";
// 			$result = $db->query($insert);
			
			$fp = fopen("./Chat/Logs/Site/$date.html", "a"); 
 fputs($fp, "<table width=100% border=0><tr><td>\n");
 fputs($fp, "$ip<BR>$date,$time<BR>\n");  
 fputs($fp, "From: $regusername</font> $unregusername<BR> $agent<BR> $querystring<BR> $room<BR>  </tr></td></table><hr>\n"); 
 flock($fp, 3);  
 fclose($fp);

	}
	
	function log_insert($date,$time,$regusername,$unregusername,$ip,$agent,$requested,$querystring,$refering,$room){
// include_once("db.inc.php");
// 	$db=new DB();
// 	$db->open();
// $insert = "INSERT INTO sitelog (ip, referer, agent, query, name, guestname, room, date_time) VALUES ('$ip', '$refering', '$agent', '$querystring', '$regusername', '$unregusername', '$room', '$date,$time')";
// 			$result = $db->query($insert);
$fp = fopen("./Chat/Logs/Site/$date.html", "a"); 
 fputs($fp, "<table width=100% border=0><tr><td>\n");
 fputs($fp, "$ip<BR>$date,$time<BR>\n");  
 fputs($fp, "From: $regusername</font> $unregusername<BR> $agent<BR> $querystring<BR> $room<BR>  </tr></td></table><hr>\n"); 
 flock($fp, 3);  
 fclose($fp);
	}		
}