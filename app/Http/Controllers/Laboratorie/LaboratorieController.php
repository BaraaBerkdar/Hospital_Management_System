<?php

namespace App\Http\Controllers\Laboratorie;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Interfaces\LaboratorieEmployee\LaboratorieEmployeeRepositoryInterface;
use Auth;
class LaboratorieController extends Controller
{
    private $Laboratorie;

    public function __construct(LaboratorieEmployeeRepositoryInterface $Laboratorie)
    {
        $this->Laboratorie = $Laboratorie;
    }

    public function index(){
        
        return $this ->Laboratorie->index();
    }

    public function store(Request $request ){

        return $this ->Laboratorie->store($request);

    }
    public function update(Request $request, string $id){
        return $this ->Laboratorie->update($request,$id);
        
    }

    public function destroy(string $id){

        return $this ->Laboratorie->destroy($id);

    }
   

    public function logout(Request $request){

        Auth::guard('ray_employee')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
