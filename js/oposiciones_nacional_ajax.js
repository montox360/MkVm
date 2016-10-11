$("document").ready(function(){
                var response = '';
                    if($("#tabla_reporte").length){
                        $(".generar_cartas").attr('disabled', false);
                    }
                    $(".aceptar").click(function(){
                        var referencia = '';
                        var clienteid = '';
                        var idmarcabase='';
                        var idmarcaopuesta='';
                        var boletin = $("select[name=boletin]").val();
                        var vencimiento = $("input[name=vencimiento]").val();
                                if($(".generar_cartas").is(':checked'))
                                {
                                    var counter = 1;
                                    $('tr#caso').each(function (){
                                                           if(counter>133)  {                                                                                   
                                        referencia = $(this).children("td:eq(2)").attr("referencia");
                                        clienteid = $(this).children("td:eq(3)").attr("clienteid");
                                        idmarcabase = $(this).children("td:eq(4)").attr("idmarcabase");
                                        idmarcaopuesta = $(this).children("td:eq(5)").attr("idmarcaopuesta");
                                    
                                        var data = {
                                            "action": "generar carta",
                                            "referencia": referencia,
                                            "clienteid": clienteid,
                                            "idmarcabase": idmarcabase,
                                            "idmarcaopuesta": idmarcaopuesta,
                                            "vencimiento": vencimiento,
                                            "boletin": boletin
                                            };
                                        data = $(this).serialize() + "&" + $.param(data);
                                        $('#divLoading').addClass('show');
                                        $.ajax({
                                        type: "POST",
                                        dataType: "json",
                                        url: "./apps/generar_oposiciones.php", 
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
                            } 
                                )
                        alert("Los casos en verde han sido generados!!");
                        return false;
                        }
                      });
                    });