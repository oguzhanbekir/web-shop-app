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
  <div class="top-body">
      <div class="row">
          <div class="col-12 text-center">
            <h2 class="font-weight-bold">Hesabım</h2>
          </div>
      </div>
      <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" id="personalinfo-tab" data-toggle="tab" href="#personalinfo" role="tab" aria-controls="personalinfo" aria-selected="true">Kişisel Bilgilerim</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="addressinfo-tab" data-toggle="tab" href="#addressinfo" role="tab" aria-controls="addressinfo" aria-selected="false">Adres Bilgilerim</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="orderinfo-tab" data-toggle="tab" href="#orderinfo" role="tab" aria-controls="orderinfo" aria-selected="false">Sipariş Bilgilerim</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="passwordinfo-tab" data-toggle="tab" href="#passwordinfo" role="tab" aria-controls="passwordinfo" aria-selected="false">Parola İşlemlerim</a>
        </li>
      </ul>
      <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade " id="passwordinfo" role="tabpanel" aria-labelledby="Kişisel Bilgilerim">
          <br />
          <form id="password_info">
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Parola</label>
              <div class="col-sm-10">
                <input type="password" class="form-control" name="password" id="userinfo_password" required>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Parola (Tekrar)</label>
              <div class="col-sm-10">
                <input type="password" class="form-control" name="password2" id="userinfo_password_check" required>
              </div>
            </div>
            <div class="form-group row">
              <div class="col-sm-10">
                <button type="submit" name="submit" class="btn btn-primary">Parola Değiştir</button>
              </div>
            </div>
          </form >
        </div>
        <div class="tab-pane fade show active" id="personalinfo" role="tabpanel" aria-labelledby="Kişisel Bilgilerim">
          <br />
          <form id="user_info">
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">E-Mail</label>
              <div class="col-sm-10">
                <input type="email" class="form-control" name="email" id="userinfo_email" required>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Telefon</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="phone"  id="userinfo_phone" required>
              </div>
            </div>
            <div class="form-group row">
              <div class="col-sm-10">
                <button type="submit" name="submit" class="btn btn-primary">Güncelle</button>
              </div>
            </div>
          </form >
        </div>

        <div class="tab-pane fade w-50 p-3" id="addressinfo" role="tabpanel" aria-labelledby="Adres Bilgilerim">
          <button type="button" class="btn btn-outline-success"  data-toggle="modal" data-target="#exampleModal"><i class="fas fa-plus-circle" data-toggle="modal" data-target="#exampleModal"></i> Yeni Adres Ekle</button>
          <form id="userinfo_address" method="post">
            <div class="form-group">
              <label for="updateaddress_name" >Güncellemek İstediğiniz Adresi Seçiniz</label>
                <select class="form-control" id="updateaddress_name">
                </select>
            </div>
            <div class="form-group row">
              <div class="col">
                  <label for="address_city">İl</label>
                <select class="form-control address_city" id="address_city" required></select>
              </div>
              <div class="col">
                  <label for="address_district">İlçe</label>
                <select class="form-control address_district" id="address_district" required></select>
              </div>
              <div class="col">
                  <label for="address_neighborhood">Mahalle</label>
                <select class="form-control address_neighborhood" id="address_neighborhood" required></select>
              </div>
            </div>
            <div class="form-group">
              <label for="address_description">Adres</label>
              <textarea class="form-control" rows="3" id="address_description" required></textarea>
            </div>
            <div class="row mt-5">
              <div class="col">
                <button type="submit" class="btn btn-primary" >Adres Bilgilerini Güncelle</button><br>
              </div>
            </div>
          </form>
        </div>

        <div class="tab-pane fade" id="orderinfo" role="tabpanel" aria-labelledby="Sipariş Bilgilerim">
          <br />
          <table class="table table-bordered table-hover">
            <thead class="table-dark">
            <tr>
              <th>Sipariş Tarihi</th>
              <th>Sipariş Kodu</th>
              <th>Toplam Tutar</th>
              <th>Ödeme Şekli</th>
              <th>Market</th>
              <th>Sipariş Durumu</th>
            </tr>
          </thead>
          <tbody  id="order_data">

          </tbody>
          </table>
          <nav>
            <ul class="pagination">

            </ul>
          </nav>

        </div>
      </div>
  </div>
</div>

  <?php include 'footer.php' ?>

  <div class="modal" tabindex="-1" role="dialog" id="modal_orderdetail">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="siparis">Sipariş Detayı</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <table border='1' class="table table-bordered mb-2">
              <thead>
                <th>Ürün</th>
                <th>Adet</th>
                <th>Birim Fiyat</th>
                <th>Ara Toplam</th>
              </thead>
              <tbody id="orderdetails_data">

              </tbody>

            </table>

        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Adres Bilgileri</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form class="needs-validation" id="addnew_Address" novalidate>
                <div class="mb-3">
                  <label for="address_name">Adresin Adı</label>
                  <input type="text" class="form-control" id="address_name" required>
                </div>

              <div class="mb-3">
                <label for="address">Adres</label>
                <input type="text" class="form-control" id="adres" required>
              </div>

              <div class="row" >
                <div class="col-md-4 mb-3">
                  <label for="sehir">Şehir</label>
                  <select class="custom-select d-block w-100 address_city2" id="sehir" required>

                  </select>
                </div>
                <div class="col-md-4 mb-3">
                  <label for="ilce">İlçe</label>
                  <select class="custom-select d-block w-100 address_district2" id="ilce" required>
                  </select>
                </div>

                <div class="col-md-4 mb-3">
                  <label for="mahalle">Mahalle</label>
                  <select class="custom-select d-block w-100 address_neighborhood2" id="mahalle" required>

                  </select>
                </div>
              </div>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
            <button type="submit" class="btn btn-primary">Kaydet</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </body>
  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/main.js"></script>
  <script>

  function parseJwt (token) {
        var base64Url = token.split('.')[1];
        var base64 = base64Url.replace(/-/g, '+').replace(/_/g, '/');
        var deneme=JSON.parse(window.atob(base64));
        return deneme.userId;

    };
  $(document).ready(function(){

    var token= $.parseJSON(localStorage.getItem('Token'));
      if (token == null ) {
          location.href="index.php";
          return;
      }else{
        var userId = parseJwt(token);


        $("#addnew_Address").on('submit', function (event){
          $.ajax({
          url: "http://localhost:3000/addresses",
          type: "POST",
          async:false,
          data: {
              city: $("#sehir").val(),
              district: $("#ilce").val(),
              neighborhood: $("#mahalle").val(),
              description: $("#adres").val()
          },
          dataType: "JSON",
          success: function (jsonStr) {
              var user_address=jsonStr.createdAddress._id;
              user_addnewAddress(user_address);
          },
          error: function (xhr, status, error) {
              alert("Lütfen Tüm Alanları Doldurun");
          }
          });

        });

        function user_addnewAddress(user_address){
          $.ajax({
          url: "http://localhost:3000/userAddresses",
          async:false,
          type: "POST",
          data: {
              user: userId,
              address: user_address,
              name: $("#address_name").val()
          },
          dataType: "JSON",
          success: function (jsonStr) {

            alert("Kayıt Oluşturuldu");
          },
          error: function (xhr, status, error) {
              alert("Oluşturulamadı");
          }
        });
        }

        $("#password_info").on('submit', function (event){
          if($('#userinfo_password').val()==$('#userinfo_password_check').val())
          {
            var request = new XMLHttpRequest();
            request.open('PATCH', 'http://localhost:3000/user/'+userId);
            request.setRequestHeader("Content-Type", "application/json")
            request.setRequestHeader('Authorization','Bearer '+token);
          //  request.setRequestHeader("cache-control", "no-cache");
            request.send('[{"propName": "password","value":"'+$('#userinfo_password').val()+'"}]');
            alert("Parola Başarılı Bir Şekilde Değiştirildi");
          } else{
            alert("Parola Eşleşmedi");
          }

        });


        $.getJSON("http://localhost:3000/user/"+userId,function(d){
          $('#userinfo_email').val(d.email);
          $('#userinfo_phone').val(d.phone);
          $("#user_info").on('submit', function (event){
            var request = new XMLHttpRequest();
            request.open('PATCH', 'http://localhost:3000/user/'+userId);
            request.setRequestHeader("Content-Type", "application/json")
            request.setRequestHeader('Authorization','Bearer '+token);
          //  request.setRequestHeader("cache-control", "no-cache");
            request.send('[{"propName": "email","value":"'+$('#userinfo_email').val()+'"},{"propName": "phone","value":"'+$("#userinfo_phone").val()+'"}]');

            alert("Güncelleme Başarılı Bir Şekilde Değiştirildi");
          });
        });


        let dropdown_neighborhood = $('.address_neighborhood');
        let dropdown_city = $('.address_city');
        dropdown_city.empty();
        dropdown_city.append('<option selected="true" disabled>Şehir Seçiniz</option>');
        dropdown_city.prop('selectedIndex', 0);
        $.getJSON("http://localhost:3000/cities", function (data) {
          $.each(data.city, function (key, entry) {
              dropdown_city.append($('<option></option>').val(entry._id).text(entry.name).attr('data-id', entry.code));
          });
        });

          $(".address_city").on('change', function() {
            var city_code = $('.address_city').find(":selected").attr("data-id");
            let dropdown_district = $('.address_district');
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

          $(".address_district").on('change', function() {
            var district_code = $(this).val();
            dropdown_neighborhood.empty();
            dropdown_neighborhood.append('<option selected="true" disabled>Mahalle Seçiniz</option>');
            dropdown_neighborhood.prop('selectedIndex', 0);
            $.getJSON("http://localhost:3000/neighborhoods", function (data) {
              $.each(data.Neighborhood, function (key, entry) {
                 if(entry.District==district_code)
                  dropdown_neighborhood.append($('<option></option>').attr('value', entry._id).text(entry.name));
              });
            });
          });


          let dropdown_neighborhood2 = $('.address_neighborhood2');
          let dropdown_city2 = $('.address_city2');
          dropdown_city2.empty();
          dropdown_city2.append('<option selected="true" disabled>Şehir Seçiniz</option>');
          dropdown_city2.prop('selectedIndex', 0);
          $.getJSON("http://localhost:3000/cities", function (data) {
            $.each(data.city, function (key, entry) {
                dropdown_city2.append($('<option></option>').val(entry._id).text(entry.name).attr('data-id', entry.code));
            });
          });

            $(".address_city2").on('change', function() {
              var city_code = $('.address_city2').find(":selected").attr("data-id");
              let dropdown_district2 = $('.address_district2');
              dropdown_district2.empty();
              dropdown_district2.append('<option selected="true" disabled>İlçe Seçiniz</option>');
              dropdown_district2.prop('selectedIndex', 0);
              dropdown_neighborhood2.empty();
              dropdown_neighborhood2.append('<option selected="true" disabled>Mahalle Seçiniz</option>');
              dropdown_neighborhood2.prop('selectedIndex', 0);
              $.getJSON("http://localhost:3000/districts", function (data) {
                $.each(data.District, function (key, entry) {
                   if(entry.code==city_code)
                    dropdown_district2.append($('<option></option>').attr('value', entry._id).text(entry.name));
                });
              });
            });

            $(".address_district2").on('change', function() {
              var district_code = $(this).val();
              dropdown_neighborhood2.empty();
              dropdown_neighborhood2.append('<option selected="true" disabled>Mahalle Seçiniz</option>');
              dropdown_neighborhood2.prop('selectedIndex', 0);
              $.getJSON("http://localhost:3000/neighborhoods", function (data) {
                $.each(data.Neighborhood, function (key, entry) {
                   if(entry.District==district_code)
                    dropdown_neighborhood2.append($('<option></option>').attr('value', entry._id).text(entry.name));
                });
              });
            });





          let dropdown_updateaddress = $('#updateaddress_name');
          dropdown_updateaddress.empty();
          dropdown_updateaddress.append('<option selected="true" disabled>Adresinizi Seçiniz</option>');
          dropdown_updateaddress.prop('selectedIndex', 0);
          $.getJSON("http://localhost:3000/useraddresses?user="+userId,function(data){
              $.each(data.UserAddresses, function(k,v){
                      dropdown_updateaddress.append($('<option></option>').attr('value', v._id).text(v.name));
              });
            });


              $("#updateaddress_name").on('change', function() {

                $.getJSON("http://localhost:3000/userAddresses/"+$(this).val(),function(d){
                    $.getJSON("http://localhost:3000/addresses/"+d.userAddress.address,function(data){

                        $('#address_description').val(data.address.description);
                        $('#address_city').val(data.address.city);
                          var city_code = $('#address_city').find(":selected").attr("data-id");
                          let dropdown_district = $('#address_district');
                          dropdown_district.empty();
                          dropdown_district.append('<option selected="true" disabled>İlçe Seçiniz</option>');
                          dropdown_district.prop('selectedIndex', 0);
                          $.getJSON("http://localhost:3000/districts", function (dataa) {
                            $.each(dataa.District, function (key, entry) {
                               if(entry.code==city_code)
                                dropdown_district.append($('<option></option>').attr('value', entry._id).text(entry.name));
                            });
                              $('#address_district').val(data.address.district);
                              var district_code = $('#address_district').val();
                              let dropdown_neighborhood = $('#address_neighborhood');
                              dropdown_neighborhood.empty();
                              dropdown_neighborhood.append('<option selected="true" disabled>Mahalle Seçiniz</option>');
                              dropdown_neighborhood.prop('selectedIndex', 0);
                              $.getJSON("http://localhost:3000/neighborhoods", function (data2) {
                                $.each(data2.Neighborhood, function (key, entry) {
                                   if(entry.District==district_code)
                                    dropdown_neighborhood.append($('<option></option>').attr('value', entry._id).text(entry.name));
                                });
                                $('#address_neighborhood').val(data.address.neighborhood);
                              });
                          });
                      });

                      $("#userinfo_address").on('submit', function (event){
                      var request = new XMLHttpRequest();
                        request.open('PATCH', 'http://localhost:3000/addresses/'+d.userAddress.address, false);
                        request.setRequestHeader("Content-type","application/json");
                        request.send('[{"propName": "description","value":"'+$('#address_description').val()+'"},{"propName": "city","value":"'+$('#address_city').val()+'"},{"propName": "district","value":"'+$('#address_district').val()+'"},{"propName": "neighborhood","value":"'+$('#address_neighborhood').val()+'"}]');
                      });

                    });
              });

             function products_table(page_number=1){
               $.getJSON("http://localhost:3000/orders?sort=-1&user="+userId+"&page="+page_number+"&limit=10",function(data){
                    var order_data='', pagenumber_data='' ;

                    var count = `${data.sumcount}`;
                    var perpage=10;
                    var total_pagenumber= Math.ceil(count/perpage);
                    if(page_number>1){
                          var before=parseInt(page_number)-1;
                          pagenumber_data +='<li class="page-item"><a class="page-link" href="#'+before+'">Önceki</a></li>';
                    }
                    for(var i=1;i<=total_pagenumber;i++){
                        if(i==page_number){
                            pagenumber_data +='<li class="page-item active"><a class="page-link" href="#'+i+'">'+i+'</a></li>';
                        }else{
                            pagenumber_data +='<li class="page-item"><a class="page-link" href="#'+i+'">'+i+'</a></li>';
                        }
                    }
                    if(page_number!=total_pagenumber){
                          var next = parseInt(page_number) + 1;
                          pagenumber_data +='<li class="page-item"><a class="page-link" href="#'+next+'">Sonraki</a></li>';
                    }
                      $('.pagination').html(pagenumber_data);

                    $('.page-item a').click(function(){
                      var num_href=$(this).attr('href');
                      var num=num_href.split('#');
                      products_table(num[1]);
                    });

                    $.each(data.orders, function(k,v){

                        var orderstatus='';
                        var orderstatus_id=v.order_status;
                        var payment_type;
                          var fields = v.created_at.split('T');
                          if(v.payment_type==0){
                            payment_type="Kredi Kartı";
                          }else if(v.payment_type==1){
                            payment_type="Nakit";
                          }

                      if(orderstatus_id==0){
                        orderstatus="Onay Bekliyor";
                      } else if(orderstatus_id==1){
                        orderstatus="Siparişiniz Hazırlandı";
                      } else if(orderstatus_id==2){
                        orderstatus="Alıcıya Ulaştırılmak Üzere Yola Çıktı";
                      } else if(orderstatus_id==3){
                        orderstatus="Teslim Edildi";
                      } else if(orderstatus_id==4){
                        orderstatus="İptal Edildi";
                      }
                            $.getJSON("http://localhost:3000/shopUnits/"+v.shopUnit,function(data){
                                var shopUnit_name = `${data.shopUnit.name}`
                                $("."+v.shopUnit ).removeClass().addClass( v.shopUnit );
                                $("."+v.shopUnit).text(shopUnit_name);
                            });
                          order_data +='<tr>';
                          order_data += '<td>'+fields[0]+'</td>';
                          order_data += '<td>'+v.guid+'</td>';
                          order_data += '<td>'+v.total_amount+'</td>';
                          order_data += '<td>'+payment_type+'</td>';
                          order_data += '<td class="'+v.shopUnit+'"></td>';
                          order_data += '<td>'+orderstatus+'</td>';
                          order_data += '<td><a data-toggle="modal" href="#modal_orderdetail" class="orderdetail"  id="'+v._id+'">Sipariş Detayı</a></td></tr>';


                      });

                      $('#order_data').html(order_data);

                      $(".orderdetail").click(function(){
                      var orderId=$(this).closest("tr").find(".orderdetail").attr('id');
                      $.getJSON("http://localhost:3000/orderdetails/?guid="+orderId,function(data){

                        var shopUnit_name ='';
                        var orderdetails_data='';
                          $.each(data.orderDetails, function(k,v){

                              function getproductname(product_id){
                                var mydata = [];
                                  $.ajax({
                                  url: "http://localhost:3000/products/"+product_id,
                                  async: false,
                                  dataType: 'json',
                                  success: function (json) {
                                    mydata = json.product.name;
                                  }
                                  });
                                  return mydata;
                              }

                              function getproductimage(product_id){
                                var mydata = [];
                                  $.ajax({
                                  url: "http://localhost:3000/products/"+product_id,
                                  async: false,
                                  dataType: 'json',
                                  success: function (json) {
                                    mydata = json.product.productImage;
                                  }
                                  });
                                  return mydata;
                              }

                          orderdetails_data +='<tr>';
                          orderdetails_data +='<td><img src="http://localhost:3000/'+getproductimage(v.product)+'" class="img-responsive" height="50" width="50"/> '+ getproductname(v.product)+'</td>';
                          orderdetails_data +='<td>'+v.quantity+'</td>';
                          orderdetails_data +='<td>'+v.amount+'</td>';
                          orderdetails_data +='<td>'+v.quantity*v.amount+'</td>';
                          orderdetails_data +='</tr>';

                        });
                          $("#orderdetails_data tr").remove();
                          $('#orderdetails_data').append(orderdetails_data);
                      });
                    });

                  });
              }
              products_table();
      }

  });



  </script>
</html>
