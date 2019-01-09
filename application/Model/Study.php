<?php
namespace Mini\Model;
use Mini\Libs\Dbpdo;
use PDO;


class Study extends Dbpdo
{


    public function insert($fields)
    {
        $prepare = $this->db->prepare("INSERT INTO study(id_user, id_curso) VALUES(:id_user, :id_curso)");
        $prepare->bindParam(':id_user', $fields['id_user'], PDO::PARAM_STR);
        $prepare->bindParam(':id_curso', $fields['id_curso'], PDO::PARAM_STR);

        $prepare->execute();
    }

    public function query($id_user, $id_curso)
    {
        $prepare = $this->db->prepare("SELECT * FROM study WHERE id_user = :id_user AND id_curso = :id_curso");
        $prepare->bindParam(':id_user', $id_user, PDO::PARAM_STR);
        $prepare->bindParam(':id_curso', $id_curso, PDO::PARAM_STR);

        $prepare->execute();

        if($prepare->rowCount()){
            return true;
        }else{
            return false;
        }
    }

}