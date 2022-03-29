<?php

namespace App\Services;

use App\Models\Client;

use App\Repositories\ClientRepository;
use Attribute;

//use Illuminate\Support\Str;


class ClientService
{
    protected $clientRepository;

    public function __construct(ClientRepository $clientRepository)
    {
        $this->clientRepository = $clientRepository;
    }

     /**
     * Display a listing of the resource.
     *
     */
    public function all($attributes) 
    {
        return $this->clientRepository->all($attributes);
    }

      /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request array data
     * @return \Illuminate\Http\Response
     */
    public function store(array $data)
    {
        $client = $this->clientRepository->store($data);
        return $client;
    }

     /**
     * Find specific Client with $id.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function findById(int $id) :? Client
    {
        return $this->clientRepository->findById($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request - array $data
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($data) 
    {
        return $this->clientRepository->update($data);
    }

     /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(int $id)
    {
       
        return $this->clientRepository->delete($id);

    }
}