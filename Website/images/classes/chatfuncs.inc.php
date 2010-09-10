<?php
/*
***************************************************
* DD-CCMS 2.5.2 Beta        01-07-2005       	  * 
* Written Kevin Brooker                           *
* DemonDezigns Copyright 2004-Present             *
***************************************************
*/
class chatfuncs
{

	function chatfuncs()
	{

	}
	
// gets config values for Selected room
	function get_room_config($chat_room, $rmcfg)
	{
				include_once("db.inc.php");
$db=new DB();
$db->open();
		$query = "SELECT * from roomcfg where RoomName = '$chat_room'";
		$result = $db->query($query);
		$rmcfg = $db->fetchArray($result);
//
//
//
		return $rmcfg;
	}
// gets the room cascading style sheet values	
	function display($display,$chat_room) {
				include_once("db.inc.php");
$db=new DB();
$db->open();
		$DEBUG = 0;
		$query = "SELECT * FROM RoomDisplay where RoomName = '$chat_room'";
		$result = $db->query($query);
		$num_results = $db->numRows($result);
		$display = $db->fetchArray($result);
			return $display;
			
	}
	
	function reg_login($username, $userinfo){		
		include_once("db.inc.php");
$db=new DB();
$db->open();

$query = "SELECT * FROM memberships where username = '$username'";
$result = $db->query($query);
$num_results = $db->numRows($result);
$userinfo = $db->fetchArray($result);
			return $userinfo;	
}
function unreg_login($username, $members){
			include_once("db.inc.php");
$db=new DB();
$db->open();
$query = "SELECT * FROM memberships where username = '$username'";
$result = $db->query($query);
$members = $db->numRows($result);
return $members;
}
function bio_check($username, $bios){
			include_once("db.inc.php");
$db=new DB();
$db->open();
$query = "SELECT * FROM Bios where bioname = '$username'";
$result = $db->query($query);
$bios = $db->numRows($result);
return $bios;
}
function bio_check1($username,$chatname,$bios){
			include_once("db.inc.php");
$db=new DB();
$db->open();
$query = "SELECT * FROM Bios where bioname = '$chatname' and username !='$username'";
$result = $db->query($query);
$bios = $db->numRows($result);
return $bios;
}
function insert_online_user($chat_room, $username1, $chatname2, $ip, $registered){
include_once("db.inc.php");
$db=new DB();
$db->open();  
$lastaction = time();
$insert="INSERT INTO room_online (lastaction, room, username, changename, ip, registered) VALUES ('$lastaction', '$chat_room', '$username1', '$chatname2', '$ip' , '$registered');";
$result = $db->query($insert);
	}

// Gets whisper box
function get_room_user_list($chat_room){
include_once("db.inc.php");
$db=new DB();
$db->open();
$query = "SELECT * FROM room_online where room = '$chat_room'";
$result = $db->query($query);
while($row = $db->fetchArray($result)) {  
    echo '<option value="' . $row[changename] . '">' . $row[changename] . '</option>';
}  
	}
	
	// Gets whisper box
function get_roomlist($chat_room){
include_once("db.inc.php");
$db=new DB();
$db->open();
$query = "SELECT * FROM Roomcfg";
$result = $db->query($query);
while($row = $db->fetchArray($result)) {  
    echo '<option value="' . $row[RoomName] . '">' . $row[RoomName] . '</option>';
}  
	}

// Inserts the Messages into the table
function insert_message($chat_room,$changename,$to,$avatar,$ip,$message,$attitudes,$actions,$namecolor,$namesize,$nametype,$stcfg,$roomcfg,$scenefont,$messcolor,$messsize){
include_once("db.inc.php");
$db=new DB();
$db->open();  
$timemess = time();
$message_date = date('m-j-Y');
$message_time = date('H:i A');
$day = date('j');
$messdatetime = "$message_date , $message_time";
$post="INSERT INTO chat_messages (room, user_to, user_from, avatar, message, ip, messagetime, date_time,attitude, action, namecolor, namesize, nametype, scenefont, messagecol, messagesize) VALUES ('$chat_room', '$to', '$changename', '$avatar', '$message', '$ip', '$timemess', '$messdatetime', '$attitudes', '$actions', '$namecolor', '$namesize', '$nametype', '$scenefont', '$messcolor', '$messsize');";
			$result = $db->query($post);

 $fp = fopen("$stcfg[GlassDir]/Logs/$roomcfg[RoomDir]/$day.html", "a"); 
 fputs($fp, "<table width=100% border=0><tr><td>\n");
 fputs($fp, "$ip<BR>\n");  
 fputs($fp, "From: <font color=$namecolor size=$namesize face=$nametype>$changename</font> $attitudes $messdatetime SAYS TO: $to <BR> $actions<BR> $scenefont $message  </tr></td></table><hr>\n"); 
 flock($fp, 3);  
 fclose($fp);

 if($to == 'ALL'){	
 $fp = fopen("$stcfg[GlassDir]/$roomcfg[RoomDir]/$day.html", "a"); 
 fputs($fp, "<table width=100% border=0><tr><td>\n");  
 fputs($fp, "From: <font color=$namecolor size=$namesize face=$nametype>$changename</font> $attitudes $messdatetime SAYS TO: $to <BR> $actions<BR> $scenefont $message  </tr></td></table><hr>\n"); 
 flock($fp, 3);  
 fclose($fp);
 }	
	}

// Gets the Messages for a specified room and user
function get_messages($chat_room, $changename,$roomcfg,$images,$oldmessages,$stcfg) {
include_once("db.inc.php");
$db=new DB();
$db->open();
function getignored($user,$changename,$ignored){
	include_once("db.inc.php");
$db=new DB();
$db->open();
$query = "SELECT * FROM ignored where ignored = '$user' and user = '$changename'";
$result = $db->query($query);
$num_results = $db->numRows($result);

	$ignored = $num_results;
	 return $ignored;
}
function getbioinfo($user,$namecolor,$nametype,$namesize){
	include_once("db.inc.php");
$db=new DB();
$db->open();
$query = "SELECT * FROM Bios where bioname = '$user'";
$result = $db->query($query);
$row=$db->fetchArray($result);
$num_results = $db->numRows($result);
if($num_results == '0'){
	echo '<font color="' . $namecolor . '" face="' . $nametype . '" size="' . $namesize . '">';
	echo $user;
	echo '</font>';
}
else{
	 echo '<a target=_bio href=' . $stcfg[RootDir] . '/?userbio=' . $user . '><font color="' . $namecolor . '" face="' . $nametype . '" size="' . $namesize . '">' . $user . '</a></font>';
}
}
$query = "SELECT * FROM chat_messages where room = '$chat_room' order by id DESC LIMIT $oldmessages";
$result = $db->query($query);
while ($row=$db->fetchArray($result)) {
	$ignored = getignored($row[user_from],$changename,$ignored);
	//echo $ignored;
	if($ignored >'0'){
	echo'';
	}
	else{
		if($chat_room != $row[room]){echo '';}
if($row['id'] > $_COOKIE['lastread' . $chat_room . '']){
	$new = $roomcfg['new'];
}
else {$new = '';}

	echo $new;
if($row[user_to] == 'ALL'){
echo '<table width="100%"  border="0"><tr><td colspan="2"><font size=3><B>From:';
echo getbioinfo($row[user_from],$row[namecolor],$row[nametype],$row[namesize]);;
echo '</font> ' . $row[attitude] . ' ' . $row[date_time] . ' Says to: ALL <a href=#topdoc>Top</a></font></B></td></tr>';

if($_SESSION[group] == '1' or $_SESSION[group] == '2'){
		echo '<tr><td colspan="2">' . $row[ip] . ' <a target=ban href=' . $stcfg[RootDir] . '/?action=ipban&ip=' . $row[ip] . '>BAN USER</a> | <a target=gag href=' . $stcfg[RootDir] . '/?action=sitegag&ip=' . $row[ip] . '>Gag USER</a></td></tr>';}
echo'<tr><td>';
	
echo'<tr><td width="12%" valign="top">';
if($row[avatar] != '' and $images =='on'){
	echo '<img src=' . $row[avatar] . ' width="80" height="95"></td><td width="88%" valign="top">';
}
echo'' . $row[action] . '<BR> 
' . $roomcfg[messagetext] . '
<font color="' . $row[messagecol] . '" size="' . $row[messagesize] . '">
' . $row[scenefont] . '' . $row[message] . '</font></td></tr></table>';
echo '</font><hr></td></tr></table>';
}
elseif($row[user_to] == $changename or $row[user_from] == $changename){
echo '<table width="100%"  border="0"><tr><td colspan="2"><font size=+2 color=red>~~PRIVATE MESSAGE~~</font><BR><font size=3><B>From: ';
echo getbioinfo($row[user_from],$row[namecolor],$row[nametype],$row[namesize]);;
echo '</font> ' . $row[attitude] . ' ' . $row[date_time] . ' Says to: ';
echo getbioinfo($row[user_to],$row[namecolor],$row[nametype],$row[namesize]);;
echo ' <a href=#topdoc>Top</a></font></B></td></tr>';

if($_SESSION[group] == '1' or $_SESSION[group] == '2'){
	echo '<tr><td colspan="2">' . $row[ip] . ' <a target=ban href=' . $stcfg[RootDir] . '/?action=ipban&ip=' . $row[ip] . '>BAN USER</a> | <a target=gag href=' . $stcfg[RootDir] . '/?action=sitegag&ip=' . $row[ip] . '>Gag USER</a></td></tr>';}
echo'<tr><td width="12%" valign="top">';
if($row[avatar] != '' and $images =='on'){
	echo '<img src=' . $row[avatar] . ' width="80" height="95"></td><td width="88%" valign="top">';
}
echo'' . $row[action] . '<BR> ' . $roomcfg[messagetext] . '
<font color="' . $row[messagecol] . '" size="' . $row[messagesize] . '">
' . $row[scenefont] . '' . $row[message] . '</font></td></tr></table>';
echo '</font><hr>';		
}
else{echo '';}
} 
}
}
function userlist($room){
include_once("db.inc.php");
$db=new DB();
$db->open();
$query = "SELECT * FROM room_online where room = '$room'";
$result = $db->query($query);
while($row = $db->fetchArray($result)) { 

echo '<li> ' . $row[changename] . '';
if($_SESSION[group] == '1'){echo '~~ ' . $row[ip] . '';}
echo '</li>'; 
}  
}

function room_count($room){
include_once("db.inc.php");
$db=new DB();
$db->open();
$query = "SELECT * FROM room_online where room = '$room'";
$result = $db->query($query);
$num_results = $db->numRows($result);
if($num_results == '0'){
	$users = '0';
}
else{
	 $users = $num_results;
}
echo $users;
}

function total_count(){
include_once("db.inc.php");
$db=new DB();
$db->open();
$query = "SELECT * FROM room_online";
$result = $db->query($query);
$num_results = $db->numRows($result);
if($num_results == '0'){
	$users = '0';
}
else{
	 $users = $num_results;
}
echo $users;
}	

function deleteonline($changename){
include_once("db.inc.php");
$db=new DB();
$db->open();
$query = "DELETE FROM room_online where changename = '$changename'";
$result = $db->query($query);
}
function deleteignore($changename){
include_once("db.inc.php");
$db=new DB();
$db->open();
$query = "DELETE FROM ignored where user = '$changename'";
$result = $db->query($query);
}
function online_timeout($changename){		
include_once("db.inc.php");
$db=new DB();
$db->open();
$timeout = time()-600;		
$delete = "delete from room_online where lastaction < '$timeout' and changename != '$changename';";
$deleted = $db->query($delete);	
}	
function online_update($changename,$chat_room){
		
include_once("db.inc.php");
$db=new DB();
$db->open();
$lastaction=time();
$update= "UPDATE `room_online` SET `lastaction`='$lastaction' WHERE changename = '$changename' and room = '$chat_room'";
$updated = $db->query($update);
}
function prune_messages(){		
include_once("db.inc.php");
$db=new DB();
$db->open();
$timeout = time()-7200;		
$delete = "delete from chat_messages where messagetime < '$timeout';";
$deleted = $db->query($delete);	
}	

function lastread($chat_room, $changename){
	include_once("db.inc.php");
$db=new DB();
$db->open();
$query = "SELECT * FROM chat_messages where room = '$chat_room' AND user_to = 'ALL'  OR user_to = '$changename' OR user_from = '$changename' order by id DESC LIMIT 1";
$result = $db->query($query);
$row=$db->fetchArray($result);
if($row['id'] > $_COOKIE['lastread' . $chat_room . '']){
setcookie ("lastread$row[room]", "$row[id]", time()+604800);
}
}
function insert_ignore($changename, $ignore){
include_once("db.inc.php");
$db=new DB();
$db->open();  
$lastaction = time();
$insert="INSERT INTO ignored (user, ignored) VALUES ('$changename', '$ignore');";
$result = $db->query($insert);
	}
	
///////////////////// BANNING  \\\\\\\\\\\\\\\\\\\\\\\\\\
///////////////////// insert a global ban  \\\\\\\\\\\\\\\\\\\\\\\\\\	
	function insert_global_ban($banip)
	{	
	include_once("db.inc.php");
	$db=new DB();
	$db->open();
	$query= "INSERT INTO banned (bannedip) VALUES ('$banip');";
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

///////////////////// Room banning  \\\\\\\\\\\\\\\\\\\\\\\\\\	
	function getbanned($roomname,$ip) {
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
			if(strstr($ip, $row[bannedip])){
				$query = "delete from online where username = '$username';";
				echo'Youve Been banned from this room';
				exit;
			}
			
	}
	}
///////////////////// Room banning  \\\\\\\\\\\\\\\\\\\\\\\\\\	
	function getsilenced($roomname,$ip,$silenced) {
			include_once("db.inc.php");
	$db=new DB();
	$db->open();
				$query = "SELECT * from roomgag WHERE gaggedfrom = '$roomname'";
				$result = $db->query($query);
		$num_results = $db->numRows($result);
		if ($DEBUG) echo $query . "<br>\n";
		if ($DEBUG) echo('Invalid query: ' . mysql_error() . "<br>\n");
		for ($i=0; $i <$num_results; $i++)
		{
			$row = $db->fetchArray($result);
			if(strstr($ip, $row[gaggedip])){
$silenced = '1';
			}
			
	}
	return $silenced;
	}	
///////////////////// Insert a room ban  \\\\\\\\\\\\\\\\\\\\\\\\\\	
		function insert_room_ban($ip,$room)
	{	include_once("db.inc.php");
	$db=new DB();
	$db->open();
			$query= "INSERT INTO roomban (Roomname, ip) VALUES ('$room', '$ip');";
			$result = $db->query($query);
	}	
///////////////////// Insert a room ban  \\\\\\\\\\\\\\\\\\\\\\\\\\	
		function insert_room_gag($ip,$room)
	{	include_once("db.inc.php");
	$db=new DB();
	$db->open();
			$query= "INSERT INTO roomgag (gaggedfrom, gaggedip) VALUES ('$room', '$ip');";
			$result = $db->query($query);
			$DEBUG = 0;
	}	
	// end of class
	
}

?>