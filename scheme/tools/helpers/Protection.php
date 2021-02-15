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
 *  Protection
 * -------------------------------------------------------
 */






    /*
     * -------------------------------------------------------
     *  Generate CSRF Token
     * -------------------------------------------------------
     */
    if ( ! function_exists('CSRFToken')){
        function CSRFToken(){
            $_SESSION['token'] = bin2hex(random_bytes(32));
            return $_SESSION['token'];
        }
    }

    /*
     * -------------------------------------------------------
     *  Verify CSRF Token
     * -------------------------------------------------------
     */
    if ( ! function_exists('CSRFProtect')){

        function CSRFProtect($token){
            if(hash_equals($_SESSION['token'], $token)){
                return true;
            }else{
                return false;
            }
        }
    }

    /*
     * -------------------------------------------------------
     *  Sanitize Outputs
     * -------------------------------------------------------
     */
    if ( ! function_exists('Sanitize')){
        function Sanitize($string){
            return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
        }
    }

    /*
     * -------------------------------------------------------
     *  Clean Data Inputs
     * -------------------------------------------------------
     */
    if ( ! function_exists('cleanData')){
        function cleanData($string){
            $string = trim($string);
            $string = stripslashes($string);
            return $string;
        }
    }

    /*-------------------------------------------------------
        $name = test_input($_POST["name"]);
        if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
            $nameErr = "Only letters and white space allowed";
        }
    -------------------------------------------------------*/

    /*-------------------------------------------------------
        $email = test_input($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
        }
    -------------------------------------------------------*/

    /*-------------------------------------------------------
        Constant						ID		Description
        
		FILTER_VALIDATE_BOOLEAN			258		Validates a boolean
		FILTER_VALIDATE_EMAIL			274		Validates an e-mail address
		FILTER_VALIDATE_FLOAT			259		Validates a float
		FILTER_VALIDATE_INT				257		Validates an integer
		FILTER_VALIDATE_IP				275		Validates an IP address
		FILTER_VALIDATE_REGEXP			272		Validates a regular expression
		FILTER_VALIDATE_URL				273 	Validates a URL
		FILTER_SANITIZE_EMAIL			517		Removes all illegal characters from an e-mail address
		FILTER_SANITIZE_ENCODED			514		Removes/Encodes special characters
		FILTER_SANITIZE_MAGIC_QUOTES	521		Apply addslashes()
		FILTER_SANITIZE_NUMBER_FLOAT	520		Remove all characters, except digits, +- and optionally .,eE
		FILTER_SANITIZE_NUMBER_INT		519		Removes all characters except digits and + -
		FILTER_SANITIZE_SPECIAL_CHARS	515		Removes special characters
		FILTER_SANITIZE_FULL_SPECIAL_CHARS	 	 
		FILTER_SANITIZE_STRING			513		Removes tags/special characters from a string
		FILTER_SANITIZE_STRIPPED		513		Alias of FILTER_SANITIZE_STRING
		FILTER_SANITIZE_URL				518		Removes all illegal character from s URL
		FILTER_UNSAFE_RAW				516		Do nothing, optionally strip/encode special characters
		FILTER_CALLBACK					1024	Call a user-defined function to filter data
	-------------------------------------------------------*/

?>
