<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
 <title>Human Power Institute - Submitted</title>
 <link rel="stylesheet" type="text/css" href="files/master.css" />
 <link rel="stylesheet" type="text/css" href="files/simple.css" />
</head>

<body>

<table id="maintable" cellspacing="0" cellpadding="0">
 <tr>
  <td id="titlebanner" colspan="2">

   <img src="files/images/cf_hupi.gif" alt="Chainring Feather Logo" />
   <img src="files/images/hupititl.gif" alt="HuPI - Human Power Institute" />

  </td>
 </tr>
 <tr>
  <td id="links" colspan="2">

   <a href="index.php">Home / News</a><a href="about.php">About / Contact</a><a href="comments.php" class="open">Comments</a>
   <div id="datedisplay"><?php echo date("l, d F Y"); ?></div>

  </td>
 </tr>
 <tr>
  <td id="leftsidebar" rowspan="2">

   <div id="infoblock">
    <div id="infotitle" class="hardwire">Commentary</div>
    <div id="infocontentlsb">
     <ul>
      <li>A place for visitors to comment on the site or organization.</li>
     </ul>
    </div>
   </div>

   <div id="infoblock">
    <div id="linkslsb"><a href="comments.php">Comments Page</a></div>
   </div>

   <div id="infoblock">
    <div id="linkslsb"><a href="comment1.php">Add a Comment</a></div>
   </div>

   <div id="infoblock">
    <div id="infotitle" class="hardwire">Submission Tips:</div>
    <div id="infocontentlsb">
     <ul>
      <li>Once submitted, articles can only be removed by an editor.</li>
      <li>Comments posted using this page appear on the Comments Page.</li>
     </ul>
    </div>
   </div>

  </td>
  <td id="content">

<?
if($HTTP_POST_VARS['submit']) {
	if($HTTP_POST_VARS['password'] == 'guest') {
		if(!$HTTP_POST_VARS['title']) {
			echo "<div id=\"infoblock\"><div id=\"infotitle\" class=\"warning\">Comment Not Posted, Missing Element: Subject</div><div id=\"infocontent\"><ul><li>Use your browser's \"back\" button to fix the following problem:</li><li>Your comment has <b>NO SUBJECT TITLE</b>.</li></ul>";
			exit;
		}
		if(!$HTTP_POST_VARS['user']) {
			echo "<div id=\"infoblock\"><div id=\"infotitle\" class=\"warning\">Comment Not Posted, Missing Element: Author</div><div id=\"infocontent\"><ul><li>Use your browser's \"back\" button to fix the following problem:</li><li>Your comment has <b>NO AUTHOR NAME</b> (user name).</li></ul>";
			exit;
		}
		if(!$HTTP_POST_VARS['contents']) {
			echo "<div id=\"infoblock\"><div id=\"infotitle\" class=\"warning\">Comment Not Posted, Missing Element: Content</div><div id=\"infocontent\"><ul><li>Use your browser's \"back\" button to fix the following problem:</li><li>Your comment has <b>NO BODY CONTENT</b>.</li></ul>";
			exit;
		}
		if(strstr($HTTP_POST_VARS['title'],"|")) {
			echo "<div id=\"infoblock\"><div id=\"infotitle\" class=\"warning\">Comment Not Posted, Invalid Character: \"pipe symbol\" (|)</div><div id=\"infocontent\"><ul><li>Use your browser's \"back\" button to fix the following problem:</li><li><b>Subject</b> contains an invalid character.</li></ul>";
			exit;
		}
		if(strstr($HTTP_POST_VARS['user'],"|")) {
			echo "<div id=\"infoblock\"><div id=\"infotitle\" class=\"warning\">Comment Not Posted, Invalid Character: \"pipe symbol\" (|)</div><div id=\"infocontent\"><ul><li>Use your browser's \"back\" button to fix the following problem:</li><li><b>Author</b> contains an invalid character.</li></ul>";
			exit;
		}
		if(strstr($HTTP_POST_VARS['contents'],"|")) {
			echo "<div id=\"infoblock\"><div id=\"infotitle\" class=\"warning\">Comment Not Posted, Invalid Character: \"pipe symbol\" (|)</div><div id=\"infocontent\"><ul><li>Use your browser's \"back\" button to fix the following problem:</li><li><b>Body</b> contains an invalid character.</li></ul>";
			exit;
		}
		$fp = fopen('files/comments.txt','a');
		if(!$fp) {
			echo "Error opening file!";
			exit;
		}
		$line = date("H:i d.M.Y") . "|" . $HTTP_POST_VARS['user'] . "|" . $HTTP_POST_VARS['title'] . "|" . $HTTP_POST_VARS['contents'];
		$line = str_replace("\r\n","<br />",$line);
		$line = str_replace("\\","",$line);
		$line .= "\r\n";
		fwrite($fp, $line);
		if(!fclose($fp)) {
			echo "Error while closing file!";
			exit;
		}
	}
	else {
		echo "<div id=\"infoblock\"><div id=\"infotitle\" class=\"warning\">Invalid Password</div><div id=\"infocontent\"><ul><li>Use your browser's \"back\" button to fix the following problem:</li><li>Password was incorrect.</li></ul>";
		exit;
	}
}
?>
<div id="infoblock"><div id="infotitle" class="hardwire">Thank You</div><div id="infocontent"><ul><li>Your comment has been accepted.</li></ul>
    </div>
   </div>
  </td>
 </tr>
 <tr>
  <td id="footer" colspan="2">2004-2005 | Human Power Institute</td>
 </tr>
</table>

</body>

</html>