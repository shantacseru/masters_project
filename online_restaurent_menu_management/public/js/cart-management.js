(function(){
    let cart = getCart();
    let totalItems = 0;
    cart.forEach(item => {
        totalItems += item.amount;
    });
    document.getElementById("number-of-item").innerHTML = totalItems;
     
})();

function addToCart(id, price){

    this.event.preventDefault();
    document.getElementById("number-of-item").innerHTML  =  parseInt(  document.getElementById("number-of-item").innerHTML.trim() ) + 1 ;

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

    let isFound = false;
    for(let i=0, n = cart.length; i < n; i++){

        if(cart[i].id == id){
            cart[i].amount++;
            isFound = true;
            break;
        }
    }

    if(!isFound){

        cart.push({
            "id": id,
            "amount": 1,
            "unit_price": price
        });
    }

    // console.log(JSON.stringify(cart, null, 2));
    localStorage.setItem('cart', JSON.stringify(cart));
    // console.log('Ok');
}


function showCart(){
    this.event.preventDefault();
     let cart = localStorage.getItem('cart');
     let href = document.getElementById('cart').getAttribute('href');
     if(cart == null){
         cart = "[]";
     }

     window.location.href = href + "?cart="+cart;

}

function preventInput() {
    this.value = Math.abs(this.value) == 0 ? 1 : Math.abs(this.value);
    
    return false;
}

function updateCart(id){
    let amount = Math.abs(this.event.target.value), prevAmount;
     
    let cart = getCart(); 
    cart.forEach(item => {
        if(item.id == id) {
            prevAmount = item.amount;
            item.amount = amount;
        }
    });
    
    localStorage.setItem('cart', JSON.stringify(cart) );
    document.getElementById("number-of-item").innerHTML  =  parseInt(  document.getElementById("number-of-item").innerHTML.trim() ) + amount - prevAmount ;
    updateTotalAmountOfCart();

}

function calculateCartTotal(){

    let cart = getCart();
    let totalPayable = 0;
    
    console.log(JSON.stringify(cart, null, 2));
    cart.forEach(item => {
        totalPayable += item.amount*item.unit_price;
    });

    return totalPayable;
}


function updateTotalAmountOfCart() {

    let total = calculateCartTotal();

    document.getElementById('totalAmount').innerHTML = total;
}

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

function updateCartItemNumber(){
    let cart = getCart();

    let numberOfItems = 0 ;
    cart.forEach(item => {

         numberOfItems += item.amount;
        
    });

    document.getElementById("number-of-item").innerHTML = numberOfItems;
}

function deleteFromCart(id){

    let cart = getCart();

    
    $("div#" + id).hide();
    let updatedCart = [];
    cart.forEach(item => {

        if(item.id != id) {

            updatedCart.push(item);
        } 
    });

    if(updatedCart.length <= 0){
        $('#orderBtn').attr("disabled","disabled");
    }
    localStorage.setItem('cart', JSON.stringify(updatedCart) );
    updateTotalAmountOfCart();
    updateCartItemNumber();

}