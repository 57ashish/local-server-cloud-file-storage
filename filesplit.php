<?php
/*
 --------------------------------------------------
 filesplit.php HJSplit compatiple PHP file splitter
 --------------------------------------------------
 
 File name: 
	filesplit.php                
 Author: 
	Umit Tirpan 2007-03-22          
	Umit Tirpan 2008-03-12 [remote file support added]         
 Author's Website: 
	http://forum.iyinet.com/

 Description:
	This PHP script, splits the files into smaller pieces in binary.
	It is compatiple with HJSplit, so you can re-join splitted files using HJSplit's Join utility.
	It can split a file up to 999 pieces.

 What is the use, why will I use this?
	Some webmasters do not have shell access to their websites. This prevents them splitting big files, ie. MySQL backups, into smaller files. Splitting a 200Mb file into 10 x 20Mb file may be easy on webmaster to download in pieces. 
 
 How to run:
	Make sure your webserver has write permission on the target folder.
	Edit variables. 
	Upload (ftp) this file to your webserver or run on your PC.
	For security reason, filename is hardcoded. You can modify code to accept $_GET['filename']

 Run with your favorite browser.
	http://www.<your-web-site>.com/filesplit.php
 Or run on shell (ie. ssh)
	php filesplit.php

 It is Ok to share and modify this code and use in/with your applications. No restrictions.

 */




// ---------------------------
// Edit variables (3 variables)
// ---------------------------

// File to split, is its not in the same folder with filesplit.php, full path is required.
$filename = "http://www.iyinet.com/my-big-file.zip"; 

// Target folder. Splitted files will be stored here. Original file never gets touched.
// Do not append slash! Make sure webserver has write permission on this folder.
$targetfolder = '/tmp';

// File size in Mb per piece/split. 
// For a 200Mb file if piecesize=10 it will create twenty 10Mb files
$piecesize = 10; // splitted file size in MB



// ---------------------------
// Do NOT edit this section
// ---------------------------

$buffer = 1024;
$piece = 1048576*$piecesize;
$current = 0;
$splitnum = 1;

if(!file_exists($targetfolder)) {
	if(mkdir($targetfolder)) {
		echo "Created target folder $targetfolder".br();
	}
}

if(!$handle = fopen($filename, "rb")) {
	die("Unable to open $filename for read! Make sure you edited filesplit.php correctly!".br());
}

$base_filename = basename($filename);

$piece_name = $targetfolder.'/'.$base_filename.'.'.str_pad($splitnum, 3, "0", STR_PAD_LEFT);
if(!$fw = fopen($piece_name,"w")) {
	die("Unable to open $piece_name for write. Make sure target folder is writeable.".br());
}
echo "Splitting $base_filename into $piecesize Mb files ".br()."(last piece may be smaller in size)".br();
echo "Writing $piece_name...".br();
while (!feof($handle) and $splitnum < 999) {
	if($current < $piece) {
		if($content = fread($handle, $buffer)) {
			if(fwrite($fw, $content)) {
				$current += $buffer;
			} else {
				die("filesplit.php is unable to write to target folder. Target folder may not have write permission! Try chmod +w target_folder".br());
			}
		}
	} else {
		fclose($fw);
		$current = 0;
		$splitnum++;
		$piece_name = $targetfolder.'/'.$base_filename.'.'.str_pad($splitnum, 3, "0", STR_PAD_LEFT);
		echo "Writing $piece_name...".br();
		$fw = fopen($piece_name,"w");
	}
}
fclose($fw);
fclose($handle);
echo "Done! ".br();
exit;

function br() {
	return (!empty($_SERVER['SERVER_SOFTWARE']))?'<br>':"\n";
}
?> 
