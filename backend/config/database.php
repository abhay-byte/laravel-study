<?php

/**
 * --------------------------------------------------------------------------
 * Database Configuration (The Address Book)
 * --------------------------------------------------------------------------
 * 
 * This file tells Laravel HOW to talk to the database.
 * It's like an address book that says:
 * "The MySQL library is located at this IP address, use this key to open it."
 * 
 */

return [

    // Default Connection
    // We usually use 'mysql' as the default library to look in.
    'default' => env('DB_CONNECTION', 'mysql'),

    // Connections List
    'connections' => [

        'mysql' => [
            'driver'   => 'mysql',           // What language does the DB speak?
            'host'     => env('DB_HOST', '127.0.0.1'), // Where does it live? (IP Address)
            'port'     => env('DB_PORT', '3306'),      // Which door to knock on?
            'database' => env('DB_DATABASE', 'laravel'), // Which filing cabinet?
            'username' => env('DB_USERNAME', 'root'),    // Who are we?
            'password' => env('DB_PASSWORD', ''),        // What is the secret code?
            'charset'  => 'utf8mb4',
            'collation'=> 'utf8mb4_unicode_ci',
            'prefix'   => '',
            'strict'   => true,
            'engine'   => null,
        ],

        // We could also add 'sqlite' or 'pgsql' here.
    ],

    // Migrations Table
    // Where we keep track of changes to the database structure.
    'migrations' => 'migrations',

];
