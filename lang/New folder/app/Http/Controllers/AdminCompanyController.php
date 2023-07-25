<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class AdminCompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'companies' => Company::all(),
        ];

        return view('admin.companies.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.companies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required','unique:companies,name'],
            'uid' => ['required','unique:companies,uid'],
        ]);

        $data = [
            'name' => $request->name,
            'uid' => $request->uid,
        ];
        $is_company_created = Company::create($data);

        if($is_company_created){
            return redirect()->back()->with('success', 'Company added Successfully');
        }else{
            return redirect()->back()->with('error', 'Company has failed to be created!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        $data = [
            'company' => $company,
        ];
        return view('admin.companies.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company)
    {
        $request->validate([
            'name' => ['required','unique:companies,name,'. $company->id .',id'],
            'uid' => ['required','unique:companies,uid,'. $company->id .',id'],
        ]);

        $data = [
            'name' => $request->name,
            'uid' => $request->uid,
        ];
        $is_company_updated = Company::find($company->id)->update($data);

        if($is_company_updated){
            return redirect()->back()->with('success', 'Company updated Successfully');
        }else{
            return redirect()->back()->with('error', 'Company has failed to update!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        $is_company_deleted = Company::find($company->id)->delete();

       if($is_company_deleted){
        return redirect()->back()->with('success', 'company deleted Successfully');
    }else{
        return redirect()->back()->with('error', 'company has failed to delete');
    }
    }
}
