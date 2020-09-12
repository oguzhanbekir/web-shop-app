$(document).ready(function(){
    var login='';
    if (localStorage.getItem('Token')!=null) {
      login = '<a id="myaccount" class="btn btn-secondary btn-md" href="myaccount.php" role="button"><i class="fas fa-sign-in-alt"></i>&nbspHesabım</a> <a id="logout" class="btn btn-secondary btn-md text-white" role="button"><i class="fas fa-sign-in-alt"></i>&nbspÇıkış Yap</a>';
    } else {
      login ='<a id="login" class="btn btn-secondary btn-md" href="login.php" role="button"><i class="fas fa-sign-in-alt"></i>&nbspGiriş Yap</a>';
    }
    $('#top_buttons').append(login);

  $("#logout").click(function () {
       if (localStorage.getItem('Token')==null) {
           alert("Zaten Çıkış Yapmıştınız");
           return;
       }
       alert("Çıkış Başarılı");
       $('#logout').remove();
       $('#myaccount').remove();
       login ='<a id="login" class="btn btn-secondary btn-md" href="login.php" role="button"><i class="fas fa-sign-in-alt"></i>&nbspGiriş Yap</a>';
        $('#top_buttons').append(login);
       localStorage.removeItem('Token');
   });

   $('.top_menu_dataid').click(function(){
         localStorage.setItem('last_page', $(this).attr('id'));
   });
});
