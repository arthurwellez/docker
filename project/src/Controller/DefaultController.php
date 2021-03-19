<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;

class DefaultController
{
    public function index()
    {
        ob_start();
        include __DIR__.'/../../public/welcome.html.php';
        return new Response(ob_get_clean(), Response::HTTP_NOT_FOUND);
    }
}
