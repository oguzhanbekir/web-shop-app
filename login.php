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

    <div class="row justify-content-center ">

      <div class="login">
        <div class="top-login">
            <div class="panel-heading">
              <div class="row justify-content-around">
                  <div class="col-xs-6">
                    <a href="#" class="active" id="login-form-link" style="text-decoration: none;">Giriş</a>
                  </div>
                  <div class="col-xs-6">
                    <a href="#" id="register-form-link" style="text-decoration: none;">Kayıt Ol</a>
                  </div>
              </div>
              <hr>
        </div>

          </div>

          <form id="login-form" method="post" role="form" style="display: block;">
            <div class="form-group ">
              <input type="email" class="form-control" aria-describedby="emailHelp" placeholder="Kullanıcı Adı" id="login_email" />
            </div>
            <div class="form-group">
              <input type="password" class="form-control" placeholder="Parola" id="login_password">
            </div>
            <div class="row justify-content-center">
              <div class="form-check mb-3 mt-2">
                <input type="checkbox" class="form-check-input" id="exampleCheck1" />
                <label class="form-check-label" for="exampleCheck1">Beni Hatırla</label>
              </div>
            </div>
            <div class="row justify-content-center">
              <button type="submit" class="btn btn-primary btn-block col-sm-6 col-sm-offset-3" id="login_submit" data-id="5c6d60b42fc5e43e944786ac">Giriş Yap</button>
            </div>
            <div class="row mt-3 justify-content-center">
              <a href="#" id="forgot-form-link" tabindex="5" class="forgot-password">Şifremi Unuttum</a>
            </div>


          </form>

          <form id="register-form" method="post"  style="display: none;">

            <div class="form-group ">
              <label for="exampleInputEmail1">Email Adresi</label>
              <input type="email" class="form-control" id="signup_email" aria-describedby="emailHelp" placeholder="E-Mail">
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Parola</label>
              <input type="password" class="form-control" id="signup_password" placeholder="Parola">
            </div>
            <div class="form-group">
              <label for="tel">Telefon Numarası</label>
              <input type="text" class="form-control" id="signup_phone" placeholder="Telefon Numarası" required>
            </div>
            <div class="form-group row">
              <div class="col">
                <select name="city" class="form-control" id="address_city"></select>
              </div>
              <div class="col">
                <select name="district" class="form-control" id="address_district"></select>
              </div>
              <div class="col">
                <select name="neighborhood" class="form-control" id="address_neighborhood"></select>
              </div>
            </div>
            <div class="form-group">
              <label for="address">Adres:</label>
              <textarea class="form-control" rows="3" id="address"></textarea>
            </div>
            <div class="row mt-5 justify-content-center">
              <button type="reset" class="btn btn-primary btn-block col-sm-6 col-sm-offset-3" id="signup_submit">Kayıt Ol</button><br>
            </div>
          </form>

          <form id="forgot-form" role="form" autocomplete="off" class="form" method="post" style="display: none;">
              <div class="form-group">
                  <input type="email" class="form-control" id="forgotInputEmail" aria-describedby="emailHelp" placeholder="E-Mail">
              </div>
              <div class="row justify-content-center">
                  <button type="submit" class="btn btn-primary btn-block col-sm-6 col-sm-offset-3">Parolamı Sıfırla</button>
              </div>
          </form>


      </div>
    </div>
  </div>

  <?php include 'footer.php' ?>

  </body>
  </html>
  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/main.js"></script>

  <script>
    $('#login-form-link').click(function(e) {
    $("#login-form").delay(100).fadeIn(100);
    $("#register-form").fadeOut(100);
    $('#register-form-link').removeClass('active');
    $("#forgot-form").fadeOut(100);
    $('#forgot-form-link').removeClass('active');
    $(this).addClass('active');
    e.preventDefault();
  });
  $('#register-form-link').click(function(e) {
    $("#register-form").delay(100).fadeIn(100);
    $("#login-form").fadeOut(100);
    $('#login-form-link').removeClass('active');
    $("#forgot-form").fadeOut(100);
    $('#forgot-form-link').removeClass('active');
    $(this).addClass('active');
    e.preventDefault();
  });
  $('#forgot-form-link').click(function(e) {
    $("#forgot-form").delay(100).fadeIn(100);
    $("#login-form").fadeOut(100);
    $('#login-form-link').removeClass('active');
    $("#register-form").fadeOut(100);
    $('#register-form-link').removeClass('active');
    $(this).addClass('active');
    e.preventDefault();
  });
 $(document).ready(function() {
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
           });
         });
       });

    $("#signup_submit").click(function(){
      if($("#signup_email").val()!='' && $("#signup_phone").val()!='' && $("#signup_password").val()!=''){
            $.ajax({
            url: "http://localhost:3000/addresses",
            type: "POST",
            async:false,
            data: {
                city: $("#address_city").val(),
                district: $("#address_district").val(),
                neighborhood: $("#address_neighborhood").val(),
                description: $("#address").val()
            },
            dataType: "JSON",
            success: function (jsonStr) {
                var user_address=jsonStr.createdAddress._id;
                user_signup(user_address);
            },
            error: function (xhr, status, error) {
                alert("Kayıt Başarısız");
            }
            });
      } else {
        alert("Lütfen Tüm Alanları Doldurun");
      }
  });

function user_signup(user_address){
  $.ajax({
  url: "http://localhost:3000/user/signup",
  async:false,
  type: "POST",
  data: {
      email: $("#signup_email").val(),
      phone: $("#signup_phone").val(),
      password: $("#signup_password").val(),
      userType: "5c1d170270920532900b6a5e",
  },
  dataType: "JSON",
  success: function (data) {
    var user_Id=data.id;
      $.ajax({
      url: "http://localhost:3000/userAddresses",
      async:false,
      type: "POST",
      data: {
          user: user_Id,
          address: user_address,
          name: 'Ev'
      },
      dataType: "JSON",
      success: function (jsonStr) {

        alert("Kayıt Oluşturuldu");
      },
      error: function (xhr, status, error) {
          alert("Oluşturulamadı");
      }
    });
  },
  error: function (xhr, status, error) {
      alert("Oluşturulamadı");
  }
  });
}




   $("#login_submit").click(function(e){
     e.preventDefault();
     if($("#login_password").val()!='' && $("#login_email").val()!=''){
       $.ajax({
       url: "http://localhost:3000/user/login",
       type: "POST",
       data: {
           "password": $("#login_password").val(),
           "email": $("#login_email").val()
       },
       dataType: "JSON",
       cache: false,
       async:false,

       success: function (result) {
          alert("Giriş Başarılı");
          localStorage.setItem('Token', JSON.stringify(result.token));
          if(parseJwt(result.token)=="5c1d177b70920532900b6a60"){
            location.href="market_panel/myaccount.html";
          } else if(parseJwt(result.token)=="5c1d176670920532900b6a5f"){
            location.href="market_panel/adminpanel.html";
          } else {
            location.href="index.php";
          }
       },
       error: function (xhr, status, error) {
          alert("Kullanıcı Adı veya Parola Hatalıdır");
       }
     });
     } else {
      alert("Lütfen Tüm Alanları Doldurun");
     }

  });

  function parseJwt (token) {
        var base64Url = token.split('.')[1];
        var base64 = base64Url.replace(/-/g, '+').replace(/_/g, '/');
        var deneme=JSON.parse(window.atob(base64));
        return deneme.userType;
    };
    function parseJwt_userId (token) {
          var base64Url = token.split('.')[1];
          var base64 = base64Url.replace(/-/g, '+').replace(/_/g, '/');
          var deneme=JSON.parse(window.atob(base64));
          return deneme.userId;
    };


});
  </script>
