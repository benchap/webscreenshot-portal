<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class ScreenshotErrors extends Controller
{
    public function index()
    {
        $screenshots = array();
        $sql = "SELECT c.url, c.id, c.schedule, c.status,  DATE_FORMAT(s.created, '%d %b %Y %h%p') as date_format,
                s.*
                FROM webscreen.screenshotConfig c
                LEFT JOIN webscreen.screenshots s ON (s.screenshotId=c.id)
                WHERE c.status != 'deleted' AND s.console_path!='' AND s.client_id=1
                AND s.created >= CONCAT(CURDATE(),' 00:00:00')
                ORDER BY s.created DESC
        ";

        $screenshots = DB::connection('mysql2')->select($sql);

        //$tmp = $screenshots['lastEventDate']->diffForHumans(\Carbon\Carbon::now());

        return view('screenshotErrors.index', compact('screenshots'));
    }
}
