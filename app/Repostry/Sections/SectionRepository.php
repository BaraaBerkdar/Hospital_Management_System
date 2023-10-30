<?php

namespace App\Repostry\Sections;
use  App\Interfaces\Section\SectionRepositoryInterface;
use App\Models\Section;
class SectionRepository implements SectionRepositoryInterface
{

    public  function index(){

        $sections=Section::all();
        return view('Dashboard.Sections.index',compact('sections'));


    }

    public function store($req){
      $s=  Section::create(['name'=>$req->name]);
    //   return $s;  
      return redirect()->back()->with(["add"=>"ff"]);
    
    }

        public function update($req){
            $section=Section::find($req->id);
            if($section){
            $section->update(['name'=>$req->name]);
            return redirect()->back()->with(["edit"=>"ff"]);
            }
            else{
                return redirect()->withErorr(['no ']);
            }
        }   

        public function destroy($req){
            $section=Section::find($req->id);
            $section->delete();
            return redirect()->back()->with(["delete"=>"ff"]);

        }

        public function show($id){
            $section=Section::find($id);
            $doctors= $section->hasdoctors;
            return view('Dashboard.Sections.show_doctors',compact('doctors','section'));

        }
}