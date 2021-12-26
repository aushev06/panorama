<?php

namespace App\Http\Controllers\Admin;

use App\Filters\OrderFilter;
use App\Models\Order\models\OrderViewModel;
use App\Models\Order\Order;
use App\Repositories\Order\OrderRepository;
use App\Services\Tillypad\TillypadService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    const ROUTE_INDEX   = 'order.index';
    const ROUTE_CREATE  = 'order.create';
    const ROUTE_SHOW    = 'order.show';
    const ROUTE_STORE   = 'order.store';
    const ROUTE_UPDATE  = 'order.update';
    const ROUTE_EDIT    = 'order.edit';
    const ROUTE_DESTROY = 'order.destroy';

    const TITLE = 'Заказы';
    /**
     * @var OrderRepository
     */
    private $orderRepository;
    /**
     * @var TillypadService
     */
    private $service;

    public function __construct(OrderRepository $orderRepository, TillypadService $service)
    {
        $this->orderRepository = $orderRepository;
        $this->service         = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, OrderFilter $orderFilter)
    {
        /**
         * @var Order[] $orders
         */
        $orders = $this->orderRepository->get()->filter($orderFilter)->orderBy(Order::ATTR_ID, 'desc')->paginate(15);
        return view('admin.order.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::findOrFail($id);
        $model = new OrderViewModel($order, $this->orderRepository);

        return view('admin.order.show', compact('model'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $order = Order::findOrFail($id);
        $model = new OrderViewModel($order, $this->orderRepository);

        return view('admin.order.edit', compact('model'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->orderRepository->update($request->all(['name']), $id);

        return redirect()->route(static::ROUTE_SHOW, $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->orderRepository->destroy($id);

        return redirect()->route('admin.index');
    }

    public function sendToTillypad(string $id)
    {
        $order      = Order::query()->findOrFail($id);
        $properties = $this->orderRepository->getOrderProperties($order->cart_id)->toArray();


        foreach ($properties as $property) {
            if (null === $property['mitm_id']){
                return "Не возможно отправить в тилипад, так как отсутствует MITM_ID";
            }
        }

        $this->service->sendingOrderToTillypad($order, $properties);
    }

}
