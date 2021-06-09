class shopController {
    constructor() {

        this.$productDetailRow = $('#products');
        this.$detailColumn = [];
        this.$productCategoryRow = $('#productCategoryRow');
        this.$categoryColumn = [];
        this.$productsInCart = $('#productsInCart');


    }

    activateGUI() {
        let self = this;

        self.getCategoryList();


    }

    getCategoryList() {

        $.ajax({
            url: "index.php?action=listTypes",
            type: "json",
            method: "GET"
        })

            .done((data) => {
                this.createProductCategories(data);
                this.$productDetailRow.empty();
            })

    }

    createProductCategories(data) {
        let self = this;
        for (let i in data) {

            this.$categoryColumn[i] = [`<div class="col-sm-12 col-md-6 col-lg-4 productCategories">
                                        <h2 class="categoryName"> ${data[i].name}</h2>
                                        <button class="btn btn-outline-dark productInfoButton" id="${data[i].id}">mehr</button></div>`];


        }


        for (let i in data) {
            this.$productCategoryRow.append(this.$categoryColumn[i]);


        }

        $('#productCategoryRow').on('click', '.productInfoButton', function () {
            self.getProductsByIDList($(this).attr('id')).unbind('click');
        });

    }

    getProductsByIDList(id) {
        console.log(id);

        let self = this;


        $.ajax({
            url: "http://localhost:63355/Uebung3_BEB_ROHL/index.php?action=listProductsByTypeId&typeId=" + id,
            type: "json",
            method: "GET"
        })

            .done((data) => {
                this.createProductListEntries(data);
                this.$productCategoryRow.find('.productCategories').remove();
            })

        $('#products').on('click', '#returnToCategories', function () {
            self.getCategoryList().unbind('click');
        });

        $('#products').on('click', '.toCartButton', function () {
            self.productToCart($(this).attr('id'));


        });
    }

    createProductListEntries(data) {

        for (let i in data) {

            this.$detailColumn[i] = [`<div class="col-sm-12 col-md-6 col-lg-4 productCategories">
                                    <p class="categoryName"> ${data[i].productName}</p>
                                    <img class="productImage" src="assets/images/products/products/${data[i].productId}.png">
                                    <button class="btn btn-success toCartButton" id="${data[i].productId}" data-toggle="modal" data-target="#added">in den Einkaufswagen</button>
                                    </div>`];

        }

        this.$productDetailRow.append(`<div class="col-12 productFamily">
                                        <h1 class="subtitle">${data[1].productTypeName}</h1>
                                      
                                        </div>`);

        let productEntries = data;
        for (let i in productEntries) {
            this.$productDetailRow.append(this.$detailColumn[i]);


        }

        this.$productDetailRow.append('<div class="col-12 backButtonRow">' +
            '<button class="btn btn-danger backButton" id="returnToCategories">Zurück</button>' +
            '</div>');
    }

    productToCart(id) {
        $.ajax({
            url: "http://localhost:63355/Uebung3_BEB_ROHL/index.php?action=addArticle&articleId=" + id,
            type: "json",
            method: "GET"
        })

            .done(() => {
                console.log('success');
            });
    }

    productRemoveFromCart(id) {
        $.ajax({
            url: "http://localhost:63355/Uebung3_BEB_ROHL/index.php?action=removeArticle&articleId=" + id,
            type: "json",
            method: "GET"
        })

            .done(() => {
                console.log('success');
            });
    }

    toCart() {
        let self = this;
        $.ajax({
            url: "http://localhost:63355/Uebung3_BEB_ROHL/index.php?action=listCart",
            type: "json",
            method: "get",
        })

            .done((data) => {
                console.log(data['cart']);
                this.showCart(data['cart']);
            })

        $('#productsInCart').on('click', '.addToCart', function () {
            self.productToCart($(this).attr('id'));
            $('#productsInCart').empty();
            self.toCart();
            self.productToCart($(this)).unbind('click');
        });

        $('#productsInCart').on('click', '.removeFromCart', function () {
            self.productRemoveFromCart($(this).attr('id'));
            $('#productsInCart').empty();
            self.toCart();
            self.productToCart($(this)).unbind('click');
        });
    }

    showCart(data) {
        let $priceAllproducts = 0;
        for (let i in data) {
            $priceAllproducts = +$priceAllproducts + data[i].amount * data[i].price;

        }
        for (let i in data) {
            let $totalPriceUnrounded = data[i].amount * data[i].price;
            let $totalPrice = $totalPriceUnrounded.toFixed(2);

            this.$detailColumn[i] = [`<div class="col-sm-12 col-md-6 col-lg-4 productCategories">
                                    <p class="categoryName"> ${data[i].articleName}</p>
                                    <img class="productImageInCart" src="assets/images/products/products/${data[i].id}.png">
                                    <p class="amount">Anzahl: ${data[i].amount}</p>
                                    <p class="singlePrice">Einzelpreis: € ${data[i].price}</p>
                                    <p class="totalPrice">Gesamtpreis: € ${$totalPrice}</p>
                                    <button class="btn btn-success addToCart" id="${data[i].id}">&plus;</button>
                                    <button class="btn btn-danger removeFromCart" id="${data[i].id}">&minus;</button>
                                    </div>`];

            this.$productsInCart.append(this.$detailColumn[i]);
        }


        this.$productsInCart.append('<div class="col-12 checkOutButtonRow">' +
            '<button class="btn btn-success checkOutButton">Gesampreis: € ' + $priceAllproducts.toFixed(2) + '<br> <b>Jetzt bezahlen</b></button>' +
            '</div>');


    }
}
