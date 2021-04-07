<?php

namespace iBlog\Http\Controllers;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    

    public function afterPayment()
    {
        echo 'Payment Has been Received';
    }
}
