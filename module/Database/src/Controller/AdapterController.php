<?php 

namespace Database\Controller;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Db\Adapter\Adapter;

class AdapterController extends AbstractActionController{
    //set up database
    public function AdapterDB(){
        $adapter = new Adapter([
            'driver'=>'Pdo_MySql',
            'database'=>'zendframework',
            'username'=>'root',
            'password'=>'',
            'hostname'=>'localhost',
            'charset'=>'utf8',
        ]);

        return $adapter;
    }

    public function indexAction(){
        $database = $this->AdapterDB();
        $sql = "SELECT * FROM food_type LIMIT 0,4";
        $statement= $database->query($sql);
        $result = $statement->execute();
        // echo "<pre>";
        // print_r($result);
        // echo "</pre>";
        foreach ($result as $row)
        {
            echo "<pre>";
            print_r($row);
            echo "</pre>";
        }
        return false;

    }

    public function demoAction(){
        $db = $this->AdapterDB();
        $sql = "SELECT * FROM food_type WHERE id<:id_start and name=:thisname";
        $statement = $db->query($sql);
        $result = $statement->execute([
            'id_start'=>5,
            'thisname'=>'Cơm',
        ]);
        // $sql = "SELECT * FROM food_type WHERE id<? and name=?";
        // $statement = $db->query($sql);
        // $result = $statement->execute([5,"Cơm"]);

        foreach ($result as $row)
        {
            echo "<pre>";
            print_r($row);
            echo "</pre>";
        }

        return false;
    }
}