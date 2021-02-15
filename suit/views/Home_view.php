<?php defined('BASE_DIRECTORY') OR exit('Direct access are not allowed'); 
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
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php notify(); ?>
    <div class="container">
        <div class="header">Welcome to ConfiRed Framework</div>
        <div class="body">

            <div class="content">a light & basic PHP MVC framework.</div>
        </div>
        <div class="footer">
            <div class="left">Version 1.0.0</div>
            <div class="right"><a href="https://www.confired.com">www.confired.com</a></div>
        </div>
    </div>
</body>
</html>

<style>
    .container{
        background-color: rgb(236, 236, 236);
        margin: 40px;
        border-radius: 2px;
        border: solid 1px rgb(212, 212, 212);
    }
    .header{
        padding: 10px;
        font-size: 28px;
        color: rgb(97, 97, 97);
        font-family: Arial;
        font-weight: normal;
        background-color: rgb(221, 218, 218);
        border-bottom: solid 1px rgb(207, 206, 206);
    }
    .body{
        
    }
    .content{
        padding: 10px;
        font-size: 14px;
        color: rgb(97, 97, 97);
        font-family: Arial;
    }
    .footer{
        padding-left: 10px;
        padding-right: 10px;
        font-size: 12px;
        color: rgb(97, 97, 97);
        font-family: Arial;
        font-weight: normal;
        background-color: rgb(230, 230, 230);
        /* border-top: solid 1px rgb(207, 206, 206); */
        border-bottom: solid 1px rgb(207, 206, 206);
        
    }
    .left{
        margin-top: 5px;
        text-align: left;
        float:left
    }
    .right{
        margin-top: 5px;
        text-align: right;
        float:right
    }
</style>