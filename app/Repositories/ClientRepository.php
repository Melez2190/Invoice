<?php

namespace App\Repositories;

use App\Models\Client;
use App\Repositories\Interfaces\ClientRepositoryInterface;
use App\Repositories\Interfaces\RepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ClientRepository implements RepositoryInterface, ClientRepositoryInterface
{
     /**
    * @var Client $model
    */

    private $model;

     /**
     * TicketRepository constructor.
     * @param Client $model
     */
        public function __construct(Client $model)
        {
            $this->model = $model;
        }
        public function findByRelation()
        {
            return $this->model::where('user_id', '=', auth()->user()->id);
        }
        public function all()
        {
           
             return $this->findByRelation()->filter(request([
                    'client_name',
                    'city',
                    'email',
                    'tax_number',
                    'id_number'
                ]))->orderBy('name')
                ->paginate(10);
        }

        public function findById(int $id): ?Client
        {
            if($this->model->find($id)){
                return $this->model->find($id);
            }else {
                return abort(404);
            }
        }


        public function store(array $data) :Client
        {
            return $this->model->create($data);
        }

        public function update($data, $id)
        {
            try{
                $client = $this->findById($id);
                return $client->update($data);
            }catch (\Throwable $e){
                return redirect('errors.404');
            }
          
        }

        public function delete($id)
        {
           $this->findById($id)->delete();
        }
  

}


