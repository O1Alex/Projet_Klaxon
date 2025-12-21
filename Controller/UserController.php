<?php
require_once '../Config/database.php';

class UserController{

    //Liste des utilisateurs sans leur mdp
    public function getUser(){
        $sql="SELECT id, first_name, last_name, email, phone, role FROM users";
        $db=Config::Connexion();

        try {
            $query=$db->prepare($sql);
            $query->execute();
            $user=$query->fetchAll();       
            return $user;

        } catch (PDOException $e) {
            echo "Erreur".$e->getMessage();
        }
    }

    //Connexion
    public function Connexion($email,$password){
        $sql="SELECT * FROM users WHERE email=:email AND password=:password";
        $db=Config::Connexion();

        try{
            $query=$db->prepare($sql);
            $query->execute([
                'email'=>$email,
                'password'=>$password
            ]);
            $user=$query->fetch();

            if($user){
                session_start();
                $_SESSION['user_id']=$user['id'];
                $_SESSION['user_name']=$user['first_name'].$user['last_name'];
                $_SESSION['user_password']=$user['password'];
                $_SESSION['user_role']=$user['role'];
                $_SESSION['user_email']=$user['email'];

                return true;
            }
            return false;

        }catch(PDOException $e){
                echo "Erreur".$e->getMessage();
        }
    }

    //Deconnexion
    public function Deconnexion(){
        session_start();
        session_destroy();
        return true;
    }
}
?>