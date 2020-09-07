<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Companies Controller
 *
 * @property \App\Model\Table\CompaniesTable $Companies
 */
class CompaniesController extends AppController
{
    public function index()
    {
        return $this->responseJson(['ack' => time()]);
    }

    public function add()
    {
        return $this->responseNotContent();
    }

    public function edit()
    {
        return $this->responseNotContent();
    }

    public function delete()
    {
        return $this->responseNotContent();
    }
}
