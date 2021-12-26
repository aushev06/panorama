<?php

namespace App\Http\Controllers;

use App\Filters\OrderFilter;
use App\Mail\SendFeedback;
use App\Models\Category\Category;
use App\Models\Order\Order;
use App\Repositories\Order\OrderRepository;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Twilio\Rest\Client;

class HomeController extends Controller
{

    /**
     * @var OrderRepository
     */
    private $orderRepository;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $categories = Category::get();
        return view('home', compact('categories'));
    }

    public function pay()
    {
        return view('static.pay');
    }

    public function delivery()
    {
        return view('static.delivery');
    }

    public function contact()
    {
        return view('static.contact');
    }
    public function bonus()
    {
        return view('static.bonus');
    }

    public function cabinet(OrderFilter $orderFilter)
    {
        /**
         * @var Order[] $orders
         */
        $orders = $this->orderRepository
            ->get()
            ->filter($orderFilter)
            ->where('user_id' , auth()->user()->id)
            ->orderBy(Order::ATTR_ID, 'desc')
            ->paginate(15);
        return view('cabinet', [
            'orders' => $orders
        ]);
    }

    public function userOrders(OrderFilter $orderFilter) {
        /**
         * @var Order[] $orders
         */
        $orders = $this->orderRepository
            ->get()
            ->filter($orderFilter)
//            ->where('phone' , auth()->user()->phone)
            ->where('user_id' , auth()->user()->id)
            ->orderBy(Order::ATTR_ID, 'desc')
            ->paginate(15);

        $responseOrder = [];
        foreach ($orders as $order) {
            $responseOrder[] = [
                'id' => $order->id,
                'date_delivery' => $order->date_delivery,
                'total' => $order->total
            ];
        }

        return \response()->json([
            'orders' => $responseOrder,
        ], 200);
    }

    public function saveClient (Request $request)
    {
        $this->validate($request, [
            'name'  => ['required', 'string', 'max:255'],
            'email'    => ['string', 'nullable', 'email', 'max:255', 'unique:ref_user,email, '. auth()->user()->id . ',id'],
            'phone'    => ['required', 'string', 'min:11', 'max:11', 'unique:ref_user,phone, '. auth()->user()->id . ',id'],
        ],[
            'phone.max' => 'Введен некорректный телефонный номер',
            'email.unique' => 'Этот Email-адрес уже используется',
            'phone.unique' => 'Этот телефон уже используется',
        ]);

        /**
         * @var User $user
         */
        $user = auth()->user();
        $phone = str_replace(["+", ' ', '-', '(', ')'], '', $user->phone);
        $request->request->set('phone', $phone);
        $user->fill($request->all());
        $user->save();

        return \response()->json([
            'user' => $user,
        ], 200);

//        return redirect()->route('home');

    }

    public function sendFeedback(Request $request)
    {
        if ($request->isMethod('post')) {
            $this->validate($request, [
                'name' => ['required', 'string', 'max:255'],
                'feedback' => ['string', 'max:255'],
            ]);

            $emailTo = "help@magia-dostavka.ru";

            Mail::to($emailTo)->send( new SendFeedback($request) );

        }

        return redirect('/');

    }

}
