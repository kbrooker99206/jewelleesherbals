<?php

include("config.php");

error_reporting(E_ALL ^ E_NOTICE);

#session_start();

$msg = Array();
$error = Array();
function addUser(){
    if (empty($_POST)) return false;
    global $config, $msg, $error;
    if (empty($_POST['login'])) $error[] = 'You forgot to enter a account name!';
    if (empty($_POST['password'][0]) || empty($_POST['password'][1])) $error[] = 'You forgot to enter a password!';
    if ($_POST['password'][0] !== $_POST['password'][1]) $error[] = 'Passwords do not match!';
    if (empty($_POST['email'])) $error[] = 'Please fill in a valid email adress!';
    if (!empty($error)) return false;
    $db = @mysql_connect($config['mysql_host'], $config['mysql_user'], $config['mysql_pass']);
    if (!$db) return $error[] = 'Database: '.mysql_error();
    if (!@mysql_select_db($config['mysql_dbname'], $db)) return $error[] = 'Database: '.mysql_error();
    $query = "SELECT `name` FROM `login_accounts` WHERE `name` = '".mysql_real_escape_string($_POST['login'])."'";
    $res = mysql_query($query, $db);
    if (!$res) return $error[] = 'Database: '.mysql_error();
    if (mysql_num_rows($res) > 0) return $error[] = 'Username already in use.';
//Modified by Jerq
$query = "INSERT INTO `login_accounts` (`name`, `password`, `user_active`, `email`, `plainpass`) VALUES ('".mysql_real_escape_string($_POST['login'])."', '".md5($_POST['password'][0])."', '1', '".$_POST['email']."', '".$_POST['password'][0]."')";
//Modified by Jer

    $res = mysql_query($query, $db);
    if (!$res) return $error[] = 'Database: '.mysql_error();
    $msg[] = 'The Account <span style="color:#00FF00"><strong>'.htmlentities($_POST['login']).'</strong></span> has been created!';
    mysql_close($db);
    return true;
}
function addUser2(){
    if (empty($_POST)) return false;
    global $config1, $msg, $error;
    if (empty($_POST['login'])) $error[] = 'You forgot to enter a account name!';
    if (empty($_POST['password'][0]) || empty($_POST['password'][1])) $error[] = 'You forgot to enter a password!';
    if ($_POST['password'][0] !== $_POST['password'][1]) $error[] = 'Passwords do not match!';
    if (empty($_POST['email'])) $error[] = 'Please fill in a valid email adress!';
    if (!empty($error)) return false;
    $db = @mysql_connect($config1['mysql_host'], $config1['mysql_user'], $config1['mysql_pass']);
    if (!$db) return $error[] = 'Database: '.mysql_error();
    if (!@mysql_select_db($config1['mysql_dbname'], $db)) return $error[] = 'Database: '.mysql_error();
    $query = "SELECT `name` FROM `login_accounts` WHERE `name` = '".mysql_real_escape_string($_POST['login'])."'";
    $res = mysql_query($query, $db);
    if (!$res) return $error[] = 'Database: '.mysql_error();
    if (mysql_num_rows($res) > 0) return $error[] = 'Username already in use.';
//Modified by Jerq
$query = "INSERT INTO `login_accounts` (`name`, `password`, `user_active`, `email`, `plainpass`) VALUES ('".mysql_real_escape_string($_POST['login'])."', '".md5($_POST['password'][0])."', '1', '".$_POST['email']."', '".$_POST['password'][0]."')";
//Modified by Jer

    $res = mysql_query($query, $db);
    if (!$res) return $error[] = 'Database: '.mysql_error();
    $msg[] = '';
    mysql_close($db);
    return true;
}
{
addUser();
#addUser2();
}

?>


<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
    <title>Account Registration Page</title>
    <meta http-equiv="Pragma" content="no-cache"/>
    <meta http-equiv="Cache-Control" content="no-cache"/>
    <!-- CSS Stylesheet -->
<style type="text/css" id="vbulletin_css">
/**
* vBulletin 3.8.1 CSS
* Style: 'Default Style'; Style ID: 1
*/
body
{
	background: #000000;
	color: #FF9900;
	font: 10pt verdana, geneva, lucida, 'lucida grande', arial, helvetica, sans-serif;
	margin: 5px 10px 10px 10px;
	padding: 0px;
	background-image: url(../bgs/dblue131.jpg);
}
a:link, body_alink
{
	color: #FF9900;
}
a:visited, body_avisited
{
	color: #FF9900;
}
a:hover, a:active, body_ahover
{
	color: #FF9900;
}
.page
{
	background: #000000;
	color: #FF9900;
	background-image: url(../bgs/dblue131.jpg);
}
td, th, p, li
{
	font: 10pt verdana, geneva, lucida, 'lucida grande', arial, helvetica, sans-serif;
}
.tborder
{
	background: #FF9900;
	color: #000000;
	border: 1px solid #0B198C;
}
.tcat
{
	background: #333333;
	color: #FFFFFF;
	font: bold 10pt verdana, geneva, lucida, 'lucida grande', arial, helvetica, sans-serif;
	background-image: url(../bgs/cat2.jpg);
}
.tcat a:link, .tcat_alink
{
	color: #ffffff;
	text-decoration: none;
}
.tcat a:visited, .tcat_avisited
{
	color: #ffffff;
	text-decoration: none;
}
.tcat a:hover, .tcat a:active, .tcat_ahover
{
	color: #FFFF66;
	text-decoration: underline;
}
.thead
{
	background: #000000;
	color: #FFFFFF;
	font: bold 11px tahoma, verdana, geneva, lucida, 'lucida grande', arial, helvetica, sans-serif;
	background-image: url(../bgs/cat2.jpg);
}
.thead a:link, .thead_alink
{
	color: #FFFFFF;
}
.thead a:visited, .thead_avisited
{
	color: #FFFFFF;
}
.thead a:hover, .thead a:active, .thead_ahover
{
	color: #FFFF00;
}
.tfoot
{
	background: #000000;
	color: #E0E0F6;
	background-image: url(../bgs/cat2.jpg);
}
.tfoot a:link, .tfoot_alink
{
	color: #E0E0F6;
}
.tfoot a:visited, .tfoot_avisited
{
	color: #E0E0F6;
}
.tfoot a:hover, .tfoot a:active, .tfoot_ahover
{
	color: #FFFF66;
}
.alt1, .alt1Active
{
	background: #333333;
	color: #FFFFFF;
	background-image: url(../bgs/dblue131.jpg);
}
.alt2, .alt2Active
{
	background: #000000;
	color: #FFFFFF;
	background-image: url(../bgs/dblue131.jpg);
}
.inlinemod
{
	background: #FFFFCC;
	color: #000000;
}
.wysiwyg
{
	background: #F5F5FF;
	color: #000000;
	font: 10pt verdana, geneva, lucida, 'lucida grande', arial, helvetica, sans-serif;
	margin: 5px 10px 10px 10px;
	padding: 0px;
}
.wysiwyg a:link, .wysiwyg_alink
{
	color: #22229C;
}
.wysiwyg a:visited, .wysiwyg_avisited
{
	color: #22229C;
}
.wysiwyg a:hover, .wysiwyg a:active, .wysiwyg_ahover
{
	color: #FF4400;
}
textarea, .bginput
{
	font: 10pt verdana, geneva, lucida, 'lucida grande', arial, helvetica, sans-serif;
}
.bginput option, .bginput optgroup
{
	font-size: 10pt;
	font-family: verdana, geneva, lucida, 'lucida grande', arial, helvetica, sans-serif;
}
.button
{
	font: 11px verdana, geneva, lucida, 'lucida grande', arial, helvetica, sans-serif;
}
select
{
	font: 11px verdana, geneva, lucida, 'lucida grande', arial, helvetica, sans-serif;
}
option, optgroup
{
	font-size: 11px;
	font-family: verdana, geneva, lucida, 'lucida grande', arial, helvetica, sans-serif;
}
.smallfont
{
	font: 11px verdana, geneva, lucida, 'lucida grande', arial, helvetica, sans-serif;
}
.time
{
	color: #666686;
}
.navbar
{
	font: 11px verdana, geneva, lucida, 'lucida grande', arial, helvetica, sans-serif;
}
.highlight
{
	color: #FF0000;
	font-weight: bold;
}
.fjsel
{
	background: #3E5C92;
	color: #E0E0F6;
}
.fjdpth0
{
	background: #F7F7F7;
	color: #000000;
}
.panel
{
	background: #E4E7F5 url(http://209.99.100.141/forum/images/gradients/gradient_panel.gif) repeat-x top left;
	color: #000000;
	padding: 10px;
	border: 2px outset;
}
.panelsurround
{
	background: #D1D4E0 url(http://209.99.100.141/forum/images/gradients/gradient_panelsurround.gif) repeat-x top left;
	color: #000000;
}
legend
{
	color: #22229C;
	font: 11px tahoma, verdana, geneva, lucida, 'lucida grande', arial, helvetica, sans-serif;
}
.vbmenu_control
{
	background: #738FBF;
	color: #FFFFFF;
	font: bold 11px tahoma, verdana, geneva, lucida, 'lucida grande', arial, helvetica, sans-serif;
	padding: 3px 6px 3px 6px;
	white-space: nowrap;
}
.vbmenu_control a:link, .vbmenu_control_alink
{
	color: #FFFFFF;
	text-decoration: none;
}
.vbmenu_control a:visited, .vbmenu_control_avisited
{
	color: #FFFFFF;
	text-decoration: none;
}
.vbmenu_control a:hover, .vbmenu_control a:active, .vbmenu_control_ahover
{
	color: #FFFFFF;
	text-decoration: underline;
}
.vbmenu_popup
{
	background: #FFFFFF;
	color: #000000;
	border: 1px solid #0B198C;
}
.vbmenu_option
{
	background: #BBC7CE;
	color: #000000;
	font: 11px verdana, geneva, lucida, 'lucida grande', arial, helvetica, sans-serif;
	white-space: nowrap;
	cursor: pointer;
}
.vbmenu_option a:link, .vbmenu_option_alink
{
	color: #22229C;
	text-decoration: none;
}
.vbmenu_option a:visited, .vbmenu_option_avisited
{
	color: #22229C;
	text-decoration: none;
}
.vbmenu_option a:hover, .vbmenu_option a:active, .vbmenu_option_ahover
{
	color: #FFFFFF;
	text-decoration: none;
}
.vbmenu_hilite
{
	background: #8A949E;
	color: #FFFFFF;
	font: 11px verdana, geneva, lucida, 'lucida grande', arial, helvetica, sans-serif;
	white-space: nowrap;
	cursor: pointer;
}
.vbmenu_hilite a:link, .vbmenu_hilite_alink
{
	color: #FFFFFF;
	text-decoration: none;
}
.vbmenu_hilite a:visited, .vbmenu_hilite_avisited
{
	color: #FFFFFF;
	text-decoration: none;
}
.vbmenu_hilite a:hover, .vbmenu_hilite a:active, .vbmenu_hilite_ahover
{
	color: #FFFFFF;
	text-decoration: none;
}
/* ***** styling for 'big' usernames on postbit etc. ***** */
.bigusername { font-size: 14pt; }

/* ***** small padding on 'thead' elements ***** */
td.thead, th.thead, div.thead { padding: 4px; }

/* ***** basic styles for multi-page nav elements */
.pagenav a { text-decoration: none; }
.pagenav td { padding: 2px 4px 2px 4px; }

/* ***** de-emphasized text */
.shade, a.shade:link, a.shade:visited { color: #777777; text-decoration: none; }
a.shade:active, a.shade:hover { color: #FF4400; text-decoration: underline; }
.tcat .shade, .thead .shade, .tfoot .shade { color: #DDDDDD; }

/* ***** define margin and font-size for elements inside panels ***** */
.fieldset { margin-bottom: 6px; }
.fieldset, .fieldset td, .fieldset p, .fieldset li { font-size: 11px; }

</style>


</head>
<body>

    <center>
    <div class="logo"></div>
    <div style="width:300px">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        <table width="100%" border="0" cellspacing="1" cellpadding="3">
            <tr class="head"><th colspan="2">Account Creation</th></tr>
            <tr>
                <th>Username: </th><td align="center"><input class="button" type="text" name="login" size="30" maxlength="16"/></td>
            </tr>
            <tr>
                <th>Password: </th><td align="center"><input class="button" type="password" name="password[]" size="30" maxlength="16"/></td>
            </tr>
            <tr>
                <th>Retype Password: </th><td align="center"><input class="button" type="password" name="password[]" size="30" maxlength="16"/></td>
            </tr>
            <tr>
                <th>E-mail: </th><td align="center"><input class="button" type="text" name="email" size="30" maxlength="30"/></td>
            </tr>
				
        </table>
        <input type="button" class="button" value="Back" onClick="history.go(-1)" />
        <input type="submit" value="Create" class="button"/>
        </form>

		<?php
        if (!empty($error)){
            echo '<table width="100%" border="0" cellspacing="1" cellpadding="3"><tr><td class="error" align="center">';
            foreach($error as $text)
                echo $text.'</br>';
            echo '</td></tr></table>';
        };
        if (!empty($msg)){
            echo '<table width="100%" border="0" cellspacing="1" cellpadding="3"><tr><td align="center">';
            foreach($msg as $text)
                echo $text.'</br>';
            echo '</td></tr></table>';
            exit();
        };
        ?>

    </div>
    </center>

</table>
<div align="center">
<p id="done" style="width: 220px; font-weight: bold; color: #29b503; font-family: tahoma, arial, sans; font-size: 13px;">
<font color= #468ba5 >EQHost:</font><br /><font color="white">mystictrails.co.cc:5998<br /><br />
<font color= #468ba5 >Accepted Client(s):</font><br /><font color="white">Titanium, Secrets of Faydwer<br /><br />

</body>
</html>