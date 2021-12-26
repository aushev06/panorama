<?php

namespace App\Http\Controllers;

use App\Http\Requests\Cart\CartRequest;
use App\Models\Cart\Cart;
use App\Models\Cart\CartProperty;
use App\Models\Cart\models\CartPropertyViewModel;
use App\Models\Cart\models\CartViewModel;
use App\Models\Order\Order;
use App\Models\Settings;
use App\Repositories\Cart\CartRepository;
use App\Repositories\Food\FoodReadRepository;
use App\Services\Cart\CartService;
use Hamcrest\Core\Set;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class CartController extends Controller
{
    /**
     * @var CartService
     */
    private $cartService;
    /**
     * @var CartRepository
     */
    private $cartRepository;
    /**
     * @var FoodReadRepository
     */
    private $foodReadRepository;

    public function __construct(
        CartService $cartService,
        CartRepository $cartRepository,
        FoodReadRepository $foodReadRepository
    ) {
        $this->cartService        = $cartService;
        $this->cartRepository     = $cartRepository;
        $this->foodReadRepository = $foodReadRepository;
    }

    public function store(CartRequest $request)
    {
        $this->cartService->save($request);

        $recomends = $this->foodReadRepository->getRecomendsFromFoodPropertyId($request->post('foodPropertyId'));

        $html = view('cart.api.recomend', [
            'recomend' => $recomends
        ])->render();


        return $html;
    }

    /**
     * Вывод JSON информации о корзине
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show()
    {
        return response()->json(['cart' => $this->cartRepository->getCart()]);
    }

    /**
     * Страница корзины
     */
    public function cart(Request $request)
    {
        $settings = new Settings();
        $isOrdersOff = $settings::getIsOrdersOff($settings->getActiveSettings());
        $orderStart  = $settings::getOrdersOpen($settings->getActiveSettings());
        $orderEnd    = $settings::getOrdersClose($settings->getActiveSettings());

        if ($isOrdersOff && $isOrdersOff->status === Settings::STATUS_ACTIVE) {
            $request->session()->flash(
                'message',
                ['class' => 'alert-danger', 'message' => $isOrdersOff->value ?: 'На данный момент заказы не принимаются!']
            );
            return redirect()->route('home');
        }

        if (date('H:m') > $orderEnd || date('H:m') < $orderStart) {
            $request->session()->flash(
                'message',
                ['class' => 'alert-danger', 'message' => 'В данное время суток заказы не принимаются!']
            );
            return redirect()->route('home');
        }


        $cart = $this->cartRepository->getCart();

        if (null === $cart) {
            $request->session()->flash(
                'message',
                ['class' => 'alert-danger', 'message' => 'Добавьте товары в корзину!']
            );
            return redirect()->route('home');
        }
        $model = new CartViewModel($cart, $this->cartRepository);


        return view('cart.cart', [
            'breadcumb' => 'Корзина',
            'model'     => $model
        ]);
    }

    public function checkout()
    {
        return view('cart.checkout');
    }

    public function complete(Request $request)
    {
        session()->regenerate();
        return view('cart.complete');
    }

    public function destroy(Request $request, $id)
    {
        $cart = $this->cartRepository->destroy($id);

        return $request->ajax() ? response()->json(['response' => $cart]) : redirect('home');
    }

    public function updateProperty(Request $request)
    {

        $quantitiesInfo = $request->post('quantitiesInfo') ?? [];
        foreach ($quantitiesInfo as $quantityInfo) {
            $this->cartRepository->updateProperty(
                $quantityInfo['id'],
                [CartProperty::ATTR_QUANTITY => $quantityInfo['quantity']]
            );
        }

    }


    public function destroyProperty($cartPropertyId)
    {
        $cartProperty = $this->cartRepository->destroyProperty($cartPropertyId);

        return $cartProperty;
    }

    public function activateCoupon(Request $request)
    {
        $message = $this->cartService->activateCoupon($request);

        $request->session()->flash(
            'message',
            ['class' => 'alert-info', 'message' => $message['message']]
        );


        return redirect()->route('cart');
    }
}
