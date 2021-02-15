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
	 *  Trim Url
	 * -------------------------------------------------------
	 */
    if ( ! function_exists('trimURL')){
        // trim url
        function trimURL($loc_url,$file_url){
            if($loc_url != $file_url){
                $url = str_replace('index'.PHP_EXT, '', $file_url); // ----- /
                $url = str_replace('/', '\/', $url) .'/'; // ----  \//
                $url = preg_replace('/'. $url, '', $loc_url, 1); // ------ 
                $url = trim($url, '/');
                return $url;
            }
        }
    }

    /*
	 * -------------------------------------------------------
	 *  Slice Url
	 * -------------------------------------------------------
	 */
    if ( ! function_exists('sliceURL')){
        // slice url
        function sliceURL($url){
            global $route;
            return $slices = explode('/', extractMapURL(filter_var($url, FILTER_SANITIZE_URL),$route));
        }
    }

    /*
	 * -------------------------------------------------------
	 *  Extract Url
	 * -------------------------------------------------------
	 */
    if ( ! function_exists('extractMapURL')){
        // extract correct URL
        function extractMapURL($url, $route){
            foreach($route as $pattern => $replacement){
                $pattern = str_replace("@any", "(.+)", $pattern);
                $pattern = str_replace("@num", "(\d+)", $pattern);
                $pattern = '/' . str_replace("/", "\/", $pattern) . '/i';
                $extractMapURL = preg_replace($pattern, $replacement, $url);
                if($extractMapURL !== $url && $extractMapURL !== NULL){
                    return $extractMapURL;
                }
            }
            return $url;
        }
    }

    /*
	 * -------------------------------------------------------
	 *  Check URL Controller & Method
	 * -------------------------------------------------------
	 */
    if ( ! function_exists('check_sliceURL_ctrl_methd')){
        // check URL controller & method
        function check_sliceURL_ctrl_methd($slices, $val){
            if(!is_int($val)){
                return false;
            }
            if(isset($slices[$val]) && !empty($slices[$val])){
                return $slices[$val];
            }else{
                return false;
            }
        }
    }

    /*
	 * -------------------------------------------------------
	 *  Check Controller
	 * -------------------------------------------------------
	 */
    if ( ! function_exists('checkControllerFile')){
        function checkControllerFile($controller,$dir){
            // check if the controller exist
            if(file_exists(SUIT_DIR . $dir. DS . $controller . PHP_EXT)){
                require_once(SUIT_DIR . $dir. DS . $controller . PHP_EXT);
            }else{
                $controller = ERR_CONTROLLER;
                require_once(SUIT_DIR . $dir. DS . ERR_CONTROLLER . PHP_EXT);
                $method = 'controllererr404';
                return array($controller,$method);
            }
        }
    }

    /*
	 * -------------------------------------------------------
	 *  Check Controller Method
	 * -------------------------------------------------------
	 */
    if ( ! function_exists('checkControllerMethod')){
        function checkControllerMethod($controller, $dir, $method){
            // check if the method not exist
            if(!method_exists($controller, $method)){
                $controller = ERR_CONTROLLER;
                require_once(SUIT_DIR . $dir. DS . ERR_CONTROLLER . PHP_EXT);
                $method = 'methoderr404';
                return array($controller,$method);
            }
        }
    }

    /*
	 * -------------------------------------------------------
	 *  Transmit Url
	 * -------------------------------------------------------
	 */
    if ( ! function_exists('transmit')){
        // transmit to another location 
        function transmit($location){
            header('Location: '. BASE_URL . $location);
        }
    }
?>