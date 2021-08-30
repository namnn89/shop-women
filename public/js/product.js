$( document ).ready(function() {
    let number = 1;
    const price = $('#product_price').val();
    const productId = $("#product_id").val();

    // generate amount detail
    function generateAmount(number, amount) {
        $('#delivery').html(number);
        $('#amount').html(amount);
    }

    // generate Cart detail
    function generateCart() {
        let storage = JSON.parse(localStorage.getItem("cart"));
        let totalNumberCart = 0;
        let totalAmountCart = 0;
        if (storage) {
            for (let i=0; i < storage.length; i++) {
                if (storage[i].product === productId) {
                    generateAmount(storage[i].number, price * storage[i].number);
                    number = storage[i].number;
                }
                totalNumberCart += 1;
                totalAmountCart += storage[i].price * storage[i].number;
            }

            if (totalNumberCart > 0) {
                if (totalNumberCart === 1) {
                    $('.totalNumber').html("1 article");
                } else {
                    $('.totalNumber').html(totalNumberCart + " articles");
                }
                $('.totalPrice').html(totalAmountCart);
            }
        }
    }

    // Image gallery thumbnail
    $(document).on('click', '.preview-thumbnail li', function(event) {
        if (!$(this).hasClass('active')) {
            $('.preview-thumbnail li.active').removeClass('active');
            $(this).addClass('active');
            const target = $(this).find('a').attr("data-target");
            $('.preview-pic .active').removeClass('active');
            $(target).addClass('active');
        }
    });

    // add to cart event click: calculate cart
    $(document).on('click', '.add-to-cart', function(event) {
        let storage = JSON.parse(localStorage.getItem("cart"));

        if (!storage) {
            storage = [];
        }

        let product = null;

        for(let i=0; i < storage.length; i++) {
            // update storage if product existed
            if (storage[i].product === productId) {
                product = storage[i];
                product.number = number;
                storage[i] = product
            }
        }
        // Create an object to store if product not existed
        if (!product) {
            product = {product:productId, price: price, number: number};
            storage.push(product);
        }

        // Store it.
        localStorage.setItem("cart",JSON.stringify(storage));
        generateCart();
        alert('save cart to success');
        window.location.href = '/'
    });

    // delivery number product
    $(document).on('click', '.productAdd', function(event) {
        number += 1;
        generateAmount(number, number * price);
    });

    // reduce number product
    $(document).on('click', '.productReduce', function(event) {
        if (number === 1) {
            return;
        }
        number -= 1;
        generateAmount(number, number * price);
    });

    generateCart();
});

