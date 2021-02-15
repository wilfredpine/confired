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

    class User extends Caller{
        
        function __construct(){
            parent:: __construct();
            
            if(!Session::pull('username')){
                transmit('Login');
            }

        }

        function index($page = 1)
        {
            $limit = 5;

            $data = $this->user_model->fetchUsers($limit, $page);

            $data['limit'] = $limit;
            $data['page'] = $page;
            $data['total'] = $data['total'];
            $data['users'] = $data['rows'];

            $this->preview('User_view',$data);
        }
    
        function create()
        {
            CSRFToken();
            $this->preview('UserCreate_view');
        }
        
        function creatingUser()
        {
            if(Form::submit('register'))
            {
                if(CSRFProtect(cleanData($_POST['token']))){
                    $this->callModels(['access']);

                    $operat = $this->user_model->checkUsername(Form::post('username'));

                    if($operat==true){			
                            Session::push(['alert_message' => 'Username already exist!', 'alert_class' => 'danger']);
                            transmit('Create-user');
                    }else{
        
                        if(Form::post('PASSWORD') == Form::post('CONFIRM_PASSWORD'))
                        {
                            
                            $result = $this->user_model->insertUser(Form::post('USERNAME'),$this->access_model->passwordhash(Form::post('PASSWORD')),Form::post('FULLNAME'),'USER',Form::post('PROGORGID'));
                            if($result==true)
                            {
                                Session::push(['alert_message' => 'Successfully saved', 'alert_class' => 'success']);
                                transmit('User-list');
                            }
                            else
                            {
                                Session::push(['alert_message' => 'Failed', 'alert_class' => 'danger']);
                                transmit('Create-user');
                            }
                        }
                        else
                        {
                            
                            Session::push(['alert_message' => 'Password did not match!', 'alert_class' => 'danger']);
                            transmit('Create-user');
                        }
        
                    }
                }else{
                    Session::push(['alert_message' => 'Invalid Token', 'alert_class' => 'danger']);
                    transmit('Create-user');
                }
            }
        }

        function change_password()
        {
            CSRFToken();
            $data['profile'] = $this->user_model->fetchProfile(cleanData(Session::pull('username')));
            $this->preview('UserChangePassword_view',$data);
        }

        function changing_password()
        {
            if(Form::submit('change')){
                if(CSRFProtect(cleanData($_POST['token']))){
                    $this->callModels(['access']);

                    if($this->user_model->cheackOldPassword(Form::post('USERNAME'),Form::post('OLDPASSWORD')))
                    {

                        if(Form::post('PASSWORD') == Form::post('CONFIRM_PASSWORD'))
                        {

                            if($this->user_model->updatePassword(Form::post('USERNAME'),$this->access_model->passwordhash(Form::post('PASSWORD'))))
                            {

                                Session::push(['alert_message' => 'Successfuly changed!', 'alert_class' => 'success']);
                                transmit('Update-password');

                            }
                            else
                            {
                                Session::push(['alert_message' => 'Failed updating your password', 'alert_class' => 'danger']);
                                transmit('Update-password');
                            }

                        }
                        else
                        {
                            Session::push(['alert_message' => 'Password did not match!', 'alert_class' => 'danger']);
                            transmit('Update-password');
                        }

                    }
                    else
                    {
                        Session::push(['alert_message' => 'Password incorrect!', 'alert_class' => 'danger']);
                        transmit('Update-password');
                    }



                }else{
                    Session::push(['alert_message' => 'Invalid Token', 'alert_class' => 'danger']);
                    transmit('Update-password');
                }
            }
        }

    }

?>