<?php

include_once 'db.php';

class User extends DB{
    private
        $nombre,
        $username;

    public function userExist($user, $pass){
        $md5pass = md5($pass);

        $query = 
            $this->connect()->prepare(
                'SELECT * FROM usuarios WHERE usuario = :user AND pass = :pass'
            );

        $query->execute([
            'user' => $user,
            'pass' => $md5pass
        ]);

        if($query->rowCount()){
            return true;
        }else{
            return false;
        }
    }

    public function setUser($user){
        $query = $this->connect()->prepare(
            'SELECT * FROM usuarios WHERE usuario = :user'
        );
        $query->execute([
            'user' => $user
        ]);

        foreach($query as $currentUser){
            $this->nombre = $currentUser['nombre'];
            $this->username = $currentUser['usuario'];
        }
    }

    public function getNombre(){
        return $this->nombre;
    }
}