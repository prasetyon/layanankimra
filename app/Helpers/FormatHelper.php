<?php

namespace App\Helper;

use App\Models\Notification;
use App\Models\User;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class FormatHelper
{
    public static function formatDate($date)
    {
        if (!$date) return null;
        $date = date_create($date);
        return date_format($date, "d M Y");
    }

    public static function formatTimestamp($timestamp)
    {
        $date = substr($timestamp, 0, 10);
        $time = substr($timestamp, 12);
        $date = date_create($date);
        return date_format($date, "d M Y") . ' ' . $time;
    }
}
