<?php
/**
 * Created by PhpStorm.
 * User: Ethan
 * Date: 3/4/2017
 * Time: 11:28 PM
 */

namespace admin;

use framework\libs\Authenticate;
use framework\User;
use home\IUserInterface;

class Head extends IUserInterface {

    public function __construct(Authenticate &$auth, User &$USER) {
        self::$htmlString = <<<headUI

            <!DOCTYPE html>
            <html lang="en">
            <head>
                <title>Underground Art School</title>
                <meta charset="utf-8">
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
                <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
                <script src="http://cloud.tinymce.com/stable/tinymce.min.js?apiKey=q51gr2pl1firxabxen6o39fc0gu7vd7m6hwzim9v9pqh68a7"></script>
                <script>
                    tinymce.init({
                        selector: "textarea",
                        plugins: [
                            "advlist autolink lists link image charmap print preview anchor",
                            "searchreplace visualblocks code fullscreen",
                            "insertdatetime media table contextmenu paste"
                        ],
                        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
                    });
                    
                    
                    
                </script>
                <style>
                    /* Set black background color, white text and some padding */
                    footer {
                        background-color: #555;
                        color: white;
                        padding: 15px;
                    }
                    .profileButton {
                        border: none;
                        cursor: pointer;
                    }
                    .dropdownImage {
                        margin-top: 10px;
            
                    }
                    .navbar-login
                    {
                        width: 305px;
                        padding: 10px;
                        padding-bottom: 0px;
                    }
            
            
                    .navbar-login-session
                    {
                        padding: 10px;
                        padding-bottom: 0px;
                        padding-top: 0px;
                    }
            
                    .icon-size
                    {
                        font-size: 87px;
                    }
            
                    @media screen and (max-width: 1000px) {
                        .searchForm {
                            width: 200px;
                        }
                    }
                </style>
            </head>
            <body>
headUI;
        parent::__construct($auth, $USER, self::$htmlString);
    }

}