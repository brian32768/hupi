<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
 <title>Human Power Institute - Home / News</title>
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

   <a href="index.php" class="open">Home / News</a><a href="about.php">About / Contact</a><a href="comments.php">Comments</a>
   <div id="datedisplay"><?php echo date("l, d F Y"); ?></div>

  </td>
 </tr>
 <tr>
  <td id="leftsidebar" rowspan="2">

   <div id="infoblock">
    <div id="infocontent"><a href="HPeJ/index.htm" target="_blank">Human Power eJournal</a></div>
   </div>

   <div id="infoblock">
    <div id="infocontent"><a href="http://www.ihpva.org/" target="_blank">International Human Powered Vehicle Association</a></div>
   </div>

  </td>
  <td id="content">

<?php
$data = file('files/news.txt');
$data = array_reverse($data);
foreach($data as $element) {
	$element = trim($element);
	$pieces = explode("|", $element);
	echo "<div id=\"infoblock\"><div id=\"infotitle\">" 
	. $pieces[2] 
	. "<div id=\"infocredit\">" 
	. $pieces[0] 
	. " | " 
	. $pieces[1] 
	. "</div></div><div id=\"infocontent\">" 
	. $pieces[3] 
	. "</div></div>";
}
?>

  </td>
 </tr>
 <tr>
  <td id="footer">2004-2005 | Human Power Institute | <script language="javascript" src="../files/hp_hits.php"></script></td>
 </tr>
</table>

</body>

</html>