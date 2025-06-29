<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;
use App\Models\Place;
use App\Models\Photo;
use App\Models\Price;

class PlaceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $places = Place::all();
        $photos = Photo::whereNotNull('place_id')->where('type', 'post')->get();

        // $postPhotos = Photo::where('type','post')->get();
        // dd($postPhotos);
        return view('places.index', ['places' => $places, 'photos' => $photos]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cities = City::all();
        return view('places.create', ['cities' => $cities]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $place = new Place();
        $photo = new Photo();
        $price = new Price();

        $place->city_id = (int) $request->city;
        $place->rate = (int) $request->rate;
        $textContent = [
            'title',
            'body',
            'address_title',
            'address_details',
            'post_title',
            'post_description',
            'features',
            'timeTables'
        ];
        foreach ($textContent as $text) {
            $place->$text = $request->$text;
        }
        if ($request->hasFile('postPhoto')) {
            $image = $request->file('postPhoto');
            $imageName =  $image->getClientOriginalName();
            $destinationPath = $_SERVER['DOCUMENT_ROOT'] . '/images/places/';
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }
            $image->move($destinationPath, $imageName);

            // Save the image path or name in the database if needed
            $imagePath = 'images/places/' . $imageName;
            $photo->path = $imagePath;
            //    $photo->url=url($photo->path);

            $photo->type = 'post';
        }
        // dd($place,$photo);
        $place->save();
        $photo->place_id = $place->id;
        $photo->save();

        //price
        $price->place_id = $place->id;
        $price->egyptions = $request->egyptions;
        $price->foreigners = $request->foreigners;
        $price->entry = $request->entry;

        $price->epyption_price = (int) $request->epyption_price;
        $price->foreigners_price = (int) $request->foreigners_price;
        $price->entry_price = (int) $request->entry_price;


        $price->save();



        return redirect()->back()->with('success', 'Place Created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $place = Place::find($id);
        $cities = City::all();


        $postPhoto = $place->post->first();
        // dd($postPhoto);
        //post photo

        return view('places.edit', ['place' => $place, 'cities' => $cities, 'postPhoto' => $postPhoto]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
        $place = Place::find($id);
        $photo = Photo::where('place_id', $id)->where('type', 'post')->first();

        $place->city_id = (int) $request->city;
        $place->rate = (int) $request->rate;
        $textContent = [
            'title',
            'body',
            'address_title',
            'address_details',
            'post_title',
            'post_description',
            'features',
            'timeTables'
        ];
        foreach ($textContent as $text) {
            $place->$text = $request->$text;
        }
        if ($request->hasFile('postPhoto')) {
            $image = $request->file('postPhoto');
            $imageName =  $image->getClientOriginalName();
            $destinationPath = $_SERVER['DOCUMENT_ROOT'] . '/images/places/';
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }
            $image->move($destinationPath, $imageName);

            // Save the image path or name in the database if needed
            $imagePath = 'images/places/' . $imageName;
            $photo->path = $imagePath;
            //    $photo->url=url($photo->path);

            $photo->type = 'post';
        }
        // dd($place,$photo);
        $place->save();

        $photo->save();

        //price
        $prices = $place->prices;

        $prices->egyptions = $request->egyptions;
        $prices->foreigners = $request->foreigners;
        $prices->entry = $request->entry;

        $prices->epyption_price = (int) $request->epyption_price;
        $prices->foreigners_price = (int) $request->foreigners_price;
        $prices->entry_price = (int) $request->entry_price;


        $prices->save();
        return redirect()->back()->with('success', 'Place Updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $place = Place::findOrFail($id);
        if ($place->photos()->exists()) {
            $place->photos()->delete();
        }

        if ($place->postPhoto()->exists()) {
            $place->postPhoto()->delete();
        }

        // Check if prices relationship exists and delete
        if ($place->prices()->exists()) {
            $place->prices()->delete();
        }

        // Check if accessability relationship exists and delete
        if ($place->accessability()->exists()) {
            $place->accessability()->delete();
        }
        $place->delete();
        return redirect()->back()->with('success', 'Place Deleted successfully!');
    }

    public function photos($id)
    {
        $place = Place::find($id);
        $photos = $place->photos;


        return view('places.photos', ['place' => $place, 'photos' => $photos]);
    }
    public function storePhotos(Request $request, $id)
    {
        $place = Place::find($id);

        $photos = $request->file('mainPhoto');
        if ($photos) {
            foreach ($photos as $mainPhoto) {
                $photo = new Photo();
                $photo->place_id = $id;

                $destinationPath = $_SERVER['DOCUMENT_ROOT'] . '/images/places';
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0777, true);
                }

                // Generate a unique name for each file
                $fileName = $mainPhoto->getClientOriginalName();

                // Move the file to the destination path
                $mainPhoto->move($destinationPath, $fileName);
                $relativePath = '/images/places/' . $fileName;

                // Save photo info to the database
                $photo->path = $relativePath;
                $photo->type = 'mainPhoto'; // Adjust the type if needed
                $photo->save();
            }
        }
        return redirect()->back()->with('success', 'Photos Uploaded successfully!');
    }
    public function updatePhotos(Request $request, $id)
    {
        $photo = Photo::find($id);

        if ($request->hasFile('mainPhoto')) {
            $image = $request->file('mainPhoto');
            $imageName =  $image->getClientOriginalName();
            $destinationPath = $_SERVER['DOCUMENT_ROOT'] . '/images/places/';
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }
            $image->move($destinationPath, $imageName);

            // Save the image path or name in the database if needed
            $imagePath = 'images/places/' . $imageName;
            $photo->path = $imagePath;
            //    $photo->url=url($photo->path);


        }
        $photo->save();
        return redirect()->back()->with('success', 'Photo Updated successfully!');
    }
}
