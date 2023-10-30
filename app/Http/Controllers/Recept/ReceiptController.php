<?php

namespace App\Http\Controllers\Recept;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Interfaces\Finance\ReceiptRepositoryInterface;
use App\Models\ReceiptAccount;

class ReceiptController extends Controller
{
    
    
    private $Receipt;

    public function __construct(ReceiptRepositoryInterface $Receipt)
    {
        $this->Receipt = $Receipt;
    }

    public function index()
    {
      return $this->Receipt->index();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
  return $this->Receipt->create();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
            $this->validate($request, [
            'patient_id' => 'required|',
            'amount' => 'required'
        ]);
        return $this->Receipt->store($request);
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $receipt = ReceiptAccount::find($id);
        return view('Dashboard.Receipt.print',compact('receipt'));


    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return $this->Receipt->edit($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {   $this->validate($request, [
        'patient_id' => 'required|',
        'amount' => 'required'
    ]);
        return  $this->Receipt->update($request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
           return $this->Receipt->destroy($request);
    }
}
