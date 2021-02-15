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
 *  Page URL
 * -------------------------------------------------------
 */






    /*
     * -------------------------------------------------------
     *  Active
     * -------------------------------------------------------
     */
    if ( ! function_exists('active')){
        // active page
        function active($page){
            $url_array =  explode('/', $_SERVER['REQUEST_URI']);
            
            /* -------------------------------------
                $countURL = count($url_array);
                if($countURL > 2){
                    $urlPage = $url_array[2];
                }else{
                    $urlPage = $url_array[1];
                }
                if($page == $urlPage){
                    echo 'active';
                }

                $countURL = count($url_array);
                if($countURL > 1){
                    $urlPage = $url_array[1];
                }else{
                    $urlPage = $url_array[0];
                }
                if($page == $urlPage){
                    echo 'active';
                }
            -------------------------------------- */
            
            if($page == $url_array[1]){
                echo 'active';
            }
        }
    }

    /*
     * -------------------------------------------------------
     *  call CSS
     * -------------------------------------------------------
     */
    if ( ! function_exists('callCSS')){
        // call external css
        function callCSS($files){
            foreach ($files as $file) {
                if(file_exists(ROOT_DIR . 'resources/css/' . $file. '.css')){
					echo '<link href="' . BASE_URL . 'resources/css/' . $file . '.css" rel="stylesheet" />' . "\r\n";
				}else{
					trigger_error($file . '.css' . ' file does not exist!', E_USER_WARNING);
                }
            }
        }
    }

    /*
     * -------------------------------------------------------
     *  Call JavaScript
     * -------------------------------------------------------
     */
    if ( ! function_exists('callJS')){
        // call external java script
        function callJS($files){
            foreach ($files as $file) {
                if(file_exists(ROOT_DIR . 'resources/js/' . $file. '.js')){
					echo '<script src="' . BASE_URL . 'resources/js/' . $file . '.js"></script>' . "\r\n";
				}else{
					trigger_error($file . '.js' . ' file does not exist!', E_USER_WARNING);
                }
            }
        }
    }




?>