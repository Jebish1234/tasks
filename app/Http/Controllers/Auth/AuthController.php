<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Models\User;
use DB;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Orders;
use Hash;
  
class AuthController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index()
    {
        return view('auth.login');
    }  
      
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function registration()
    {
        return view('auth.registration');
    }
      
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function postLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
   
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('dashboard')
                        ->withSuccess('You have Successfully loggedin');
        }
  
        return redirect("login")->withSuccess('Oppes! You have entered invalid credentials');
    }
      
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function postRegistration(Request $request)
    {  
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);
           
        $data = $request->all();
        $check = $this->create($data);
         
        return redirect("dashboard")->withSuccess('Great! You have Successfully loggedin');
    }
    
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function dashboard()
    {
        if(Auth::check()){
            $products = Product::all();

            return view('dashboard',compact('products'));
        }
  
        return redirect("login")->withSuccess('Opps! You do not have access');
    }
    
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function create(array $data)
    {
      return User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password'])
      ]);
    }
    
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function logout() {
        Session::flush();
        Auth::logout();
  
        return Redirect('login');
    }

    public function cart($data){
        $cart = Cart::create([
            'customer' => Auth::user()->id,
            'product' => $data,
          ]);
        
          $cart->save();

          $product = Cart::where('customer','=',Auth::user()->id)->get();
          $products  = [];
          
          foreach($product as $pr){
            $products = [];
            
            $pra = Product::where('id','=',$pr->product)->first();
            
            $products= [$pra];
          }
          
          $products = $products;

          return view('cart',compact('products'));

    }

    public function order($data){
        $cart = Orders::create([
            'customer' => Auth::user()->id,
            'product' => $data,
          ]);
        
          $cart->save();

          $it = Cart::where('customer','=',Auth::user()->id)->where('product','=',$data)->first();
          $it->delete();
         
          $qt = Product::where('id',$data)->first();
          $qt->weight = $qt->weight - 1;
          $qt->save();


          return redirect("dashboard")->withSuccess('Successfully you have purchase this order');;

    }

    public function adminorder()
    {
      $orders = DB::table('orders')->join('users','orders.customer','=','users.id')
      ->join('products','orders.product','=','products.id')->select('users.name as un','products.name as pn','orders.created_at as time')->get();
      
      return view('adminorder',compact('orders'));
    }


}
