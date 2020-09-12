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



<div class="container">
    <h4 class="mt-3 b">SEPETİM</h4>
    <ul class="nav nav-tabs" id="myTab" role="tablist">

    </ul>
  <div class="tab-content" id="myTabContent">



  </div>

</div>

        <?php include 'footer.php' ?>

        <div class="modal" id="changeAddress_modal" tabindex="-1" role="dialog">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Hangi Adresiniz için sipariş vermek istiyorsunuz?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form method="post">
                  <div class="form-group">
                    <label for="updateaddress_name">Adresi Seçiniz</label>
                      <select class="form-control" id="changeAddress_name">
                      </select>
                  </div>
                </form>

                <div class="form-group row" id="address_select">

                </div>
              </div>

              <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="changeAddress_submit">Kaydet</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
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

    var token = $.parseJSON(localStorage.getItem('Token'));
    function parseJwt_userId (token) {
          var base64Url = token.split('.')[1];
          var base64 = base64Url.replace(/-/g, '+').replace(/_/g, '/');
          var deneme=JSON.parse(window.atob(base64));
          return deneme.userId;
    };
      if (token == null ) {
          location.href="login.php";
          alert("Lütfen Önce Giriş Yapınız")

          return;
      }else{
          var userId = parseJwt_userId(token);

          var changeAddress='';
          changeAddress = '<a class="text-white btn btn-secondary btn-md" data-toggle="modal" data-target="#changeAddress_modal" role="button"><i class="fas fa-location-arrow"></i>&nbspAdres Değiştir</a>';
          $('#changeAddress').append(changeAddress);
          let dropdown_changeAddress_name = $('#changeAddress_name');
          dropdown_changeAddress_name.empty();
          dropdown_changeAddress_name.append('<option selected="true" disabled>Adresinizi Seçiniz</option>');
          dropdown_changeAddress_name.prop('selectedIndex', 0);
          $.getJSON("http://localhost:3000/useraddresses?user="+userId,function(data){
              $.each(data.UserAddresses, function(k,v){
                      dropdown_changeAddress_name.append($('<option></option>').attr('value', v._id).text(v.name));
              });

                dropdown_changeAddress_name.append($('<option>Farklı Bir Adres Girin</option>').attr('data-id', "newAddress"));

              $('#changeAddress_submit').trigger( "click" );
            });

            $("#changeAddress_name").change(function(){
                if($("#changeAddress_name").find(':selected').attr('data-id')=="newAddress"){
                  var newAddress='';
                  newAddress += '<br /><div class="col"><select name="city" class="form-control" id="address_city"></select></div><div class="col"><select name="district" class="form-control" id="address_district"></select></div><div class="col"><select name="neighborhood" class="form-control" id="address_neighborhood"></select></div>'
                  $('#address_select').html(newAddress);
                  let dropdown_neighborhood = $('#address_neighborhood');
                  let dropdown_city = $('#address_city');
                  dropdown_city.empty();
                  dropdown_city.append('<option selected="true" disabled>Şehir Seçiniz</option>');
                  dropdown_city.prop('selectedIndex', 0);
                  $.getJSON("http://localhost:3000/cities", function (data) {
                    $.each(data.city, function (key, entry) {
                        dropdown_city.append($('<option></option>').val(entry._id).text(entry.name).attr('data-id', entry.code));
                    });
                  });

                    $("#address_city").on('change', function() {
                      var city_code = $('#address_city').find(":selected").attr("data-id");
                      let dropdown_district = $('#address_district');
                      dropdown_district.empty();
                      dropdown_district.append('<option selected="true" disabled>İlçe Seçiniz</option>');
                      dropdown_district.prop('selectedIndex', 0);
                      dropdown_neighborhood.empty();
                      dropdown_neighborhood.append('<option selected="true" disabled>Mahalle Seçiniz</option>');
                      dropdown_neighborhood.prop('selectedIndex', 0);
                      $.getJSON("http://localhost:3000/districts", function (data) {
                        $.each(data.District, function (key, entry) {
                           if(entry.code==city_code)
                            dropdown_district.append($('<option></option>').attr('value', entry._id).text(entry.name));
                        });
                      });
                    });

                    $("#address_district").on('change', function() {
                      var district_code = $(this).val();
                      dropdown_neighborhood.empty();
                      dropdown_neighborhood.append('<option selected="true" disabled>Mahalle Seçiniz</option>');
                      dropdown_neighborhood.prop('selectedIndex', 0);
                      $.getJSON("http://localhost:3000/neighborhoods", function (data) {
                        $.each(data.Neighborhood, function (key, entry) {
                           if(entry.District==district_code)
                            dropdown_neighborhood.append($('<option></option>').attr('value', entry._id).text(entry.name));
                        //    dropdown_changeAddress_name.append($('<option>Farklı Bir</option>').attr('value', entry._id).text(entry.name));
                        });
                      });
                    });
                    $("#address_neighborhood").on('change', function() {
                      var district_code = $(this).val();
                  //    alert(district_code);
                      $('#changeAddress_name').find(":selected").val(district_code).attr('data-id','newAddress');
                    });
                } else {
                    $('#address_select').empty();
                }
            });


              $("#changeAddress_submit").click(function(){

                  $("#changeAddress_name option:eq(1)").attr('selected','selected').val();

                    var address_Id = {addressId:$("#changeAddress_name").val()};
                    localStorage.setItem('addressId', JSON.stringify(address_Id));

                    var address_Id2 = $("#changeAddress_name").find(':selected').attr('data-id');

                    if(address_Id2=="newAddress"){
                        var neighborhood = $("#changeAddress_name").val();
                        if ( $("#address_neighborhood").val() == null) {
                          alert("Lütfen Gerekli Alanları Doldurun");
                        } else {
                          markets = [];
                          $.ajax({
                             url: "http://localhost:3000/shopUnitServiceAddresses?neighborhood="+neighborhood,
                             type: "Get",
                             dataType: "json",
                             headers: {
                                 "accept": "application/json",
                                 "content-type": "application/json",
                                 "authorization": "Bearer "+ token
                                 },
                             success: function (data2) {
                               if(data2.count == 0){
                                 alert("Seçtiğiniz Mahallede Kayıtlı Market Bulunmamaktadır");
                               } else {
                               var tab_menu ='';
                               var myTabContent='';
                               var newAddress = {
                                         city: data2.ShopUnitServiceAddress[0].city,
                                         district: data2.ShopUnitServiceAddress[0].district,
                                         neighborhood: data2.ShopUnitServiceAddress[0].neighborhood
                                 };
                               localStorage.setItem('addressId', JSON.stringify(newAddress));

                               var tab_menu ='';
                               var myTabContent='';
                               $.each(data2.ShopUnitServiceAddress, function (key, entry) {
                                 considerTotalAmount(entry.shopUnit);
                               });

                               markets.sort(function(a, b) {
                                   return ((a.sum < b.sum) ? -1 : ((a.sum == b.sum) ? 0 : 1));
                               });

                               for (var i = 0; i<markets.length; i++) {
                                   $.ajax({
                                   url: "http://localhost:3000/shopUnits/"+markets[i].marketId,
                                   dataType: 'json',
                                   async: false,
                                   type:'GET',
                                   success: function(data) {
                                     var shopUnit_name = data.shopUnit.name;

                                     tab_menu += '<li class="nav-item"><a class="nav-link tab_menu '+markets[i].marketId+'" id="'+markets[i].marketId+'" data-toggle="tab" href="#tab'+markets[i].marketId+'" role="tab" aria-selected="false">'+shopUnit_name+'</a></li>';

                                     myTabContent += '<div class="tab-pane fade show" id="tab'+markets[i].marketId+'" role="tabpanel"><table class="table table-hover table-condensed" style="background-color:#fff"><thead><tr style="border-top:2px solid #fff;"><th style="width:50%">Ürün</th><th style="width:10%">Fiyat</th>	<th style="width:8%">Adet</th><th style="width:22%" class="text-center">Ara Toplam</th><th style="width:10%"></th></tr></thead>';
                                     myTabContent += '<tbody id="a'+markets[i].marketId+'"></tbody><tfoot><tr><td><a href="products.php" class="btn btn-success"><i class="fa fa-angle-left"></i> Alışverişe Devam Et</a></td><td colspan="2" class="hidden-xs"></td>';
                                     myTabContent += '<td class="hidden-xs text-center">Toplam <strong id="sum'+markets[i].marketId+'"></strong></td>';
                                     myTabContent += '<td><a href="checkout.php" class="btn btn-success btn-block">Alışverişi Tamamla <i class="fa fa-angle-right"></i></a></td></tr></tfoot></table></div>';
                                   }
                                 });
                               }

                               $('#myTab').html(tab_menu);
                               $('#myTabContent').html(myTabContent);

                               $(".tab_menu").click(function() {
                               $("#myTabContent table tbody tr").remove();
                                 var marketName=($(this).attr('id'));
                                 get_cart(marketName);
                                         var shoppingcart_info = {
                                               shoppingcart: {
                                                   marketName: marketName,
                                               }
                                           };
                                 localStorage.setItem('Market', JSON.stringify(shoppingcart_info));
                               });
                               $("ul.nav-tabs li:eq(0) a").click();

                               $('#changeAddress_modal').modal('hide');
                             }
                             },
                             error: function (xhr, status, error) {
                                 alert("Token Alınamadı");
                             }
                         });
                        }
                    } else {
                      markets = [];
                      var address_Id = $.parseJSON(localStorage.getItem('addressId'));

                      $.getJSON("http://localhost:3000/userAddresses/"+address_Id.addressId,function(d){
                            $.getJSON("http://localhost:3000/addresses/"+d.userAddress.address, function (d) {
                                var neighborhood =d.address.neighborhood;

                                $.getJSON("http://localhost:3000/shopUnitServiceAddresses?neighborhood="+neighborhood, function (data2) {
                                  var tab_menu ='';
                                  var myTabContent='';
                                  $.each(data2.ShopUnitServiceAddress, function (key, entry) {
                                    considerTotalAmount(entry.shopUnit);
                                  });

                                  markets.sort(function(a, b) {
                                      return ((a.sum < b.sum) ? -1 : ((a.sum == b.sum) ? 0 : 1));
                                  });

                                  for (var i = 0; i<markets.length; i++) {
                                      $.ajax({
                                      url: "http://localhost:3000/shopUnits/"+markets[i].marketId,
                                      dataType: 'json',
                                      async: false,
                                      type:'GET',
                                      success: function(data) {
                                        var shopUnit_name = data.shopUnit.name;

                                        tab_menu += '<li class="nav-item"><a class="nav-link tab_menu '+markets[i].marketId+'" id="'+markets[i].marketId+'" data-toggle="tab" href="#tab'+markets[i].marketId+'" role="tab" aria-selected="false">'+shopUnit_name+'</a></li>';

                                        myTabContent += '<div class="tab-pane fade show" id="tab'+markets[i].marketId+'" role="tabpanel"><table class="table table-hover table-condensed" style="background-color:#fff"><thead><tr style="border-top:2px solid #fff;"><th style="width:50%">Ürün</th><th style="width:10%">Fiyat</th>	<th style="width:8%">Adet</th><th style="width:22%" class="text-center">Ara Toplam</th><th style="width:10%"></th></tr></thead>';
                                        myTabContent += '<tbody id="a'+markets[i].marketId+'"></tbody><tfoot><tr><td><a href="products.php" class="btn btn-success"><i class="fa fa-angle-left"></i> Alışverişe Devam Et</a></td><td colspan="2" class="hidden-xs"></td>';
                                        myTabContent += '<td class="hidden-xs text-center">Toplam <strong id="sum'+markets[i].marketId+'"></strong></td>';
                                        myTabContent += '<td><a href="checkout.php" class="btn btn-success btn-block">Alışverişi Tamamla <i class="fa fa-angle-right"></i></a></td></tr></tfoot></table></div>';
                                      }
                                    });
                                  }


                            //   });


                            /*    $.getJSON("http://localhost:3000/shopUnitServiceAddresses?neighborhood="+neighborhood, function (data2) {
                                  var tab_menu ='';
                                  var myTabContent='';
                                  $.each(data2.ShopUnitServiceAddress, function (key, entry) {
                                      $.getJSON("http://localhost:3000/shopUnits/"+entry.shopUnit, function (data) {
                                        var shopUnit_name = data.shopUnit.name;
                                        $( "."+entry.shopUnit ).removeClass(entry.shopUnit).addClass( entry.shopUnit );
                                        $("."+entry.shopUnit).text(shopUnit_name);
                                      });

                                      tab_menu += '<li class="nav-item"><a class="nav-link tab_menu '+entry.shopUnit+'" id="'+entry.shopUnit+'" data-toggle="tab" href="#tab'+entry.shopUnit+'" role="tab" aria-selected="false"></a></li>';

                                      myTabContent += '<div class="tab-pane fade show" id="tab'+entry.shopUnit+'" role="tabpanel"><table class="table table-hover table-condensed" style="background-color:#fff"><thead><tr style="border-top:2px solid #fff;"><th style="width:50%">Ürün</th><th style="width:10%">Fiyat</th>	<th style="width:8%">Adet</th><th style="width:22%" class="text-center">Ara Toplam</th><th style="width:10%"></th></tr></thead>';
                                      myTabContent += '<tbody id="a'+entry.shopUnit+'"></tbody><tfoot><tr><td><a href="products.php" class="btn btn-success"><i class="fa fa-angle-left"></i> Alışverişe Devam Et</a></td><td colspan="2" class="hidden-xs"></td>';
                                      myTabContent += '<td class="hidden-xs text-center">Toplam <strong id="sum'+entry.shopUnit+'"></strong></td>';
                                      myTabContent += '<td><a href="checkout.php" class="btn btn-success btn-block">Alışverişi Tamamla <i class="fa fa-angle-right"></i></a></td></tr></tfoot></table></div>';

                                  });*/


                                  $('#myTab').html(tab_menu);
                                  $('#myTabContent').html(myTabContent);

                                  $(".tab_menu").click(function() {
                                  $("#myTabContent table tbody tr").remove();
                                    var marketName=($(this).attr('id'));
                                    get_cart(marketName);
                                            var shoppingcart_info = {
                                                  shoppingcart: {
                                                      marketName: marketName,
                                                  }
                                              };
                                    localStorage.setItem('Market', JSON.stringify(shoppingcart_info));
                                  });
                                  $("ul.nav-tabs li:eq(0) a").click();

                                });
                            });
                      });
                      $('#changeAddress_modal').modal('hide');
                    }
              });
              var markets = [];
              function considerTotalAmount(marketId){

                var main, sum=0;
                var products = $.parseJSON(localStorage.getItem('Products'));

                for (let i = 0; i < products.length; i++) {
                    $.ajax({
                    url: "http://localhost:3000/shopUnitstocks?shopUnit="+marketId+"&product="+products[i].product._id,
                    dataType: 'json',
                    async: false,
                    type:'GET',
                    success: function(data) {
                      if(data.count==0){

                      }else{
                          $.each(data.shopUnitStocks, function(k,v){
                          if(v.stock>=products[i].product.amount){
                                sum += v.price*products[i].product.amount;
                          }
                        });
                      }
                    }
                  });
                }
                var orderMarket = {
                          marketId: marketId,
                          sum:sum
                  };
                markets.push(orderMarket);
              }



            function get_cart(marketName){
              var main, sum=0;
              var products = $.parseJSON(localStorage.getItem('Products'));

              for (let i = 0; i < products.length; i++) {
                  $.ajax({
                  url: "http://localhost:3000/shopUnitstocks?shopUnit="+marketName+"&product="+products[i].product._id,
                  dataType: 'json',
                  async: false,
                  type:'GET',
                  success: function(data) {
                    var sayac=0;

                      if(data.count==0){
                        if(sayac==0){
                          var shoppingcart_totalPrice = {
                                shoppingcart: {
                                    totalPrice: sum ,
                                }
                            };
                          localStorage.setItem('TotalPrice', JSON.stringify(shoppingcart_totalPrice));
                        }
                        var cart_data='';
                        cart_data +='<tr>';
                          cart_data += '<td data-th="Product">';
                            cart_data += '<div class="row">';
                              cart_data += '<div class="col-sm-2 hidden-xs"><img src="http://localhost:3000/'+products[i].product.productImage+'" class="img-responsive" height="50" width="50"/></div>';
                              cart_data += '<div class="col-sm-10">';
                                cart_data +='<p class="nomargin" id="'+products[i].product._id+'">'+products[i].product.name+'<p style="color:#FF0000">Bu ürün stokta bulunmamaktadır.</p></p>';
                              cart_data +='</div>';
                            cart_data +='</div>';
                          cart_data +='</td>';
                            cart_data +='<td data-th="Price" class="price"></td>';
                            cart_data +='<td data-th="Quantity">';
                              cart_data +='<input type="number" class="form-control text-center amount" value="'+products[i].product.amount+'" min="1">';
                            cart_data +='</td>';
                            cart_data +='<td data-th="Subtotal" class="text-center "></td>';
                            cart_data +='<td class="actions" data-th="">';
                              cart_data +='<button type="submit" class="btn btn-info btn-sm refresh" ><i class="fas fa-sync-alt"></i></button>';
                              cart_data +='<button type="submit" class="btn btn-danger btn-sm delete" ><i class="fas fa-trash-alt"></i></button>';
                            cart_data +='</td>';
                        cart_data +='</tr>';

                          $("#a"+marketName).append(cart_data);
                      } else {
                        $.each(data.shopUnitStocks, function(k,v){
                        //  alert(products[i].product.amount);
                        if(v.stock>=products[i].product.amount){
                          sayac++;
                          var cart_data='';
                          cart_data +='<tr>';
                            cart_data += '<td data-th="Product">';
                              cart_data += '<div class="row">';
                                cart_data += '<div class="col-sm-2 hidden-xs"><img src="http://localhost:3000/'+products[i].product.productImage+'" class="img-responsive" height="50" width="50"/></div>';
                                cart_data += '<div class="col-sm-10">';
                                  cart_data +='<p class="nomargin" id="'+products[i].product._id+'">'+products[i].product.name+'</p>';
                                cart_data +='</div>';
                              cart_data +='</div>';
                            cart_data +='</td>';
                              cart_data +='<td data-th="Price"><span>₺</span><span class="price">'+currency_format(v.price, ' ')+'</span></td>';
                              cart_data +='<td data-th="Quantity">';
                                cart_data +='<input type="number" class="form-control text-center amount" value="'+products[i].product.amount+'" min="1" max="'+v.stock+'">';
                              cart_data +='</td>';
                              cart_data +='<td data-th="Subtotal" class="text-center"><span>₺</span><span class="subTotal">'+currency_format(v.price*products[i].product.amount, ' ')+'</span></td>';
                              cart_data +='<td class="actions" data-th="">';
                                cart_data +='<button type="submit" class="btn btn-info btn-sm refresh" ><i class="fas fa-sync-alt"></i></button>';
                                cart_data +='<button type="submit" class="btn btn-danger btn-sm delete" ><i class="fas fa-trash-alt"></i></button>';
                              cart_data +='</td>';
                          cart_data +='</tr>';

                          sum += (v.price*products[i].product.amount);

                          function currency_format(n, currency) {
                            return currency + n.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, '$1,');
                          }


                          $("#a"+marketName).append(cart_data);


                          $("#sum"+marketName).text(currency_format(sum, '₺'));
                          var shoppingcart_totalPrice = {
                                shoppingcart: {
                                    totalPrice: sum,
                                }
                            };
                          localStorage.setItem('TotalPrice', JSON.stringify(shoppingcart_totalPrice));
                          $(".refresh").click(function(){
                            var price = $(this).closest("tr").find(".price").text();
                            var amount = $(this).closest("tr").find(".amount").val();
                            $(this).closest("tr").find(".subTotal").text(currency_format(price*amount,' '));
                            sum = 0;
                            $('.subTotal').each(function(){

                              sum += parseFloat($(this).text());
                            });
                            var shoppingcart_totalPrice = {
                                  shoppingcart: {
                                      totalPrice: sum,
                                  }
                              };
                            localStorage.setItem('TotalPrice', JSON.stringify(shoppingcart_totalPrice));
                            $("#sum"+marketName).text(currency_format(sum, '₺'));

                            location.reload();
                          });

                          $(".amount").bind('keyup mouseup', function () {
                              var deneme = $(this).closest("tr").find(".amount").val()

                              for(i=0;i<products.length;i++){

                                if($(this).closest("tr").find(".nomargin").attr("id")==products[i].product._id){
                                  products[i].product.amount=deneme;
                                }
                              }
                              localStorage.setItem("Products", JSON.stringify(products));
                          });
                        } else {
                          var shoppingcart_totalPrice = {
                                shoppingcart: {
                                    totalPrice: sum,
                                }
                            };
                          localStorage.setItem('TotalPrice', JSON.stringify(shoppingcart_totalPrice));

                          var cart_data='';
                          cart_data +='<tr>';
                            cart_data += '<td data-th="Product">';
                              cart_data += '<div class="row">';
                                cart_data += '<div class="col-sm-2 hidden-xs"><img src="http://localhost:3000/'+products[i].product.productImage+'" class="img-responsive" height="50" width="50"/></div>';
                                cart_data += '<div class="col-sm-10">';
                                  cart_data +='<p class="nomargin" id="'+products[i].product._id+'">'+products[i].product.name+'<p style="color:#FF0000">Bu ürün stokta bulunmamaktadır.</p></p>';
                                cart_data +='</div>';
                              cart_data +='</div>';
                            cart_data +='</td>';
                              cart_data +='<td data-th="Price" class="price"></td>';
                              cart_data +='<td data-th="Quantity">';
                                cart_data +='<input type="number" class="form-control text-center amount" value="'+products[i].product.amount+'" min="1">';
                              cart_data +='</td>';
                              cart_data +='<td data-th="Subtotal" class="text-center "></td>';
                              cart_data +='<td class="actions" data-th="">';
                                cart_data +='<button type="submit" class="btn btn-info btn-sm refresh" ><i class="fas fa-sync-alt"></i></button>';
                                cart_data +='<button type="submit" class="btn btn-danger btn-sm delete" ><i class="fas fa-trash-alt"></i></button>';
                              cart_data +='</td>';
                          cart_data +='</tr>';

                            $("#a"+marketName).append(cart_data);

                        }
                      });
                      }

                      }
                  });
              }


              /*var a = [], diff = [];

               for (let i = 0; i < products.length; i++) {
                   a[products[i].product._id] = true;
               }

               for (let i = 0; i < sayac.length; i++) {
                   if (a[sayac[i]]) {
                       delete a[sayac[i]];
                   } else {
                       a[sayac[i]] = true;
                   }
               }

               for (var k in a) {
                   diff.push(k);
               }

               for(let a=0;a<products.length;a++){
                 for(let c=0;c<diff.length;c++)
                 {
                   if(diff[c]==products[a].product._id){

                   }
                 }
               }*/
               $(".delete").click(function(){
                 var id = $(this).closest("tr").find(".nomargin").attr("id");
                 var deleteProduct = JSON.parse(localStorage.getItem("Products"));

                 jQuery.each(deleteProduct, function(i, val) {
                      if(id == products[i].product._id) // delete index
                      {
                         deleteProduct.splice(i, 1);
                         localStorage.setItem("Products", JSON.stringify(deleteProduct));
                         var active_market= $('ul.nav-tabs li').find('.active').attr("id");
                         $("#myTabContent table tbody tr").remove();
                         get_cart(active_market);

                     }
                   });
               });
            }

      }


});




  </script>
</html>
