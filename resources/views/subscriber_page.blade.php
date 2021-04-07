@extends('layouts.frontend.app')

@section('title','Subscribe')

@push('css')
    <link href="{{ asset('assets/frontend/css/home/styles.css')}}" rel="stylesheet">

	<link href="{{ asset('assets/frontend/css/home/responsive.css')}}" rel="stylesheet">
	<link href="{{ asset('assets/frontend/css/home/iblog.css')}}" rel="stylesheet">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<style>
.card-body{width:450px;height:auto;background:rgba(0,0,0,0.2);border-radius:0px;}
.card-body>h4{color:black;}
.card-deck{margin-top:30px;margin-bottom:30px;}


</style>
@endpush

@section('content')
    @php
        $stripe_key = 'pk_test_51Id5N7LalF3Lv2yPFRuAoJFdMgiuZU9QOYt58F4tpgb4NzWqskFR6OYGpvdSKyQlWaceEGRXg8wLfqvDTKbLH39P00pvE7jVa9';
    @endphp
        <div class="container">
    <div class="card-deck">
   <div  >
  <div class="card-body">
    <h4 class="card-title">Free</h4>
    <div class="input-area">
              <form method="POST" action ="{{ route('subscriber.store')}}" >
              @csrf
                <input class="email-input" name ="email" type="email" placeholder="Enter your email" style="height:50px;">
                <button class="submit-btn" type="submit"><i class="icon ion-ios-email-outline"></i></button>
              </form>
            </div>
  </div>
</div>
<div >
  <div class="card-body">
    <h4 class="card-title">Premium</h4>
    <p>You will be charged $10</p>
    <form action="{{route('subscriber_page.checkout')}}"  method="post" id="payment-form">
                        @csrf                    
                        <div class="form-group">
                            
                                <input class="email-input" name ="email" type="email" placeholder="Enter your email" style="height:50px;">
                            <div class="card-body">
                                <div id="card-element">
                                <!-- A Stripe Element will be inserted here. -->
                                </div>
                                <!-- Used to display form errors. -->
                                <div id="card-errors" role="alert"></div>
                                <input type="hidden" name="plan" value="" />
                            </div>
                        </div>
                        <div class="card-footer">
                          <button
                          id="card-button"
                          class="btn btn-dark"
                          type="submit"
                          data-secret="{{ $intent }}"
                        > Pay </button>
                        </div>
                    </form>
  </div>
</div>
</div>
</div>
@endsection

@push('js')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
 <script src="https://js.stripe.com/v3/"></script>
    <script>
        // Custom styling can be passed to options when creating an Element.
        // (Note that this demo uses a wider set of styles than the guide below.)

        var style = {
            base: {
                color: '#32325d',
                lineHeight: '18px',
                fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                fontSmoothing: 'antialiased',
                fontSize: '16px',
                '::placeholder': {
                    color: '#aab7c4'
                }
            },
            invalid: {
                color: '#fa755a',
                iconColor: '#fa755a'
            }
        };
    
        const stripe = Stripe('{{ $stripe_key }}', { locale: 'en' }); // Create a Stripe client.
        const elements = stripe.elements(); // Create an instance of Elements.
        const cardElement = elements.create('card', { style: style }); // Create an instance of the card Element.
        const cardButton = document.getElementById('card-button');
        const clientSecret = cardButton.dataset.secret;
    
        cardElement.mount('#card-element'); // Add an instance of the card Element into the `card-element` <div>.
    
        // Handle real-time validation errors from the card Element.
        cardElement.addEventListener('change', function(event) {
            var displayError = document.getElementById('card-errors');
            if (event.error) {
                displayError.textContent = event.error.message;
            } else {
                displayError.textContent = '';
            }
        });
    
        // Handle form submission.
        var form = document.getElementById('payment-form');
    
        form.addEventListener('submit', function(event) {
            event.preventDefault();
    
        stripe.handleCardPayment(clientSecret, cardElement, {
                payment_method_data: {
                    //billing_details: { name: cardHolderName.value }
                }
            })
            .then(function(result) {
                console.log(result);
                if (result.error) {
                    // Inform the user if there was an error.
                    var errorElement = document.getElementById('card-errors');
                    errorElement.textContent = result.error.message;
                } else {
                    console.log(result);
                    form.submit();
                }
            });
        });
    </script>
@endpush