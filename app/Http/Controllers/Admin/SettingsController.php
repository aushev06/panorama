<?php

namespace App\Http\Controllers\Admin;

use App\Models\Settings;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\View\View;

class SettingsController extends Controller
{
    const TITLE = "Настройки сайта";

    const ROUTE_INDEX   = 'settings.index';
    const ROUTE_CREATE  = 'settings.create';
    const ROUTE_SHOW    = 'settings.show';
    const ROUTE_STORE   = 'settings.store';
    const ROUTE_UPDATE  = 'settings.update';
    const ROUTE_EDIT    = 'settings.edit';
    const ROUTE_DESTROY = 'settings.destroy';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response|View
     */
    public function index()
    {
        $settings = Settings::query()->get();

        return view('admin.settings.index', [
            'settings' => $settings
        ]);
    }

    public function create(Settings $setting)
    {
        return view('admin.settings.create', [
            'model' => $setting
        ]);
    }

    public function store(Request $request, Settings $setting)
    {
        $setting->fill($request->all());
        if (empty($request->post(Settings::ATTR_DESCRIPTION))) {
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
        $setting = Settings::findOrFail($key);
        return view('admin.settings.edit', [
            'model' => $setting
        ]);
    }

    public function update(Request $request, $id)
    {
        $model = Settings::findOrFail($id);
        $model->fill($request->all());
        $model->save();
        return redirect()->route(self::ROUTE_INDEX);
    }

    public function destroy($key)
    {
        $setting = Settings::findOrFail($key)->delete();
        return redirect()->route(self::ROUTE_INDEX);
    }
}
