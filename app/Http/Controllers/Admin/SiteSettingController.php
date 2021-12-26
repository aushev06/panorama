<?php

namespace App\Http\Controllers\Admin;

use App\Models\Setting;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class SiteSettingController extends Controller
{
    const TITLE = "Настройки сайта";


    const ROUTE_INDEX   = 'site-setting.index';
    const ROUTE_CREATE  = 'site-setting.create';
    const ROUTE_SHOW    = 'site-setting.show';
    const ROUTE_STORE   = 'site-setting.store';
    const ROUTE_UPDATE  = 'site-setting.update';
    const ROUTE_EDIT    = 'site-setting.edit';
    const ROUTE_DESTROY = 'site-setting.destroy';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response|View
     */
    public function index()
    {
        $settings = SiteSetting::query()->get();

        return view('admin.site-setting.index', [
            'settings' => $settings
        ]);
    }

    public function create(SiteSetting $setting)
    {
        return view('admin.site-setting.create', [
            'model' => $setting
        ]);
    }

    public function store(Request $request, SiteSetting $setting)
    {
        $setting->fill($request->all());
        if (empty($request->post(SiteSetting::ATTR_DESCRIPTION))) {
            $setting->description = '';
        }
        $setting->save();
        return redirect()->route(self::ROUTE_INDEX);
    }

    public function show($id)
    {
        //
    }

    public function edit($key)
    {
        $setting = SiteSetting::findOrFail($key);
        return view('admin.site-setting.edit', [
            'model' => $setting
        ]);
    }

    public function update(Request $request, $id)
    {
        $model = SiteSetting::findOrFail($id);
        $model->fill($request->all());
        $model->save();
        return redirect()->route(self::ROUTE_INDEX);
    }

    public function destroy($key)
    {
        $setting = SiteSetting::findOrFail($key)->delete();
        return redirect()->route(self::ROUTE_INDEX);
    }
}
