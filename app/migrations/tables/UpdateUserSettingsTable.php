<?php


namespace app\migrations\tables;


use app\interfaces\IMigration;
use app\migrations\Migration;

class UpdateUserSettingsTable implements IMigration {

    public function up()
    {
        // TODO: Implement up() method.
        $table = new Migration("usersettings");
        $table->insert("showonline", "enum", ['show', 'hide'], 'null');
        $table->insert("showonactives", "enum", ['show', 'hide'], 'null');

        $table->update();
    }

    public function down()
    {
        // TODO: Implement down() method.
    }

}