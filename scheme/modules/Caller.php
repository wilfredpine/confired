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
 *  Caller
 * -------------------------------------------------------
 */
class Caller extends Startup{

	public function __construct(){
		parent:: __construct();
	}
	
	/*
	 * -------------------------------------------------------
	 *  Call Functions
	 * -------------------------------------------------------
	 */
	public function callFunctions($functions = array()){
			if(is_array($functions)){
				foreach($functions as $function){
					if(file_exists(SUIT_DIR . 'glob' . DS. ucfirst($function) .PHP_EXT)){
						require(SUIT_DIR .'glob'. DS. ucfirst($function) .PHP_EXT);
					}else{
						trigger_error($function . ' file does not exist!', E_USER_WARNING);
					}
				}
			}else{
				return false;
			}
	}

	/*
	 * -------------------------------------------------------
	 *  Call Libraries
	 * -------------------------------------------------------
	 */
	public function callLibraries($libraries = array()){
			if(is_array($libraries)){
				foreach($libraries as $library){
					if(file_exists(SCHEME_DIR .'tools'. DS .'lib'. DS . ucfirst($library) .PHP_EXT)){
						if( ! class_exists(ucfirst($library), FALSE)) {
							require(SCHEME_DIR .'tools'. DS .'lib'. DS . ucfirst($library) .PHP_EXT);
							$this->$library = new $library;
						}
					}else{
						trigger_error($library . ' file does not exist!', E_USER_WARNING);
					}
				}
			}else{
				return false;
			}
	}
	
	/*
	 * -------------------------------------------------------
	 *  Call Model
	 * -------------------------------------------------------
	 */
	public function callModels($models = array()){
			if(is_array($models)){
				foreach($models as $model){
					if(file_exists(SUIT_DIR .'models'. DS . ucfirst($model) .PHP_EXT)){
						if( ! class_exists(ucfirst($model), FALSE)) {
							require(SUIT_DIR .'models'. DS . ucfirst($model) .PHP_EXT);
							$this->$model = new $model;
						}
					}else{
						$model = $model . '_model';
						if(file_exists(SUIT_DIR .'models'. DS . ucfirst($model) .PHP_EXT)){
							if( ! class_exists(ucfirst($model), FALSE)) {
								require(SUIT_DIR .'models'. DS . ucfirst($model) .PHP_EXT);
								$this->$model = new $model;
							}
						}else{
							trigger_error($model . ' file does not exist!', E_USER_WARNING);
						}
					}
				}
			}else{
				return false;
			}
	}

	/*
	 * -------------------------------------------------------
	 *  Call Helpers
	 * -------------------------------------------------------
	 */
	public function callHelpers($helpers = array()){
		if(is_array($helpers)){
			foreach($helpers as $helper){
				if(file_exists(SCHEME_DIR .'tools'. DS .'helpers'. DS . ucfirst($helper) .PHP_EXT)){
					require(SCHEME_DIR .'tools'. DS .'helpers'. DS . ucfirst($helper) .PHP_EXT);	
				}else{
					trigger_error($helper . ' file does not exist!', E_USER_WARNING);
				}
			}
		}else{
			return false;
		}
	}

	/*
	 * -------------------------------------------------------
	 *  Call Addon / Plugins
	 * -------------------------------------------------------
	 */
	public function callAddon($add_on = array()){
		if(is_array($add_on)){
			foreach($add_on as $adds){
				if(file_exists(ROOT_DIR .'add_on'. DS. $adds .PHP_EXT)){
					require(ROOT_DIR .'add_on'. DS. $adds .PHP_EXT);
					//$this->$adds = new $adds;
				}else{
					trigger_error($adds . ' file does not exist!', E_USER_WARNING);
				}
			}
		}else{
			return false;
		}
	}
    
    /*
	 * -------------------------------------------------------
	 *  Call View
	 * -------------------------------------------------------
	 */
    public function preview($fileName, $vars = NULL, $value = NULL){
		ob_start();
		if(!empty($vars)){
            if(is_array($vars)){
                foreach($vars as $var => $value){
                    $this->pageVariable[$var] = $value;
                }
            }else{
                $this->pageVariable[$vars] = $value;
            }
			extract($this->pageVariable);
		}
		//
			if(file_exists(SUIT_DIR .'views'. DS . str_replace('.','/',ucfirst($fileName)) . PHP_EXT)){
				require(SUIT_DIR .'views'. DS . str_replace('.','/',ucfirst($fileName)) . PHP_EXT);
			}else{
				$fileName = ucfirst($fileName) . '_view';
				if(file_exists(SUIT_DIR .'views'. DS . str_replace('.','/',$fileName) . PHP_EXT)){
					require(SUIT_DIR .'views'. DS . str_replace('.','/',$fileName) . PHP_EXT);
				}else{
					trigger_error(str_replace('.','/',$fileName) . ' file does not exist!', E_USER_WARNING);
				}
			}
		echo ob_get_clean();
	}
	
	

}

?>