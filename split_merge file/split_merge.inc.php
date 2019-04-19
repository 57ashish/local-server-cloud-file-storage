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

class split_merge
{


    /*------------------------------------------------------------------
    -                           SPLIT                                  -
    - This function splits a file into given numbers of parts          -
    --------------------------------------------------------------------*/
    function split_file($file_name,$parts_num)
    {
        $handle = fopen($file_name, 'rb') or die("error opening file");
        $file_size = filesize($file_name);
        $parts_size = floor($file_size/$parts_num);
        $modulus=$file_size % $parts_num;
        for($i=0;$i<$parts_num;$i++)
        {
            if($modulus!=0 & $i==$parts_num-1)
                $parts[$i] = fread($handle,$parts_size+$modulus) or die("error reading file");
            else
                $parts[$i] = fread($handle,$parts_size) or die("error reading file");
        }
        //close file handle
        fclose($handle) or die("error closing file handle");

        //writing to splited files
        for($i=0;$i<$parts_num;$i++)
        {
            $handle = fopen('splited_'.$i, 'wb') or die("error opening file for writing");
            fwrite($handle,$parts[$i]) or die("error writing splited file");
        }
        //close file handle
        fclose($handle) or die("error closing file handle");
        return 'OK';
    }//end of function split_file

    /*------------------------------------------------------------------
    -                           MERGE                                  -
    - This function merges splited files that are splited with above   -
    - split_file function.                                             -
    --------------------------------------------------------------------*/
    function merge_file($merged_file_name,$parts_num)
    {
        $content='';
        //put splited files content into content
        for($i=0;$i<$parts_num;$i++)
        {
            $file_size = filesize('splited_'.$i);
            $handle    = fopen('splited_'.$i, 'rb') or die("error opening file");
            $content  .= fread($handle, $file_size) or die("error reading file");
        }
        //write content to merged file
        $handle=fopen($merged_file_name, 'wb') or die("error creating/opening merged file");
        fwrite($handle, $content) or die("error writing to merged file");
        return 'OK';
    }//end of function merge_file
    
}//end of class split_merge
?>
