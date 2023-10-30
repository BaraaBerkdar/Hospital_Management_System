<?php



use App\Models\Image;
use Illuminate\Support\Facades\Storage;


function uplodeImage($request,$path,$image,$model){
  $username=$request->name;
    $exd=$image->getClientOriginalExtension();
 
      $name=$username.'.'.$exd;
      $image->move($path,$name);

    Image::create([
      "filename"     =>$name,
      "imageable_id" =>$request->id,
      "imageable_type" =>$model
    ]);
  }
    

      function deleteAttach($disk,$filename,$id){
        // return $disk .'/'.$filename;
        // Storage::disk('doctor')->delete($req->filename);

        Storage::disk('doctor')->delete($filename);
        Image::where('imageable_id',$id)->delete();


      
    }

     function uplodeImages($image,$path,$name,$model,$id)
   {   
   
    
      try{ 
        $exd=$image->getClientOriginalExtension();
        
        $filename=time().".".$exd;
        
        $image->move(public_path($path),$filename);
        Image::create([
          "filename"     =>$filename,
          "imageable_id" =>$id,
          "imageable_type" =>$model
        ]);
        
      }
      catch(\Exception $ex){
        return $ex;
      }
    }
  


 