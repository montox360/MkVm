$("document").ready(function(){
                var response = '';
                    if($("#tabla_reporte").length){
                        $(".envio_correos").attr('disabled', false);
                    }
                    $(".aceptar").click(function(){
                        var codigo = '';
                                if($(".envio_correos").is(':checked'))
                                {
                                    var idioma = $("select[name=Idioma]").val();
                                    $('td#Codigo').each(function (){
                                        if( $('td#Codigo:last').attr('code') !== $(this).attr('code'))
                                        {
                                            codigo = codigo + $(this).attr('code') + ", ";
                                        }
                                        else{
                                            codigo = codigo + $(this).attr('code');
                                        }
                                    });
                                    var data = {
                                        "action": "send mail",
                                        "idioma": idioma,
                                        "codigo": codigo                        
                                        };
                                    data = $(this).serialize() + "&" + $.param(data);
                                    $('#divLoading').addClass('show');
                                $.ajax({
                                type: "POST",
                                dataType: "json",
                                url: "./apps/envio_certificados_json.php", 
                                async: false,
                                data: data,
                                success: function(data){ 
                                codigo = data;
                          },
                                error: function(xhr, status, error) {
                                var err = eval("(" + xhr.responseText + ")");
                                alert(err.Message);
                          }
                        })
                    $('td#Codigo').each(function (){
                        
                        if(codigo['json'][$(this).attr('code')] == 'Ok'){
                            $(this).parent().css('background-color', '#2cc469');
                        }
                        else{
                            $(this).parent().css('background-color', '#ebccd1');
                        }
                    })
                    $('#divLoading').removeClass('show');
                    alert("Los casos en verde han sido enviados!!");
                        return false;
                        }
  });
});