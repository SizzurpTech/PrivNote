<?php
class Database {
    function __construct($host, $usr, $pwd, $db) {
        $this->db = mysqli_connect($host, $usr, $pwd, $db);
    }

    function getUser($id) {
        $uid = $id;
        
        $stmt = $this->db->prepare("SELECT * FROM users WHERE `id` = ?");
        $stmt->bind_param("i", $uid);
        $stmt->execute();
        $res = $stmt->get_result();
        $ret = array();
        while ($row = $res->fetch_assoc()) {
            $ret[] = $row;
        }
        return $ret;
    }

    function getUserN($name) {
        $uid = $name;
        
        $stmt = $this->db->prepare("SELECT * FROM users WHERE `username` = ?");
        $stmt->bind_param("s", $uid);
        $stmt->execute();
        $res = $stmt->get_result();
        $ret = array();
        while ($row = $res->fetch_assoc()) {
            $ret[] = $row;
        }
        return $ret;
    }

    function getUserE($mail) {
        $uid = $mail;
        
        $stmt = $this->db->prepare("SELECT * FROM users WHERE `email` = ?");
        $stmt->bind_param("s", $uid);
        $stmt->execute();
        $res = $stmt->get_result();
        $ret = array();
        while ($row = $res->fetch_assoc()) {
            $ret[] = $row;
        }
        return $ret;
    }

    function addUser($name, $mail, $pwd) {
        $name = trim($name);
        $mail = trim($mail);
        $pwd = trim($pwd);

        if(empty($name) || !preg_match("/^[A-Za-z0-9_-]{3,16}$/", $name))
            return "uInvalid username.";

        if(count($this->getUserN($name)) > 0)
            return "uUsername taken.";
        
        if(count($this->getUserE($mail)) > 0)
            return "eEmail taken.";
        
        if(!filter_var($mail, FILTER_VALIDATE_EMAIL))
            return "eInvalid email.";

        if(strlen($pwd) < 8)
            return "pPassword must be at least 8 characters long!";

        if(!preg_match("#[0-9]+#", $pwd))
            return "pPassword must include at least one number!";

        if(!preg_match("#[a-z]+#", $pwd))
            return "pPassword must include at least one lowercase letter!";

        if(!preg_match("#[A-Z]+#", $pwd))
            return "pPassword must include at least one uppercase letter!";

        $pass = hash("sha512", $pwd);

        $code = hash("sha512", mt_rand(PHP_INT_MIN, PHP_INT_MAX));
        $ver = false;
        $user = $name;
        $email = $mail;
        
        $stmt = $this->db->prepare("INSERT INTO `users` (`username`, `email`, `emailcode`, `verified`, `password`) VALUES (?, ?, ?, ?, ?)");
        if(!$stmt)
            return $this->db->error;
        $stmt->bind_param("sssis", $user, $email, $code, $ver, $pass);

        $stmt->execute();

        return true;
    }

    function verifyUser($hash) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE `emailcode` = ?");
        $stmt->bind_param("s", $hash);
        $stmt->execute();
        $res = $stmt->get_result();
        while ($row = $res->fetch_assoc()) {
            if($row["verified"] == 0) {
                $stmt = $this->db->prepare("UPDATE `users` SET `verified` = 1 WHERE `id` = ?");
                $id = $row["id"];
                $stmt->bind_param("i", $id);
                $stmt->execute();
                return 2;
            } else {
                return 1;
            }
        }
        return 0;
    }

    function authUser($name, $pwd) {
        $name = trim($name);
        $pwd = trim($pwd);

        $u = null;
        
        if(count($this->getUserN($name)) < 1) {
            if(count($this->getUserE($name)) < 1) {
                return array(false, "uInvalid username.");
            } else {
                $u = $this->getUserE($name)[0];
            }
        } else {
            $u = $this->getUserN($name)[0];
        }

        $pass = hash("sha512", $pwd);

        if($u["password"] == $pass) {
            return array(true, $u);
        } else {
            return array(false, "pInvalid password. ($u[password] != $pass)");
        }
    }

    function addNote($user, $name, $content) {
        $u = $this->getUser($user)[0];
        $name = htmlentities(trim($name));
        $content = htmlentities(trim($content));

        if(empty($name))
            return "uInvalid name.";

        if(empty($content))
            return "uInvalid content.";

        $stmt = $this->db->prepare("INSERT INTO `notes` (`owner`, `name`, `content`, `iv`) VALUES (?, ?, ?, ?)");
        if(!$stmt)
            return $this->db->error;
        
        $enc = Crypto::Encrypt($content, $u["password"]);
        $data = $enc["encrypted"];
        $iv = $enc["iv"];

        $stmt->bind_param("isss", $user, $name, $data, $iv);

        if($stmt->execute())
            return true;
        else
            return $stmt->error;
    }

    function getNote($user, $id) {
        $u = $this->getUser($user)[0];
        
        $stmt = $this->db->prepare("SELECT * FROM notes WHERE `id` = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $res = $stmt->get_result();
        $ret = array();
        while ($row = $res->fetch_assoc()) {
            if($row["owner"] == $user)
                $ret[] = $row;
        }
        if(count($ret) == 0) return false;
        $enc = $ret[0];
        $data = $enc["content"];
        $iv = $enc["iv"];
        $enc["content"] = Crypto::Decrypt($data, $u["password"], base64_decode($iv));
        unset($enc["iv"]);
        return $enc;
    }

    function getNotes($user) {
        $stmt = $this->db->prepare("SELECT * FROM notes WHERE `owner` = ?");
        $stmt->bind_param("i", $user);
        $stmt->execute();
        $res = $stmt->get_result();
        $ret = array();
        while ($row = $res->fetch_assoc()) {
            if($row["owner"] == $user)
                $ret[] = $row;
        }
        return $ret;
    }
}