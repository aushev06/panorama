<?php

namespace App\Observers;

use App\Models\Order\Order;
use App\Repositories\Order\OrderRepository;
use App\Services\Telegram\TelegramService;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class OrderObserver
{
    /**
     * @var OrderRepository
     */
    private $orderRepository;

    private $tillypadService;
    /**
     * @var TelegramService
     */
    private $telegramService;

    public function __construct(OrderRepository $orderRepository, TelegramService $telegramService)
    {
        $this->orderRepository = $orderRepository;
        $this->telegramService = $telegramService;
    }

    /**
     * Handle the order "created" event.
     *
     * @param \App\Models\Order\Order $order
     * @return void
     */
    public function created(Order $order)
    {
        $properties = $this->orderRepository->getOrderProperties($order->cart_id)->toArray();
        $this->telegramService->sendToTelegram($order, $properties);
        session()->regenerate();
    }

    /**
     * Handle the order "updated" event.
     *
     * @param \App\Models\Order\Order $order
     * @return void
     */
    public function updated(Order $order)
    {
        if ($order::STATUS_PAID === (int)$order->status) {
            $properties = $this->orderRepository->getOrderProperties($order->cart_id)->toArray();
//            $this->tillypadService->sendingOrderToTillypad($order, $properties);
            $this->telegramService->sendToTelegram($order, $properties);
        }
    }

    /**
     * Handle the order "deleted" event.
     *
     * @param \App\Models\Order\Order $order
     * @return void
     */
    public function deleted(Order $order)
    {
        //
    }

    /**
     * Handle the order "restored" event.
     *
     * @param \App\Models\Order\Order $order
     * @return void
     */
    public function restored(Order $order)
    {
        //
    }

    /**
     * Handle the order "force deleted" event.
     *
     * @param \App\Models\Order\Order $order
     * @return void
     */
    public function forceDeleted(Order $order)
    {
        //
    }
}
