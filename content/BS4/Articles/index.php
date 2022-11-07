<html>
  <head>
    <title>Index</title>
    <meta content="">
    <style></style>
  </head>
  <body></br><em>This folder contains the following files: </em></br></br></body>
</html> 
 <?php
    $dirname = './';
    $handle = opendir($dirname);

    $file = '';

    while(($file=readdir($handle))!=''){
        if($file!='..' && $file != '.'){
            $extension = substr($file,strrpos('.',$file));
            
            $size = filesize($dirname.'/'.$file);    
            echo '<a href="'.$dirname.'/'.$file.'">'.$file.' ('.($size/1024).'kB)</a><br />';
        }
    }

    closedir($handle);        
?> 