<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
 <title>Human Power Institute - Submit Comment</title>
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
    <div id="linkslsb"><a href="comments.php">Cancel Comment</a></div>
   </div>

   <div id="infoblock">
    <div id="infotitle" class="hardwire">Submission Tips:</div>
    <div id="infocontentlsb">
     <ul>
      <li>Please use a unique User Name or the default 'Guest' User Name.</li>
      <li>Once submitted, articles can only be removed by an editor.</li>
      <li>Comments posted using this page appear on the Comments Page.</li>
     </ul>
    </div>
   </div>

  </td>
  <td id="content">

   <div id="infoblock">
    <div id="infotitle" class="hardwire">Comment Submission Form:<div id="infocredit">Submission Date: <?php echo date("d.M.Y") ?></div></div>
    <div id="infocontent">
     <form action="comment2.php" method="post">
      <input type="hidden" value="guest" name="password" />
      <input type="text" value="Guest" name="user" size="23" /> Author<br />
      <br />
      <input type="text" value="" name="title" size="42" /> Subject<br />
      <br />
      <textarea rows="10" cols="55" name="contents"></textarea><br />
      <br />
      <input type="reset" value="Reset Form" name="reset" />
      <input type="submit" value="Submit Comment" name="submit" />
     </form>
    </div>
   </div>

  </td>
 </tr>
 <tr>
  <td id="footer">2004-2005 | Human Power Institute</td>
 </tr>
</table>

</body>

</html>