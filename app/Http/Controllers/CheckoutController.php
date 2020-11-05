<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Payment\PagSeguro\CreditCard;
use App\Payment\PagSeguro\Notification;
use App\Store;
use Ramsey\Uuid\Uuid;

class CheckoutController extends Controller
{
    public function index()
    {
        // session()->forget('pagseguro_session_code');
        if(!auth()->check()) {
            return redirect()->route('login');
        }

        if(!session()->has('cart')) return redirect()->route('home');

        $this->makePagSeguroSession();

        $cartItems = array_map(function($line) {
            return $line['amount'] * $line['price'];
        }, session()->get('cart'));

        $cartItems = array_sum($cartItems);

        return view('checkout', compact('cartItems'));
    }

    public function sold()
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        if(!session()->has('cart')) return redirect()->route('home');

        $user = auth()->user();

        return view('sold', compact('user'));
    }

    public function process(Request $request)
    {
        try {
            $dataPost = $request->all();
            $user = auth()->user();
            $reference = Uuid::uuid4();
            $cartItems = session()->get('cart');
            $stores = array_unique(array_column($cartItems, 'store_id'));

            $creditCardPayment = new CreditCard($cartItems, $user, $dataPost, $reference);
            $result = $creditCardPayment->doPayment();

            $userOrder = [
                'reference' => $reference,
                'pagseguro_code' => $result->getCode(),
                'pagseguro_status' => $result->getStatus(),
                'items' => serialize($cartItems),
            ];

            $userOrder = $user->orders()->create($userOrder);
            $userOrder->stores()->sync($stores);

            // Notificação de novo pedido
            $store = new Store;
            $store->notifyStoreOwners($stores);

            session()->forget('cart');
            session()->forget('pagseguro_session_code');

            return response()->json([
                'data' => [
                    'status' => true,
                    'message' => 'Pedido criado com sucesso.',
                    'order' => $reference
                ]
            ]);
        } catch (\Exception $e) {
            $message = env('APP_DEBUG') ? $e->getMessage() : 'Ocorreu um erro inesperado ao processar o pedido.';

            return response()->json([
                'data' => [
                    'status' => false,
                    'message' => $message
                ]
            ], 401);
        }
    }

    public function thanks()
    {
        return view('thanks');
    }

    public function notification()
    {
        try {
            $notification = new Notification();
            $notification = $notification->getTransaction();

            $userOrder = UserOrder::whereReference($notification->getReference());
            $userOrder->update([
                'pagseguro_status' => $notification->getStatus()
            ]);

            if ($notification->getStatus() == 3) {
                //Liberar o pedido
                //Notificar o usuário
                //Notificar a loja
            }

            return response()->json([], 204);
        } catch (\Exception $e) {
            $message = env('APP_DEBUG') ? $e->getMessage() : '';
            return response()->json(['error' => $message], 500);
        }
    }

    private function makePagSeguroSession()
    {
        if (!session()->has('pagseguro_session_code')) {
            $sessionCode = \PagSeguro\Services\Session::create(
                \PagSeguro\Configuration\Configure::getAccountCredentials()
            );

            session()->put('pagseguro_session_code', $sessionCode->getResult());
        }
    }
}
