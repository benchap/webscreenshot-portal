<?php

namespace App\Http\Controllers\Admin;
use DB;

class HomeController
{
    public function index()
    {
        //$screenshots = array('activeScreenshots' => '');
        $sql = "SELECT count(*) as activeScreenshots
                FROM webscreen.screenshotConfig c
                WHERE c.status = 'active' and c.client_id
                GROUP BY c.client_id
        ";
        $screenshots = DB::connection('mysql2')->select($sql);
        $screenshot = $screenshots[0];


        // Get daily screenshot count
        $sql = "SELECT count(*) as dailyScreenshots
                FROM webscreen.screenshots 
                WHERE client_id=1 AND created >= CONCAT(CURDATE(),' 00:00:00');
        ";
        $daily = DB::connection('mysql2')->select($sql);
        $screenshot->dailyScreenshots = $daily[0]->dailyScreenshots;


        // Get daily screenshot count
        $sql = "SELECT count(*) as dailyConsoleErrors
                FROM webscreen.screenshots 
                WHERE client_id=1 AND created >= CONCAT(CURDATE(),' 00:00:00') AND console_path!=''
        ";
        $errors = DB::connection('mysql2')->select($sql);
        $screenshot->dailyConsoleErrors = $errors[0]->dailyConsoleErrors;
        
        return view('home', compact('screenshot'));
    }
}
