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

    // -------  Default controller to load ------
    define('DEFAULT_CONTROLLER', 'Home');
    define('DEFAULT_METHOD', 'index');
    
    // --------  Error Controller ----------------
    define('ERR_CONTROLLER', 'Errors');

    

    /*
     * -------------------------------------------------------
     *  Route
     * -------------------------------------------------------
     */

    Router::site(['Login'=>'Access']);
    Router::site(['Main'=>'Home']);
    Router::site(['Logging-in'=>'Access/signing_in']);
    Router::site(['Logging-out'=>'Access/signing_out']);

    Router::site(['Announcement-list/@any'=>'Announcement/index/$1']);
    Router::site(['Announcement-list'=>'Announcement']);
    Router::site(['Create-announcement'=>'Announcement/create']);
    Router::site(['Creating-announcement'=>'Announcement/creatingAnnouncement']);

    Router::site(['User-list/@any'=>'User/index/$1']);
    Router::site(['User-list'=>'User']);
    Router::site(['Create-user'=>'User/create']);
    Router::site(['Creating-user'=>'User/creatingUser']);

    Router::site(['MyProfile'=>'profile']);

    //Router::site(['Update-announcement/@num/@any'=>'Announcement/edit/$1/$2']);

?>