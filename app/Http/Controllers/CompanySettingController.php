<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CompanySetting;
use App\Http\Requests\UpdateCompanySettingRequest;

class CompanySettingController extends Controller
{
    public function show($id)
    {
        $setting = CompanySetting::findOrFail($id);
        return view('company_setting.show', compact('setting'));
    }

    public function edit(CompanySetting $company_setting)
    {
        return view('company_setting.edit', compact('company_setting'));
    }

    public function update($id , UpdateCompanySettingRequest $request)
    {
        $setting = CompanySetting::findOrFail($id);
        $setting->update($request->only('company_name', 'company_email', 'company_phone', 'company_address', 'office_start_time', 'office_end_time', 'break_start_time', 'break_end_time'));

        return redirect()->route('company-setting.show', 1)->with('update', 'CompanySetting is Successfully Update');
    }
}
