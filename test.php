<?php


//include the split_merge.php file that contains the needed functions
require_once('split_merge.inc.php');

//set file name
$file_name='test.txt';

//Set the number of parts
$parts_num=5;

$w=new split_merge();

//call split_file() function to splite the given file
$w->split_file($file_name,$parts_num) or die('Error spliting file');
echo 'File Splitted succesfully';

//Set the merged file name
$merged_file_name='merged.txt';

//call merge_file() function to merge the splited files
$w->merge_file($merged_file_name,$parts_num) or die('Error merging files');
echo '<br>Files merged succesfully';

?>
