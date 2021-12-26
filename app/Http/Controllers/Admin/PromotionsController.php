<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Promotions\Promotions;
use Illuminate\Http\Request;

class PromotionsController extends Controller
{

    const ROUTE_INDEX   = 'promotions.index';
    const ROUTE_CREATE  = 'promotions.create';
    const ROUTE_SHOW    = 'promotions.show';
    const ROUTE_STORE   = 'promotions.store';
    const ROUTE_UPDATE  = 'promotions.update';
    const ROUTE_EDIT    = 'promotions.edit';
    const ROUTE_DESTROY = 'promotions.destroy';

    const TITLE = 'Акции и предложения';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $model = Promotions::paginate(15);
        return view('admin.promotions.index', [
            'promotions' => $model
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $statusVariants = Promotions::getStatusesVariants();
        return view('admin.promotions.create', [
            'statusVariants' => $statusVariants
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            Promotions::ATTR_NAME     => 'required',
            Promotions::ATTR_INFO     => 'required',
            Promotions::ATTR_DISCOUNT => 'nullable',
            Promotions::ATTR_STATUS   => 'required',
        ]);

        $promotions = new Promotions();
        $promotions->fill($request->all());

        if ($promotions->save()) {
            return redirect()->route('promotions.index');
        }

        return redirect()->route('promotions.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $model = Promotions::findOrFail($id);

        return view('admin.promotions.show', [
            'model' => $model,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $statusVariants = Promotions::getStatusesVariants();
        $model          = Promotions::findOrFail($id);
        return view('admin.promotions.edit', compact('statusVariants','model'));
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
        $this->validate($request, [
            Promotions::ATTR_NAME     => 'required',
            Promotions::ATTR_INFO     => 'required',
            Promotions::ATTR_DISCOUNT => 'nullable',
            Promotions::ATTR_STATUS   => 'required',
        ]);

        $promotions = Promotions::findOrFail($id);
        $promotions->fill($request->all());
        $promotions->save();

        return redirect()->route('promotions.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Promotions::findOrFail($id)->delete();

        return redirect()->route('promotions.index');
    }
}
