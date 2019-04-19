<?php
/*
   +-----------------+------------------------------------------------------------+
   |  Functions      | Splite ,Merge                                              |
   |  Author         | Arash Hemmat                                               |
   |  Last Modified  | 08 August 2005 Monday 17:33                                |
   +-----------------+------------------------------------------------------------+
   |  This program is free software; you can redistribute it and/or               |
   |  modify it under the terms of the GNU General Public License                 |
   |  as published by the Free Software Foundation; either version 2              |
   |  of the License, or (at your option) any later version.                      |
   |                                                                              |
   |  This program is distributed in the hope that it will be useful,             |
   |  but WITHOUT ANY WARRANTY; without even the implied warranty of              |
   |  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the               |
   |  GNU General Public License for more details.                                |
   |                                                                              |
   +------------------------------------------------------------------------------+
*/


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
