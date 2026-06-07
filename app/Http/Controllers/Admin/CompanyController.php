<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Company;
use Illuminate\Support\Facades\Hash;

class CompanyController extends Controller
{
    public function index()
    {
        $companies = Company::latest()->get();

        return view('admin.companies.index', compact('companies'));
    }

    public function store(Request $request)
    {
        Company::create([
            'company_name' => $request->company_name,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'status' => $request->status ?? 'active',
        ]);

        return back();
    }

    public function edit(Company $company)
    {
        $allCompanies = Company::where('id', '!=', $company->id)->get();

        return view('admin.companies.edit', compact('company', 'allCompanies'));
    }

    public function update(Request $request, Company $company)
    {
        $data = [
            'company_name' => $request->company_name,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'status' => $request->status,
            'price_type' => $request->price_type,
        ];

        if (!empty($request->password)) {
            $data['password'] = Hash::make($request->password);
        }

        $company->update($data);

        return redirect()
            ->route('companies.index')
            ->with('success', 'Company yeniləndi');
    }


    public function destroy(Company $company)
    {
        $company->delete();

        return back();
    }
}
