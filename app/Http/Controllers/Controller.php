<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public static function DisplayViews($views)
    {
        if ($views > 0) {
            if ($views <= 999) {
                return $views;
            } elseif ($views > 999999) {
                $display = round($views / 1000000, 2);
                return $display . "M";
            } else {
                $display = round($views / 1000, 2);
                return $display . "K";
            }
        } else {
            return "0";
        }
    }
}
