<?php


namespace app\migrations;


use app\interfaces\IMigration;


class CreateUserSettingsTable implements IMigration {

    // insert
    public function up(){
        $table = new Migration("usersettings");

        $table->insert('id', 'int', 11, 'required', true);
        $table->insert("location", 'varchar', 255, 'NULL');
        $table->insert("workplace", 'varchar', 255, 'NULL');
        $table->insert("relationship", 'enum', ['None', 'Single', 'In a relationship', 'Married', 'Engaged'], 'NULL');
        $table->insert('follow', 'enum', ['nobody', 'everyone'], 'everyone');
        $table->insert('showactives', 'enum', ['show', 'hide'], 'show');
        $table->insert('allowcommentings', 'enum', ['allow', 'notallow'], 'allow');

        $table->save();
    }

    // delete
    public function down(){
        $table = new Migration("usersettings");

        $table->delete();
    }

}