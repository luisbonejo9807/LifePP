$(document).ready(function(){
    $('.fixed-action-btn').floatingActionButton();
    $('.sidenav').sidenav();
    $('.tooltipped').tooltip();
    $('#modal1').modal();
    $('input#new_titulo, input#new_descripcion').characterCounter();
    $('select').formSelect();
    $('.collapsible').collapsible();
    $('.materialboxed').materialbox();

    $('#new_btn').click(function(event){
      if($('#new_titulo').val().length>25){
        alert("Límite de caracteres excedido!");
        event.preventDefault();
      }
    });

    $('.sidenav-trigger').show();    
  });