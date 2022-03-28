<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProductCategory;
use App\Product;
use App\ProductPhoto;
use App\Cart;
use App\Address;
use App\State;
use App\Lga;
use App\Order;
use PDF;
use Codedge\Fpdf\Fpdf\Fpdf;

use Illuminate\Support\Facades\Auth;

class StoreController extends Controller
{

    public $fpdf;
    
    public function index(){
    	// require_once('helper.php');
       // $cookieManager = new cookieManager();
		
		$setCookie = setGuestCookie();

		// dd($setCookie);

    	$data['product_categories'] = ProductCategory::select("*")
    		->orderBy('title')
    		->get();


    	$data['products'] = \DB::table('product')
    	->join('product_categories', "product.category", "=", "product_categories.id")
    	->select('product.*', 'product_categories.title as catTitle', 'product_categories.id as catId')
    	->paginate(10);
         /*dd($_COOKIE['guest']);*/
    	// Product::paginate(10);

    	return view('store.index')->with($data);
    }


    public function productDetail($slug){
        $setCookie = setGuestCookie();
    	// $data['product'] = Product::where('slug', $slug)->first();
    	$data['product'] = \DB::table('product')
    	->join('product_categories', "product.category", "=", "product_categories.id")
    	->select('product.*', 'product_categories.title as catTitle', 'product_categories.id as catId')
    	->where(['product.slug'=>$slug])
    	->first();

    	if (!is_null($data['product'])) {

    		$data['productPhotos'] = ProductPhoto::where('product_id', $data['product']->id)->get();

    	 	$data['related'] = Product::where('category', $data['product']->category)->get();
    	}else{
    	 	
    	 	die('<h2 style="color:red; text-align:center; margin-top:20px;">This Product is no longer Found</h2>');

		}
        /*dd($_COOKIE['guest']);*/

    	return view('store.product_detail')->with($data);
    	
    }

    public function addCart(Request $request){


        $cart = \DB::table('cart')
            ->join('product', "product.id", "=", "cart.product_id")
            ->select('product.quantity as productQty','product.price as productPrice','cart.quantity as cartQty', 'cart.*')
            ->where(['guest_id'=>$request->guest, 'product_id'=>$request->productId])
            ->first();
    	
    	
        if (is_null($cart)) {
            $product = Product::where('id', $request->productId)->first();

            if ($request->quantity>$product->quantity) {
                $resArr = ['status'=> 'failed', 'quantity'=>$product->quantity];
                return json_encode($resArr);
            }else{
                $cart = new Cart;

                $cart->product_id       = $request->productId;
                $cart->guest_id         = $request->guest;
                $cart->guest_expires    = strtotime("+30 days");
                $cart->price            = $request->price;
                $cart->quantity         = $request->quantity;
                $cart->total            = (float)$request->quantity * (float)$request->price;

            }

    			    	
    	}else{
           

            if ($request->quantity + $cart->cartQty > $cart->productQty) {

               $resArr = ['status'=> 'failed', 'quantity'=>$cart->productQty];
                return json_encode($resArr);
            }

                 $cart = Cart::where(['guest_id'=>$request->guest, 'product_id'=>$request->productId])->first();

                $cart->quantity       = $cart->quantity + $request->quantity;
                $cart->total            = ( (float)$request->quantity * (float)$request->price ) + $cart->total; 
    		

    	}

        $cart->save();
        $cartCount = cartCount($request->guest);
        $priceSum = sumCartPrice($request->guest);
        

        return json_encode(['status'=>'success', 'cartCount'=>$cartCount, 'priceSum'=>$priceSum]);
    	

    }


    public function viewCart(){
        $setCookie =setGuestCookie();
        $data['cartProducts'] = \DB::table('cart')
            ->join('product', "product.id", "=", "cart.product_id")
            ->select('cart.*', 'product.*', 'product.id as productId', 'cart.quantity as cartQty', 'cart.id as id')
            ->where(['cart.guest_id'=>$_COOKIE['guest']])
            ->get();

            // dd($_COOKIE['guest']);
            // dd($data['cartProducts']);

             /*dd($_COOKIE['guest']);*/

        return view('store.cart')->with($data);
    }

    public function increaseCartQty(Request $request){


        $cart = \DB::table('cart')
            ->join('product', "product.id", "=", "cart.product_id")
            ->select('product.quantity','cart.quantity as cartQty', 'cart.price')
            ->where(['cart.id'=>$request->cartId])
            ->first();

            // return $request->cartId;

        if ($cart->quantity < $request->quantity) {
            
            $resArr = ['status'=> 'failed', 'quantity'=>$cart->quantity];
            return json_encode($resArr);
        }else{

            $cartPrd = Cart::where('id', $request->cartId)->first();

            $cartPrd->quantity = $request->quantity;

            $cartPrd->total = $request->quantity * $cart->price;

            $cartPrd->save();

            $cartCount = cartCount($_COOKIE['guest']);

            $priceSum = sumCartPrice($_COOKIE['guest']);

            $resArr = ['status'=> 'success', 'quantity'=>$cartPrd->quantity, 'cartWorth'=>$priceSum, 'cartCount'=>$cartCount, 'productTotal'=>$cartPrd->total];
            return json_encode($resArr);
        }


    }

     public function removeFromCart(Request $request)
    {
        $getCart = cart::where('id', $request->product_id)->delete();
        // $getCart->delete();
        return redirect()->back()->with('success', 'Item has been removed from cart');
    }


    public function checkout(){
        if (!Auth::check()) {

            return redirect(route('login'))->with('error', 'login to complete shopping');
        }else{
            $data['states'] = State::all();
            $data['myStateLga'] = Lga::where('state_id', Auth::user()->state)->get();
            $data['addresses'] = Address::where('user_id', Auth::user()->id)->get();

            $data['lgas'] = Lga::all();

            $setCookie =setGuestCookie();

            $data['cartProducts'] = \DB::table('cart')
                ->join('product', "product.id", "=", "cart.product_id")
                ->select('cart.*', 'product.*', 'product.id as productId', 'cart.quantity as cartQty')
                ->where(['cart.guest_id'=>$_COOKIE['guest']])
                ->get();



            // dd($data['myStateLga']);
            return view('store.checkout')->with($data);
        }
    }


    public function addAddress(Request $request){
        
        if (is_null($request->addressId)) {
           $address = new Address;
           $address->user_id = Auth::user()->id;
           $address->state = $request->state;
           $address->lga = $request->lga;
           $address->landmark = $request->landmark;
           $address->address = $request->address;

        }else{
            $address = Address::where('id', $request->addressId)->first();
            $address->state = $request->state;
            $address->lga = $request->lga;
            $address->landmark = $request->landmark;
            $address->address = $request->address;

        }

        $address->save();

        return redirect(route('checkout'))->with('success', 'address added successfuly');
    }

    public function setOrderData(Request $request){

        // return $request->shopping_data;

        if (!is_null($request->shopping_data)) {

            Session(['orderData'=>$request->shopping_data]);

            // return json_encode($request);
            return 'success';
        }else{
             return 'failed';
        }
        
        
    }

    public function confirmOrder(){
        // dd(session('orderData'));
        $shopData = session('orderData');

        
            
            // generate order reference
            $orderData['reference']=\Str::random(3).time();

             $orderData['checkoutData']=$shopData;

            $orderData['products']=[];

            // $cartProducts = Cart::where('guest_id', $_COOKIE['guest'])->get();

            $cartProducts = \DB::table('cart')
                ->join('product', "product.id", "=", "cart.product_id")
                ->select('cart.*', 'product.*', 'product.id as productId', 'cart.quantity as cartQty')
                ->where(['cart.guest_id'=>$_COOKIE['guest']])
                ->get();

            foreach ($cartProducts as $product) {
                $productData = array(
                    'product_id'=>$product->product_id, 
                    'price'=>$product->price, 
                    'quantity'=>$product->cartQty,
                    'title' => $product->title,
                );

                array_push($orderData['products'], $productData);
               
               // array_push($orderData['products'], ['product_id'=>$product->product_id, 'price'=>$product->seller_id, 'quantity'=>$product->quantity, 'total'=>$product->total]);
            }

            Session(['paymentData' => $orderData]);

            if ($orderData['checkoutData']['payment_method']=='debit_card') {

                return redirect(url('store/payment/debitcard'));
                
            }else{
                dd($orderData);
            }
            

        /*if ($shopData['payment_method']=='debit_card') {
        }*/
    }


    public function paymentSuccess($reference){

        // $data['order'] = Order::where('reference', $reference)->first();

        $data['order'] = \DB::table('orders')
                ->join('shippings', "shippings.order_ref", "=", "orders.reference")
                ->select('orders.*', 'shippings.*')
                ->first();
        // dd(session('payment_summary'));
        // dd($data['order']);
        $data['products'] = json_decode($data['order']->products);

        // dd( $data['products'] );

        // $data['products'] = Produ

        return view('store.paymentsuccess')->with($data);
    }


    public function orderReceipt($reference){
        $data['order'] = \DB::table('orders')
                ->join('shippings', "shippings.order_ref", "=", "orders.reference")
                ->select('orders.*', 'shippings.*')
                ->first();
        
        $data['products'] = json_decode($data['order']->products);
        return view('store.receipt')->with($data);
/*
        view()->share($data);
      $pdf = PDF::loadView('store.paymentsuccess', $data);

      // download PDF file with download method
      return $pdf->download('pdf_file.pdf');*/
    }

    /*public function payWithPaystack(){

    }*/



    /*public function cartCount($guestId){
    	return $cartCount = Cart::where('guest_id', $guestId)->count();
    }

    public function sumCartPrice($guestId){
    	return $cartCount = Cart::where('guest_id', $guestId)->sum('total');
    }*/
}
