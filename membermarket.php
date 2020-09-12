<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="css/all.min.css"/>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="css/main.css"/>

    <title>Sanal Market</title>
  </head>
  <body>

      <?php include 'header.php' ?>

    <div class="container d-flex justify-content-center">
      <div class="w-50 p-3">
        <h4 class="mb-4 text-center">ÜYE İŞYERİ OLMAK İSTİYORUM</h4>
            <form id="membermarketForm">
            <div class="form-group row ">
              <label for="companyname" class="col-sm-12 col-form-label">Firma İsmi</label>
              <div class="col-sm-12">
                <input type="text" class="form-control" id="companyname" required>
              </div>
            </div>
            <div class="form-group row">
              <label for="min_order" class="col-sm-12 col-form-label">Minimum Servis Tutarı</label>
              <div class="col-sm-12">
                <input type="text" class="form-control" id="min_order" required>
              </div>
            </div>
            <div class="form-group row mt-3">
              <div class="col-sm-10">
                <button type="submit" class="btn btn-primary">Üye Ol</button>
              </div>
            </div>
          </form>
        </diV>
      </div>

    <?php include 'footer.php' ?>


  </body>

      <script src="js/jquery-3.3.1.min.js"></script>
      <script src="js/bootstrap.min.js"></script>
      <script src="js/pdfmake.min.js"></script>
      <script src="js/vfs_fonts.js"></script>
      <script src="js/main.js"></script>

      <script>

      function parseJwt_userId (token) {
            var base64Url = token.split('.')[1];
            var base64 = base64Url.replace(/-/g, '+').replace(/_/g, '/');
            var deneme=JSON.parse(window.atob(base64));
            return deneme.userId;

        };

      $(document).ready(function(){
        var token = $.parseJSON(localStorage.getItem('Token'));
        var userId = parseJwt_userId(token);
        var addressId;
        var phone;
        var email;
          if (token == null ) {
              location.href="login.php";
              alert("Lütfen Önce Giriş Yapınız")

              return;
          } else {

              $.getJSON("http://localhost:3000/userAddresses",function(d){
                  $.each(d.UserAddresses, function (key, entry) {
                    if(entry.user==userId){
                        addressId = entry.address;
                     }
                  });
              });
              $.getJSON("http://localhost:3000/user/"+userId,function(d){
                phone = d.phone;
                email = d.email;
              });


            $('#membermarketForm').submit(function(e){
                $.ajax({

                url: "http://localhost:3000/shopUnitApplies",
                async:false,
                type: "POST",
                data: {
                    shopName: $('#companyname').val(),
                    shopUser: userId,
                    shopUnitName: $('#companyname').val(),
                    shopUnitAddress: addressId,
                    shopUnitMin_order: $('#min_order').val(),
                    shopUnitPhone:  phone,
                    shopUnitEmail:  email
                },
                dataType: "JSON",
                success: function (jsonStr) {

                  alert("Kayıt Oluşturuldu");
                },
                error: function (xhr, status, error) {
                    alert("Oluşturulamadı");
                }
              });

            });

          }



      });

      </script>
</html>
