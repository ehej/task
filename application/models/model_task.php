<?php

class Model_Task extends Model
{
    
    public $table = 'task';


    public $property = [
        'id',
        'name',
        'descr',
        'photo',
        'created_time',
        'updated_time'
    ];

    public $label = [
        'id' => 'ID',
        'name' => 'Name',
        'descr' => 'Description',
        'photo' => 'Photo',
        'created_time' => 'Created',
        'updated_time' => 'Last Updated'
    ];
    
    public function getAllTasks($page = false, $num = 3)
    {
        $count = $this->db
            ->query("SELECT COUNT(*) FROM {$this->table}")
            ->fetchColumn();

        $total = intval(($count - 1) / $num) + 1;
        if(empty($page) || $page < 0) {
            $page = 1;
        }
        if($page > $total) {
            $page = $total;
        }

        $start = $page * $num - $num;

        if ($start) {
            $limit = "LIMIT $start";
        }
        if ($num) {
            $limit = empty($limit) ? "LIMIT $num" : $limit . ', ' . $num;
        }
        $sql = "SELECT * FROM {$this->table} $limit";
        return $this->db
                    ->query("SELECT * FROM {$this->table} $limit")
                    ->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTask($id)
    {
        return $this->db
                    ->query("SELECT * FROM {$this->table} WHERE id='{$id}'")
                    ->fetch(PDO::FETCH_ASSOC);
    }

    public function delete_task($id)
    {
        if (empty($id)) {
            return false;
        } else {
            $SQL = "DELETE FROM {$this->table} WHERE id='{$id}'";
            $this->db->exec($SQL);
        }
        return true;
    }

    public function create_task($data)
    {
        //$SQL = "INSERT INTO (name, descr, photo) {$data['name']}, {$data['descr']}, {$data['photo']}";
        try {
            $stmt = $this->db
                ->prepare("INSERT INTO {$this->table} (name, descr, photo) VALUES (?,?,?)");
            $stmt->execute([ $data['name'], $data['descr'], $data['photo'] ]);

            $newId = $this->db->lastInsertId();
            if (!empty($newId)) {
                return $newId;
            }
        } catch (PDOException $e) {
            //print 'NOT ADD';
        }
        return null;
    }

    /**
     *
     * @param type $page
     * @return string
     */
    public function pagination($page = 1)
    {
        $num = 3;
        $count = $this->db
            ->query("SELECT COUNT(*) FROM {$this->table}")
            ->fetchColumn();
        $total = intval(($count - 1) / $num) + 1;
        if(empty($page) || $page < 0) {
            $page = 1;
        }
        if($page > $total) {
            $page = $total;
        }

        $start = $page * $num - $num;

        if ($page != 1) {
            $pervpage = '<a href= ./task?page=1><<</a>
                               <a href= ./task?page='. ($page - 1) .'><</a> ';
        }
        // Проверяем нужны ли стрелки вперед
        if ($page != $total) {
            $nextpage = ' <a href= ./task?page='. ($page + 1) .'>></a>
                        <a href= ./task?page=' .$total. '>>></a>';
        }

        // Находим две ближайшие станицы с обоих краев, если они есть
        if($page - 2 > 0) {
            $page2left = ' <a href= ./task?page='. ($page - 2) .'>'. ($page - 2) .'</a> | ';
        }
        if($page - 1 > 0) {
            $page1left = '<a href= ./task?page='. ($page - 1) .'>'. ($page - 1) .'</a> | ';
        }
        
        if($page + 2 <= $total) {
            $page2right = ' | <a href= ./task?page='. ($page + 2) .'>'. ($page + 2) .'</a>';
        }
        if($page + 1 <= $total) {
            $page1right = ' | <a href= ./task?page='. ($page + 1) .'>'. ($page + 1) .'</a>';
        }

        // Вывод меню
        $result = $pervpage.$page2left.$page1left.'<b>'.$page.'</b>'.$page1right.$page2right.$nextpage;

        return $result;
    }

    public function uploadImage()
    {
        $uploaddir =  $_SERVER['DOCUMENT_ROOT'] . '/upload/';
        $uploadfile = $uploaddir . basename($_FILES['new_task']['name']['photo']);

        if (move_uploaded_file($_FILES['new_task']['tmp_name']['photo'], $uploadfile)) {
            return '/upload/' . $_FILES['new_task']['name']['photo'];
        } else {
            //echo "<b>Файл не загрузился !</b>\n";
        }
    }

}
?>