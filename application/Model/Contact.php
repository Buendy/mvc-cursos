<?php
/**
 * Created by PhpStorm.
 * User: daniel
 * Date: 2/01/19
 * Time: 16:12
 */

namespace Mini\Model;
use Mini\Libs\Dbpdo;
use PDO;

class Contact extends Dbpdo
{


    public function allWithCategory($id)
    {
        $prepare = $this->db->prepare('SELECT p.*, c.name FROM contacts p INNER JOIN categories c on p.category_id = c.id WHERE user_id = :field;');
        $prepare->bindParam(':field', $id, PDO::PARAM_STR);
        $prepare->execute();

        return $prepare->fetchAll();
    }


    public function insert($fields)
    {
        $prepare = $this->db->prepare("INSERT INTO contacts(first_name, last_name, email, phone, address, category_id, user_id)
                  VALUES(:first_name, :last_name, :email, :phone, :address, :category_id, :user_id)");

        $prepare->bindParam(':first_name', $fields['first_name'], PDO::PARAM_STR);
        $prepare->bindParam(':last_name', $fields['last_name'], PDO::PARAM_STR);
        $prepare->bindParam(':email', $fields['email'], PDO::PARAM_STR);
        $prepare->bindParam(':phone', $fields['phone'], PDO::PARAM_STR);
        $prepare->bindParam(':address', $fields['address'], PDO::PARAM_STR);
        $prepare->bindParam(':category_id', $fields['category_id'], PDO::PARAM_STR);
        $prepare->bindParam(':user_id', $fields['user_id'], PDO::PARAM_STR);


        $prepare->execute();
    }

    public function update($table, $fields)
    {

        if(isset($table) || isset($fields)){


            $prepare = $this->db->prepare("UPDATE $table SET first_name=:first_name, last_name=:last_name, email=:email, phone=:phone, address=:address,
                      category_id=:category_id, user_id=:user_id WHERE id = :id");

            $prepare->bindParam(':first_name', $fields['first_name'], PDO::PARAM_STR);
            $prepare->bindParam(':last_name', $fields['last_name'], PDO::PARAM_STR);
            $prepare->bindParam(':email', $fields['email'], PDO::PARAM_STR);
            $prepare->bindParam(':phone', $fields['phone'], PDO::PARAM_STR);
            $prepare->bindParam(':address', $fields['address'], PDO::PARAM_STR);
            $prepare->bindParam(':category_id', $fields['category_id'], PDO::PARAM_STR);
            $prepare->bindParam(':user_id', $fields['user_id'], PDO::PARAM_STR);
            $prepare->bindParam(':id', $fields['id'], PDO::PARAM_STR);

            $prepare->execute();


        }else {
            throw new Exception('A ocurrido un error con la base de datos');
        }


    }

    public function search($name)
    {
        $name = "%$name%";

        $prepare = $this->db->prepare("SELECT p.*, c.name FROM contacts p INNER JOIN categories c on p.category_id = c.id WHERE p.first_name LIKE :name");
        $prepare->bindParam(':name', $name, PDO::PARAM_STR);
        $prepare->execute();

        if($prepare->rowCount()){
            return $prepare->fetchAll();
        }else{
            return null;
        }


    }


}