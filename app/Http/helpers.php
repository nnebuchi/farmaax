<?php 
	
	use Illuminate\Http\Request;
	// use Symfony\Component\HttpFoundation\Cookie;
	use Illuminate\Support\Facades\Cookie;
	use App\Cart;


	// class CookieManager
	// {
		
	function setGuestCookie(){
		// setcookie("guest", "", time() - 3600);

		
		// $grabCookie  = $_COOKIE['guest'];

		
		if (!isset($_COOKIE['guest'])) {
			$expires = strtotime("+30 days"); //1 month
			setcookie('guest', sha1(rand(0,1).microtime()), $expires, '/');
	      	
	      	$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	      	return redirect($actual_link);
	      	
	      	return $_COOKIE['guest'];
	      	
		}else{
			$expires = strtotime("+30 days"); //1 month
			 setcookie('guest', $_COOKIE['guest'], $expires, '/');
	      	
	      	return $_COOKIE['guest'];
	      	
		}


    	
    }



	 function cartCount($guestId){
    	return $cartCount = Cart::where('guest_id', $guestId)->count();
    }

    function sumCartPrice($guestId){
    	return $cartCount = Cart::where('guest_id', $guestId)->sum('total');
    }

	    /*function getCookie(Request $request){
	      $value = $request->cookie('guest');
	      return $value;
	   }*/
	// }

	

 ?>