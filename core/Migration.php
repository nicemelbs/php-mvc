<?php

namespace app\core;

class Migration
{
    public function up()
    {
        //get the classname of the subclass calling this method
        echo 'Executing ' . get_class($this) . ': up' . PHP_EOL;
    }

    public function down()
    {

        echo 'Executing ' . get_class($this) . ': down' . PHP_EOL;
    }

    protected function getDB(): Database
    {
        return Application::$app->db;
    }
}