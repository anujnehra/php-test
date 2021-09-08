<?php

class ProcessForm
{

    const USER_INFO_ALIAS = 'user_info';
    const USER_HOBBY_ALIAS = 'user_hobby';

    public $conn = null;

    public function __construct()
    {
        $servername = "localhost";
        $username = "root";
        $password = "root";
        $dbname = "assignment";

        $this->conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function form_submit($post)
    {
        try {
            $stmt = $this->conn->prepare("INSERT INTO " . self::USER_INFO_ALIAS . " (first_name, last_name, email, dob, phone, designation, gender)
        VALUES (:first_name, :last_name, :email, :dob, :phone, :designation, :gender)");
            $stmt->bindParam(':first_name', $post['firstname']);
            $stmt->bindParam(':last_name', $post['lastname']);
            $stmt->bindParam(':email', $post['email']);
            $stmt->bindParam(':dob', $post['dob']);
            $stmt->bindParam(':phone', $post['phone']);
            $stmt->bindParam(':designation', $post['designation']);
            $stmt->bindParam(':gender', $post['gender']);
            $stmt->execute();
            return $this->conn->lastInsertId();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            die;
        }
        if (empty($_POST['hobby'])) {
            $this->conn = null;
        }
    }

    public function checkEmailExist($email)
    {
        $id = 0;
        $stmt = $this->conn->prepare("SELECT user_id FROM " . self::USER_INFO_ALIAS . " WHERE email=:email");
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch();
        if (!empty($user)) {
            $id = $user['user_id'];
        }
        return $id;
    }

    public function insertHobby($userId, $hobbies)
    {
        try {
            foreach ($hobbies as $id) { //loop won't be problem for multiple insert as they are of max 4 count
                $stmt = $this->conn->prepare("INSERT INTO " . self::USER_HOBBY_ALIAS . " (user_id, hobby_id)
            VALUES (:user_id, :hobby_id)");
                $stmt->bindParam(':user_id', $userId);
                $stmt->bindParam(':hobby_id', $id);
                $stmt->execute();
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            die;
        }
    }

}

if (empty($_POST)) {
    echo "no post data present";
    die;
}

if (empty($_POST['firstname']) || empty($_POST['lastname']) || empty($_POST['email']) || empty($_POST['dob']) || empty($_POST['phone']) || empty($_POST['designation']) || empty($_POST['gender'])) {
    echo "form data is empty";
    die;
}

//sanitize
$_POST['firstname'] = filter_var($_POST['firstname'], FILTER_SANITIZE_STRING);
$_POST['lastname'] = filter_var($_POST['lastname'], FILTER_SANITIZE_STRING);
$_POST['designation'] = filter_var($_POST['designation'], FILTER_SANITIZE_STRING);
$_POST['email'] = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

if (!is_numeric($_POST['phone'])) {
    echo "phone data is invalid";
    die;
}


$obj = new ProcessForm;
$user = $obj->checkEmailExist($_POST['email']);

if ($user > 0) {
    echo "user already exist";
} else {
    $userId = $obj->form_submit($_POST);
    if (!empty($_POST['hobby'])) {
        $obj->insertHobby($userId, $_POST['hobby']);
    }
    echo "Record inserted";
}

