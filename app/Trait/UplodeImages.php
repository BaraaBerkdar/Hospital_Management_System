<?php
namespace App\Trait;
use App\Models\Image;

trait  UplodeImages
{
    public function uplodeImages($image,$path,$name,$model,$id){
        
      try{ 
        $exd=$image->getClientOriginalExtension();
        
        $filename=time().".".$exd;
        
        $image->move($path."\\".$name,$filename);
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
}
