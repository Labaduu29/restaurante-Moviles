$(document).ready(function(){	   
    
    $(document).on("click", "#btn_pedido", function(){
        var fila=$('#tr_pedido').html();		
		
        $('#tbody_pedido').append("<tr>"+fila+"</tr>");                       
                
    });
      
    $(document).on("click", ".eliminar", function(){
            $(this).parent().parent().remove();
    });
       
    $(".select2").select2();
    $(".tables").DataTable();
	
	$(document).on("click", "#btn_reporteVenta", function(){	
		console.log($('#frm_reporteVenta').serializeArray());
		/*var url=$(this).attr('data-url');
		var cliente=$('#cliente').val();
		var mesero=$('#mesero').val();
		var fechaini=$('#fechaini').val();
		var fechafin=$('#fechafin').val();
		alert(cliente);
		$.ajax({
			url: url,
			data:"cliente="+cliente+"&mesero="+mesero+"&fechaini="+fechaini+"&fechafin="+fechafin,
			type:"POST",		
			success: function(registros){		
				el = document.getElementById('div_contenidoReporte_JALF');
				el.innerHTML = registros;			
				
			}
		});*/
	});
});


   
