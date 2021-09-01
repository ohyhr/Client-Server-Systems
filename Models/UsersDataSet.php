<?php
require_once ('Database.php');
require_once ('UsersData.php');
require_once('topics.php');

class UsersDataSet
{
    protected $_dbHandle, $_dbInstance;

    public function __construct() {
        $this->_dbInstance = Database::getInstance();
        $this->_dbHandle = $this->_dbInstance->getdbConnection();
    }

    //fetches all users.
    public function fetchAllUsers() {
        $sqlQuery = 'SELECT * FROM users';

        //prepares the sql query
        $statement = $this->_dbHandle->prepare($sqlQuery); // prepare a PDO statement
        $statement->execute(); // execute the PDO statement

        //This will fetch the particular row.
        $dataSet = [];
        while ($row = $statement->fetch()) {
            $dataSet[] = new UsersData($row);
        }
        return $dataSet;
    }

    //User login function.
    function userLogin($username, $password) //username and password is what the user will use to log in.
    {
        try {
            if (empty($username) || empty ($password)) { //if both username and password are empty an error message will occur.
                echo 'Please fill in the username and password fields';
            } else {
                $query = "SELECT username, email, password FROM users WHERE username='$username' AND password='$password'";
                var_dump($query);
                echo '<br>';
                $statement = $this->_dbHandle->prepare($query);
                // var_dump($statement);
                $statement->execute();
                $row = $statement->fetch();

                if ($row['username'] == $username && $row['password'] == $password) {
                    echo "You have successfully logged in" . row['username'];
                    return true;
                } else {
                    echo "Sorry, incorrect login details";
                    return false;
                }
            }
        } catch (PDOException $e) {
            echo $query . "<br>" . $e->getMessage();
        }
    }

    //Register function
    function registerUser($email, $username, $password)
    {
        try {
            // hashes password onto the database.
            $hash = password_hash($password, PASSWORD_DEFAULT);
            var_dump($hash);

            //this will select the emails and userId's from the users table where the email is given the value of input email.
            $query = 'SELECT email, user_id From users WHERE email="$email"';

            $statement = $this->_dbHandle->prepare($query);

            $statement->execute();
            $row = $statement->fetch();
            $_SESSION['id'] = $row['user_id'];

            //so if the email field, username and password email is empty then the user cannot register.
            if(empty($email) || empty($username) || empty($password))
            {
                return false;
            }
            // if the email field is equal to the input email then the error message will occur. Which states the email already exists.
            elseif($row['email'] == $email)
            {
                echo 'This email' . $row['email']. 'already occurs';
            }

            elseif($password !== $_POST['password2'])
            {
                echo 'Sorry the password does not match';
            }

            else {

//                $id = 'SELECT user_id FROM users WHERE user_email = $email';
//
//                $statement = $this->_dbHandle->prepare($id);
//                $statement->execute();
//
//                $row = $statement->fetch();


                $insertQuery = 'INSERT INTO users (username, password, email)
                                VALUES ('."\"$username\"".', '."\"$password\"".', '."\"$email\"".')';

                $statement = $this->_dbHandle->prepare($insertQuery);
                $statement->execute();
                $hash = password_hash($password, PASSWORD_DEFAULT);
                var_dump($hash);
                var_dump($statement);
                $this->_dbHandle = null;
            }
        }

        catch (PDOException $e)
        {
            echo $insertQuery . "<br>" . $e->getMessage();
        }
    }
    // this function get's all the posts from the post table.
    public function fetchAllPosts() {
        $sqlQuery = 'SELECT * FROM posts';

        $statement = $this->_dbHandle->prepare($sqlQuery); // prepare a PDO statement
        $statement->execute(); // execute the PDO statement

        $dataSet = [];
        while ($row = $statement->fetch()) {
            $dataSet[] = new posts($row);
        }
        return $dataSet;
    }


    function login($username, $user_pass)
    {
        $userData = $this->checkLogin($username, $user_pass);
        if(!($userData==null))
        {
            $_SESSION['loggedIn'] = $userData->getUserID();
            $_SESSION['loggedInUser'] = $userData->getUsername();
        }
    }


    private function userExits($username)
    {
        $query = "SELECT COUNT(*) FROM users WHERE username=:username";
        $statement = $this->_dbHandle->prepare($query);
        $statement->bindParam(':username', $username, PDO::PARAM_STR);
        $statement->execute();
        $row = $statement->fetch();
        $count = $row[0];
        if($count>0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }


    private function checkLogin($username, $user_pass)
    {
        try {
            $dataSet = null;

            $query = "SELECT users.* FROM users WHERE username = :username";

            $statement = $this->_dbHandle->prepare($query);
            $statement->bindParam(':username', $username, PDO::PARAM_STR);
            $statement->execute();
            while($row = $statement->fetch()) {
                if (password_verify($user_pass, $row['user_pass'])) {
                    echo "correct";
                    //$dataSet = [];
                    //$row = $statement->fetch();
                    $dataSet = new UserData($row);
                } else {
                    echo "Password or Email is incorrect. Please try again.";
                }
            }

            return $dataSet;
        } catch (PDOException $e) {
            echo $query . "<br>" . $e->getMessage();
        }

    }
}