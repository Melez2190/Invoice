<?php

namespace App\Services;

use App\Models\Client;

use App\Repositories\ClientRepository;

//use Illuminate\Support\Str;


class ClientService
{
    protected $clientRepository;

    public function __construct(ClientRepository $clientRepository)
    {
        $this->clientRepository = $clientRepository;
    }

    public function all() 
    {
        return $this->clientRepository->all();
    }

    
    public function store(array $data)
    {
        $client = $this->clientRepository->store($data);
        return $client;
    }

    public function findById(int $id) :? Client
    {
        return $this->clientRepository->findById($id);
    }

    public function update($data, $id) 
    {
        return $this->clientRepository->update($data, $id);
    }

    public function delete($id)
    {
        return $this->clientRepository->delete($id);

    }
}