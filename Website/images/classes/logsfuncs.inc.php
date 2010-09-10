<?PHP
/*
***************************************************
* DD-CCMS 2.5.2 Beta        01-07-2005       	  * 
* Written Kevin Brooker                           *
* DemonDezigns Copyright 2004-Present             *
***************************************************
*/
class logfuncs{

function logfuncs(){

}
function put_stats($ip,$browser,$refering){
	include_once("db.inc.php");
$db=new DB();
$db->open();
$sql = "INSERT INTO table_name(refer,ip,browser,recieved) VALUES('$refering','$ip','$browser',now())";  
$result = $db->query($sql);
}
///////////////////// View LOGS \\\\\\\\\\\\\\\\\\\\\\\\\\
		function get_main_log() {
		$DEBUG = 0;
		$query = "SELECT * FROM sitelog GROUP BY ip order by logid";
		$result = mysql_query($query);
		$num_results = mysql_num_rows($result);
		if ($DEBUG) echo $query . "<br>\n";
		if ($DEBUG) echo('Invalid query: ' . mysql_error() . "<br>\n");
		for ($i=0; $i <$num_results; $i++)
		{
			$row = mysql_fetch_array($result);
			echo '<li>';
			echo $row[name];
			echo ' -- ';
			echo $row[date_time];
			echo '<a href=/?action=fulliplog&ip=';
			echo $row[ip];
			echo '>';
			echo ' -- ';
			echo $row[ip];
			echo '</a>';
			echo ' -- <a href=/?action=ipban&ip=';
			echo $row[ip];
			echo '>BANIP</a>';
			echo'</li><hr>';
			

		}
	}
	
	function get_ip_log($getip) {
		$DEBUG = 0;
		$query = "SELECT * FROM sitelog where ip = '$getip' order by date_time";
		$result = mysql_query($query);
		$num_results = mysql_num_rows($result);
		if ($DEBUG) echo $query . "<br>\n";
		if ($DEBUG) echo('Invalid query: ' . mysql_error() . "<br>\n");
		for ($i=0; $i <$num_results; $i++)
		{
			$row = mysql_fetch_array($result);
			echo '<hr><li>';
			echo $row[date_time];
			echo '</li><li><a href=/?action=ipban&ip=';
			echo $row[ip];
			echo '>';
			echo $row[ip];
			echo '</a></li>'; 
			echo ' <li>Name 1:';
			echo $row[name];
			echo '</li><li>USERAGENT:';
			echo $row[agent];
			echo '</li><li> QUERY:';
			echo $row[query];
			echo '</li><li> REFERER:';
			echo $row[referer];
			echo '</li><li>REQUESTED:';
			echo $row[requested];
			echo '</li><hr>';
			

		}
	}
	
		function get_reg_log() {
		$DEBUG = 0;
		$query = "SELECT * FROM RegLog ORDER BY userid";
		$result = mysql_query($query);
		$num_results = mysql_num_rows($result);
		if ($DEBUG) echo $query . "<br>\n";
		if ($DEBUG) echo('Invalid query: ' . mysql_error() . "<br>\n");
		for ($i=0; $i <$num_results; $i++)
		{
			$row = mysql_fetch_array($result);
			echo'<center><font size=+2><B><U><I>' . $row[userid] . '</B></U></I><P><table border="1" style="border-collapse: collapse" width="100%">
	<tr>
		<td width="135">Chat Room:</td>
		<td>' . $row[room] . '</td>
	</tr>
			<tr>
		<td width="135">Username:</td>
		<td>' . $row[username] . '</td>
	</tr>
	<tr>
		<td width="135">Unregged Name:</td>
		<td>' . $row[unregname] . '</td>
	</tr>
	<tr>
		<td width="135">date and time:</td>
		<td>' . $row[logdate] . ',' . $row[logtime] . '</td>
	</tr>
	<tr>
		<td width="135">IP/AGENT</td>
		<td>' . $row[userip] . ', ' . $row[useragent] . '</td>
	</tr>
	<tr>
		<td width="135">Accessed</td>
		<td>' . $row[accessed] . '</td>
	</tr>
	<tr>
		<td width="135">Query</td>
		<td>' . $row[query] . '</td>
	</tr>
	<tr>
		<td width="135">Referer</td>
		<td>' . $row[referer] . '</td>
	</tr>
</table><HR><P>';
			

		}
	}
	
		function get_unreg_log() {
		$DEBUG = 0;
		$query = "SELECT * FROM UnregLog ORDER BY userid";
		$result = mysql_query($query);
		$num_results = mysql_num_rows($result);
		if ($DEBUG) echo $query . "<br>\n";
		if ($DEBUG) echo('Invalid query: ' . mysql_error() . "<br>\n");
		for ($i=0; $i <$num_results; $i++)
		{
			$row = mysql_fetch_array($result);
			echo'<center><font size=+2><B><U><I>' . $row[userid] . '</B></U></I><P><table border="1" style="border-collapse: collapse" width="100%">
	<tr>
		<td width="135">Chat Room:</td>
		<td>' . $row[room] . '</td>
	</tr>
			<tr>
		<td width="135">Username:</td>
		<td>' . $row[username] . '</td>
	</tr>
	<tr>
		<td width="135">Unregged Name:</td>
		<td>' . $row[unregname] . '</td>
	</tr>
	<tr>
		<td width="135">date and time:</td>
		<td>' . $row[logdate] . ',' . $row[logtime] . '</td>
	</tr>
	<tr>
		<td width="135">IP/AGENT</td>
		<td>' . $row[userip] . ', ' . $row[useragent] . '</td>
	</tr>
	<tr>
		<td width="135">Accessed</td>
		<td>' . $row[accessed] . '</td>
	</tr>
	<tr>
		<td width="135">Query</td>
		<td>' . $row[query] . '</td>
	</tr>
	<tr>
		<td width="135">Referer</td>
		<td>' . $row[referer] . '</td>
	</tr>
</table><HR><P>';
			

		}
	}
	
		function get_userlist_log() {
		$DEBUG = 0;
		$query = "SELECT * FROM UserlistLog ORDER BY userid";
		$result = mysql_query($query);
		$num_results = mysql_num_rows($result);
		if ($DEBUG) echo $query . "<br>\n";
		if ($DEBUG) echo('Invalid query: ' . mysql_error() . "<br>\n");
		for ($i=0; $i <$num_results; $i++)
		{
			$row = mysql_fetch_array($result);
			echo'<center><font size=+2><B><U><I>' . $row[userid] . '</B></U></I><P><table border="1" style="border-collapse: collapse" width="100%">
			<tr>
		<td width="135">Username:</td>
		<td>' . $row[username] . '</td>
	</tr>
	<tr>
		<td width="135">Unregged Name:</td>
		<td>' . $row[unregname] . '</td>
	</tr>
	<tr>
		<td width="135">date and time:</td>
		<td>' . $row[logdate] . ',' . $row[logtime] . '</td>
	</tr>
	<tr>
		<td width="135">IP/AGENT</td>
		<td>' . $row[userip] . ', ' . $row[useragent] . '</td>
	</tr>
	<tr>
		<td width="135">Accessed</td>
		<td>' . $row[accessed] . '</td>
	</tr>
	<tr>
		<td width="135">Query</td>
		<td>' . $row[query] . '</td>
	</tr>
	<tr>
		<td width="135">Referer</td>
		<td>' . $row[referer] . '</td>
	</tr>
</table><HR><P>';
			

		}
	}
	
}

?>