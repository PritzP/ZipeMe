<?php

/*
Zipme

Description: Allows you to pass in GET params of audio file path and it will produced a downloadable zip file that is timestamped straight to the browser.
Version: 1
Author: Pritesh Pindoria
Author URI: https://twitter.com/Pritz_P

License:

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.
*/


	if (isset($_GET["files"])){	
		$filenames = $_GET["files"];
		$filenames = explode(",", $filenames);
		$today = date('Y/m/d H:i:s');
		$today_file_name =  "playlist-" . strval((strtotime($today))) . ".zip";
		//$today_file_name = "test.zip";
		$zip = new ZipArchive;
		if ($zip->open($today_file_name, ZipArchive::CREATE) === TRUE) {
			for ( $i = 0; $i < count($filenames); $i++) {
				$filepath = $filenames[$i];
				$filename = substr(strrchr($filenames[$i], "/"), 1);
				$zip->addFile($filepath, $filename);
			}
			$zip->close();
			$file = $today_file_name;
			header ("Content-type: octet/stream");
			header ("Content-disposition: attachment; filename=".$file.";");
			header("Content-Length: ".filesize($file));
			readfile($file);
			unlink($file);
			exit;
		}else{
			var_dump($res);	
		}

    }else{
	    echo "Opps, you haven't told me what you what to zip...";
    }
?>