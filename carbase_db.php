<?php
class carbase_db
{
    private static $carbase_instance = null;
    private $dbh;
    private function __construct() {
        try{
            $config = Config::getConfigInstance();
            $server = $config->getServer();
            $database = $config->getDatabase();
            $username = $config->getUsername();
            $password = $config->getPassword();
            $this->dbh = new PDO("mysql:host=$server; dbname=$database", $username, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $e) {
            die($e->getMessage());
        }
    }
    public static function getCarbaseInstance() {
        if(is_null(self::$carbase_instance)) {
            self::$carbase_instance = new Carbase_db();
        }
        return self::$carbase_instance;
    }
    public function closeConnection() {
        $this->dbh = null;
    }
    //TODO sql functions here
    public function getPass($username) {
        $passCrypt = "";
        try {
			$sql = "select hashedpassword from gerbrand_jd2.users where username like :username";
			$stmt = $this->dbh->prepare($sql);
			$stmt->bindParam(":username", $username);
			$stmt->execute();
			$login = $stmt->fetchAll(PDO::FETCH_COLUMN);
			if(!empty($login)) {
				$login = $login[0];
			} else {
				echo "<div class='error'><p>Failed to fetch login</p></div>";
				$login = "";
			}
			$passCrypt = $login;
		}catch(PDOException $e) {
        	die($e->getMessage());
		}
		return $passCrypt;
    }
    public function searchUser($keyword){
        $result = "";
        try {
			$sql = "select username from gerbrand_jd2.users where username like :keyword";
			$stmt = $this->dbh->prepare($sql);
			$stmt->bindParam(":keyword", $keyword);
			$stmt->execute();
			$resultSet = $stmt->fetchAll(PDO::FETCH_COLUMN);
			if(!empty($resultSet)) {
				$resultSet = $resultSet[0];
			} else {
				echo "<div class='error'><p>No users found.</p></div>";
				$resultSet = "";
			}
			$result = $resultSet;
		}catch(PDOException $e) {
        	die($e->getMessage());
		}
		return $result;
    }
    public function searchCar($keyword){
        $result = "";
        try {
			$sql = "select carbrand from gerbrand_jd2.cars where carbrand like :keyword";
			$stmt = $this->dbh->prepare($sql);
			$stmt->bindParam(":keyword", $keyword);
			$stmt->execute();
			$resultSet = $stmt->fetchAll(PDO::FETCH_COLUMN);
			if(!empty($resultSet)) {
				$resultSet = $resultSet[0];
			} else {
				echo "<div class='error'><p>No cars found.</p></div>";
				$resultSet = "";
			}
			$result = $resultSet;
		}catch(PDOException $e) {
        	die($e->getMessage());
		}
		return $result;
    }
    public function getLastImages(){
        $imgs = "";
        try{
            $sql = "select * from gerbrand_jd2.images order by uploadDate desc limit 20";
            $stmt = $this->dbh->prepare($sql);
            $stmt->execute();
            $imgs = $stmt->fetchAll(PDO::FETCH_OBJ);
        }catch(PDOException $e) {
            die($e->getMessage());
        }
        return $imgs;
    }
    public function getUsersImages($user){
        $imgs = "";
        try{
            $userid = self::getUserId($user);
            $sql = "select * from gerbrand_jd2.images where user_id = :userid order by uploadDate desc";
            $stmt = $this->dbh->prepare($sql);
			$stmt->bindParam(":userid", $userid);
            $stmt->execute();
            $imgs = $stmt->fetchAll(PDO::FETCH_OBJ);
        }catch(PDOException $e) {
            die($e->getMessage());
        }
        return $imgs;
    }
    public function getUserId($username){
        $UserId = "";
        try {
			$sql = "select user_id from gerbrand_jd2.users where username like :username";
			$stmt = $this->dbh->prepare($sql);
			$stmt->bindParam(":username", $username);
			$stmt->execute();
			$UserId = $stmt->fetchAll(PDO::FETCH_COLUMN);
		}catch(PDOException $e) {
        	die($e->getMessage());
		}
		return $UserId[0];
    }
    public function storeFile($userId, $imgName, $path){
        $success = false;
        try{
            $uname = self::getUserId($userId);
            $date = date("Y-m-d H:i:s");
            
            $sql = "insert into gerbrand_jd2.images (user_id, name, path, uploadDate) values (:user_id, :name, :path, :uploadDate);";
            $stmt = $this->dbh->prepare($sql);
            $stmt->bindParam(":user_id", $uname);
            $stmt->bindParam(":name", $imgName);
            $stmt->bindParam(":path", $path);
            $stmt->bindParam(":uploadDate", $date);
            $stmt->execute();
            $success = true;
        }catch(PDOException $e) {
            die($e->getMessage());
        }
        return $success;
    }
    public function registerUser($username, $password) {
        $success = false;
        try{
            $sql = "select * from gerbrand_jd2.users where username like :username";
            $stmt = $this->dbh->prepare($sql);
            $stmt->bindParam(":username", $username);
            $stmt->execute();
            $resultset = $stmt->fetchAll(PDO::FETCH_OBJ);
            if(empty($resultset)) {
                $sql = "insert into gerbrand_jd2.users (username, hashedpassword) values (:username, :hashedpassword);";
                $stmt = $this->dbh->prepare($sql);
                $stmt->bindParam(":username", strtolower($username));
                $stmt->bindParam(":hashedpassword", $password);
                $stmt->execute();
                $success = true;
            }
        }catch(PDOException $e) {
            die($e->getMessage());
        }
        return $success;
    }
}
