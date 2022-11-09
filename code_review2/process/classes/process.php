<?php
ini_set ('display_errors', 1); 
ini_set ('display_startup_errors', 1); 
error_reporting (E_ALL);      

class Database {
    // methods
    public function check (string $name, string $password): bool {
        $mysqli = new mysqli('localhost', 'root', 'root', 'school');
        if(!$mysqli->connect_errno) {
            $query = "SELECT username, password FROM users WHERE username = ? AND password = ?";
            $stmt = $mysqli->prepare($query);
            $stmt->bind_param('ss', $name, $password);
            if($stmt->execute()) {
                $result = $stmt->get_result();
                if($result->num_rows > 0) {
                    return true;
                }
                return false;
            }
        }
        return false;
    }

    public function read (): bool {
        $mysqli = new mysqli('localhost', 'root', 'root', 'school');
        if(!$mysqli->connect_errno) {
            $query = "SELECT iduser, username FROM users";
            $stmt = $mysqli->prepare($query);
            if($stmt->execute()) {
                $result = $stmt->get_result();
                if($result->num_rows > 0) {
                    while($row = $result->fetch_object()) { 
                        if(!array_key_exists('users', $_SESSION)) {
                            $_SESSION['users'] = [];
                        }
                        $_SESSION['users']['user' . $row->iduser] = array(
                            'iduser' => $row->iduser,
                            'username' => $row->username
                        );
                    }
                    return true;
                }
            }
        }
    }

    public function update (int $iduser, string $username, string $new_password): bool {
        $mysqli = new mysqli('localhost', 'root', 'root', 'school');
        if(!$mysqli->connect_errno) {
            $query = "UPDATE users SET password = ? WHERE iduser = ? AND username = ?";
            $stmt = $mysqli->prepare($query);
            $stmt->bind_param('sis', $new_password, $iduser, $username);
            if($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function delete (int $iduser, string $username): bool {
        $mysqli = new mysqli('localhost', 'root', 'root', 'school');
        if(!$mysqli->connect_errno) {
            $query = "DELETE FROM users WHERE iduser = ? AND username = ?";
            $stmt = $mysqli->prepare($query);
            $stmt->bind_param('is', $iduser, $username);
            if($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function add_user (string $username, string $password): bool {
        $mysqli = new mysqli('localhost', 'root', 'root', 'school');
        if(!$mysqli->connect_errno) {
            $query = "INSERT INTO users (username, password) VALUES (?, ?)";
            $stmt = $mysqli->prepare($query);
            $stmt->bind_param('ss', $username, $password);
            if($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}