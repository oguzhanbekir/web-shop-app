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
    <body onload="firstLoad()">

      <div class="header">
        <div class="container">
                 <div class="d-flex">
                    <div class="mr-auto p-2"><a class="navbar-brand" href="index.php"><img src="images/logo.png"></a></div>
                    <div class="p-2 align-self-center" id="top_buttons">
                        <a class="btn btn-secondary btn-md" href="shoppingcart.php" role="button"><i class="fas fa-shopping-cart"></i>&nbspSepetim</a>
                    </div>

                </div>
        </div>
      </div>
          <nav class="navbar navbar-expand-lg navbar-custom" style="background-color: #ff6600;">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
              <i class="fas fa-bars "></i>
            </button>
              <div class="container">
            <div class="collapse navbar-collapse" id="navbarNavDropdown">

              <ul class="navbar-nav mr-auto mt-2 mt-lg-0" id="top_category">
                  <li class="nav-item ">
                      <a class="nav-link" href="index.php" id="Anasayfa">Anasayfa</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link top_menu" href="products.php" id="5c0e5993a0544e3578bc29c4">Yiyecek</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link top_menu" href="products.php" id="5c0e59c5a0544e3578bc29c5">İçecek</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link top_menu" href="products.php" id="5c0e59d0a0544e3578bc29c6">Meyve & Sebze</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link top_menu" href="products.php" id="5c0e59d9a0544e3578bc29c7">Temel Gıda</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link top_menu" href="products.php" id="5c0e59e3a0544e3578bc29c8">Kişisel Bakım</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link top_menu" href="products.php" id="5c0e59eaa0544e3578bc29c9">Temizlik</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link top_menu" href="products.php" id="5c0e59f3a0544e3578bc29ca">Atıştırmalık</a>
                  </li>
                </ul>

              </div>
            </div>
          </nav>
  <div class="container">
    <div class="row mt-3 mb-4">
      <div class="col-12 col-md-3 d-none d-md-block" >
        <div class="row " style="margin-top: 70px;">
          <div class="col">
            <div class="card  scrollspy-example" style="width:100%;background-color:#ff6600;  ">
              <div class="card-header" id="card_header"  style="color:#fff;">
              </div>
              <ul class="list-group list-group-flush productscrollClass" data-spy="scroll" data-target="#list-example" data-offset="0">
                <div id="sub_category" class="list-group">
                      <!--<a class="list-group-item list-group-item-action" href="#" id="product-form-link">deneme</a>;-->
                </div>
              </ul>
            </div>
          </div>
        </div>
      </div>
    <div class="col-12 col-md-9" >

        <div class="row">

              <div class="col-6">
                  <nav aria-label="breadcrumb">
                      <ol class="breadcrumb">
                          <li class="breadcrumb-item"><a href="index.php">Anasayfa</a></li>
                          <li class="breadcrumb-item"><a href="#">Kategori</a></li>
                          <li class="breadcrumb-item active" aria-current="page" id="breadcrumb"></li>
                      </ol>
                  </nav>
              </div>
            
        </div>

        <div class="row" id="products_data">

        </div>
        <nav class="d-flex justify-content-center">
          <ul class="pagination">

          </ul>
        </nav>
      </div>

    </div>
  </div>

  <?php include 'footer.php' ?>

  </body>
  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/main.js"></script>
  <script>
  function productLink(product_link){
    $.getJSON("http://localhost:3000/products?category="+product_link,function(data){

        $.each(data.products, function(k,v){
          $('#'+v._id).click(function(){
              $.getJSON("http://localhost:3000/products/"+v._id,function(data){
              var existingEntries = JSON.parse(localStorage.getItem("Products"));
                if(existingEntries == null){
                existingEntries = [];
                }
               var control = existingEntries.find(existingEntries => existingEntries.product._id === v._id);
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
    });
  }
  function firstLoad(){
    var last_page = localStorage.getItem('last_page');
    if(last_page){

      getProducts(last_page);
      productLink(last_page);

      $.getJSON("http://localhost:3000/categories/"+last_page, function (d) {
        if(d.category.node_id==0){
          $('#card_header').text(d.category.name);
          $('#breadcrumb').text(d.category.name);
        } else {
            $.getJSON("http://localhost:3000/categories/"+d.category.node_id, function (data) {
              $('#card_header').text(data.category.name);
              $('#breadcrumb').text(data.category.name);
            });
        }

      });


      $.getJSON("http://localhost:3000/categories", function (data) {
        var products_cat = "";
        $.each(data.categories, function (key, entry) {
          if(entry.node_id==last_page)
          {
            products_cat += '<a class="list-group-item list-group-item-action top_menu sub_delete" href="#" data-id="'+entry._id+'">'+entry.name+'</a>';
          }
          else if(last_page==entry._id && entry.node_id!=0){

            $.getJSON("http://localhost:3000/categories/"+last_page, function (data1) {
                $.getJSON("http://localhost:3000/categories", function (data) {
                  var products_cat = "";
                  $.each(data.categories, function (key, entry) {
                    if(entry.node_id==data1.category.node_id){
                      products_cat += '<a class="list-group-item list-group-item-action top_menu sub_delete" href="#" data-id="'+entry._id+'">'+entry.name+'</a>';
                    }
                  });
                  $('#sub_category').html(products_cat);
                  $(".sub_delete").click(function(e){
                    var sub_menu = $(this).data('id');
                    getProducts(sub_menu);
                  });
                });
            });
          }
        });
        $('#sub_category').html(products_cat);
        $(".sub_delete").click(function(e){
          var sub_menu = $(this).data('id');
          getProducts(sub_menu);
        });
      });

    }

  }
  function getProducts(id){
    localStorage.setItem('last_page', id);
    products_table();

    function products_table(page_number=1){
      $.getJSON("http://localhost:3000/products?category="+id+"&page="+page_number+"&limit=20",function(data){
          var products_data='', pagenumber_data='' ;

          var count = `${data.sumcount}`;
          var perpage=20;
          var total_pagenumber= Math.ceil(count/perpage);
          if(page_number>1){
                var before=parseInt(page_number)-1;
                pagenumber_data +='<li class="page-item"><a class="page-link" href="#'+before+'"><</a></li>';
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
                pagenumber_data +='<li class="page-item"><a class="page-link" href="#'+next+'">></a></li>';
          }
          $('.pagination').html(pagenumber_data);

          $('.page-item a').click(function(){
            var num_href=$(this).attr('href');
            var num=num_href.split('#');
            products_table(num[1]);
            productLink(id);
          });

          $.each(data.products, function(k,v){

            products_data += ' <div class="col-md-3 mb-2">';
              products_data += '<figure class="card card-product h-100">';
                products_data += '<div class="img-wrap p-3">';
                  products_data += '<img class="product-img" style="cursor: pointer;" data-id="'+v._id+'" src="http://localhost:3000/'+v.productImage+'">';
                products_data += '</div>';
                products_data += '<figcaption class="info-wrap">';
                  products_data += '<p class="title text-dots product_name">'+v.name+'</p><p style="color:#A9A9A9;font-size:15px">'+v.description+'</p>';
                  products_data += '<div class="action-wrap">';
                    products_data += '<div class="price-wrap h6">';
                    products_data += '</div>';
                    products_data += '<a href="#" class="btn btn-success btn-sm btn-block pull-bottom" style="position:absolute;right:0;bottom:0;" id="'+v._id+'"><i class="fas fa-shopping-cart"></i> Sepete Ekle</a>';
                  products_data += '</div>';
                products_data += '</figcaption>';
              products_data += '</figure>';
            products_data += '</div>';
            });

            $('#products_data').html(products_data);

            $('.product-img').click(function(){
                  location.href="product_detail.php?id="+$(this).data('id');
            });

      });
    }





  /*  $.getJSON("http://localhost:3000/products?category="+id,function(data){
      var products_data='';

        $.each(data.products, function(k,v){

          products_data += ' <div class="col-md-3 mb-2">';
            products_data += '<figure class="card card-product h-100">';
              products_data += '<div class="img-wrap p-3">';
                products_data += '<img class="product-img" style="cursor: pointer;" data-id="'+v._id+'" src="http://localhost:3000/'+v.productImage+'">';
              products_data += '</div>';
              products_data += '<figcaption class="info-wrap">';
                products_data += '<p class="title text-dots product_name">'+v.name+'</p>';
                products_data += '<div class="action-wrap">';
                  products_data += '<div class="price-wrap h6">';
                  products_data += '</div>';
                  products_data += '<a href="#" class="btn btn-success btn-sm btn-block pull-bottom" style="position:absolute;right:0;bottom:0;" id="'+v._id+'">Sepete Ekle</a>';
                products_data += '</div>';
              products_data += '</figcaption>';
            products_data += '</figure>';
          products_data += '</div>';
          });

          $('#products_data').html(products_data);

          $('.product-img').click(function(){
                location.href="product_detail.php?id="+$(this).data('id');
          });
    });*/
  }
  $(document).ready(function(){

    $(".top_menu").click(function(e){
      e.preventDefault();
        var top_menu_name = $(this).text();
        var top_menu = $(this).attr('id');

        $('#card_header').text(top_menu_name);
        $('#breadcrumb').text(top_menu_name);

          $.getJSON("http://localhost:3000/categories", function (data) {
            var products_cat = "";
            $.each(data.categories, function (key, entry) {
              if(entry.node_id==top_menu)
              {
                products_cat += '<a class="list-group-item list-group-item-action top_menu sub_delete" href="#" data-id="'+entry._id+'">'+entry.name+'</a>';
              }
            });

            $('#sub_category').html(products_cat);
            $(".sub_delete").click(function(e){
              var sub_menu = $(this).data('id');
              getProducts(sub_menu);
              productLink(sub_menu);
            });
          });
        getProducts(top_menu);
        productLink(top_menu);
    });

  });

  </script>
</html>
