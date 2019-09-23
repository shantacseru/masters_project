 
 window.onload =   function(){
        let cart = getCart();
        console.log('Len' + cart.length);
        if(cart.length <= 0 ){
            window.history.back();
        }
    };
 

function getCart(){
    let cart = localStorage.getItem('cart');

    if(cart == null) {

        cart = [];
        

    } else {

        try {

            cart = JSON.parse(cart);

        } catch (error) {

            cart = [];

        }
    }

    return cart;
}

function confirmOrder(){

    this.event.preventDefault();

    let cart = getCart();
    let formData = $('#orderForm').serializeArray();
    let token = $('[name=_token]').val(); 
    console.log(JSON.stringify(cart, null, 2));
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    let user_id = $('[name=userId]').val();
     $.ajax({
        type: 'POST',  
        url: "http://localhost:8000/confirm-order",
        data: {cart: cart, form: formData, userId: user_id}, 
        success: function(resultData) { 
            console.log(resultData);
            localStorage.clear();
            let link = 'http://localhost:8000/';
            $("#order_ajax_response").val('success');
            $('#number-of-item').html('0');
            $('#orderMessage').addClass('alert alert-success');
            $('#orderMessage').html('Order successful ! To do more order : <a  class="info" href ="'+ link +'">Click here</a>');
            $('#confirm-order').attr("disabled", true);
            $('#orderForm').trigger("reset");
            swal("Good job!", "Your order is confirmed.", "success");
            
         },
         error: (error)=>{
            
            console.log(error);
            $("#order_ajax_response").val('error');
            $('#orderMessage').addClass('alert alert-danger');
            $('#orderMessage').html('Something wrong , try again !');
            
         }
  });
}