<?PHP
/*
***************************************************
* DD-CCMS 2.5.2 Beta        01-07-2005       	  * 
* Written Kevin Brooker                           *
* DemonDezigns Copyright 2004-Present             *
***************************************************
*/
class forumfuncs{

function forumfuncs(){
}
///////////////////// Search pages \\\\\\\\\\\\\\\\\\\\\\\\\\
 function forum($forum){
include_once("db.inc.php");
	$db=new DB();
	$db->open();

function countreplies($rowid, $replies_count1){
include_once("db.inc.php");
$db=new DB();
$db->open();

$query1="SELECT * FROM posts WHERE parentpost='$rowid'";
$result1 = $db->query($query1);
$replies_count1 = $db->numRows($result1);
if(!isset($replies_count1)){$replies_count1 = 0;}
return $replies_count1;
   }
$query = "SELECT * FROM posts WHERE forumname ='$forum' and parentpost = '0' ORDER BY postid DESC";
$result = $db->query($query);
$num_results = $db->numRows($result);
		
if($num_results < 1){echo ' No messages have been posted yet';}

while($row=$db->fetchArray()){
$replies_count = countreplies($row[postid],$replies_count1);
	include './skin/boards/forumbit.html';
}
}
 ///////////////////// Search pages \\\\\\\\\\\\\\\\\\\\\\\\\\
function forums(){
	include_once("db.inc.php");
	$db=new DB();
	$db->open();
	function forummods($value){
			include_once("db.inc.php");
	$db=new DB();
	$db->open();
		$query2="SELECT * FROM Bios WHERE bioname = '$value'";
$result2 = $db->query($query2);
$num_results2 = $db->numRows($result2);

if ($num_results2 = 1){
echo '<a href=/?userbio=' . $value . '>' . $value . '</a> ';
}
elseif($num_results2 < 1){
print "$value "; 
}

}

function getlatest($forum, $latestpostinfo){
	include_once("db.inc.php");
$db=new DB();
$db->open();
	$latest="SELECT * FROM posts WHERE forumname ='$forum' and parentpost='0' order by datetime DESC limit 1";
$latestresult = $db->query($latest);
$last_count1 = $db->numRows($latestresult);
$latestpostinfo=$db->fetchArray();
return $latestpostinfo;
}

	function countposts($rowid, $replies_count1){
	include_once("db.inc.php");
	$db=new DB();
	$db->open();
	$query1="SELECT * FROM posts WHERE forumname='$rowid'";
	$result1 = $db->query($query1);
	$replies_count1 = $db->numRows($result1);
	if(!isset($replies_count1)){$replies_count1 = 0;}
	return $replies_count1;
   }
   
   
function childboards($catid){
	
include_once("db.inc.php");
$db=new DB();
$db->open();
 
   	
$query1="SELECT * FROM forums WHERE parentforum = '$catid' ORDER BY forumorder";
$result1 = $db->query($query1);
$num_results1 = $db->numRows($result1);		
while ($row1=$db->fetchArray($result1)) {

$latestpost = getlatest($row1[forumid], $latestpostinfo);
if(!isset($latestpost[title])){
$lasttitle = 'N/A';}
else{$lasttitle = '<a href=' . $stcfg[RootDir] . '/?action=message&forum=' . $row1[forumid] . '&postid=' . $latestpost[postid] . '>' . $latestpost[title] . '</a>';}
if(!isset($latestpost[datetime])){$lastdate = 'N/A';}
else{$lastdate = $latestpost[datetime];}
$replies_count = countposts($row1[forumid],$replies_count1);
$value_array = explode(',',$row1[usergroup]);

while(list(,$value) = each($value_array)) {
	if($value == $_SESSION[group] || $value == '5'){
		$permission = '1';}
		else {$permission = '0';}
	}

if ($permission == '1' || $_SESSION['group'] == '1'){
				echo '<tr> <td valign="top" class="alt2" width="52%"><LI> <a href="' . $stcfg[RootDir] . '/?action=forum&forum=' . $row1[forumid] . '">' . $row1[forumname] . '</a><BR>' . $row1[descrip] . '<BR>Moderators:';
if(empty($row1[moderators])){
}
else {
$value_array = explode(',',$row1[moderators]);
while(list(,$value) = each($value_array)) {
forummods($value);
}
}

echo'</td><td valign="top" class="alt1" width="12%">' . $replies_count . '</td><td valign="top" class="alt2" width="12%">' . $lasttitle . '</td></tr> ';

}
elseif ($permission != '1' || $_SESSION['group'] != '1'){
				echo'';
			}

						} 
						echo '</table><P>'; 
}
   
$query = "SELECT * FROM forumcats ORDER BY catorder";
$result = $db->query($query);
while ($row=$db->fetchArray($result)) {
$value_array = explode(',',$row[usergroup]);
while(list(,$value) = each($value_array)) {
	if($value == $_SESSION[group] || $value == '5'){
		$permission = '1';}
		else {$permission = '0';}
	}
if ($permission == '1' || $_SESSION['group'] == '1'){
		echo'<table width="100%" border="0" align="center" bordercolor="#333333" cellspacing=0><tr><td valign="top" class="tcat" colspan="3">: ' . $row[catname] . ' :</td></tr>';
childboards($row[catid]);
}

elseif ($permission != '1' || $_SESSION['group'] != '1'){
				echo'';
			}
}
echo '<BR><BR>';
 }
 ///////////////////// Search pages \\\\\\\\\\\\\\\\\\\\\\\\\\
 function post($forum,$postid){
	 		include_once("db.inc.php");
	$db=new DB();
	$db->open();

	function postbio($changename,$bio){
	 		include_once("db.inc.php");
	$db=new DB();
	$db->open();
$query1 = "SELECT * FROM Bios WHERE bioname ='$changename'";
$result1 = $db->query($query1);
$num_results1 = $db->numRows($result1);
$bio=$db->fetchArray($result1);
return $bio;
	}
$query = "SELECT * FROM posts WHERE forumname ='$forum' and parentpost = '0' and postid = '$postid'";
		$result = $db->query($query);
		$num_results = $db->numRows($result);
$row=$db->fetchArray($result);
if($row[registered] == '1' and $row[username] != $row[changename]){
	$bio1 = postbio($row[changename],$bio);
}
if($row[registered] == '1' and $row[username] == $row[changename]){
	$posthandle = "<a href=/?action=userprofile&userid=$row[changename]>$row[changename]</a>";}
if ($bio1[bioname] == $row[changename]){
$posthandle = "<a href=/?userbio=$row[changename]>$row[changename]</a>";}
elseif($row[registered] == '1' and $row[username] == $row[changename]){
	$posthandle = "<a href=/?action=userprofile&userid=$row[changename]>$row[changename]</a>";}	
else{$posthandle = $row[changename];}
if ($row[registered] == '0'){
$posthandle = $row[changename];}

include './skin/boards/messagebit.html'; 
}

	function get_replies($forum,$postid){
	include_once("db.inc.php");
	$db=new DB();
	$db->open();
		function replybio($changename,$bio){
	 		include_once("db.inc.php");
	$db=new DB();
	$db->open();
$query1 = "SELECT * FROM Bios WHERE bioname ='$changename'";
$result1 = $db->query($query1);
$num_results1 = $db->numRows($result1);
$bio=$db->fetchArray($result1);
return $bio;
	}
		$query = "SELECT * from posts where parentpost = '$postid' ORDER BY postid ASC";
		$result = $db->query($query);
		$num_results = $db->numRows($result);
for ($i=0; $i <$num_results; $i++)
		{
			$row=$db->fetchArray($result);
			if($row[registered] == '1' and $row[username] != $row[changename]){
	$bio1 = replybio($row[changename],$bio);
}
if($row[registered] == '1' and $row[username] == $row[changename]){
	$posthandle = "<a href=/?action=userprofile&userid=$row[changename]>$row[changename]</a>";}
if ($bio1[bioname] == $row[changename]){
$posthandle = "<a href=/?userbio=$row[changename]>$row[changename]</a>";}
elseif($row[registered] == '1' and $row[username] == $row[changename]){
	$posthandle = "<a href=/?action=userprofile&userid=$row[changename]>$row[changename]</a>";}	
else{$posthandle = $row[changename];}
if ($row[registered] == '0'){
$posthandle = $row[changename];}
			include './skin/boards/replybit.html';
		 }
	 }
	 
function insert_post($forum, $username, $title, $content, $date, $time, $ip,$avatar,$reg,$changename){
	include_once("db.inc.php");
	$db=new DB();
	$db->open();
$query= "INSERT INTO posts (forumname, title, content, username, datetime, ip, avatar, registered, changename) VALUES ('$forum', '$title', '$content', '$username', '$date , $time', '$ip', '$avatar', '$reg', '$changename');";
			$result = $db->query($query);	
}	 

function insert_reply($forum, $username, $title, $content, $date, $time, $ip,$avatar,$reg,$changename, $parent){
		include_once("db.inc.php");
	$db=new DB();
	$db->open();
$query= "INSERT INTO posts (forumname, title, content, username, parentpost, datetime, ip, avatar, registered, changename) VALUES ('$forum', '$title', '$content', '$username', '$parent', '$date , $time', '$ip', '$avatar', '$reg', '$changename');";
			$result = $db->query($query);	
}
function get_shouts(){
include_once("db.inc.php");
$db=new DB();
$db->open();
	
$query1="SELECT * FROM shoutposts ORDER BY shoutid DESC";
$result1 = $db->query($query1);
$num_results1 = $db->numRows($result1);		
while ($row1=$db->fetchArray($result1)) {
	if($row1['name'] == 'GUEST'){
		echo'<li>' . $row1[name] . '</li><BR>' . $row1[message] . '<hr>';
}
else{		
echo'<li><a href=' . $stcfg[RootDir] . '/?action=userprofile&userid=' . $row1['name'] . '>' . $row1[name] . '</a></li><BR>' . $row1[message] . '<hr>';	
}
}
	
	}
function insert_shout($name, $content, $date, $time){
include_once("db.inc.php");
$db=new DB();
$db->open();
$query= "INSERT INTO shoutposts (name, message, datetime) VALUES ('$name', '$content', '$date , $time');";
			$result = $db->query($query);	
}

	
function forummods($username,$forum,$ismod2){
			include_once("db.inc.php");
	$db=new DB();
	$db->open();
	
function checkmods($value,$username,$forum,$ismod1){
				include_once("db.inc.php");
	$db=new DB();
	$db->open();
		$query2="SELECT * FROM Bios WHERE username = '$username' and bioname = '$value'";
$result2 = $db->query($query2);
$num_results2 = $db->numRows($result2);
//echo $num_results2;
if ($num_results2 > 0){
	$ismod1 = 1;
	setcookie ("forum$forum", "moderator$forum", time()+604800);
}
elseif ($num_results2 < 1) {
$ismod1 = 0;
	}
return $ismod1;
		}
		
$query1="SELECT * FROM forums WHERE forumid = '$forum'";
$result1 = $db->query($query1);
$num_results1 = $db->numRows($result1);		
$row1=$db->fetchArray($result1);
$value_array = explode(',',$row1[moderators]);
while(list(,$value) = each($value_array)) { 
$ismod2 = checkmods($value, $username,$forum, $ismod1);
//echo $ismod2;
return $ismod2;
}
}
}
?>