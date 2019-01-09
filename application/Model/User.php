<?php
namespace Mini\Model;
use Mini\Libs\Dbpdo;
use PDO;
class User extends Dbpdo
{
    public function checkRepeat($table, $campo1, $campo2)
    {

        $prepare = $this->db->prepare("SELECT $campo1 FROM $table WHERE $campo1 = :fields");
        $prepare->bindParam(":fields", $campo2, PDO::PARAM_STR);

        $prepare->execute();
        $check = $prepare->fetchall(PDO::FETCH_ASSOC);

        if($check){
            return true;
        } else{
            return false;
        }

    }


    public function checkRepeatPass($table, $campo1, $campo2, $campo3, $campo4)
    {

        $prepare = $this->db->prepare("SELECT $campo1 FROM $table WHERE $campo1 = :field AND $campo3 = :clave ");

        $prepare->bindParam(':field', $campo2, PDO::PARAM_STR);
        $prepare->bindParam(':clave', $campo4, PDO::PARAM_STR);

        $prepare->execute();

        $check = $prepare->fetchall(PDO::FETCH_ASSOC);

        if($check){
            return true;
        } else{
            return false;
        }

    }

    public function allFields($table, $campo1, $campo2)
    {
        $prepare = $this->db->prepare("SELECT * FROM $table WHERE $campo1 = :field");
        $prepare->bindParam(':field', $campo2, PDO::PARAM_STR);

        $prepare->execute();

        return $prepare->fetch(PDO::FETCH_ASSOC);

    }

    public function insert($fields)
    {
        $prepare = $this->db->prepare("INSERT INTO users(nombre, apellidos, email, password, rol)
                  VALUES(:first_name, :last_name, :email, :password, :rol)");
        $prepare->bindParam(':first_name', $fields['first_name'], PDO::PARAM_STR);
        $prepare->bindParam(':last_name', $fields['last_name'], PDO::PARAM_STR);
        $prepare->bindParam(':email', $fields['email'], PDO::PARAM_STR);
        $prepare->bindParam(':password', $fields['password'], PDO::PARAM_STR);
        $prepare->bindParam(':rol', $fields['rol'], PDO::PARAM_STR);
        $prepare->execute();
    }

    public function update($table, $fields)
    {
        if(isset($table) || isset($fields)){

            $prepare = $this->db->prepare("UPDATE $table SET nombre=:first_name, apellidos=:last_name, email=:email, rol=:rol WHERE id = :id");

            $prepare->bindParam(':first_name', $fields['first_name'], PDO::PARAM_STR);
            $prepare->bindParam(':last_name', $fields['last_name'], PDO::PARAM_STR);
            $prepare->bindParam(':email', $fields['email'], PDO::PARAM_STR);
            $prepare->bindParam(':rol', $fields['rol'], PDO::PARAM_STR);
            $prepare->bindParam(':id', $fields['id'], PDO::PARAM_STR);

            $prepare->execute();

        }else {
            throw new Exception('A ocurrido un error con la base de datos');
        }


    }


}