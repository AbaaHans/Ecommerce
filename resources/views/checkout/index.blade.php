@extends('layouts.master')

@section('extra-meta')
  <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('extra-script')
    <script src="https://js.stripe.com/v3/"></script>   
@endsection
@section('content')
    <div class="col-md-12 text-centercl">
        <h1>Page de paiement</h1>    
    </div>    
    <div class="row">
        <div class="col-md-6">
           <form action="{{route ('checkout.store')}}" method="POST"  id="payment-form" class="bg-dark  border mt-4 p-3">
            @csrf
            <div id="card-element">
                <!-- Elements will create input elements here -->
              </div>
              <div id="card-errors" role="alert"></div>
              <button class="btn btn-success mt-4" id="submit">Procéder au paiement ({{getPrice(Cart::total())}}) </button>
           </form>
        </div>
    </div>
@endsection

@section('extra-js')
    <script>
        var stripe = Stripe('pk_test_51I7kTWEvStWm48209wFSkDZMejJLr9a0s1lfWJsNO8CVLoYSeLm2CzZsrEXAP3dPUbIvc7D1Uv4Q6VVs6tLqvxAo00tOCAQ2QG');
        var elements = stripe.elements();
        var style = {
            base: {
              color: "#32325d",
              fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
              fontSmoothing: "antialiased",
              fontSize: "16px",
              "::placeholder": {
                color: "#aab7c4"
              }
            },
            invalid: {
              color: "#fa755a",
              iconColor: "#fa755a"
            }
          };
        var card = elements.create("card", { style: style });
        card.mount("#card-element");
        card.on('change', ({error}) => {
            let displayError = document.getElementById('card-errors');
            if (error) {
              displayError.classList.add('alert' ,'alert-warning');  
              displayError.textContent = error.message;
            } else {
              displayError.classList.remove('alert' ,'alert-warning');  
              displayError.textContent = '';
            }
          });
          var form = document.getElementById('submit');

          form.addEventListener('click', function(ev) {
            ev.preventDefault();
            
            stripe.confirmCardPayment("{{ $clientSecret }}", {
              payment_method: {
                card: card
              }
            }).then(function(result) {
              if (result.error) {
                // Show error to your customer (e.g., insufficient funds)
                submitButton.desabled = false;
                console.log(result.error.message);
              } else {
                // The payment has been processed!
                if (result.paymentIntent.status === 'succeeded') {
                  var paymentIntent = result.paymentIntent;
                  var form  = document.getElementById('payment-form');
                  var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                  var url = form.action;
                  var redirect = '/merci';

                  fetch(
                    url,
                    {
                      headers:{
                        "Content-Type" :"application/json",
                        "Accept": "application/json, text-align, */*",
                        "X-Requested-With": "XMLHttpRequest",
                        "X-CSRF-TOKEN" : token
                      },
                      method:'post',
                      body: JSON.stringify({
                        paymentIntent: paymentIntent
                      })                    }
                  ).then((data) =>{
                    console.log(data)
                    window.location.href = redirect
                  }).catch( (error) =>{
                    console.log(error)
                  })
                }
              }
            });
          });
</script>
@endsection