<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;

class LegacyController extends Controller
{
    public function index()
    {
        ob_start();
        require app_path('Http') . '/legacy.php';
        $output = ob_get_clean();

        // be sure to import Illuminate\Http\Response
        return new Response($output);
    }
}