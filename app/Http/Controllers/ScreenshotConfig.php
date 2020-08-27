<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;

class ScreenshotConfig extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $screenshots = array();
        $sql = "SELECT c.url, c.id, c.schedule, c.status,
                MAX(s.created) as lastEventDate,
                TIMESTAMPDIFF(MINUTE,now(),MAX(s.created))*-1 as minutesAgo,
                TIMESTAMPDIFF(HOUR,now(),MAX(s.created))*-1 as hoursAgo,
                TIMESTAMPDIFF(DAY,now(),MAX(s.created))*-1 as daysAgo
                FROM webscreen.screenshotConfig c
                LEFT JOIN webscreen.screenshots s ON (s.screenshotId=c.id)
                WHERE c.status != 'deleted'
                GROUP BY c.id
        ";
        $screenshots = DB::connection('mysql2')->select($sql);

        return view('screenshotConfig.index', compact('screenshots'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('screenshotConfig.create'); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $url = $request->input('url');
        $schedule = $request->input('schedule');
        $sql = "INSERT INTO webscreen.screenshotConfig (url,schedule,client_id,status) VALUES (?,?,1,'active') ";
        $screenshots = DB::connection('mysql2')->insert($sql,array($url,$schedule));

        // Get inserted id 
        $sql = "SELECT * FROM webscreen.screenshotConfig WHERE client_id=? and url=? and schedule=?";
        $screenshot = DB::connection('mysql2')->select($sql, array(1,$url,$schedule));

        // Check to see if an alert was created at the same time
        $alertType = $request->input('alertType');
        if($request->input('submit') != 'Save without Alert'){
            $operation = $request->input('operation');
            $respCode = $request->input('respCode');
            $email = $request->input('emailAddress');

            $sql = "INSERT INTO webscreen.screenshotAlerts (screenshot_id,alert_type,send_to,operation,result,status,created)
                VALUES (?,?,?,?,?,'active',now())
            ";

            DB::connection('mysql2')->insert($sql,array($screenshot[0]->id,$alertType,$email,$operation,$respCode));
        }
        
        return redirect()->route('screenshots.config.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        // Need to filter by logged in user

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Pause the screenshots for a url
     */
    public function pause($id){
        self::_set_status($id,'paused');
        return redirect()->route('screenshots.config.index');
    }

    /**
     * Enable screenshots for url
     */
    public function play($id){
        self::_set_status($id,'active');
        return redirect()->route('screenshots.config.index');
    }

    /**
     * Enable screenshots for url
     */
    public function delete($id){
        self::_set_status($id,'deleted');
        return redirect()->route('screenshots.config.index');
    }

    private function _set_status($id,$status){
        $sql = "UPDATE webscreen.screenshotConfig SET status=? WHERE id=? and client_id = 1 LIMIT 1";
        $screenshots = DB::connection('mysql2')->update($sql,array($status,$id));
    }
}
