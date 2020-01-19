<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Http\Response;

/**
 * Companies Controller
 *
 * @property \App\Model\Table\CompaniesTable $Companies
 *
 * @method \App\Model\Entity\Company[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CompaniesController extends AppController
{
    public function index()
    {
        return $this->responseNotImplemented();
    }

    /**
     * Esse fluxo é tratado pelo PersistenceOrmMiddleware
     * validate um exception caso tenha erros,
     * create outro exception caso tenha erros de persistencia
     * @return \Cake\Http\Response
     */
    public function add()
    {
        $company = $this->Companies->instanceAndValidate(
            $this->request->getData()
        );

        $this->Companies->createOrFail($company, true);

        return $this
            ->responseWithSuccess($company);
    }


    /**
     * Rota para desativação de uma companhia
     * @param $id
     * @return Response
     */
    public function deactivate($id)
    {
        $this->Companies->enableCompany($id, false);
        return $this
            ->responseOk();
    }

    /**
     * Rota para ativação de uma companhia
     * @param $id
     * @return Response
     */
    public function active($id)
    {
        $this->Companies->enableCompany($id, true);
        return $this
            ->responseOk();
    }
}
