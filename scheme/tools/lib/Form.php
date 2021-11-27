<?php
defined('BASE_DIRECTORY') OR exit('Direct access are not allowed');
/**
 * __________________________________________________________________
 *
 * ConfiRed - an opensource light & basic PHP MVC Framework
 * __________________________________________________________________
 *
 * MIT License
 * 
 * Copyright (c) 2020 Wilfred V. Pine
 * 
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package ConfiRed
 * @author Wilfred V. Pine <only.master.red@gmail.com>
 * @copyright Copyright 2020 (https://red.confired.com)
 * @link https://confired.com
 * @license https://opensource.org/licenses/MIT MIT License
 */


/*
 * -------------------------------------------------------
 *  Form
 * -------------------------------------------------------
 */
class Form{

	/*
	 * -------------------------------------------------------
	 *  Post
	 * -------------------------------------------------------
	 */
    static function post($input){
		if(isset($_POST[$input])){
			return cleanData($_POST[$input]);
		}
    }
	
	/*
	 * -------------------------------------------------------
	 *  Get
	 * -------------------------------------------------------
	 */
    static function get($get){
		if(isset($_GET[$get])){
			return cleanData($_GET[$get]);
		}
	}

	/*
	 * -------------------------------------------------------
	 *  Submit
	 * -------------------------------------------------------
	 */
	static function submit($btn){
		if(isset($_POST[$btn])){
			//return true;
			return !empty($_POST) ? TRUE : FALSE;
		}
	}

	/*
	 * -------------------------------------------------------
	 *  Upload
	 * -------------------------------------------------------
	 */
	static function upload($input_fileName,$target_dir,$newName,$valid_ext=array(),$MB_limit,$quality=100){
		
		$path = basename($_FILES[$input_fileName]["name"]);
		$ext = strtolower(pathinfo($path, PATHINFO_EXTENSION)); //get extension
		$new_inputfilename = $newName.'.'.$ext; // rename
		$target_file = $target_dir.$new_inputfilename; //whole path file
		$file = $_FILES[$input_fileName]["tmp_name"];
		
		if(file_exists($target_file))  { 
			unlink($target_file);
		} 

		$maxFileSize = $MB_limit * 1024 * 1024; // MB to bytes

		if (!in_array($ext, $valid_ext)) {
			return 'Invalid file type.';
		}elseif($_FILES[$input_fileName]["size"] == 0) { 
			return 'There was a problem on your file.';
		}elseif($_FILES[$input_fileName]["size"] > $maxFileSize) { 
			return 'Your file is too large.';
		}else{

			if($ext=='jpeg' || $ext=='jpg' || $ext=='png' || $ext=='gif'){

				//double check the file
				if(($_FILES[$input_fileName]["type"] == "image/jpeg") || ($_FILES[$input_fileName]["type"] == "image/gif") || ($_FILES[$input_fileName]["type"] == "image/jpg") || ($_FILES[$input_fileName]["type"] == "image/png")){

					//upload the file
					if(Self::compressImage($file, $target_file, $quality, $ext)){
						return 'success';
					}
					return 'Failed uploading your file.';

				}else{
					return 'Your file is invalid.';
				}

			}else{

				//double check the file
				if(($_FILES[$input_fileName]["type"] == "video/mp4") || ($_FILES[$input_fileName]["type"] == "audio/mp3")){
					if(move_uploaded_file($file, $target_file)) {
						return 'success';
					}
					return 'Failed uploading your file.';
				}else{
					return 'Your file is invalid.';
				}

			}
			

		}
		
	}

	/*
	 * -------------------------------------------------------
	 *  Compress Image
	 * -------------------------------------------------------
	 */
	static function compressImage($source, $destination, $quality, $ext) {

		if($ext=='jpeg'){
			$image = imagecreatefromjpeg($source);
			return imagejpeg($image, $destination, $quality);
		}elseif($ext=='png'){
			$image = imagecreatefrompng($source);
			return imagepng($image, $destination, 0);
		}elseif($ext=='gif'){
			$image = imagecreatefromgif($source);
			return imagegif($image, $destination);
		}else{
			$image = imagecreatefromjpeg($source);
			return imagejpeg($image, $destination, $quality);
		}
			
    }

	/*
	 * -------------------------------------------------------
	 *  Auto Genirated Number
	 * -------------------------------------------------------
	 */
	static function GENID(){
		mt_srand((double)microtime()*10000);
		$charid = md5(uniqid(rand(), true));
		$c = unpack("C*",$charid);
		$c = implode("",$c);
		return cleanData(substr($c,0,20));
	}

}
?>