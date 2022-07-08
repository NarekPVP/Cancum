<?php


namespace app\interfaces;


interface IMigration
{

    public function up();
    public function down();

}