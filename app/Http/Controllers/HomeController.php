<?php

namespace iBlog\Http\Controllers;

use Illuminate\Http\Request;
use iBlog\Category;
use iBlog\Post;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        $posts = Post::latest()->approved()->published()->paginate(6);
        return view('welcome',compact('categories','posts'));
    }
    public function aboutpage()
    {
        return view('about');
    }


    public function checkout()
    {   
        // Enter Your Stripe Secret
        \Stripe\Stripe::setApiKey('sk_test_51Id5N7LalF3Lv2yPdxRPVkPJeWtfGFzsGhxulmJnxVW7jBA7y7USFGU5J00rhaPJVdVl1d888NDajQ05PuTpUdOK009T0dXPlD');
                
        $amount = 10;
        $amount *= 10;
        $amount = (int) $amount;
        
        $payment_intent = \Stripe\PaymentIntent::create([
            'description' => 'Stripe Test Payment',
            'amount' => $amount,
            'currency' => 'USD',
            'description' => 'Payment From Codehunger',
            'payment_method_types' => ['card'],
        ]);
        $intent = $payment_intent->client_secret;

        return view('subscriber_page',compact('intent'));

    }
    
}
