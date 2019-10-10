$(function(){
       $('#login').submit(function(){
        if($('input[name=username]').val() == ""){
         swal({
          title: "Kesalahan",
          text: "Username Tidak Boleh Kosong",
          icon: "warning",
          button: "OK",
        });
       }else if($('input[name=password]').val() == ""){
        swal({
          title: "Kesalahan",
          text: "Password Tidak Boleh Kosong",
          icon: "warning",
          button: "OK",
        });
      }else{
        $.ajax({
          type : "POST",
          url : base_url()+'/home/login',
          data : $(this).serialize(),
          success : function(data){
           if(data == 'Y'){
            swal("Sedang Mengalihkan Harap Tunggu Sesaat ....", "Proses Login Berhasil", "success");
            window.location = base_url()+"admin/?gos=Berhasil"; 
          }else{
            swal({
              title: "Kesalahan",
              text: 'Username Dan Password Salah',
              icon: "warning",
              button: "OK ",
            });
          }
        },
        error : function(data){
          swal("Sedang Mengalihkan Harap Tunggu Sesaat ....", "KONEKSI DATABASE TIDAK DI TEMUKAN", "success");
        }
      });

      }
      return false;
    });

    });
