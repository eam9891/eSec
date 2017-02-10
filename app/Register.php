<?php

/**
 * Created by PhpStorm.
 * User: Ethan
 * Date: 2/7/2017
 * Time: 1:28 PM
 */

error_reporting(E_ALL | E_STRICT);
ini_set("display_errors", 1);

include_once('Database.php');
include_once('Encryption.php');

class Register {
    private $username;
    private $password;
    private $email;
    private $stmt;
    private $row;

    public function doRegistration(string $user, string $pass, string $email) {
        $this->username = $user;
        $this->password = $pass;
        $this->email = $email;

        // Ensure that the user has entered a non-empty username
        if(empty($this->username)) {
            die("Please enter a username.");
        }

        // Ensure that the user has entered a non-empty password
        if(empty($this->password)) {
            die("Please enter a password.");
        }

        // Make sure the user entered a valid E-Mail address.
        // filter_var is a useful PHP function for validating form input, see:
        // http://us.php.net/manual/en/function.filter-var.php
        // http://us.php.net/manual/en/filter.filters.php
        if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            die("Invalid E-Mail Address");
        }

        // Using an sql query we first check if the username they want is in use
        $this->row = Database::selectOne("users", "username = ?", [$this->username]);

        // If a row was returned, then we know a matching username was found in
        // the database already and we should not allow the user to continue.
        if($this->row) {
            die("This username is already in use");
        }

        // Now we perform the same type of check for the email address, in order
        // to ensure that it is unique.
        $this->row = Database::selectOne("users", "email = ?", [$this->email]);

        if($this->row)
        {
            die("This email address is already registered");
        }

        // An INSERT query is used to add new rows to a database table.
        // Again, we are using special tokens (technically called parameters) to
        // protect against SQL injection attacks.
        // For more information on SQL injections, see Wikipedia:
        // http://en.wikipedia.org/wiki/SQL_Injection
        $query = "
            INSERT INTO users (
                username,
                password,
                salt,
                email
            ) VALUES (
                :username,
                :password,
                :salt,
                :email
            )
        ";

        // Generate a salt, and encrypt the password with it.
        $validate = new Encryption();
        $salt = $validate->generateSalt();
        $encryptedPass = $validate->eCrypt($pass, $salt);

        // Here we prepare our tokens for insertion into the SQL query.  We do not
        // store the original password; only the encrypted version of it.  We do store
        // the salt (in its plaintext form).
        $query_params = array (
            ':username' => $this->username,
            ':password' => $encryptedPass,
            ':salt' => $salt,
            ':email' => $this->email
        );

        $this->stmt = Database::insert($query, $query_params);


        // Todo: Fix this so users can upload a photo
        // Check if we have made the directory on the filesystem for the current user
        //if (!is_dir(" /var/www/html/userData/$id")) {

        // If it does not exist we will make it with the username
        //mkdir(" /var/www/html/userData/$id", 0777, true);
        //}


        // This redirects the user back to the index/login page after they registerForm
        header("Location: ../index.php");

        // Calling die or exit after performing a redirect using the header function is critical.
        // The rest of your PHP script will continue to execute and will be sent to the user if you do not die or exit.
        die("Redirecting to ../index.php");
    }

}