<?PHP
/*
***************************************************
* DD-CCMS 2.5.2 Beta        01-07-2005       	  * 
* Written Kevin Brooker                           *
* DemonDezigns Copyright 2004-Present             *
***************************************************
*/
class userfuncs{
function userfuncs(){
///////////////////// SESSION AND COOKIES  \\\\\\\\\\\\\\\\\\\\\\\\\\
session_start();
if(!isset ($_COOKIE[username])){
$_SESSION[username] = '';
}
else{
$_SESSION[username] = $_COOKIE[username];
}
if(!isset ($_COOKIE[membergroup])){
$_SESSION[group] = '5';
}
else{
$_SESSION[group] = $_COOKIE[membergroup];
}

}

///////////////////// USER FUNCTIONS \\\\\\\\\\\\\\\\\\\\\\\\\\

///////////////////// REGISTRATION  \\\\\\\\\\\\\\\\\\\\\\\\\\	

///////////////////// Check if name is already regged  \\\\\\\\\\\\\\\\\\\\\\\\\\	
	function user_cookie_update($user,$date,$time,$ip)
	{
include_once("db.inc.php");
$db=new DB();
$db->open();
$lasttime = time()-300;
if(!isset($_COOKIE[username])){
	$registered = '0';
	$user = 'GUEST';
	}
	else{$registered = '1';
	}
		$query= "UPDATE `memberships` SET `lastlogin`='$date,$time', `lastip`='$ip' where username = '$user';";
		$result = $db->query($query);
$query1 = "SELECT * FROM memberships where username = '$user'";
$result1 = $db->query($query1);
$num_results1 = $db->numRows($result1);
			$info = $db->fetchArray($result1);
			setcookie ("username", "$user", time()+604800);
			setcookie ("useravatar", "$info[avatar]", time()+604800);
			setcookie ("membergroup", "$info[membergroup]", time()+604800);
			setcookie ("password", "$info[plainpass]", time()+604800);
			setcookie ("useravatar", "$info[avatar]", time()+604800);
			setcookie ("lastactive", "$date,$time", time()+604800);


$query4 = "SELECT * FROM activeusers";
$result4 = $db->query($query1);
$num_results4 = $db->numRows($result1);
for ($i=0; $i <$num_results4; $i++)
		{
$info2 = $db->fetchArray($result2);
if($lasttime > $info2[lastaction]){
	$query5 = "delete from activeusers where id = '$info2[id]';";
		$result5 = $db->query($query);
	}
	else{
	echo $info2[name];
	echo ' ';	
	}
	
}		
			
	}
	
function online_update($user,$ip){
		
include_once("db.inc.php");
$db=new DB();
$db->open();
$lastaction=time();
$timeout = time()-300;		
$select = "SELECT * FROM activeusers where ip = '$ip'";
$selected = $db->query($select);
$results = $db->numRows($selected);
$info1 = $db->fetchArray($selected);
if ($results >0){
$update= "UPDATE `activeusers` SET `lastaction`='$lastaction', `name`='$user' WHERE ip = '$ip'";
$updated = $db->query($update);	
}
else{
$insert = "INSERT INTO activeusers (name, ip, lastaction) VALUES ('$user', '$ip', '$lastaction');";
$inserted = $db->query($insert);	
}

		}
function online_timeout(){		
include_once("db.inc.php");
$db=new DB();
$db->open();
$timeout = time()-300;		
$delete = "delete from activeusers where lastaction < '$timeout';";
$deleted = $db->query($delete);	
}		

function check_new_user($username,$email,$password,$password1,$num_results)
	{
include_once("db.inc.php");
$db=new DB();
$db->open();
$query = "SELECT * FROM memberships where username = '$username'";
$result = $db->query($query);
$num_results = $db->numRows($result);
return $num_results;
}
//////////////// Members online \\\\\\\\\\\\\\\\\\\\    
function getusernames(){
	include_once("db.inc.php");
$db=new DB();
$db->open();
$query = "SELECT * FROM activeusers WHERE name != 'GUEST' ORDER BY lastaction";
		$result = $db->query($query);
		$num_results = $db->numRows($result);
    for ($i=0; $i <$num_results; $i++)
		{
			$row = $db->fetchArray($result);
			echo '<a href=' . $stcfg[RootDir] . '/?action=userprofile&userid=' . $row['name'] . '>';
			echo $row[name];
			echo '</a> ';
		}	
}
//////////////// guests online \\\\\\\\\\\\\\\\\\\\
function guestcount(){
		include_once("db.inc.php");
$db=new DB();
$db->open();
		$guestcount = "SELECT * FROM activeusers WHERE name = 'GUEST' ORDER BY lastaction";
		$guestcount1 = $db->query($guestcount);
		$guests = $db->numRows($guestcount1);
		if(!isset($guests)){$guests = '0';}
		echo 'Guests Online: <B>';
		echo $guests;
        echo '</B><BR>';
    }
//////////////// STATS \\\\\\\\\\\\\\\\\\\\
function get_stats() {	
include_once("db.inc.php");
$db=new DB();
$db->open();
//////////////// posts \\\\\\\\\\\\\\\\\\\\
function currentposts(){
	include_once("db.inc.php");
$db=new DB();
$db->open();
	$postcount = "SELECT * FROM posts";
		$postcount1 = $db->query($postcount);
		$posts = $db->numRows($postcount1);
		if(!isset($posts)){$posts = '0';}
		echo'Posts: <B>';
		echo $posts;
        echo '</B>';
    }
//////////////// Last post \\\\\\\\\\\\\\\\\\\\    
    function latestpost(){
	include_once("db.inc.php");
$db=new DB();
$db->open();
	$latestpost = "SELECT * FROM posts ORDER BY postid DESC LIMIT 1";
		$latest = $db->query($latestpost);
		$postinfo = $db->fetchArray($latest);
		if($postinfo[parentpost] < 1){
		echo 'Latest Post: <a href=';
		echo $stcfg[RootDir];
		echo '/?action=message&forum=';
		echo $postinfo[forumname];
		echo'&postid=';
		echo $postinfo[postid];
		echo '>';
		echo $postinfo[title];
		echo '</a>';
	}
	if($postinfo[parentpost] > 0){
		echo 'Latest Post: <a href=';
		echo $stcfg[RootDir];
		echo '/?action=message&forum=';
		echo $postinfo[forumname];
		echo'&postid=';
		echo $postinfo[parentpost];
		echo '>';
		echo $postinfo[title];
		echo '</a>';
	}
    }
//////////////// count members \\\\\\\\\\\\\\\\\\\\    
function currentmembers(){
	include_once("db.inc.php");
$db=new DB();
$db->open();
	$membercount = "SELECT * FROM memberships";
		$membercount1 = $db->query($membercount);
		$members = $db->numRows($membercount1);
		if(!isset($members)){$members = '0';}
		echo 'Members: <B>';
		echo $members;
        echo '</B>';
    }
//////////////// count members \\\\\\\\\\\\\\\\\\\\    
function currentproducts(){
	include_once("db.inc.php");
$db=new DB();
$db->open();
	$membercount = "SELECT * FROM products";
		$membercount1 = $db->query($membercount);
		$members = $db->numRows($membercount1);
		if(!isset($members)){$members = '0';}
		echo 'Products: <B>';
		echo $members;
        echo '</B>';
    }   
    //////////////// Last member \\\\\\\\\\\\\\\\\\\\    
    function latestproduct(){
	include_once("db.inc.php");
$db=new DB();
$db->open();
	$latestmember = "SELECT * FROM products ORDER BY id DESC LIMIT 1";
		$latest = $db->query($latestmember);
		$memberinfo = $db->fetchArray($result);
		echo'Latest Product: ';
		echo ' <a href=./?action=products&cat=' . $memberinfo['category'] . '&product=' . $memberinfo['id'] . '>';
			echo $memberinfo[product_name];
			echo '</a>';
    } 
//////////////// count members \\\\\\\\\\\\\\\\\\\\    
function currentcharacters(){
	include_once("db.inc.php");
$db=new DB();
$db->open();
	$charactercount = "SELECT * FROM Bios";
		$charactercount1 = $db->query($charactercount);
		$characters = $db->numRows($charactercount1);
		if(!isset($characters)){$characters = '0';}
		echo 'Total Characters: <B>';
		echo $characters;
        echo '</B>';
    }
//////////////// Last member \\\\\\\\\\\\\\\\\\\\    
    function latestmember(){
	include_once("db.inc.php");
$db=new DB();
$db->open();
	$latestmember = "SELECT * FROM memberships ORDER BY userid DESC LIMIT 1";
		$latest = $db->query($latestmember);
		$memberinfo = $db->fetchArray($result);
		echo'Latest Member: ';
		echo ' <a href=' . $stcfg[RootDir] . '/?action=userprofile&userid=' . $memberinfo['username'] . '>';
			echo $memberinfo[username];
			echo '</a>';
    }
//////////////// Members online \\\\\\\\\\\\\\\\\\\\    
function getusernames(){
	include_once("db.inc.php");
$db=new DB();
$db->open();
$query = "SELECT * FROM activeusers WHERE name != 'GUEST' ORDER BY lastaction";
		$result = $db->query($query);
		$num_results = $db->numRows($result);
    for ($i=0; $i <$num_results; $i++)
		{
			$row = $db->fetchArray($result);
			echo '<a href=' . $stcfg[RootDir] . '/?action=userprofile&userid=' . $row['name'] . '>';
			echo $row[name];
			echo '</a> ';
		}	
}
//////////////// guests online \\\\\\\\\\\\\\\\\\\\
function guestcount(){
		include_once("db.inc.php");
$db=new DB();
$db->open();
		$guestcount = "SELECT * FROM activeusers WHERE name = 'GUEST' ORDER BY lastaction";
		$guestcount1 = $db->query($guestcount);
		$guests = $db->numRows($guestcount1);
		if(!isset($guests)){$guests = '0';}
		echo 'Guests Online: <B>';
		echo $guests;
        echo '</B>';
    }

    function roomcount(){
		include_once("db.inc.php");
$db=new DB();
$db->open();
		$roomcount = "SELECT * FROM roomcfg";
		$roomcount1 = $db->query($roomcount);
		$rooms = $db->numRows($roomcount1);
		if(!isset($rooms)){$rooms = '0';}
		echo 'Chat Rooms:<B>';
		echo $rooms;
        echo '</B>';
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
		echo 'Users Chatting: <B>';
		echo $users;
        echo '</B>';
}
function lscount(){
		include_once("db.inc.php");
$db=new DB();
$db->open();
		$lscount = "SELECT * FROM login_accounts";
		$lscount1 = $db->query($lscount);
		$ls = $db->numRows($lscount1);
		if(!isset($ls)){$ls = '0';}
		echo 'LS Accounts:<B>';
		echo $ls;
        echo '</B>';
    }
    
function tooncount(){
		include_once("db.inc.php");
$db=new DB();
$db->open();
		$tooncount = "SELECT * FROM character_";
		$tooncount1 = $db->query($tooncount);
		$toons = $db->numRows($tooncountt1);
		if(!isset($toons)){$toons = '0';}
		echo 'Eqemu Characters:<B>';
		echo $toons;
        echo '</B>';
    }    
//////////////// output \\\\\\\\\\\\\\\\\\\\        
//         echo '<b>Member Stats:</b><br>';
//         currentmembers();
//         echo '<BR>';
//         latestmember();
echo '<b>Products:</b><br>';
        currentproducts();
        echo '<BR>';
        latestproduct();
        echo '<hr>';
        echo '<b>Forum Stats:</b><br>';
        currentposts();
        echo '<BR>';
        latestpost();
//         echo '<hr><b>Chat Stats:</b><br>';
//         total_count();
//         echo '<BR>';
//         roomcount();
//         echo '<br>';
//         currentcharacters();
//         if($sitetype = 'EQEMU'){
// 	    echo '<hr>';
//         echo 'EQEmu Server Stats';
//         echo '<BR>';
//         lscount();
//         echo '<br>';
//         tooncount();
    //}
//         echo '<hr><b>Users Online:</b><br>';
//         guestcount();
//         echo '<BR> Members online:';
//         getusernames(); 
        
//         echo '<table width=100%><tr>';
//         echo '<td valign=top align=center>';
//         echo '<b>Member Stats:</b><br>';
//         currentmembers();
//         echo '<Br>';
//         latestmember();
//         echo '</td>';
//         echo '<td valign=top align=center>';
//         echo '<b>Forum Stats:</b><br>';
//         currentposts();
//         echo '<BR>';
//         latestpost();
//         echo '</td>';
//         echo '<td valign=top align=center>';
//         echo '<b>Chat Stats:</b><br>';
//         total_count();
// //         echo '<BR>';
// //         roomcount();
//         echo '<BR>';
//         currentcharacters();
//         echo '</td>';
//         echo '</tr>';
//     	echo '</table>';      
    }
/////////////////////// if they arent trying to use an already regged name insert their data \\\\\\\\\\\\\\\\\\\\\\
function insert_new_user($username,$email,$password,$password1){
include_once("db.inc.php");
$db=new DB();
$db->open();	
$query= "INSERT INTO memberships (username, password, plainpass, email, membergroup) VALUES ('$username', '$password', '$password1', '$email', '4');";
$result = $db->query($query);			
	}
function insert_new_submission($fromusername,$email,$subject,$message){
include_once("db.inc.php");
$db=new DB();
$db->open();	
$query= "INSERT INTO submissions (fromusername, fromemail, subject, message) VALUES ('$fromusername', '$email', '$subject', '$message');";
$result = $db->query($query);			
	}	
	
function insert_new_private($fromusername,$tousername,$subject,$message){
include_once("db.inc.php");
$db=new DB();
$db->open();	
$query= "INSERT INTO private (tousername, fromusername, subject, message) VALUES ('$tousername', '$fromusername', '$subject', '$message');";
$result = $db->query($query);			
	}
	
	function get_private($username){
include_once("db.inc.php");
$db=new DB();
$db->open();
$query = "SELECT * FROM private WHERE tousername = '$username'";
$result = $db->query($query);
while($row = $db->fetchArray($result)) {  
    echo '<li><a href="/?pm=' . $row[privateid] . '">' . $row[subject] . '</a> ~~ From: ' . $row[fromusername] . '</li>';
}  
	}	

///////////////////// Login \\\\\\\\\\\\\\\\\\\\\\\\\\
	
function login($username, $userinfo){
include_once("db.inc.php");
$db=new DB();
$db->open();
$query = "SELECT * FROM memberships where username = '$username'";
$result = $db->query($query);
$num_results = $db->numRows($result);
$userinfo = $db->fetchArray($result);
			return $userinfo;	
}


///////////////////// Get users account info \\\\\\\\\\\\\\\\\\\\\\\\\\
function account_info($user, $info){
include_once("db.inc.php");
$db=new DB();
$db->open();

$query = "SELECT * FROM memberships where username = '$user'";
$result = $db->query($query);
$num_results = $db->numRows($result);
			$info = $db->fetchArray($result);
			return $info;
return $info;	
}
///////////////////// Update Member account information \\\\\\\\\\\\\\\\\\\\\\\\\\

function update_info($username, $password, $plainpass,$email,$oldname,$avatar,$birthday,$msn,$icq,$yahoo,$aim,$homepage,$intrests)
	{
		include_once("db.inc.php");
$db=new DB();
$db->open();
		$query= "UPDATE `memberships` SET `username`='$username', `password`='$password', `plainpass`='$plainpass', `email`='$email', `avatar`='$avatar', `birthday`='$birthday', `msn`='$msn', `icq`='$icq', `yahoo`='$yahoo', `aim`='$aim', `homepage`='$homepage', `intrests`='$intrests' where username = '$oldname';";
		$result = $db->query($query);
	}
///////////////////// CHARACTER BIO FUNCTONS \\\\\\\\\\\\\\\\\\\\\\\\\\
	
///////////////////// Retrieve list of users bios \\\\\\\\\\\\\\\\\\\\\\\\\\
	function get_bios($user) {
		include_once("db.inc.php");
$db=new DB();
$db->open();
		echo'<table width="100%" border="1" cellspacing="1" cellpadding="1">
  <tr> 
    <td width="59%"><div align="center">Character Name</div></td>    
    <td colspan="2"><div align="center">Action</div></td>
  </tr>';
		$query = "SELECT * FROM Bios where username='$user' ORDER BY bioid";
		$result = $db->query($query);
		$num_results = $db->numRows($result);

		for ($i=0; $i <$num_results; $i++)
		{
			$row = $db->fetchArray($result);
			echo'<tr> <td><li><a href=' . $stcfg[RootDir] . '/?userbio=' . $row['bioname'] . '>';
			echo $row['bioname'];
			echo'</a></li></td>';
			echo'<td width="16%">
				<a href="delbio.php?bio=';
			echo $row['bioname'];
			echo'">Delete</a></td>';
			echo '<td width="25%">';
			echo'<a href="edbio.php?bio=';
			echo $row['bioname'];
			echo '">Edit';
			echo '</a></td></tr>';
		}
		
		echo '</table>';
	}
	
///////////////////// Get the info of a BIO \\\\\\\\\\\\\\\\\\\\\\\\\\	
	function get_bio_info($bioname, $bioinfo){
		include_once("db.inc.php");
$db=new DB();
$db->open();
		$query = "SELECT * from Bios where bioname = '$bioname'";
		$result = $db->query($query);
		$bioinfo = $db->fetchArray($result);
		return $bioinfo;
	}
	
///////////////////// Create Character Bio \\\\\\\\\\\\\\\\\\\\\\\\\\	
	function insert_bio($bioname, $content, $user){
include_once("db.inc.php");
$db=new DB();
$db->open();
		$query = "INSERT INTO Bios (username, bioname, content) VALUES ('$user', '$bioname', '$content');";
$result = $db->query($query);
}	

///////////////////// Retrieve Ccharacter Bio \\\\\\\\\\\\\\\\\\\\\\\\\\
	function get_user_bio($userbio, $biocontent){
		include_once("db.inc.php");
$db=new DB();
$db->open();
		$query = "SELECT * from Bios where bioname = '$userbio'";
		$result = $db->query($query);
		$biocontent = $db->fetchArray($result);
			include './skin/users/userbio.html';
	}
	
		function get_pm($pm, $pmcontent){
		include_once("db.inc.php");
$db=new DB();
$db->open();
		$query = "SELECT * from private where privateid = '$pm'";
		$result = $db->query($query);
		$pmcontent = $db->fetchArray($result);
			include './skin/users/pm.html';
	}
	
///////////////////// Update Character Bio \\\\\\\\\\\\\\\\\\\\\\\\\\	
	function update_bio($bioname, $content,$oldname)
	{
include_once("db.inc.php");
$db=new DB();
$db->open();
		$query= "UPDATE `Bios` SET `bioname`='$bioname', `content`='$content' where bioname = '$oldname';";
		$result = $db->query($query);
	}
	
///////////////////// Delete Bio \\\\\\\\\\\\\\\\\\\\\\\\\\	
function delete_bio($bioname){
include_once("db.inc.php");
$db=new DB();
$db->open();
		$query = "delete from Bios where bioname = '$bioname';";
		$result = $db->query($query);
	}	
/////////////////////////////////////////////////////
	
function memblist() {
		include_once("db.inc.php");
$db=new DB();
$db->open();
		echo'<CENTER> MEMBERS:<BR><table width="100%" border="o" cellspacing="1" cellpadding="1">';
		$query = "SELECT * FROM memberships ORDER BY userid";
		$result = $db->query($query);
		$num_results = $db->numRows($result);

		for ($i=0; $i <$num_results; $i++)
		{
			$row = $db->fetchArray($result);
			echo'<tr> <td><li><a href=' . $stcfg[RootDir] . '/?action=userprofile&userid=' . $row['username'] . '>';
			echo $row['username'];
			echo'</a></li></td></tr>';
		}
		
		echo '</table>';
	}
function characters($user) {
		include_once("db.inc.php");
$db=new DB();
$db->open();
		echo'<CENTER> CHARACTERS PLAYED:<BR><table width="100%" border="o" cellspacing="1" cellpadding="1">';
		$query = "SELECT * FROM Bios where username='$user' ORDER BY bioid";
		$result = $db->query($query);
		$num_results = $db->numRows($result);

		for ($i=0; $i <$num_results; $i++)
		{
			$row = $db->fetchArray($result);
			echo'<tr> <td><li><a href=' . $stcfg[RootDir] . '/?userbio=' . $row['bioname'] . '>';
			echo $row['bioname'];
			echo'</a></li></td></tr>';
		}
		
		echo '</table>';
	}
	
}
///////////////////// Retrieve list of users bios \\\\\\\\\\\\\\\\\\\\\\\\\\
	
?>