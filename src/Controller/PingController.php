<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Ping Controller
 *
 */
class PingController extends AppController
{
    public function index()
    {
        return $this->withJson([
            'ack' => time(),
            'message' => 'good!'
        ]);
    }
}
