<?php
/**
 * Created by PhpStorm.
 * User: Ethan
 * Date: 3/3/2017
 * Time: 2:08 PM
 */

namespace home {

    use framework\libs\Authenticate;
    use framework\User;

    class Head extends IUserInterface {

        public function __construct(User &$USER) {
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
            parent::__construct("user", $USER, self::$htmlString);
        }

    }
}