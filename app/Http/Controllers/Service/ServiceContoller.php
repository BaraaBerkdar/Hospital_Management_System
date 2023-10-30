<?php

namespace App\Http\Controllers\Service;
use  App\Interfaces\Service\ServiceRepostryIntrface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ServiceContoller extends Controller
{

    private $service;

    public function __construct(ServiceRepostryIntrface $service)
    {
        $this->service = $service;
    }

    public function index()
    {
    return $this ->service->index();
    }

    

   
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'price' =>"required"
        ]);

            return $this->service->store($request);
    }

    public function show(string $id)
    {
        //
    }

   
    public function edit(string $id)
    {
        //
    }

    public function update(Request $request)
    {   
        return $this->service->update($request);
    }

    public function destroy(Request $request)
    {
        return $this->service->destroy($request);
    }
}
