<?php

namespace App\Http\Controllers\Recept;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Interfaces\Finance\PymentRepostryIntrface;

class PyamentController extends Controller
{
    private $Pyment;

    public function __construct(PymentRepostryIntrface $Pyment)
    {
        $this->Pyment = $Pyment;
    }
    public function index()
    {
        return $this->Pyment->index();

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->Pyment->create();
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return $this->Pyment->store($request);
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return $this->Pyment->show($id);

        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return $this->Pyment->edit($id);
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        return $this->Pyment->update($request);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        return $this->Pyment->destroy($request);

    }
}
