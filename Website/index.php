<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<?PHP
add_log_entry();function add_log_entry(){
$ip = $_SERVER['REMOTE_ADDR'];
$currenttime = date("D dS M,Y h:i a");
include_once("./db.inc.php");
	$db1=new DB();
	$db1->open();
	$query1 = "SELECT * from sitelog where userhost = '$ip'";
	$result1 = $db1->query($query1);
	$num_results = $db1->numRows($result1);
		if($num_results > 0){
			include_once("./db.inc.php");
			$db2=new DB();
			$db2->open();
			$query2 = "UPDATE sitelog set lastupdate = '$currenttime' where userhost = '$ip'";
			$result2 = $db2->query($query2);
		}
		else
		{
			include_once("./db.inc.php");
			$db3=new DB();
			$db3->open();
			$query3 = "INSERT into sitelog (userhost, lastupdate) VALUES ('$ip','$currenttime')";
			$result3 = $db3->query($query3);
		}
	
}
function get_page($page){
	include_once("./db.inc.php");
	$db=new DB();
	$db->open();
		$query = "SELECT * from pages where linktitle = '$page'";
		$result = $db->query($query);
		$pgcontent = $db->fetchArray($result);
		echo ('<h2><a href="#" id="'.$pgcontent[linktitle].'">'.$pgcontent[title].'</a></h2>');
		if($pgcontent[pagetype] == 'php')
		{
		eval($pgcontent[content]);
		}
		else
		{
			echo $pgcontent[content];
		}
		echo('<p></p>');
		} 
function get_links()
{
	include_once ("db.inc.php");
	$db = new DB ();
	$db->open ();
	$query = "SELECT * FROM links ORDER BY order_";
	$result = $db->query ( $query );
	$num_results = $db->numRows ( $result );
	for($i = 0; $i < $num_results; $i ++)
	{
		$row = $db->fetchArray ( $result ); 
		$txttitle = str_replace("_", " ", $row [title]);
		echo ('<li><a href="'.$row[url].'">'.$txttitle.'</a></li>');
	}
}
?>
<head>
<title>Jewellee's Herbals</title>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="css/1.css" type="text/css" media="screen,projection" />
</head>
<body>
	<div id="container">
			<div id="wrapper">
					<div id="header">
					<center><img src="http://jewelleesherbals.com/images/ban1.png" border="0"></center>							
					</div>
					<div id="sidebar">					
							<h2></h2>
							<ul id="sidenav">
							<?php get_links();?>
							</ul>
					</div>
					<div id="content">
							<ul id="nav">
							</ul>
							<div id="content_main">
					<?php
					if(!isset($_GET[page])){
					get_page('index');
					}
					else{
					get_page($_GET[page]);
					}
					?>
							</div>							
							<div id="footer">
								<p class="validate"><a href="http://validator.w3.org/check?uri=referer">XHTML</a> | <a href="http://jigsaw.w3.org/css-validator/">CSS</a><br /><a href="#content">Top</a></p>
								<!-- Please leave this line intact -->
								<p><br />
								<!-- you can delete below here -->
								&copy; 2010 Jewellee's Herbals.
								<font size=-2><center>Products and information listed on this site have not been approved by the FDA, FTC or any other agency. The products and information listed on this site are not meant to cure, diagnose, treat, or prevent disease. Please inform your health care provider of any changes to your health and consult with him/her prior to taking any herbs, supplements, vitamins or anything that might otherwise change your state of health. It is always strongly suggested that you research health information from many sources, including your health care provider and those certified to give you the kind of information you are seeking.</font></center>
								</p>
				
				</div>
					
					</div>
			</div>
	</div>
</body>
</html>
