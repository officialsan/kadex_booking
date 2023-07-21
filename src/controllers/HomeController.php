<?php 
namespace Kadex\controllers;

use Kadex\app\Auth;
use Kadex\app\Country;
use Kadex\app\Services;
use Kadex\app\Product;
use Kadex\app\Category;
use Kadex\app\Filter;
use Kadex\app\Cart;
use Kadex\app\Order;
use Kadex\app\Shipping;

class HomeController {
	static function index() 
	{
		$services = (new Services())->all();
		return view('home',['services' => $services]);
	}
	static function detail($request)
	{
		$id =   $request['id'];
		$service =  (new Services())->getId( $id);
		$products = (new Product())->getProductsWithServiceId($id);
		return view('detail',['service' => $service,'products' => $products]);
	}
	static function  productDetails($request)
	{
		$id =   $request['id'];
		$product =  (new Product())->getId( $id);
		$products =  (new Product())->getRelatedProductsWithServiceId($product->service_id,$product->tasks);
		$service = (new Services())->getId(($product->service_id));
		$highestDuration = max(array_column($products, 'duration'));
		$lowestDuration = min(array_column($products, 'duration'));
		$category_ids = array_column($products, 'category_id');
		$filters_ids = array_column($products, 'filterid');
		$categories = (new Category())->whereIn($category_ids);
		$filters = (new Filter())->whereIn($filters_ids);
		// dd($products);
		$data = [
			'service' => $service,
			'products' => $products,
			'lowestDuration' => $lowestDuration,
			'highestDuration' => $highestDuration
		];
		
		return view('modal_product',$data);
	}
	static function addToCart()
	{
		$product_id = $_GET['id'];
		// dd($product_id);
		$quantity = $_GET['quantity'] ?? 1;
		$product =  (new Product())->getId( $product_id);
		$item = [
            'product_id' => $product_id,
            'product_name' => $product->product,
            'quantity' => $quantity,
            'unit_price' => $product->price,
            'total_price' =>  $product->price * $quantity,
        ];
		$cart = new Cart();
		return $cart->addCart($item);

	}
	static function removeItem()
	{
		$product_id = $_GET['id'];
		$cart = new Cart();
		return $cart->removeItem($product_id);
	}
	static function updateDateAndTime()
	{
		$date = $_GET['date'];
		$time = $_GET['time'];
		$cart = new Cart();
		return $cart->updateDateAndTime($date,$time);
	} 
	static function checkout()
	{
		if(!$user = Auth::user()) return redirect('/');
		$countries = new Country();
		$countries = $countries->all();
		return view('checkout',['countries' => $countries]);
	}
	static function orderNow()
	{
		if(!$user = Auth::user()) return redirect('/');
		// Shipping address upload
		$shipping = new Shipping();
		$shipping->data = $_POST;
		if($shipping->save() == false) errorResponse('Something went wrong');
		$shipping_id = $shipping->data['id'];
		// cart upload 
		$cart = new Cart();
		$cart_ids = $cart->upload();
		$cart_ids = implode(",", $cart_ids);
		// Order upload
		$order = new Order();
		
		$order->data =  [
					'user_id' => Auth::getUserId(),
					'shipping_id' => $shipping_id,
					'order_no' => 'KDX'. Auth::getUserId().time(),
					'cart' => $cart_ids,
					'date_booked' => $cart->getDateAndTime() ,
					'instructions' => $_POST['instructions'],
					'price' => $cart->cart['subTotal'] ,
					'discount' => 0 ,
					'vat' => 0 ,
					'final_price' => $cart->cart['subTotal'] ,
					'order_status' => 0,
					'created_at' => date('Y-m-d H:i:s'),
					'completed' =>0  
		];
		if(!$order->save()) return errorResponse('Something went wrong');
		$cart->
		return successResponse('Order completed');
	}
}