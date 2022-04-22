@extends('layouts.app')
@section('content')
<div id="paypal-button"></div>
@endsection

@section('scripts')

<script src="https://www.paypalobjects.com/api/checkout.js"></script>
<script>
  paypal.Button.render({
    // Configure environment
    env: 'sandbox',
    client: {
      sandbox: 'AdNCAZ1wmdI2Iu77PxL2-dwwNo8Zo7P4wPDdOmydJF83VYf8_iJAYg_2FFKtJbKYqb_St-1TCAwyR365',
      production: 'demo_production_client_id'
    },
    // Customize button (optional)
    locale: 'en_US',
    style: {
      size: 'large',
      color: 'gold',
      shape: 'pill',
    },

    // Enable Pay Now checkout flow (optional)
    commit: true,

    // Set up a payment
    payment: function(data, actions) {
      return actions.payment.create({
        transactions: [{
          amount: {
            total: '0.02',
            currency: 'USD'
          }
        }]
      });
    },
    // Execute the payment
    onAuthorize: function(data, actions) {
      return actions.payment.execute().then(function() {
        // Show a confirmation message to the buyer
        window.alert('Cảm ơn bạn đã mua hàng chúng tôi!');
      });
    }
  }, '#paypal-button');

</script>
@endsection
