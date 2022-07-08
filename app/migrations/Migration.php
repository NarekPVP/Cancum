<?php


namespace app\migrations;


use app\controllers\AppController;

class Migration {

    protected $tablename;
    public $rows = [];
    public $tables = [];

    protected $types = [
        'int' => 11,
        'tinyint' => 1,
        'smallint' => 1,
        'mediumint' => 1,
        'bigint' => 11,
        'date' => 11,
        'text' => 500,
        'varchar' => 255,
        'boolean' => false,
        'decimal' => 11,
        'float' => 11,
        'double' => 11,
        'enum' => array(),
    ];

    public $sql;

    public function __construct($tablename){
        if(!is_file(APP . "/migrations/tables/{$tablename}.txt")){
            $this->tablename = $tablename;
        }else{
            //update table
            $this->update();
        }
    }

    public function update(){
        $tablename = $this->tablename;
        $data = \R::findAll("{$tablename}");
        $last = end($data);
        if(!empty($this->rows)){
            $i = 0;
            foreach($this->rows as $name => $row){
                if($row['unique'] == true) $row['unique'] = 'UNSIGNED';
                if($row['base'] == "required")
                    $row['base'] = "NOT NULL";
                else
                    $row['base'] = "DEFAULT NULL";

                $sql = "";
                if($row['lenght'] != "enum"){
                    $sql = "ALTER TABLE `{$tablename} ADD `{$name}` {$row["type"]}({$row["lenght"]}) {$row["base"]} AFTER `{$last['name']}`";
                }else{
                    $ec = ',';

                    if($i == count($this->rows) - 1){
                        $ec = '';
                    }

                    $enum_parts = "";
                    $enum_default = "";
                    foreach ($row['lenght'] as $item){
                        if($row['base'] == $item){
                            $enum_default = " NOT NULL DEFAULT " . "'{$item}'";
                        }else{
                            $enum_default = "DEFAULT NULL";
                        }
                        $enum_parts .= "'{$item}',";
                    }
                    $enum_parts = rtrim($enum_parts, ',');
                    // ALTER TABLE `user` ADD `data` INT(11) NOT NULL AFTER `role`;
                    $sql = "ALTER TABLE `$tablename` ADD `{$name}` {$enum_parts} {$row['base']} AFTER `{$last['name']}`";
                }
                debug($sql);
                if(\R::exec($sql)){
                    $_SESSION['success'] = "data has been successfully saved!";
                }else{
                    $_SESSION['error'] = "Something went wrong!";
                }
                $i++;
            }
        }


    }

    public function insert(string $name, string $type, $length, $base, bool $unique = false){
        if(trim($name)){
            $name = trim($name);
            // validate
            if($this->validate($type)){
                if(!$base) $base = "required";

                $this->rows[$name] = [
                    'name' => $name,
                    'type' => $type,
                    'lenght' => $length,
                    'base' => $base,
                    'unique' => $unique,
                ];
            }
        }

    }

    protected function upload(){
        $sql_parts = "";
        $i = 0;
        foreach ($this->rows as $name => $row){
            if($row['unique'] == true) $row['unique'] = 'UNSIGNED';

            if($row['base'] == "required")
                $row['base'] = "NOT NULL";
            else
                $row['base'] = "DEFAULT NULL";

            $ec = ',';

            if($i == count($this->rows) - 1){
                $ec = '';
            }

            if($row['type'] != 'enum') {
                $sql_parts .= "`{$name}` {$row['type']}({$row['lenght']}) {$row['unique']} {$row['base']}{$ec} ";
            }else{
                $enum_parts = "";
                $enum_default = "";
                foreach ($row['lenght'] as $item){
                    if($row['base'] == $item){
                        $enum_default = " NOT NULL DEFAULT " . "'{$item}'";
                    }else{
                        $enum_default = "DEFAULT NULL";
                    }
                    $enum_parts .= "'{$item}',";

                }
                $enum_parts = rtrim($enum_parts, ',');

                $sql_parts .= "`{$name}` enum({$enum_parts}) {$enum_default}{$ec} ";
            }
            $i++;
        }

        $sql_parts = trim($sql_parts, ',');
        $sql_parts = str_replace('  ', ' ', $sql_parts);

        // $sql_parts = `name` varchar(255) NOT NULL, `age` tinyint(1) NOT NULL, `cash` int(11) NOT NULL, `role` enum('user','admin') DEFAULT NULL

        $sql = "
            CREATE TABLE `{$this->tablename}` (
            
            {$sql_parts}
            
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
        ";

        $this->sql = $sql;

        return $this->sql;
    }

    protected function validate($type){
        if(is_file(APP . "/migrations/tables/{$this->tablename}.txt")){
           return false;
        }

        foreach ($this->types as $item => $value){
            if($type == $item){
               return true;
            }
        }

        return false;
    }

    public function save(){
        $this->upload();

        if($this->sql){
            file_put_contents(APP . "/migrations/tables/{$this->tablename}.txt", "{$this->tablename}");
            if(!in_array($this->tablename, $this->tables)){
                array_push($this->tables, $this->tablename);
            }
            \R::exec($this->sql);
        }else{
            throw new \Exception("Sql not found!");
        }
    }

    public function delete(){
        $sql = "
            DROP TABLE `{$this->tablename}`
        ";
        \R::exec($sql);
        if(is_file(APP . "/migrations/tables/{$this->tablename}.txt")){
            unlink(APP . "/migrations/tables/{$this->tablename}.txt");
        }
    }

}