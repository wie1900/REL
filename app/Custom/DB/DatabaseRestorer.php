<?php

namespace App\Custom\DB;

use Illuminate\Auth\Events\Login;
use Illuminate\Console\Scheduling\Event;

/**
 * -------- ity -----------
 * Restoring database from backup at every logging-in
 */
class DatabaseRestorer
{
    public function handle(Login $event)
    {
        $database_folder = base_path().'/database/';
        $backup = 'database_backup.sqlite';
        $database_file = 'database.sqlite';

        copy($database_folder.$backup, $database_folder.$database_file);
    }
}
