<?php 
require_once(__DIR__ .  "/../Database.php");
class Utilisateur extends Modele{
    public ?int $id;
    public ?string $username;
    public ?string $pwd;
    public ?string $email;
    public ?int $role;


    public function __construct(
        int $id = null,
        string $username = null,
        string $pwd = null,
        string $email = null,
        int $role = null
    ){
        parent::__construct();
        $this->id = $id;
        $this->username = $username;
        $this->pwd = $pwd;
        $this->email = $email;
        $this->role = $role;
    }
    
    public function save(){
        $sql = "INSERT INTO utilisateurs (username, pwd, email, role) VALUES (:username, :pwd, :email, :role)";
        $stmt = $this->pdo->prepare($sql);
        $rowsAffected = $stmt->execute([
            ":username" => $this->username,
            ":pwd" => $this->pwd,
            ":email" => $this->email,
            ":role" => $this->role
        ]);
        return $rowsAffected == 1;

    }
    
    public function delete(){
        $sql = "DELETE FROM utilisateurs WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $rowsAffected = $stmt->execute([":id" => $this->id]);
        return $rowsAffected == 1;
    }

    public function update(){
        $sql = "UPDATE utilisateurs SET username = :username, pwd = :pwd, email = :email, role = :role WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $rowsAffected = $stmt->execute([
            ":username" => $this->username,
            ":pwd" => $this->pwd,
            ":email" => $this->email,
            ":role" => $this->role,
            ":id" => $this->id
        ]);
        return $rowsAffected == 1;
    }

    public function getAll($keyword = ""){
        $sql = "SELECT * FROM utilisateurs WHERE username LIKE :keyword OR email LIKE :keyword ORDER BY id DESC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(":keyword", "%$keyword%");
        $stmt->execute();
        return $stmt->fetchAll();
    }
    
    // getAllByRole
    public function getAllByRole($role){
        $sql = "SELECT * FROM utilisateurs WHERE role = :role ORDER BY id DESC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(":role", $role);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    //getone by user name
    public function getByUsername($username){
        $sql = "SELECT * FROM utilisateurs WHERE username = :username";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(":username", $username);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function getByEmail($email){
        $sql = "SELECT * FROM utilisateurs WHERE email = :email";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(":email", $email);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function isAdmin(string $username){
        $sql = "SELECT * FROM utilisateurs WHERE username = :username AND role = 1";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(":username", $username);
        $stmt->execute();
        return $stmt->fetch() != false;
    }

    public function customersCount(): int{
        $sql = "SELECT COUNT(*) FROM utilisateurs WHERE role = 0";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchColumn();
    }

    public function checkAuth(){
        // check session status
        // if the session isn't started, start it
        if(session_status() == PHP_SESSION_NONE){
            session_start();
        }

        if(!isset($_SESSION['username'])){
            header('Location: /');
            exit();
        }
    }
}
?>