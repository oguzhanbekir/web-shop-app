<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="css/all.min.css"/>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="css/main.css"/>

    <title>Sanal Market</title>
  </head>
  <body>

      <?php include 'header.php' ?>

<div class="container mt-4 mb-4">
  <div class="row">

        <div class="col-md-4 order-md-2 mb-4">
          <div id="shop_logo" class="justify-content-between"></div>
          <h4 class="d-flex justify-content-between align-items-center mb-3">
            <span class="text-muted">Sepetim</span>
            <span class="badge badge-secondary badge-pill" id="amount_product">0</span>
          </h4>
         <ul class="list-group" >
             <div id="cart_data" class="table-wrapper-scroll-y" style="display: block; max-height: 300px;  overflow-y: auto; -ms-overflow-style: -ms-autohiding-scrollbar;">

             </div>
          </ul>
          <ul class="list-group mb-3" >
            <li class="list-group-item d-flex justify-content-between">
              <span>Toplam</span>
              <strong id="total">₺0</strong>
            </li>
          </ul>
          <form class="card p-2">
            <div class="input-group">
              <input type="text" class="form-control" placeholder="Promosyon Kodu">
              <div class="input-group-append">
                <button type="submit" class="btn btn-secondary">Uygula</button>
              </div>
            </div>
          </form>
        </div>

        <div class="col-md-8 order-md-1 ">

          <div class="top_body">
            <div class="bg-dark text-light p-2">
                <i class="fas fa-home"> </i> <span id="addressName"></span>
            </div>
            <div class="bg-white text-dark p-2" style="height: 100px;">
            <div class="d-block my-3" id="radio_address">
              <div class="custom-control custom-radio">
                <input id="address_id" name="username" type="radio" class="custom-control-input" checked required>
                <label id="address_description" class="custom-control-label" for="address_id"></label>
              </div>
            </div>
            </div>
          </div>
          <div id="newAddress">
            <p id="city"></p>
            <p id="district"></p>
            <p id="neighborhood"></p>
            <label for="address">Adres:</label>
            <textarea class="form-control" rows="3" id="address"></textarea><br />
            <label>Adres Açıklaması Ekleyiniz</label>
            <input type="text" class="form-control" id="newaddress_description" placeholder="İsteğe Bağlı" required><br />
            <button class="btn btn-primary btn-lg btn-block w-25" type="submit" id="newAddress_submit">Adresi Kaydet</button>
          </diV>

            <hr class="mb-4">
            <form id="last_checkout">
              <h4 class="mb-3">Kapıda Ödeme</h4>

              <div class="d-block my-3" id="radio_payment">
                <div class="custom-control custom-radio">
                  <input id="credit" name="paymentMethod" type="radio" class="custom-control-input" value="0" checked required>
                  <label class="custom-control-label" for="credit">Kredi Kartı</label>
                </div>
                <div class="custom-control custom-radio">
                  <input id="cash" name="paymentMethod" type="radio" class="custom-control-input"  value="1" required>
                  <label class="custom-control-label" for="cash">Nakit</label>
                </div>
              </div>


              <hr class="mb-4">

              <button class="btn btn-primary btn-lg btn-block" type="submit" >Alışverişi Tamamla</button>
            </form>
        </div>
      </div>

</div>

  <?php include 'footer.php' ?>


         <div class="modal" id="successModal" tabindex="-1" role="dialog">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Sipariş Durumu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <img src="images/success.png" width="100">
                Siparişiniz bize ulaşmıştır. Teşekkür ederiz.
              </div>
            </div>
          </div>
        </div>


  </body>
  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/main.js"></script>
  <script>
        $(document).ready(function(){
              var sayac_product=0;
              var market = $.parseJSON(localStorage.getItem('Market'));
              var totalPrice = $.parseJSON(localStorage.getItem('TotalPrice'));
                $.getJSON("http://localhost:3000/shopUnitstocks/?shopUnit="+market.shoppingcart.marketName,function(d){
                  var products = $.parseJSON(localStorage.getItem('Products'));
                  var sayac=[];
                  $.each(d.shopUnitStocks, function(k,v){
                    var shopUnit_id= v.shopUnit;

                    $.getJSON("http://localhost:3000/shopUnits/"+shopUnit_id, function(data) {
                      var shopid = `${data.shopUnit.shop}`
                      dataReady(shopid);
                      });
                      function dataReady(shopid){
                      $.getJSON("http://localhost:3000/shops/"+shopid,function(data){
                            var shop_data='<img src="http://localhost:3000/'+`${data.shop.logo}`+'" width="75" height="75"><p>'+`${data.shop.name}`+'</p>';

                            $('#shop_logo').html(shop_data);
                              });
                      };
                    var shopUnit_id= v.shopUnit;
                    for(var i=0;i<products.length;i++){
                      if(v.product==products[i].product._id){
                        var cart_data='';
                        sayac.push(products[i].product._id);
                        sayac.push(products[i].product.amount);
                        sayac.push(v.price);
                        sayac.push(products[i].product.productImage);
                        sayac.push(products[i].product.name);

                        localStorage.setItem('NewProduct', JSON.stringify(sayac));
                          cart_data +='<li class="list-group-item d-flex bd-highlight lh-condensed">';
                            cart_data += '<img src="http://localhost:3000/'+products[i].product.productImage+'" width="50px" height="50px">';
                            cart_data += '<div class="ml-2">';
                              cart_data += '<h6 class="my-0">'+products[i].product.name+'</h6>';
                              cart_data += '<small>Birim Fiyat '+currency_format(v.price,'₺')+'<br> Adet '+products[i].product.amount+'</small>';
                            cart_data +='</div>';
                            cart_data +='<span class="text-muted ml-auto p-2 bd-highlight">'+currency_format(v.price*products[i].product.amount,'₺')+'</span>';
                          cart_data +='</li>';

                            $("#cart_data").append(cart_data);
                            sayac_product++;
                      }

                    }

                });
                $('#amount_product').text(sayac_product);
        });
        function currency_format(n, currency) {
          return currency + n.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, '$1,');
        }

        $('#total').text(currency_format(totalPrice.shoppingcart.totalPrice,'₺'));

        function parseJwt_userId (token) {
              var base64Url = token.split('.')[1];
              var base64 = base64Url.replace(/-/g, '+').replace(/_/g, '/');
              var deneme=JSON.parse(window.atob(base64));
              return deneme.userId;
        };

        var token=localStorage.getItem('Token');

        if (token == null) {
          location.href="login.php";
          alert("Lütfen Önce Giriş Yapınız")
        } else {
          var userId = parseJwt_userId(token);

          var userAddressId = $.parseJSON(localStorage.getItem('addressId'));
          if(userAddressId.city !=null){
            $('.top_body').addClass('d-none');
            $.getJSON("http://localhost:3000/cities/"+userAddressId.city, function (data) {
              $('#city').append("İl : "+ data.city.name);
            });
            $.getJSON("http://localhost:3000/districts/"+userAddressId.district, function (data) {
              $('#district').append("İlçe : "+ data.district.name);
            });
            $.getJSON("http://localhost:3000/neighborhoods/"+userAddressId.neighborhood, function (data) {
              $('#neighborhood').append("Mahalle : "+ data.Neighborhood.name);
            });
             $("#newAddress_submit").click(function(e){
                if($("#newaddress_description").val()!='' && $("#address").val()!=''){
                  $.ajax({
                  url: "http://localhost:3000/addresses",
                  type: "POST",
                  async:false,
                  data: {
                      city: userAddressId.city,
                      district: userAddressId.district,
                      neighborhood: userAddressId.neighborhood,
                      description: $("#address").val()
                  },
                  dataType: "JSON",
                  success: function (jsonStr) {
                     var user_address=jsonStr.createdAddress._id;
                     $.ajax({
                     url: "http://localhost:3000/userAddresses",
                     async:false,
                     type: "POST",
                     data: {
                         user: userId,
                         address: user_address,
                         name: $('#newaddress_description').val()
                     },
                     dataType: "JSON",
                     success: function (jsonStr) {

                       alert("Adres Eklendi");
                     },
                     error: function (xhr, status, error) {
                         alert("Adres Eklenemedi");
                     }
                   });
                  },
                  error: function (xhr, status, error) {
                      alert("Lütfen Tüm Alanları Doldurun");
                  }
                  });
                } else {
                    alert("Lütfen Tüm Alanları Doldurun");
                }



             });

          } else{
              $('#newAddress').addClass('d-none');
            $.getJSON("http://localhost:3000/userAddresses/"+userAddressId.addressId, function (data) {
              $('#addressName').text(data.userAddress.name);
             $.getJSON("http://localhost:3000/addresses/"+data.userAddress.address, function (d) {

                  $('#address_description').text(d.address.description);
                  $('#address_id').attr('value', d.address._id);

                });
              });
          }


          $('#last_checkout').submit(function(e){
            e.preventDefault();
            var market = $.parseJSON(localStorage.getItem('Market'));
            var totalPrice = $.parseJSON(localStorage.getItem('TotalPrice'));
            var address = $('#radio_address input:radio:checked').val();

          //    if($("#address").val()!='' && address!='' ){
                if(userAddressId.city !=null){
                  $.ajax({
                  url: "http://localhost:3000/addresses",
                  type: "POST",
                  async:false,
                  data: {
                      city: userAddressId.city,
                      district: userAddressId.district,
                      neighborhood: userAddressId.neighborhood,
                      description: $("#address").val()
                  },
                  dataType: "JSON",
                  success: function (jsonStr) {
                      var user_address=jsonStr.createdAddress._id;
                      $.getJSON("http://localhost:3000/shopUnitStocks/?shopUnit="+market.shoppingcart.marketName,function(data){
                      var myOneItem = data.shopUnitStocks[0];

                        $.getJSON("http://localhost:3000/shopUnits/"+myOneItem.shopUnit,function(data){
                          var min_order=`${data.shopUnit.min_order}`;
                          if(totalPrice.shoppingcart.totalPrice>=min_order){
                            var token=localStorage.getItem('Token');
                            parseJwt (token);

                            function parseJwt (token) {
                              var base64Url = token.split('.')[1];
                              var base64 = base64Url.replace(/-/g, '+').replace(/_/g, '/');
                              var user=JSON.parse(window.atob(base64));

                              $.ajax({
                                url: "http://localhost:3000/orders",
                                type: "POST",
                                async:false,
                                data: {
                                    shopUnit: myOneItem.shopUnit,
                                    guid: "100",
                                    user: user.userId,
                                    total_amount: totalPrice.shoppingcart.totalPrice,
                                    payment_type:$('#radio_payment input:radio:checked').val(),
                                    address: user_address,
                                    order_status:"0",
                                    order_active:"0"
                                },
                                dataType:"JSON",
                                success: function (jsonStr) {
                                  $("body").append('<div id="container-result"><div id="content-result"><img src="images/spinner.gif"></div></div>');
                                  setTimeout(function(){  $("div").remove("#container-result");
                                   $('#successModal').modal('show');

                                 }, 1000);

                                  var orderId=`${jsonStr.createdOrder._id}`;
                                  products_amount = $.parseJSON(localStorage.getItem("NewProduct"));
                                  for(var i=0;i<products_amount.length;i+=5){
                                    $.ajax({
                                       url: "http://localhost:3000/orderDetails",
                                       type: "POST",
                                       async:false,
                                       data: {
                                           order: orderId,
                                           product: products_amount[i],
                                           quantity: products_amount[i+1],
                                           amount: products_amount[i+2]
                                       },
                                       dataType:"JSON",
                                       success: function (jsonStr) {

                                       }
                                     });
                                  }
                                }
                              });
                          };
                        } else {
                          alert("Alışveriş Yaptığınız Marketin Servis İçin Mininum Tutar "+min_order);
                        }
                      });
                    });
                  },
                  error: function (xhr, status, error) {
                  //    alert("Lütfen Tüm Alanları Doldurun");
                  }
                  });
                } else {
                  $.getJSON("http://localhost:3000/shopUnitStocks/?shopUnit="+market.shoppingcart.marketName,function(data){
                  var myOneItem = data.shopUnitStocks[0];
                    $.getJSON("http://localhost:3000/shopUnits/"+myOneItem.shopUnit,function(data){
                      var min_order=`${data.shopUnit.min_order}`;
                      if(totalPrice.shoppingcart.totalPrice>=min_order){
                        var token=localStorage.getItem('Token');
                        parseJwt (token);
                    function parseJwt (token) {
                          var base64Url = token.split('.')[1];
                          var base64 = base64Url.replace(/-/g, '+').replace(/_/g, '/');
                          var user=JSON.parse(window.atob(base64));
                          $.ajax({
                            url: "http://localhost:3000/orders",
                            type: "POST",
                            async:false,
                            data: {
                                shopUnit: myOneItem.shopUnit,
                                guid: "100",
                                user: user.userId,
                                total_amount: totalPrice.shoppingcart.totalPrice,
                                payment_type:$('#radio_payment input:radio:checked').val(),
                                address: $('#radio_address input:radio:checked').val(),
                                order_status:"0",
                                order_active:"0"
                            },
                            dataType:"JSON",
                            success: function (jsonStr) {
                              $("body").append('<div id="container-result"><div id="content-result"><img src="images/spinner.gif"></div></div>');
                              setTimeout(function(){  $("div").remove("#container-result");
                               $('#successModal').modal('show');

                              }, 1000);

                              var orderId=`${jsonStr.createdOrder._id}`;
                              products_amount = $.parseJSON(localStorage.getItem("NewProduct"));
                              for(var i=0;i<products_amount.length;i+=5){
                                $.ajax({
                                   url: "http://localhost:3000/orderDetails",
                                   type: "POST",
                                   async:false,
                                   data: {
                                       order: orderId,
                                       product: products_amount[i],
                                       quantity: products_amount[i+1],
                                       amount: products_amount[i+2]
                                   },
                                   dataType:"JSON",
                                   success: function (jsonStr) {

                                   }
                                 });
                              }
                            }
                          });
                      };
                    } else {
                      alert("Alışveriş Yaptığınız Marketin Servis İçin Mininum Tutar "+min_order);
                    }
                  });
                });
                }
          /*    } else {
                alert("Lütfen Adres Alanını Doldurun");
              }*/

            });
        }




});


  </script>
</html>
