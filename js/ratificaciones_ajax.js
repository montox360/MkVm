$("document").ready(function(){
    var response = '';
        if($("#tabla_reporte").length){
            $(".envio_correos").attr('disabled', false);
        }
        $(".aceptar").click(function(){
            var referencia = '';
            var clienteid = '';
            var idcontacto = '';
            var idmarcabase='';
            var idmarcaopuesta='';
            var escritodoc='';
            var idioma = $("select[name=Idioma]").val();
            
                    if($(".envio_correos").is(':checked'))
                    {
                        var idioma = $("select[name=Idioma]").val();
                        var counter = 1;
                        $('tr#caso').each(function (){
                            if(counter > 0)
                            {
                                                                   
                            referencia = $(this).children("td:eq(1)").attr("referencia");
                            clienteid = $(this).children("td:eq(2)").attr("clienteid");
                            idcontacto = $(this).children("td:eq(3)").attr("idcontacto")
                            idmarcabase = $(this).children("td:eq(4)").attr("idmarcabase");
                            idmarcaopuesta = $(this).children("td:eq(5)").attr("idmarcaopuesta");
                        
                            var data = {
                                "action": "send mail",
                                "idioma": idioma,
                                "referencia": referencia,
                                "clienteid": clienteid,
                                "idcontacto": idcontacto,
                                "idmarcabase": idmarcabase,
                                "idmarcaopuesta": idmarcaopuesta,
                                "idioma" : idioma,
                                };
                            data = $(this).serialize() + "&" + $.param(data);
                            $('#divLoading').addClass('show');
                            $.ajax({
                            type: "POST",
                            dataType: "json",
                            url: "./apps/envio_ratificaciones_json.php", 
                            async: false,
                            data: data,
                            success: function(data){ 
                            resp = data;
                             if(resp['json'][referencia] == 'Ok'){
                                    $('tr:eq('+counter+')').css('background-color', '#2cc469');
                                    $('#divLoading').removeClass('show');
                                    
                                }
                                else{
                                     $('tr:eq('+counter+')').css('background-color', '#2cc469');
                                    $('#divLoading').removeClass('show');
                                }
                            },
                            error: function(xhr, status, error) {
                            var err = eval("(" + xhr.responseText + ")");
                            alert(err.Message);
                      }}
                      );}
                    counter = counter + 1;
                    })
            alert("Los casos en verde han sido enviados!!");
            return false;
            }
          });
        });