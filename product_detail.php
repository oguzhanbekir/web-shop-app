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


<div class="container mt-2 mb-3">
  <div class="row">

    <div class="col-md-6">
      <img class="img-fluid float-right" src="" alt="" width="300px" height="300px">
    </div>

    <div class="col-md-6">
      <h3 class="my-3" id="product_name"></h3>
      <dl>
                <dt id="product_attribute_label_1" style="">
                    <label class="text-prompt">
                        Ürün stokta yoksa
                    </label>
                        <span class="required">*</span>
                                    </dt>
                <dd id="product_attribute_input_1">
	                        <ul class="option-list product-radio-option">
	                                <li>
	                                    <input id="product_attribute_1_2" type="radio" name="product_attribute_1" value="2">
	                                    <label for="product_attribute_1_2"><span>Alternatif istemiyorum</span></label>

	                                </li>
	                                <li>
	                                    <input id="product_attribute_1_1" type="radio" name="product_attribute_1" value="1">
	                                    <label for="product_attribute_1_1"><span>Alternatif ürün gönderin</span></label>

	                                </li>
	                                <li>
	                                    <input id="product_attribute_1_3" type="radio" name="product_attribute_1" value="3" checked="checked">
	                                    <label for="product_attribute_1_3"><span>Alternatif için beni arayın</span></label>

	                                </li>
	                        </ul>
                </dd>
                <dt id="product_attribute_label_2" style="">
                    <label class="text-prompt">
                        Ürün Notu
                    </label>
                                    </dt>
                <dd id="product_attribute_input_2">
                    <textarea cols="40" id="product_attribute_2" name="product_attribute_2"></textarea>
                </dd>
        </dl>
        <input type="number" maxlength="4" class="text-center amount mb-2" value="1" min="1"><br />
        <button id="addcart_submit" type="submit" class="btn btn-primary">Sepete Ekle</button>
    </div>

  </div>
</div>
        <?php include 'footer.php' ?>

  </body>
  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/main.js"></script>
  <script>
  
$(document).ready(function(){
    function GetURLParameter(sParam)
    {
      var sPageURL = window.location.search.substring(1);
      var sURLVariables = sPageURL.split('&');
      for (var i = 0; i < sURLVariables.length; i++)
      {
          var sParameterName = sURLVariables[i].split('=');
          if (sParameterName[0] == sParam)
          {
              return decodeURIComponent(sParameterName[1]);
          }
      }
    }

    var id = GetURLParameter('id');
    $('#addcart_submit').eq(0).attr('id', id);

      $.getJSON("http://localhost:3000/products/"+id,function(data){
          var image= `${data.product.productImage}`;
          var link="http://localhost:3000/";
          $('.img-fluid').attr('src',link+image);
          $('#product_name').text(`${data.product.name}`);
      });

      $('#'+id).click(function(){
        $.getJSON("http://localhost:3000/products/"+id,function(data){
          var existingEntries = JSON.parse(localStorage.getItem("Products"));
            if(existingEntries == null){
            existingEntries = [];
            }
           var control = existingEntries.find(existingEntries => existingEntries.product._id === id);
           if(control) {
           alert("Ürünü daha önceden eklemiştiniz");
          } else {
           alert("Ürün Eklendi");
           localStorage.setItem("Products", JSON.stringify(data));
           existingEntries.push(data);
           localStorage.setItem("Products", JSON.stringify(existingEntries));
            for (var i=0;i<existingEntries.length;i++) {
              var existingEntries = JSON.parse(localStorage.getItem("Products"));
              existingEntries[i].product["amount"]="1";
            }
          localStorage.setItem("Products", JSON.stringify(existingEntries));
         }
      });
    });
});
  </script>
</html>
