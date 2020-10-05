<?php

namespace Jacob\Horizon\Classes\Controllers;

use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class HorizonFileController extends Controller
{
    public function appJs(): Response
    {
        return $this->getHorizonFile('app.js', 'text/javascript');
    }

    public function appCss(): Response
    {
        return $this->getHorizonFile('app.css', 'text/css');
    }

    public function appDarkCss(): Response
    {
        return $this->getHorizonFile('app-dark.css', 'text/css');
    }

    public function horizonSvg(): Response
    {
        return $this->getHorizonFile('img/horizon.svg', 'image/svg+xml');
    }

    private function getHorizonFile($filePath, $type): Response
    {
        return new Response(file_get_contents(base_path('vendor/horizon/' . $filePath)), 200, [
            'Content-Type' => $type
        ]);
    }
}
