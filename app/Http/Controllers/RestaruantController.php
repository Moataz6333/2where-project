<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;
use App\Models\Restaruant;
use App\Models\Photo;

class RestaruantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $city= City::find($id);
        $rests= $city->restaruants->where('status','accepted');
        
        return view('restaraunts.index',['city'=>$city ,'rests'=>$rests]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        return view('restaraunts.create',['city'=>City::find($id)]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request,$id)
    {
        // dd($request->all());
        $rest =new Restaruant();

        $rest->city_id=$id;
        $rest->title = $request->title;
        $rest->rate = (int) $request->rate;
        $rest->categories = $request->categories;
        $rest->price = $request->price;
        $rest->address = $request->address;
        $rest->hours=$request->hours;
        $rest->status='accepted';
        $rest->user_id='1';
        
        $rest->save();
        $photo =new Photo();
        $photo->restaruant_id = $rest->id;

        $mainPhoto = $request->file('postPhoto');
    
        
        $destinationPath = $_SERVER['DOCUMENT_ROOT'] . '/images/restaraunts';
        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0777, true);
        }
        // You can rename the file or keep the original name
        $fileName =  $mainPhoto->getClientOriginalName();
        
        // Move the file to the destination path
        $mainPhoto->move($destinationPath, $fileName);
        $relativePath = '/images/restaraunts/' . $fileName;
        // Optionally save file info to the database, if needed
        $photo->path=$relativePath;
        $photo->type='post';
        // $photo->url=url($relativePath);
        
        $photo->save();
        return back()->with('success', 'Restaurants created successfully.');
    }

    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id)
    {
        $rest =Restaruant::find($id);
        return view('restaraunts.edit',['rest'=>$rest]);
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
        $rest =Restaruant::find($id);

       
        $rest->title = $request->title;
        $rest->rate = (int) $request->rate;
        $rest->categories = $request->categories;
        $rest->price = $request->price;
        $rest->address = $request->address;
        $rest->hours=$request->hours;
        $rest->save();
      

        if($request->hasFile('postPhoto')){
              $photo =$rest->post;
              $mainPhoto = $request->file('postPhoto');
    
        
        $destinationPath = $_SERVER['DOCUMENT_ROOT'] . '/images/restaraunts';
        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0777, true);
        }
        // You can rename the file or keep the original name
        $fileName =  $mainPhoto->getClientOriginalName();
        
        // Move the file to the destination path
        $mainPhoto->move($destinationPath, $fileName);
        $relativePath = '/images/restaraunts/' . $fileName;
        // Optionally save file info to the database, if needed
        $photo->path=$relativePath;
        // $photo->url=url($relativePath);
        
        $photo->save();
        }

      
        return back()->with('success', 'Restaurant Updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $rest= Restaruant::find($id);
        $rest->post()->delete();
        $rest->delete();
        return back()->with('success', 'Restaurant Deleted successfully.');

    }
    //photos
    public function photos($id){
        $rest = Restaruant::find($id);
        $photos=$rest->post->where('type','slider');
        $menus=$rest->post->where('type','menu');
        return view('restaraunts.photos',compact('rest','photos','menus'));
    }
    //slider
    public function slider(Request $request,$id){
        $rest=Restaruant::find($id);
        $photos = $request->file('mainPhoto');
        if ($photos) {
            foreach ($photos as $mainPhoto) {
                $photo = new Photo();
                $photo->restaruant_id = $rest->id;
        
                $destinationPath = $_SERVER['DOCUMENT_ROOT'] . '/images/restaraunts';
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0777, true);
                }
        
                // Generate a unique name for each file
                $fileName = $mainPhoto->getClientOriginalName();
        
                // Move the file to the destination path
                $mainPhoto->move($destinationPath, $fileName);
                $relativePath = '/images/restaraunts/' . $fileName;
        
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
      $destinationPath = $_SERVER['DOCUMENT_ROOT'] . '/images/restaraunts/';
     if (!file_exists($destinationPath)) {
        mkdir($destinationPath, 0777, true);
     }
      $image->move($destinationPath, $imageName);

       // Save the image path or name in the database if needed
       $imagePath = 'images/restaraunts/' . $imageName;
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
    //menu
    public function menu(Request $request,$id){
        $rest=Restaruant::find($id);
        $photos = $request->file('menuPhoto');
        if ($photos) {
            foreach ($photos as $mainPhoto) {
                $photo = new Photo();
                $photo->restaruant_id = $rest->id;
        
                $destinationPath = $_SERVER['DOCUMENT_ROOT'] . '/images/restaraunts';
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0777, true);
                }
        
                // Generate a unique name for each file
                $fileName = $mainPhoto->getClientOriginalName();
        
                // Move the file to the destination path
                $mainPhoto->move($destinationPath, $fileName);
                $relativePath = '/images/restaraunts/' . $fileName;
        
                // Save photo info to the database
                $photo->path = $relativePath;
                $photo->type = 'menu'; // Adjust the type if needed
                $photo->save();
            }
        }
        
        return back()->with('success', count($photos).'Menus added successfully.');
    }
}
