<x-app-layout>
            <!-- Display a payment form -->
<x-slot name="header">
<h2 class="font-semibold text-xl text-gray-800 leading-tight">
{{'Subscribe'}}
</h2>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form action="{{route('monthly.subscription')}}" id="payment-form" method="post">
                        @csrf
                        <label for="standard">5£ a month</label>
                        <input type="radio" name="plane" id="standard" value="price_1NxslbCRBUY0dUDKDpyEwmw6" checked><br>

                        <label for="cardholder_name">Card Holder Name</label>
                        <input type="text" name="cardholder_name">
                        <div id="link-authentication-element">
                            <!--Stripe.js injects the Link Authentication Element-->
                        </div>
                        <div id="payment-element">
                            <!--Stripe.js injects the Payment Element-->
                        </div>
                        <button id="submit" data-secret="{{ $intent->client_secret }}">
                            <div class="spinner hidden" id="spinner"></div>
                            <span id="button-text">Pay Now</span>
                        </button>
                        <div id="payment-message" class="hidden"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-slot>

    @push('scripts')
        <script src="https://js.stripe.com/v3/"></script>

        <script>
            // This is your test publishable API key.
            const stripe = Stripe("pk_test_51Nxsk6CRBUY0dUDKOEkV8tcHs8PDBVGgyV99Q4G5AX54dWokNWgQ18NQsVu9U5U8nZqPnZlwPXho4KP3tOnuMTGH00hiPXgJY3");

            // The items the customer wants to buy
            const items = [{ id: "xl-tshirt" }];

            let elements;
            // const elements = stripe.elements();
            // const cardElement = elements.create('card');
            //
            // cardElement.mount('#card-element');

            initialize();
            checkStatus();
            
            document
                .querySelector("#payment-form")
                .addEventListener("submit", handleSubmit);

            let emailAddress = '';
            // Fetches a payment intent and captures the client secret
            async function initialize() {
                const { clientSecret } = await fetch("/create-payment-intent?price=500", {
                    method: "POST",
                    headers: { "Content-Type": "application/json" },
                    body: JSON.stringify({ items }),
                }).then((r) => r.json());

                elements = stripe.elements({ clientSecret });

                const linkAuthenticationElement = elements.create("linkAuthentication");
                linkAuthenticationElement.mount("#link-authentication-element");

                const paymentElementOptions = {
                    layout: "tabs",
                };

                const paymentElement = elements.create("payment", paymentElementOptions);
                paymentElement.mount("#payment-element");
            }
            // const cardHolderName = document.getElementById('card-holder-name');
            // const cardButton = document.getElementById('card-button');
            // const clientSecret = cardButton.dataset.secret;
            //
            // cardButton.addEventListener('click', async (e) => {
            //     const { setupIntent, error } = await stripe.confirmCardSetup(
            //         clientSecret, {
            //             payment_method: {
            //                 card: cardElement,
            //                 billing_details: { name: cardHolderName.value }
            //             }
            //         }
            //     );
            //
            //     if (error) {
            //         showMessage('Error Occurred');
            //     } else {
            //         showMessage('Verified Successfully');
            //         // The card has been verified successfully...
            //     }
            // });

            async function handleSubmit(e) {
                e.preventDefault();
                setLoading(true);
                const { error } = await stripe.confirmPayment({
                    elements,
                    confirmParams: {
                        // Make sure to change this to your payment completion page
                        return_url: "{{ route('monthly.subscription') }}",
                        receipt_email: emailAddress,
                    },
                });

                // This point will only be reached if there is an immediate error when
                // confirming the payment. Otherwise, your customer will be redirected to
                // your `return_url`. For some payment methods like iDEAL, your customer will
                // be redirected to an intermediate site first to authorize the payment, then
                // redirected to the `return_url`.
                if (error.type === "card_error" || error.type === "validation_error") {
                    showMessage(error.message);
                } else {
                    showMessage("An unexpected error occurred.");
                }

                setLoading(false);
            }

            // Fetches the payment intent status after payment submission
            async function checkStatus() {
                console.log(22)

                const clientSecret = new URLSearchParams(window.location.search).get(
                    "payment_intent_client_secret"
                );

                if (!clientSecret) {
                    return;
                }

                const { paymentIntent } = await stripe.retrievePaymentIntent(clientSecret);
  console.log(paymentIntent)

                switch (paymentIntent.status) {
                    case "succeeded":
                        showMessage("Payment succeeded!");
                        break;
                    case "processing":
                        showMessage("Your payment is processing.");
                        break;
                    case "requires_payment_method":
                        showMessage("Your payment was not successful, please try again.");
                        break;
                    default:
                        showMessage("Something went wrong.");
                        break;
                }
            }

            function request() {
                console.log(123)
                fetch('monthly/subscription', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                });
            }
            // ------- UI helpers -------

            function showMessage(messageText) {
                const messageContainer = document.querySelector("#payment-message");

                messageContainer.classList.remove("hidden");
                messageContainer.textContent = messageText;

                setTimeout(function () {
                    messageContainer.classList.add("hidden");
                    messageContainer.textContent = "";
                }, 4000);
            }

            // Show a spinner on payment submission
            function setLoading(isLoading) {
                if (isLoading) {
                    // Disable the button and show a spinner
                    document.querySelector("#submit").disabled = true;
                    document.querySelector("#spinner").classList.remove("hidden");
                    document.querySelector("#button-text").classList.add("hidden");
                } else {
                    document.querySelector("#submit").disabled = false;
                    document.querySelector("#spinner").classList.add("hidden");
                    document.querySelector("#button-text").classList.remove("hidden");
                }
            }
        </script>
    @endpush
</x-app-layout>
