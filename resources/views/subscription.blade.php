@extends('layouts.app')
@section('content')

<input id="card-holder-name" type="text">

<!-- Stripe Elements Placeholder -->
<div id="card-element"></div>

<button id="card-button" data-secret="{{ $intent->client_secret }}">
    Update Payment Method
</button>



<script src="https://js.stripe.com/v3/"></script>

<script>
    const stripe = Stripe('pk_test_51Nxsk6CRBUY0dUDKOEkV8tcHs8PDBVGgyV99Q4G5AX54dWokNWgQ18NQsVu9U5U8nZqPnZlwPXho4KP3tOnuMTGH00hiPXgJY3');
    const elements = stripe.elements();
    const cardElement = elements.create('card');

    cardElement.mount('#card-element');
</script>
    <script>
        function doSomething(payment_method) {
            fetch('subscriptions/' + payment_method + '/store', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
            }).then((response) => {
                window.location = "{{ route('payment.done') }}"
            }).catch((error) => {
               console.log(error);
            });
        }
        const cardHolderName = document.getElementById('card-holder-name');
        const cardButton = document.getElementById('card-button');
        const clientSecret = cardButton.dataset.secret;

        cardButton.addEventListener('click', async (e) => {

            // e.preventDefault();

            const { setupIntent, error } = await stripe.confirmCardSetup(
                clientSecret, {
                    payment_method: {
                        card: cardElement,
                        billing_details: { name: cardHolderName.value }
                    }
                }
            );

            if (error) {
                // Display "error.message" to the user...
            } else {
                doSomething(setupIntent.payment_method);
                // The card has been verified successfully...
            }
        });
    </script>
@endsection
