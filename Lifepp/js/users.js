(function(){
    var ajaxDiv = document.getElementById("ajax");

    function ajax(){
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function(){
            console.log(xhr.readyState);
            console.log(xhr.status);
            if(xhr.readyState==4 && xhr.status == 200){
                ajaxDiv.innerHTML = xhr.responseText;
            }else if(xhr.status >= 400){
                ajaxDiv.innerHTML = xhr.responseText;
            }              
        }            
        xhr.open("GET","php/userstable.php",true);              
        xhr.setRequestHeader("X-Request-With","XMLHttpRequest");
        xhr.send();
    }//fin ajax
    ajax();
    
    $(document).ready(function(){
        $('#new_us').click(function(event) {
            event.preventDefault();
            var username = $('#new_username').val();
            var pass = $('#new_pass').val();
            var name = $('#new_nombre').val();
            var ape = $('#new_apellido').val();
            var rol = $('#new_rol').val();            
            console.log('starting ajax');
            $.ajax({
              url: "./php/newUser.php",
              type: "post",
              data: { new_username: username, new_pass: pass, new_nombre: name, new_apellido: ape, new_rol : rol },
              success: function (data) {
                // var dataParsed = JSON.parse(data);
                // console.log(dataParsed);
                ajax();
                $('#new_username').val("");
                $('#new_pass').val("");
                $('#new_nombre').val("");
                $('#new_apellido').val("");
                $('#new_rol').val("");
                $("html, body").animate({ scrollTop: 0 }, "slow");
              }
            });
  
          });
    });


})();