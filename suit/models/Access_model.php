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

    class Access_model extends Database{

        function login($username, $password)
        {
            $sql = "SELECT * FROM user WHERE USERNAME = :username";
            $query = $this->db->prepare($sql);
            $parameters = array(
                ':username' => $username
            );
            $query->execute($parameters);
            if($query->rowcount()){
                $data = $query->fetch();
                if(password_verify($password, $data['PASSWORD'])) {
                    Session::push(
                        array(
                            'userid' => $data['USERID'],
                            'username' => $data['USERNAME'],
                            'userrole' => $data['USERROLE']
                        )
                    );
                    return true;
                }else{
                    return false;
                }
            }else{
                return false;
            }
        }

        function passwordhash($password)
        {
            $options = array(
            'cost' => 4,
            );
            $password_hash = password_hash($password, PASSWORD_BCRYPT, $options);
            return $password_hash;
        }
        
        // public function createUser($username, $email, $pass){
        //     $sql = "INSERT INTO user (USERNAME, PASSWORD) VALUES (:username, :pass)";
        //     $query = $this->db->prepare($sql);
        //     $parameters = array(
        //         ':username' => $username,
        //         ':pass' => $pass
        //     );
        //     $query->execute($parameters);
        // }

        // public function users(){
        //     $sql = "SELECT * FROM users";
        //     $query = $this->db->prepare($sql);
        //     $query->execute();
        //     return $query->fetchAll();
        // }
        
        // public function countUsers(){
        //     $sql = "SELECT COUNT(*) FROM users";
        //     $query = $this->db->prepare($sql);
        //     $query->execute();
        //     return $query->fetch();
        // }

        // public function removeUser($username){
        //     $sql = "DELETE FROM users WHERE username = :username";
        //     $query = $this->db->prepare($sql);
        //     $parameters = array(
        //         ':username' => $username
        //     );
        //     $query->execute($parameters);
        // }

        // public function getUser($username){
        //     $sql = "SELECT USERNAME FROM user WHERE username = :username";
        //     $query = $this->db->prepare($sql);
        //     $parameters = array(
        //         ':username' => $username
        //     );
        //     $query->execute($parameters);
        //     if($query->rowcount())
        //         return $query->fetch();
        //     else
        //         return false;
        // }

        // public function updateUser($username, $email){
        //     $sql = "UPDATE users SET emil = :email WHERE username = :username";
        //     $query = $this->db->prepare($sql);
        //     $parameters = array(
        //         ':email' => $email, ':username' => $username);
        //     $query->execute($parameters);
        // }

        // function transac(){
        //     $data = [
        //         'Juan','Dela Cruz', 21,
        //         'Cardo','Dalisay', 30,
        //     ];
        //     $stmt = $pdo->prepare("INSERT INTO profile (firstname, lastname, age) VALUES (?,?,?)");
        //     try {
        //         $pdo->beginTransaction();
        //         foreach ($data as $row)
        //         {
        //             $stmt->execute($row);
        //         }
        //         $pdo->commit();
        //     }catch (Exception $e){
        //         $pdo->rollback();
        //         throw $e;
        //     }
        // }

    }

?>