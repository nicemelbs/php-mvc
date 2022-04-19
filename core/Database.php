<?php

namespace app\core;


class Database
{
    public function __construct(array $config)
    {
        $dsn = $config['dsn'] ?? '';
        $user = $config['user'] ?? '';
        $password = $config['password'] ?? '';
        $dbname = $config['dbname'] ?? '';

        $this->pdo = new \PDO($dsn, $user, $password);
        $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

//        $client = new MongoDB\Client(
//            'mongodb+srv://root:1Vidi679Hrv91Zau@cluster0.niaqv.mongodb.net/sample_airbnb?retryWrites=true&w=majority');
//        $db = $client->selectDatabase('sample_airbnb');
//        $var = $db->selectCollection('listingsAndReviews');
//
//        $var = $var->findOne(['beds' => ['$lt' => 2]]);
//
//        echo '<pre>';
//        var_dump($var);
//        echo '</pre>';
//        exit;
    }

    //read files from migrations folder
    //and execute them
    public function applyMigrations()
    {
        $this->createMigrationsTable();
        $appliedMigrations = $this->getAppliedMigrations();

        $newMigrations = [];

        //scan the directory migrations and store it in $files
        $files = scandir(Application::$ROOT_DIR . '/migrations');

        //remove the first two elements from the array
        //because they are not files
        array_shift($files);
        array_shift($files);

        $migrationsToApply = array_diff($files, $appliedMigrations);

        foreach ($migrationsToApply as $migration) {
            $this->applyMigration($migration);

            $newMigrations[] = $migration;
        }

        //if there are newmigrations, save them in the database
        if (!empty($newMigrations)) {
            $this->saveMigrations($newMigrations);
        } else {
            $this->log("No new migrations to apply.");
        }

    }


    public function createMigrationsTable()
    {
        $this->pdo->exec("
            CREATE TABLE IF NOT EXISTS `migrations` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `migration` varchar(255) NOT NULL,
              `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
    }

    private function getAppliedMigrations()
    {
//        $query = $this->pdo->query('SELECT * FROM migrations');
//        $migrations = $query->fetchAll(\PDO::FETCH_ASSOC);
//        $appliedMigrations = [];
//        foreach ($migrations as $migration) {
//            $appliedMigrations[] = $migration['name'];
//        }
//        return $appliedMigrations;

        $statement = $this->pdo->prepare("SELECT migration from migrations");
        $statement->execute();
        return $statement->fetchAll(\PDO::FETCH_COLUMN);

    }

    private function applyMigration($migration)
    {
        require_once Application::$ROOT_DIR . '/migrations/' . $migration;
        $className = pathinfo($migration, PATHINFO_FILENAME);
        $instance = new $className();

        $this->log("Applying migration: $migration" . PHP_EOL);
        $instance->up();
        $this->log("Applied migration: $migration" . PHP_EOL);
        echo "----------------------------------------" . PHP_EOL;
    }

    private function saveMigrations(array $newMigrations)
    {
        $query = $this->pdo->prepare("INSERT INTO migrations (migration) VALUES (:migration)");
        foreach ($newMigrations as $migration) {
            $query->execute([
                'migration' => $migration
            ]);
        }
    }

    protected function log($message)
    {
        echo '[' . date('Y-m-d H:i:s') . '] ' . $message . PHP_EOL;
    }
}