<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PromotionCards\PromotionCardsRequest;
use App\Models\PromotionCards\PromotionCards;
use App\Models\Promotions\Promotions;
use App\Services\PromotionCards\PromotionCardsService;
use Illuminate\Http\Request;

class PromotionCardsController extends Controller
{

    const ROUTE_INDEX   = 'promotion-cards.index';
    const ROUTE_CREATE  = 'promotion-cards.create';
    const ROUTE_SHOW    = 'promotion-cards.show';
    const ROUTE_STORE   = 'promotion-cards.store';
    const ROUTE_UPDATE  = 'promotion-cards.update';
    const ROUTE_EDIT    = 'promotion-cards.edit';
    const ROUTE_DESTROY = 'promotion-cards.destroy';
    const ROUTE_REFRESH = 'promotion-cards.refresh';

    const TITLE = 'Карточки акций и предложений';

    /**
     * @var PromotionCards
     */
    private $model;
    /**
     * @var PromotionCardsService
     */
    private $service;

    public function __construct(PromotionCardsService $service) {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $model = PromotionCards::paginate(15);
        return view('admin.promotion-cards.index', [
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
        $model = new PromotionCards();
        $statusVariants = $model::getStatusesVariants();
        return view('admin.promotion-cards.create', [
            'model' => $model,
            'statusVariants' => $statusVariants
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PromotionCardsRequest $request)
    {
        $this->service->save($request);
        return redirect()->route('promotion-cards.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $model = PromotionCards::findOrFail($id);

        return view('admin.promotion-cards.show', [
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
        $model = PromotionCards::findOrFail($id);
        return view('admin.promotion-cards.edit', [
            'model' => $model
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PromotionCardsRequest $request, $id)
    {
        $this->service->edit($request, $id);
        return redirect()->route('promotion-cards.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->service->delete($id);
        return redirect()->route('promotion-cards.index');
    }

    public function refresh()
    {
        $this->service->writeToFile();
        return redirect()->route('promotion-cards.index');
    }
}
