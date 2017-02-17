<?php

/**
 * Created by PhpStorm.
 * User: Ethan
 * Date: 2/10/2017
 * Time: 11:40 PM
 */

class User {

    private $userId;
    private $userName;
    private $email;
    private $password;
    private $role;

    //##################### Accessor and Mutator Methods #########################

    public function getUserId() {
        return $this->userId;
    }

    public function getUsername() {
        return $this->userName;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getRole() {
        return $this->role;
    }

    public function setUsername($userName) {
        $this->userName = $userName;
    }

    public function setUserId($userId) {
        $this->userId = $userId;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function setRole($role) {
        $this->role = $role;
    }

    //##################### End of Accessor and Mutator Methods ##################

    /**
     * Returns the User Object provided the id of the user.
     *
     * @param int $id
     * @return User
     * @internal param PDO $db
     */
    public function getUser($id) {

        $db = Database::connect();
        // This query retrieves the user's information from the database using the supplied userID
        $query = "
            SELECT
                *
            FROM users
            WHERE
                userID = :x
        ";

        // The parameter values
        $query_params = array(
            ':x' => $id
        );

        // Prepare and execute the query against the database
        $stmt = $db->prepare($query);
        $stmt->execute($query_params);

        // Return row into array
        $user_details = $stmt->fetch();


        $user = new User();
        $user->arrToUser($user_details);
        return $user;
    }

    /**
     * Set's the user details returned from the query into the current object.
     *
     * @param array $userRow
     */
    public function arrToUser($userRow) {
        if (!empty($userRow)) {
            isset($userRow['userID']) ?
                $this->setUserId($userRow['userID']) : '';
            isset($userRow['username']) ?
                $this->setUsername($userRow['username']) : '';
            isset($userRow['email']) ?
                $this->setEmail($userRow['email']) : '';
            isset($userRow['password']) ?
                $this->setPassword($userRow['password']) : '';
            isset($userRow['role']) ?
                $this->setRole($userRow['role']) : '';
        }
    }
}