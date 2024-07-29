<?php

namespace App\Helpers;
use Request;
use App\Models\LogActivity as LogActivityModel;
use Carbon\Carbon;

class LogActivity
{
    public static function action($subject)
    {
        $currentTime = Carbon::now();

        $log = [];
        $log['user_id'] = auth()->check() ? auth()->user()->employee_id : 1;
        $log['subject'] = $subject;
        $log['time'] = "$currentTime";
        $log['url'] = Request::fullUrl();
        $log['method'] = Request::method();
        $log['ip'] = Request::ip();
        $log['agent'] = Request::header('user-agent');
        $log['created_at'] = Request::header('created_at');
        LogActivityModel::create($log);
    }

    public static function logActivityLists()
    {
        return LogActivityModel::latest()->get();
    }
}