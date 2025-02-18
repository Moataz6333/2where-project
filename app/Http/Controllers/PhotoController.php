<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Photo;
use App\Models\City;
use App\Models\Hotel;
use App\Models\Restaruant;
use Illuminate\Support\Str;


class PhotoController extends Controller
{
  
    public function citesPhotos($id){
        $city=City::find($id);
        $photos=Photo::where('city_id',$id)->get();
        return view('photos.citiesPhotos',['city'=>$city,'photos'=>$photos]);
    }
    public function cities_CreatePhotos(Request $request,$id){
        // dd($request->all());
        $city=City::find($id);
        $photo=new Photo();
        $photo->city_id= $city->id;

        $mainPhoto = $request->file('mainPhoto');
    
        
        $destinationPath = $_SERVER['DOCUMENT_ROOT'] . '/images/cities';
        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0777, true);
        }
        // You can rename the file or keep the original name
        $fileName =  $mainPhoto->getClientOriginalName();
        
        // Move the file to the destination path
        $mainPhoto->move($destinationPath, $fileName);
        $relativePath = '/images/cities/' . $fileName;
        // Optionally save file info to the database, if needed
        $photo->path=$relativePath;
       
        $photo->type='mainPhoto';
        $photo->save();
        return back()->with('success', 'Photo uploaded successfully.');

    }
    public function cities_UpdatePhotos(Request $request,$id){
        $photo=Photo::find($id);
       
        

        $mainPhoto = $request->file('mainPhoto');
    
        
        $destinationPath = $_SERVER['DOCUMENT_ROOT'] . '/images/cities';
        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0777, true);
        }
        // You can rename the file or keep the original name
        $fileName =  $mainPhoto->getClientOriginalName();
        
        // Move the file to the destination path
        $mainPhoto->move($destinationPath, $fileName);
        $relativePath = '/images/cities/' . $fileName;
        // Optionally save file info to the database, if needed
        $photo->path=$relativePath;
        // $photo->url=url($relativePath);
        $photo->type='mainPhoto';
        $photo->save();
        return back()->with('success', 'Photo updated successfully.');

    }
    public function cities_DeletePhotos($id){
        $photo=Photo::find($id);
        $photo->delete();
        return back()->with('success', 'Photo Deleted successfully.');
        
    }

    //clear photos
    public function clear_photos(){
      
         $cities=$this->count_photos('cities','city_id');
         $places=$this->count_photos('places','place_id');
         $rests=$this->count_photos('restaraunts','restaruant_id');
         $hotels=$this->count_photos('hotels','hotel_id');
         $trads=$this->count_photos('traditions','tradition_id');
         $userRests =$this->count_userRests();
         $userHotels =$this->count_userHotels();
       
        
        
        return view('photos.index',compact('cities','places','rests','hotels','trads','userRests','userHotels'));
    }

    //places , place_id
    public function clear($dir,$id){
        $photosFromDB=Photo::whereNotNull($id)->get();
        $paths=[];
        foreach($photosFromDB as $photo){
            array_push($paths,$photo->path);
        }


        //dir
        // $directory = public_path('images/places');
        $directory = $_SERVER['DOCUMENT_ROOT'].'/images/'.$dir;

      $files = scandir($directory);
      $images = array_diff($files, array('.', '..')); // Exclude '.' and '..'
        $imgs=[];
      foreach($images as $image){
        array_push($imgs,'/images/'.$dir.'/'.$image);
      }
                
        //   dd($imgs,$paths);
            $i=0;
        foreach($imgs as $img){
            if(! in_array($img ,$paths)){
                $file = $_SERVER['DOCUMENT_ROOT'].$img;
                unlink($file);
                $i++;
            }
        }
        
        return redirect()->back()->with('success',$i . ' photos deleted successfully!');
        
    }

    public function count_photos($dir,$id){

        $photosFromDB=Photo::whereNotNull($id)->get();
        $paths=[];
        foreach($photosFromDB as $photo){
                if($id == "restaruant_id"){

                    $rest = Restaruant::where('id',$photo->restaruant_id)->first();
                    if($rest->status == "accepted"){
                        if (!Str::startsWith($photo->path, 'http')) {
                        
                         array_push($paths,$photo->path);
                        }
    
                    }
                } elseif ($id == "hotel_id") {
                    $hotel = Hotel::where('id',$photo->hotel_id)->first();
                    if($hotel->status == "accepted"){
                        if (!Str::startsWith($photo->path, 'http')) {
                        
                         array_push($paths,$photo->path);
                        }
    
                    }
                }
                else{
                    if (!Str::startsWith($photo->path, 'http')) {
                        
                        array_push($paths,$photo->path);
                       }
                }
            
        }
       


        //dir
        // $directory = public_path('images/places');
        $directory = $_SERVER['DOCUMENT_ROOT'].'/images/'.$dir;

      $files = scandir($directory);
      $images = array_diff($files, array('.', '..')); // Exclude '.' and '..'
        $imgs=[];
      foreach($images as $image){
        array_push($imgs,'/images/'.$dir.'/'.$image);
      }
                
            return count($imgs)-count($paths);
           
    }

    public function clear_userRests(){
        $directory = $_SERVER['DOCUMENT_ROOT'].'/images/userRests';
        // files with id
        $files =array_diff(scandir($directory), array('.', '..')) ;
            foreach ($files as $file) {
                if(is_numeric($file)){
                    // rest folder
                    $rest =Restaruant::where('id',$file)->first();
                      if(! $rest){
                        // delete the folder
                        rmdir($directory.'/'.$file);
                        }

                }else{
                    // post photos
                   $photo = Photo::where('path','/images/userRests/'.$file)->first();
                   if (!$photo) {
                    unlink($directory.'/'.$file);
                   } 
                   
                }
            }
            return  redirect()->back()->with('success','photo deleted successfully');
    }

    public function count_userRests()  {
        $directory = $_SERVER['DOCUMENT_ROOT'].'/images/userRests';
        // files with id
        $files =array_diff(scandir($directory), array('.', '..')) ;
      
        $count =0;
        foreach($files as $file){
            if (is_numeric($file)) {
                $rest =Restaruant::where('id',$file)->first();
                      if(! $rest){
                        $count ++;
                        }
            } else {
                $photo = Photo::where('path','/images/userRests/'.$file)->first();
                   if (!$photo) {
                   $count++;
                   } 
            }

            
        }
        return $count;
    }
    public function count_userHotels()  {
        $directory = $_SERVER['DOCUMENT_ROOT'].'/images/userHotels';
        // files with id
        $files =array_diff(scandir($directory), array('.', '..')) ;
      
        $count =0;
        foreach($files as $file){
            if (is_numeric($file)) {
                $rest =Hotel::where('id',$file)->first();
                      if(! $rest){
                        $count ++;
                        }
            } else {
                $photo = Photo::where('path','/images/userHotels/'.$file)->first();
                   if (!$photo) {
                   $count++;
                   } 
            }

            
        }
        return $count;
    }
    public function clear_userHotels(){
        $directory = $_SERVER['DOCUMENT_ROOT'].'/images/userHotels';
        // files with id
        $files =array_diff(scandir($directory), array('.', '..')) ;
            foreach ($files as $file) {
                if(is_numeric($file)){
                    // rest folder
                    $rest =Hotel::where('id',$file)->first();
                      if(! $rest){
                        // delete the folder
                        rmdir($directory.'/'.$file);
                        }

                }else{
                    // post photos
                   $photo = Photo::where('path','/images/userHotels/'.$file)->first();
                   if (!$photo) {
                    unlink($directory.'/'.$file);
                   } 
                   
                }
            }
            return  redirect()->back()->with('success','photo deleted successfully');
    }
   
    
   

   
    
}
