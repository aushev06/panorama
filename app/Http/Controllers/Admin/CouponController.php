<?php

namespace App\Http\Controllers\Admin;

use App\Models\Coupon\Coupon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CouponController extends Controller
{
    const ROUTE_INDEX   = 'coupon.index';
    const ROUTE_CREATE  = 'coupon.create';
    const ROUTE_SHOW    = 'coupon.show';
    const ROUTE_STORE   = 'coupon.store';
    const ROUTE_UPDATE  = 'coupon.update';
    const ROUTE_EDIT    = 'coupon.edit';
    const ROUTE_DESTROY = 'coupon.destroy';

    const TITLE = 'Купоны';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $model = Coupon::paginate(15);
        return view('admin.coupon.index', [
            'coupons' => $model
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $statusVariants = Coupon::getStatusesVariants();
        $typeVariants   = Coupon::getTypesVariants();
        return view('admin.coupon.create', compact('statusVariants', 'typeVariants'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            Coupon::ATTR_COUPON => 'required',
            Coupon::ATTR_TYPE   => 'required',
            Coupon::ATTR_VALUE  => 'required',
            Coupon::ATTR_TYPE   => 'required',
            Coupon::ATTR_STATUS => 'required',
        ]);

        $coupon = new Coupon();
        $coupon->fill($request->all());

        if ($coupon->save()) {
            return redirect()->route('coupon.index');
        }

        return redirect()->route('coupon.index');


    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $statusVariants = Coupon::getStatusesVariants();
        $typeVariants   = Coupon::getTypesVariants();
        $model          = Coupon::findOrFail($id);
        return view('admin.coupon.edit', compact('statusVariants', 'typeVariants', 'model'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            Coupon::ATTR_COUPON => 'required',
            Coupon::ATTR_TYPE   => 'required',
            Coupon::ATTR_VALUE  => 'required',
            Coupon::ATTR_TYPE   => 'required',
            Coupon::ATTR_STATUS => 'required',
        ]);

        $coupon = Coupon::findOrFail($id);
        $coupon->fill($request->all());
        $coupon->save();

        return redirect()->route('coupon.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Coupon::findOrFail($id)->delete();

        return redirect()->route('coupon.index');
    }
}
