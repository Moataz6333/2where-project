<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use Illuminate\Http\Request;
use App\Models\Compainy;
use App\Models\Founder;
use App\Models\Photo;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $companies = Compainy::all();
        return view('companies.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('companies.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCompanyRequest $request)
    {
        $company = Compainy::create([
            'name' => $request->name,
            'description' => $request->description,
            'phone' => $request->phone,
            'phone2' => $request->phone2,
            'email' => $request->email,
            'BankIBAN' => $request->bank
        ]);
        $founder = Founder::create([
            'name' => $request->founder_name,
            'phone' => $request->founder_phone,
            'national_id' => $request->national_id,
            'company_id' => $company->id,
        ]);
        if ($request->hasFile('postPhoto')) {
            $photo = new Photo();
            $image = $request->file('postPhoto');
            $imageName =  $image->getClientOriginalName();
            $destinationPath = $_SERVER['DOCUMENT_ROOT'] . '/images/companies/';
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }
            $image->move($destinationPath, $imageName);

            // Save the image path or name in the database if needed
            $imagePath = 'images/companies/' . $imageName;
            $photo->path = $imagePath;
            $photo->type = 'post';
            $photo->company_id = $company->id;
            $photo->save();
        }
        return redirect()->back()->with('success', 'Company Created successfully!');
    }

    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $company=Compainy::findOrFail($id)->load('founder');
        return view('companies.edit',compact('company'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCompanyRequest $request, string $id)
    {
        $company=Compainy::findOrFail($id)->load('founder');
             
        $company->update([
            'name' => $request->name,
            'description' => $request->description,
            'phone' => $request->phone,
            'phone2' => $request->phone2,
            'email' => $request->email,
            'BankIBAN' => $request->bank
        ]);
        $company->founder()->update([
            'name' => $request->founder_name,
            'phone' => $request->founder_phone,
            'national_id' => $request->national_id,
        ]);
        if ($request->hasFile('postPhoto')) {
            $photo = Photo::where('company_id',$company->id)->first();
            $image = $request->file('postPhoto');
            $imageName =  $image->getClientOriginalName();
            $destinationPath = $_SERVER['DOCUMENT_ROOT'] . '/images/companies/';
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }
            $image->move($destinationPath, $imageName);

            // Save the image path or name in the database if needed
            $imagePath = 'images/companies/' . $imageName;
            $photo->path = $imagePath;
            $photo->type = 'post';
            $photo->company_id = $company->id;
            $photo->save();
        }
        return redirect()->back()->with('success', 'Company Updated successfully!');
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
