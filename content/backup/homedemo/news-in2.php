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

   <a href="news-in1.php" class="open">Edit News</a><a href="index.php">Home / News</a><a href="about.php">About / Contact</a><a href="comments.php">Comments</a>
   <div id="datedisplay"><?php echo date("l, d F Y"); ?></div>

  </td>
 </tr>
 <tr>
  <td id="leftsidebar" rowspan="2">

   <div id="infoblock">
    <div id="infotitle" class="hardwire">News Upload</div>
    <div id="infocontentlsb">
     <ul>
      <li>Authorized users only.</li>
      <li>For uploading news articles to the News Page.</li>
     </ul>
    </div>
   </div>

   <div id="infoblock">
    <div id="linkslsb"><a href="index.php">News Page</a></div>
   </div>

   <div id="infoblock">
    <div id="linkslsb"><a href="news-in1.php">Add an Article</a></div>
   </div>

   <div id="infoblock">
    <div id="infotitle" class="hardwire">Submission Tips:</div>
    <div id="infocontentlsb">
     <ul>
      <li>Articles posted using this page appear on the News Page.</li>
     </ul>
    </div>
   </div>

  </td>
  <td id="content">

<?
if($HTTP_POST_VARS['submit']) {
	if($HTTP_POST_VARS['password'] == 'temp') {
		if(!$HTTP_POST_VARS['title']) {
			echo "<div id=\"infoblock\"><div id=\"infotitle\" class=\"warning\">Article Not Posted, Missing Element: Subject</div><div id=\"infocontent\"><ul><li>Use your browser's \"back\" button to fix the following problem:</li><li>Your comment has <b>NO ARTICLE TITLE</b>.</li></ul>";
			exit;
		}
		if(!$HTTP_POST_VARS['user']) {
			echo "<div id=\"infoblock\"><div id=\"infotitle\" class=\"warning\">Article Not Posted, Missing Element: Author</div><div id=\"infocontent\"><ul><li>Use your browser's \"back\" button to fix the following problem:</li><li>Your comment has <b>NO AUTHOR NAME</b> (user name).</li></ul>";
			exit;
		}
		if(!$HTTP_POST_VARS['contents']) {
			echo "<div id=\"infoblock\"><div id=\"infotitle\" class=\"warning\">Article Not Posted, Missing Element: Content</div><div id=\"infocontent\"><ul><li>Use your browser's \"back\" button to fix the following problem:</li><li>Your comment has <b>NO BODY CONTENT</b>.</li></ul>";
			exit;
		}
		if(strstr($HTTP_POST_VARS['title'],"|")) {
			echo "<div id=\"infoblock\"><div id=\"infotitle\" class=\"warning\">Article Not Posted, Invalid Character: \"pipe symbol\" (|)</div><div id=\"infocontent\"><ul><li>Use your browser's \"back\" button to fix the following problem:</li><li><b>ARTICLE TITLE</b> contains an invalid character.</li></ul>";
			exit;
		}
		if(strstr($HTTP_POST_VARS['user'],"|")) {
			echo "<div id=\"infoblock\"><div id=\"infotitle\" class=\"warning\">Article Not Posted, Invalid Character: \"pipe symbol\" (|)</div><div id=\"infocontent\"><ul><li>Use your browser's \"back\" button to fix the following problem:</li><li><b>AUTHOR</b> contains an invalid character.</li></ul>";
			exit;
		}
		if(strstr($HTTP_POST_VARS['contents'],"|")) {
			echo "<div id=\"infoblock\"><div id=\"infotitle\" class=\"warning\">Article Not Posted, Invalid Character: \"pipe symbol\" (|)</div><div id=\"infocontent\"><ul><li>Use your browser's \"back\" button to fix the following problem:</li><li><b>BODY</b> contains an invalid character.</li></ul>";
			exit;
		}
		$fp = fopen('files/news.txt','a');
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
<div id="infoblock"><div id="infotitle" class="hardwire">News Has Been Submitted</div><div id="infocontent"><ul><li>Do not refresh this page, as it will result in multiple submissions.</li><li>Your article has been accepted.</li></ul>
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