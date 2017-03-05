<?php
/**
 * Created by PhpStorm.
 * User: Ethan
 * Date: 3/2/2017
 * Time: 8:53 PM
 */

namespace framework\libs;
use framework\database\Database;

session_start();

class Authenticate {
    private $userRole;
    private $dbRole;
    private $returnAuthStatus = false;

    public function __construct(string $userRole) {
        $this->userRole = $userRole;
        $this->checkRole($this->userRole);

    }

    /** Returns the role of a user provided the username
     * @param string $username
     *
     * @return string
     */
    private function getRole(string $username) : string {

        $db = Database::connect();

        $query = "SELECT role FROM users WHERE username = :x";
        $query_params = array(
            ':x' => $username
        );

        $stmt = $db->prepare($query);
        $stmt->execute($query_params);

        $role = $stmt->fetchColumn();

        return $role;
    }

    private function checkRole(string $role) : bool {

        if (isset($_SESSION['username'])) {
            $this->dbRole = $this->getRole($_SESSION['username']);
        } else {
            header("Location: ../");
            die("Redirecting to: ../");
        }


        switch ($role) {

            case "admin":
                if ($this->dbRole == "admin") {
                    $this->returnAuthStatus = true;
                    break;
                } else {
                    header("Location: ../");
                    die("Redirecting to: ../");
                    break;
                }

            case "moderator":



            case "contributor":


            case "user":
                if ($this->dbRole = "user" || $this->dbRole = "admin") {
                    $this->returnAuthStatus = true;
                    break;
                } else {
                    header("Location: ../");
                    die("Redirecting to: ../");
                    break;

                }


            default:
                header("Location: ../");
                die("Redirecting to: ../");
                break;
        }
        return $this->returnAuthStatus;
    }


}