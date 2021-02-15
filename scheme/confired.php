
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
	 *  Core
	 * -------------------------------------------------------
	 */
    function cheers(){
        
        $url = '';

        /*
         * -------------------------------------------------------
         *  Trim Url Path
         * -------------------------------------------------------
         */
        $url = trimURL(LOC_URL,FILE_URL);

        /*
         * -------------------------------------------------------
         *  Slice URL
         * -------------------------------------------------------
         */
        $slices = sliceURL($url);

        /*
         * -------------------------------------------------------
         *  Check URL Characters
         * -------------------------------------------------------
         */
        if($slices[0] != NULL){
            foreach($slices as $slice){
                if (!preg_match('/^['.PERMITTED_URL_CHARS.']+$/i', $slice)){
                    trigger_error("The characters you entered in the URL are not permitted!", E_USER_WARNING);
                }
            }
        }

        /*
         * -------------------------------------------------------
         *  Virtual Host
         * -------------------------------------------------------
         */
		$url_controller = 0;
		$url_method = 1;
        $url_parameter = 0;

        /*
         * -------------------------------------------------------
         *  Localhost
         * -------------------------------------------------------
         */
		if($_SERVER['SERVER_NAME']=='localhost' || $_SERVER['SERVER_NAME']=='127.0.0.1'){
			$url_controller = 1;
            $url_method = 2;
            $countSlice = count($slices);
			if($countSlice > 1){
                $url_parameter = 1;
            }
        }

        /*
         * -------------------------------------------------------
         *  Get Default Controller
         * -------------------------------------------------------
         */
        $controller = DEFAULT_CONTROLLER;

        /*
         * -------------------------------------------------------
         *  Check URL Controller
         * -------------------------------------------------------
         */
        if(check_sliceURL_ctrl_methd($slices, $url_controller)){
            $controller = check_sliceURL_ctrl_methd($slices, $url_controller);
        }

        /*
         * -------------------------------------------------------
         *  Get Default Method
         * -------------------------------------------------------
         */
        $method = DEFAULT_METHOD;

        /*
         * -------------------------------------------------------
         *  Check URL Method
         * -------------------------------------------------------
         */
        if(check_sliceURL_ctrl_methd($slices, $url_method)){
            $method = check_sliceURL_ctrl_methd($slices, $url_method);
        }

        /*
         * -------------------------------------------------------
         *  Controller naming compatibility
         * -------------------------------------------------------
         */
        $controller = ucfirst($controller);

        /*
         * -------------------------------------------------------
         *  Controller Directory
         * -------------------------------------------------------
         */
        $dir = 'controllers';

        /*
         * -------------------------------------------------------
         *  Check if Controller Exist
         * -------------------------------------------------------
         */
        if($controllerResult = checkControllerFile($controller,$dir)){
            $controller = $controllerResult[0];
            $method = $controllerResult[1];
        }

        /*
         * -------------------------------------------------------
         *  Check if Method Exist
         * -------------------------------------------------------
         */
        if($methodResult = checkControllerMethod($controller, $dir, $method)){
            $controller = $methodResult[0];
            $method = $methodResult[1];
        }
        
        /*
         * -------------------------------------------------------
         *  Call method of an class/controller
         * -------------------------------------------------------
         */
        die(call_user_func_array(array(new $controller, $method), array_slice($slices, 2)));
    }

?>