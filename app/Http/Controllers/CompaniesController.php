<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Company;

class CompaniesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Company::orderBy('name', 'id')->paginate(10);
        return view("company.index")->with('companies', $companies);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('company.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, 
             ['name' => 'required',
              'photo' => 'image|nullable|max:1999'],
            ['name.required' => 'Niste unijeli naziv preduzeća!',
            'photo.image' => 'Logo mora biti slika!']
        );

        if($request->hasFile('photo')) {
            //Get filename with extension
            $filenameWithExt = $request->file('photo')->getClientOriginalName();
            //Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            //Get just extension
            $extension = $request->file('photo')->getClientOriginalExtension();
            //Filename to store
            $filenameToStore = $filename . '_' . time() . '.' . $extension;
            //Upload image 
            $path = $request->file('photo')->storeAs('public/company_photos', $filenameToStore);
        } else {
            $filenameToStore = 'noimage.jpg';
        }

        $company = new Company;
        $company->name = $request->input('name');
        $company->pib = $request->input('pib');
        $company->pdv = $request->input('pdv');
        $company->bank_account = $request->input('bank_account');
        $company->photo = $filenameToStore;
        $company->save();
        return redirect('/companies')->with('success', 'Preduzeće je uspješno dodato');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $company = Company::find($id);
        return view('company.edit')->with('company', $company);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, 
                ['name' => 'required',
                'photo' => 'image|nullable|max:1999'],
            ['name.required' => 'Niste unijeli naziv preduzeća!',
            'photo.image' => 'Logo mora biti slika!']
        );

        if($request->hasFile('photo')) {
            //Get filename with extension
            $filenameWithExt = $request->file('photo')->getClientOriginalName();
            //Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            //Get just extension
            $extension = $request->file('photo')->getClientOriginalExtension();
            //Filename to store
            $filenameToStore = $filename . '_' . time() . '.' . $extension;
            //Upload image 
            $path = $request->file('photo')->storeAs('public/company_photos', $filenameToStore);
        } 

        $company = Company::find($id);
        $company->name = $request->input('name');
        $company->pib = $request->input('pib');
        $company->pdv = $request->input('pdv');
        $company->bank_account = $request->input('bank_account');
        if($request->hasFile('photo')) {
            $company->photo = $filenameToStore;
        }
        $company->save();
        return redirect('/companies')->with('success', 'Preduzeće je uspješno izmijenjeno');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $company = Company::find($id);
        if($company->photo != 'noimage.png') {
            //Delete the image
            Storage::delete("/public/company_photos/' . $company->photo");
        }
        $company->delete();
        return redirect('/companies')->with('success', 'Preduzeće je uspješno obrisano');
    }
}
