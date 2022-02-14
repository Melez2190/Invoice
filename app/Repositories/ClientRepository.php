<?php

namespace App\Repositories;

use App\Models\Client;
use App\Repositories\Interfaces\ClientRepositoryInterface;
use App\Repositories\Interfaces\RepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;


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
            try {
                return $this->model->findOrFail($id);
            } catch (ModelNotFoundException $e) {
                return null;
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
                return null;
            }
          
        }

        public function delete($id)
        {
           $this->findById($id)->delete();
        }
  

}


