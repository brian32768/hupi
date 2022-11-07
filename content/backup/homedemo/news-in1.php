<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
 <title>Human Power Institute - News Upload</title>
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
    <div id="infotitle" class="hardwire">Submission Tips:</div>
    <div id="infocontentlsb">
     <ul>
      <li>Choose one of the two methods presented for modifying the news.</li>
      <li>Articles posted using this page appear on the News Page.</li>
     </ul>
    </div>
   </div>

  </td>
  <td id="content">

   <div id="infoblock">
    <div id="infotitle" class="hardwire">News Article Submission Form: <div id="infocredit">Submission Date: <?php echo date("d.M.Y") ?></div></div>
    <div id="infocontent">

     <form action="news-in2.php" method="POST">
      <input type="password" value="" name="password" size="23" /> Password<br />
      <br />
      <input type="text" value="" name="user" size="23" /> Author<br />
      <br />
      <input type="text" value="" name="title" size="42" /> Article Title<br />
      <br />
      <textarea rows="10" cols="55" name="contents"></textarea><br />
      <br />
      <input type="hidden" value="" name="date" />
      <input type="reset" value="Reset Form" name="reset" />
      <input type="submit" value="Submit Article" name="submit" />
     </form>

    </div>
   </div>

<?php
//vvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvv
//   You may change maxsize, and allowable upload file types.
//^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
//Maximum file size. You may increase or decrease.
$MAX_SIZE = 2000000;
                            
//Allowable file Mime Types. Add more mime types if you want
$FILE_MIMES = array('text/txt');

//Allowable file ext. names. you may add more extension names.            
$FILE_EXTS  = array('.txt'); 

//Allow file delete? no, if only allow upload only
$DELETABLE  = true;                               


//vvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvv
//   Do not touch the below if you are not confident.
//^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
/************************************************************
 *     Setup variables
 ************************************************************/
$site_name = $_SERVER['HTTP_HOST'];
$url_dir = "http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']);
$url_this =  "http://".$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];

$upload_dir = "files/";
$upload_url = $url_dir."/files/";
$message ="";

/************************************************************
 *     Create Upload Directory
 ************************************************************/
if (!is_dir("files")) {
  if (!mkdir($upload_dir))
  	die ("upload_files directory doesn't exist and creation failed");
  if (!chmod($upload_dir,0755))
  	die ("change permission to 755 failed.");
}

/************************************************************
 *     Process User's Request
 ************************************************************/
if ($_REQUEST[del] && $DELETABLE)  {
  $resource = fopen("files/log.txt","a");
  fwrite($resource,date("Ymd h:i:s")."DELETE - $_SERVER[REMOTE_ADDR]"."$_REQUEST[del]\n");
  fclose($resource);
  
  if (strpos($_REQUEST[del],"/.")>0);                  //possible hacking
  else if (strpos($_REQUEST[del],"files/") === false); //possible hacking
  else if (substr($_REQUEST[del],0,6)=="files/") {
    unlink($_REQUEST[del]);
    print "<script>window.location.href='$url_this?message=deleted successfully'</script>";
  }
}
else if ($_FILES['userfile']) {
  $resource = fopen("files/log.txt","a");
  fwrite($resource,date("Ymd h:i:s")."UPLOAD - $_SERVER[REMOTE_ADDR]"
            .$_FILES['userfile']['name']." "
            .$_FILES['userfile']['type']."\n");
  fclose($resource);

	$file_type = $_FILES['userfile']['type']; 
  $file_name = $_FILES['userfile']['name'];
  $file_ext = substr($file_name,strrpos($file_name,"."));

  //File Size Check
  if ( $_FILES['userfile']['size'] > $MAX_SIZE) 
     $message = "The file size is over 2MB.";
  //File Type/Extension Check
  else if (!in_array($file_type, $FILE_MIMES) 
          && !in_array($file_ext, $FILE_EXTS) )
     $message = "Sorry, $file_name($file_type) is not allowed to be uploaded.";
  else
     $message = do_upload($upload_dir, $upload_url);
  
  print "<script>window.location.href='$url_this?message=$message'</script>";
}
else if (!$_FILES['userfile']);
else 
	$message = "Invalid File Specified.";

/************************************************************
 *     List Files
 ************************************************************/
$handle=opendir($upload_dir);
$filelist = "";
while ($file = readdir($handle)) {
   if(!is_dir($file) && !is_link($file)) {
      $filelist .= "<a href='$upload_dir$file'>".$file."</a>";
      if ($DELETABLE)
        $filelist .= " <a href='?del=$upload_dir$file' title='delete'>x</a><br>";
   }
}

function do_upload($upload_dir, $upload_url) {

	$temp_name = $_FILES['userfile']['tmp_name'];
	$file_name = $_FILES['userfile']['name']; 
  $file_name = str_replace("\\","",$file_name);
  $file_name = str_replace("'","",$file_name);
	$file_path = $upload_dir.$file_name;

	//File Name Check
  if ( $file_name =="") { 
  	$message = "Invalid File Name Specified";
  	return $message;
  }

  $result  =  move_uploaded_file($temp_name, $file_path);
  if (!chmod($file_path,0755))
   	$message = "change permission to 755 failed.";
  else
    $message = ($result)?"$file_name uploaded successfully." :
     	      "Somthing is wrong with uploading a file.";
  return $message;
}
?>

   <div id="infoblock">
    <div id="infotitle" class="hardwire">Upload a Replacement News or Comments File</div>
    <div id="infocontentlsb">
     Replace the existing <a href="files/news.txt" target="_blank">news.txt</a> or <a href="files/comments.txt" target="_blank">comments.txt</a> files with a modified copy using the appropriate file name. (Links open in new windows.) Download and modify the current file, then make sure no other user has posted changes to the <a href="index.php" target="_blank">news page</a> or <a href="comments.php" target="_blank">comments page</a> before uploading the replacement file.<br /><br />
     <form name="upload" id="upload" method="post" enctype="multipart/form-data">
      <input type="file" name="userfile" id="userfile" size="50" />
      <input type="submit" name="upload" value="Upload File" />
     </form>
     <div style="margin-top: 6px; margin-bottom: 6px; padding: 4px; border: 1px solid #0000FF; background: #F7FBFF; color: #0000FF;"><b>Messages:</b> <?=$_REQUEST[message]?></div>
     <div style="font-size: 8pt;">PHP script developed by <a style="text-decoration:none" href="http://tech.citypost.ca">CityPost.ca</a></div>
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