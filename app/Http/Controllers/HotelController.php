<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;
use App\Models\Photo;
use App\Models\Hotel;

class HotelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $city=City::find($id);
       
        return view('hotels.index',['city'=>$city,'hotels'=>$city->hotels->where('status','accepted')]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        $city=City::find($id);

        return view('hotels.create',['city'=>$city]);

    }

  
    public function store(Request $request ,$id)
    {
        $hotel=new Hotel();
        $hotel->city_id=$id;
        $hotel->title=$request->title;
        $hotel->rate= (int) $request->rate;
        $hotel->features=$request->features;
        $hotel->price=$request->price;
        $hotel->address=$request->address;
        $hotel->link=$request->link;
        $hotel->status='accepted';
        $hotel->user_id='1';
        $hotel->save();

        $photo= new Photo();
        $photo->hotel_id=$hotel->id;
        if($request->hasFile('postPhoto')){
           
            $mainPhoto = $request->file('postPhoto');
  
      
      $destinationPath = $_SERVER['DOCUMENT_ROOT'] . '/images/hotels';
      if (!file_exists($destinationPath)) {
          mkdir($destinationPath, 0777, true);
      }
      // You can rename the file or keep the original name
      $fileName =  $mainPhoto->getClientOriginalName();
      
      // Move the file to the destination path
      $mainPhoto->move($destinationPath, $fileName);
      $relativePath = '/images/hotels/' . $fileName;
      // Optionally save file info to the database, if needed
      $photo->path=$relativePath;
   
      $photo->type='post';
      
      $photo->save();
      }

    
      return back()->with('success', 'Hotel Created successfully.');

    }

    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id)
    {
            $hotel= Hotel::find($id);
            return view('hotels.edit',['hotel'=>$hotel]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {

        $hotel=Hotel::find($id);

        $hotel->title=$request->title;
        $hotel->rate= (int) $request->rate;
        $hotel->features=$request->features;
        $hotel->price=$request->price;
        $hotel->address=$request->address;
        $hotel->link=$request->link;
        $hotel->save();

        $photo= $hotel->post;

        if($request->hasFile('postPhoto')){
           
            $mainPhoto = $request->file('postPhoto');
  
      
      $destinationPath = $_SERVER['DOCUMENT_ROOT'] . '/images/hotels';
      if (!file_exists($destinationPath)) {
          mkdir($destinationPath, 0777, true);
      }
      // You can rename the file or keep the original name
      $fileName =  $mainPhoto->getClientOriginalName();
      
      // Move the file to the destination path
      $mainPhoto->move($destinationPath, $fileName);
      $relativePath = '/images/hotels/' . $fileName;
      // Optionally save file info to the database, if needed
      $photo->path=$relativePath;
    
      
      $photo->save();
      }
      return back()->with('success', 'Hotel Updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        $hotel=Hotel::find($id);
        $hotel->post()->delete();
        $hotel->delete();
      return to_route('dashboard')->with('success', 'Hotel Deleted successfully.');

    }
     //photos
     public function photos($id){
      $hotel = Hotel::find($id);
      $photos=$hotel->post->where('type','slider');
      return view('hotels.photos',compact('hotel','photos'));
  }
  //slider
  public function slider(Request $request,$id){
      $hotel=Hotel::find($id);
      $photos = $request->file('mainPhoto');
      if ($photos) {
          foreach ($photos as $mainPhoto) {
              $photo = new Photo();
              $photo->hotel_id = $hotel->id;
      
              $destinationPath = $_SERVER['DOCUMENT_ROOT'] . '/images/hotels';
              if (!file_exists($destinationPath)) {
                  mkdir($destinationPath, 0777, true);
              }
      
              // Generate a unique name for each file
              $fileName = $mainPhoto->getClientOriginalName();
      
              // Move the file to the destination path
              $mainPhoto->move($destinationPath, $fileName);
              $relativePath = '/images/hotels/' . $fileName;
      
              // Save photo info to the database
              $photo->path = $relativePath;
              $photo->type = 'slider'; // Adjust the type if needed
              $photo->save();
          }
      }
      
      return back()->with('success', count($photos).'Photos added successfully.');
  }
  //update slide
  public function slider_update(Request $request,$id){
      $photo=Photo::find($id);
      if($request->hasFile('mainPhoto')){
   $image = $request->file('mainPhoto');
    $imageName =  $image->getClientOriginalName();
    $destinationPath = $_SERVER['DOCUMENT_ROOT'] . '/images/hotels/';
   if (!file_exists($destinationPath)) {
      mkdir($destinationPath, 0777, true);
   }
    $image->move($destinationPath, $imageName);

     // Save the image path or name in the database if needed
     $imagePath = 'images/hotels/' . $imageName;
     $photo->path=$imagePath;
  
     
     
      }
      $photo->save();
      return redirect()->back()->with('success', 'Photo Updated successfully!');
  }
  //delete slide
  public function slider_delete($id){
      $photo=Photo::find($id);
      $photo->delete();
      return redirect()->back()->with('success', 'Photo Deleted successfully!');

  }
}
