<?php

namespace App\App\Database;
use \PDO;

// A class responsible for database connections.
class Connection
{
    public static function make(array $config)
    {
        try {
            return new PDO(
                "{$config['CONNECTION']}:dbname={$config['NAME']};host={$config['HOST']}",
                $config['USERNAME'],
                $config['PASSWORD']
            );
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}