

function guardar_menu(){
	var $ = jQuery.noConflict();
	
    if($('#editar').val()=='editar'){
            var descripcion = $('#descripcion').val();
			var modulo =  $('#modulo').val();
			var url =  $('#url').val();
			var name = $('#name').val();
			var lazyname = $('#lazyname').val();
			var view = $('#view').val();
	if (modulo==null){
	   		$('#modulo').toggleClass('is-invalid');
	   		$("#error_modulo").css("display","");
	   		$("#mensaje_modulo").empty();
			$("#mensaje_modulo").append("Este campo no debe estar incompleto. Porfavor seleccione uno de los modulos disponibles.");
			$('#btn_guardar_menu').removeAttr("onclick");
			setTimeout(function(){
			$("#modulo").removeClass('is-invalid');
			$("#error_modulo").css("display","none");
			$('#btn_guardar_menu').attr({onclick: 'guardar_menu()'});
			},3000);
			return;
		}

	if (descripcion==null
	   || descripcion==''
       || /\s/.test(descripcion)
	   || descripcion.length==0){
	   		$('#descripcion').toggleClass('is-invalid');
	   		$("#error_nom_menu").css("display","");
	   		$("#mensaje_menu").empty();
			$("#mensaje_menu").append("Este campo no debe estar incompleto. Porfavor ingresa el nombre del menu");
			$('#btn_guardar_menu').removeAttr("onclick");
			setTimeout(function(){
				$("#descripcion").removeClass('is-invalid');
				$("#error_nom_menu").css("display","none");
				$('#btn_guardar_menu').attr({onclick: 'guardar_menu()'});
				},3000);
			return;
		}


	if (url==null || url=='' || url.length==0 || url.startsWith('Academico:') === false || url === '#' || /\s/.test(url)){
	   		$('#url').toggleClass('is-invalid');
	   		$("#error_url").css("display","");
	   		$("#mensaje_url").empty();
			$("#mensaje_url").append("Porfavor ingresa una url valida para menu. Ejemplo: Academico:ejemplo");
			$('#btn_guardar_menu').removeAttr("onclick");
			setTimeout(function(){
				$("#url").removeClass('is-invalid');
				$("#error_url").css("display","none");
				$('#btn_guardar_menu').attr({onclick: 'guardar_menu()'});
				},3000);
			return;
		}

	if (lazyname==null
	   ||lazyname==''
	   ||lazyname.length==0
	   || /\s/.test(lazyname)){
	   		$('#lazyname').toggleClass('is-invalid');
	   		$("#error_lazy").css("display","");
	   		$("#mensaje_lazy").empty();
			$("#mensaje_lazy").append("Este campo no debe estar incompleto. Porfavor, ingresa un name valido para el menu.");
			$('#btn_guardar_menu').removeAttr("onclick");
			setTimeout(function(){
				$("#lazyname").removeClass('is-invalid');
				$("#error_lazy").css("display","none");
				$('#btn_guardar_menu').attr({onclick: 'guardar_menu()'});
				},3000);
			return;
		}

	if (name==null
	   ||name==''
	   ||name.length==0
	   || /\s/.test(name)){
	   		$('#name').toggleClass('is-invalid');
	   		$("#error_name").css("display","");
	   		$("#mensaje_name").empty();
			$("#mensaje_name").append("Este campo no debe estar incompleto. Porfavor, ingresa un name valido para el menu.");
			$('#btn_guardar_menu').removeAttr("onclick");
			setTimeout(function(){
				$("#name").removeClass('is-invalid');
				$("#error_name").css("display","none");
				$('#btn_guardar_menu').attr({onclick: 'guardar_menu()'});
				},3000);
			return;
		}

	if (view==null
	   ||view==''
	   ||view.length==0
	   || /\s/.test(view)){
	   		$('#view').toggleClass('is-invalid');
	   		$("#error_view").css("display","");
	   		$("#mensaje_view").empty();
			$("#mensaje_view").append("Seleccione el view valido para este menu.");
			$('#btn_guardar_menu').removeAttr("onclick");
			setTimeout(function(){
				$("#view").removeClass('is-warning');
				$("#error_view").css("display","none");
				$('#btn_guardar_menu').attr({onclick: 'guardar_menu()'});
				},3000);
			return;
		}

	var formulario_menu = document.getElementById('registrar_menu');
	var datos = new FormData(formulario_menu);


	fetch('/api_menu/',{
		method : 'POST',
		body : datos
		})
		.then(res => res.json())

		.then(function(data){

							if (data[0] === undefined){
								formulario_menu.submit();
							}

							else{
							console.log(data[0]);
		    				 if(data[0].descripcion == $('#descripcion').val()){
		    				     $('#descripcion').toggleClass('is-invalid');
	   						         $("#error_nom_menu").css("display","");
	   						             $('#btn_guardar_menu').removeAttr("onclick");
							         setTimeout(function(){
							            $("#descripcion").removeClass('is-invalid');
							                $("#error_nom_menu").css("display","none");
							                    $('#btn_guardar_menu').attr({onclick: 'guardar_menu()'});
							        },3000);
		    				 }

		    				if(data[0].url == $('#url').val()){

		    				     $('#url').toggleClass('is-invalid');
	   						         $("#error_url").css("display","");
	   						             $('#btn_guardar_menu').removeAttr("onclick");
							         setTimeout(function(){
							            $("#url").removeClass('is-invalid');
							                $("#error_url").css("display","none");
							                    $('#btn_guardar_menu').attr({onclick: 'guardar_menu()'});
							        },3000);
							     }

							if(data[0].name == $('#name').val() ){
		    				     $('#name').toggleClass('is-invalid');
	   						         $("#error_name").css("display","");
	   						             $('#btn_guardar_menu').removeAttr("onclick");
							         setTimeout(function(){
							            $("#name").removeClass('is-invalid');
							                $("#error_name").css("display","none");
							                    $('#btn_guardar_menu').attr({onclick: 'guardar_menu()'});
							        },3000);
		    				 }

		        			 if(data[0].lazy_name == $('#lazyname').val()){

		        			    	$('#lazyname').toggleClass('is-invalid');
	   		    			    	$("#error_lazyname").css("display","");
	   		    			    	$('#btn_guardar_menu').removeAttr("onclick");

			    			        setTimeout(function(){
							            $("#lazyname").removeClass('is-invalid');
							            $("#error_lazyname").css("display","none");
							            $('#btn_guardar_menu').attr({onclick: 'guardar_menu()'});
							        },3000);

		        			}


							if(data[0].view == $('#view').val()){
		        			    $('#view').toggleClass('is-invalid');
	   		    			        $("#error_view").css("display","");
	   		    			            $('#btn_guardar_menu').removeAttr("onclick");
			    			        setTimeout(function(){
							            $("#view").removeClass('is-invalid');
							                $("#error_view").css("display","none");
							                    $('#btn_guardar_menu').attr({onclick: 'guardar_menu()'});
							        },3000);
		        			}

		        }
		    })

    }
    else{
		var descripcion = $('#descripcion').val();
		var modulo =  $('#modulo').val();
		var url =  $('#url').val();
		var name = $('#name').val();
		var lazyname = $('#lazyname').val();
		var view = $('#view').val();
		if (modulo==null){
	   		$('#modulo').toggleClass('is-invalid');
	   		$("#error_modulo").css("display","");
	   		$("#mensaje_modulo").empty();
			$("#mensaje_modulo").append("Este campo no debe estar incompleto. Porfavor seleccione uno de los modulos disponibles.");
			$('#btn_guardar_menu').removeAttr("onclick");
			setTimeout(function(){
			$("#modulo").removeClass('is-invalid');
			$("#error_modulo").css("display","none");
			$('#btn_guardar_menu').attr({onclick: 'guardar_menu()'});
			},3000);

			return;
			}

		if (descripcion==null
		   || descripcion==''
    	   || /\s/.test(descripcion)
		   || descripcion.length==0){
	   		$('#descripcion').toggleClass('is-invalid');
	   		$("#error_nom_menu").css("display","");
	   		$("#mensaje_menu").empty();
			$("#mensaje_menu").append("Este campo no debe estar incompleto. Porfavor ingresa el nombre del menu");
			$('#btn_guardar_menu').removeAttr("onclick");
			setTimeout(function(){
				$("#descripcion").removeClass('is-invalid');
				$("#error_nom_menu").css("display","none");
				$('#btn_guardar_menu').attr({onclick: 'guardar_menu()'});
				},3000);
			return;
			}


		if (url==null || url=='' || url.length==0 || /\s/.test(url)){
	   		$('#url').toggleClass('is-invalid');
	   		$("#error_url").css("display","");
	   		$("#mensaje_url").empty();
			$("#mensaje_url").append("Porfavor ingresa una url valida para menu. Ejemplo: Academico:ejemplo");
			$('#btn_guardar_menu').removeAttr("onclick");
			setTimeout(function(){
				$("#url").removeClass('is-invalid');
				$("#error_url").css("display","none");
				$('#btn_guardar_menu').attr({onclick: 'guardar_menu()'});
				},3000);
			return;
		}

		if (lazyname==null
		   ||lazyname==''
		   ||lazyname.length==0
		   || /\s/.test(lazyname)){
		   		$('#lazyname').toggleClass('is-invalid');
		   		$("#error_lazy").css("display","");
		   		$("#mensaje_lazy").empty();
				$("#mensaje_lazy").append("Este campo no debe estar incompleto. Porfavor, ingresa un name valido para el menu.");
				$('#btn_guardar_menu').removeAttr("onclick");
				setTimeout(function(){
					$("#lazyname").removeClass('is-invalid');
					$("#error_lazy").css("display","none");
					$('#btn_guardar_menu').attr({onclick: 'guardar_menu()'});
					},3000);
				return;
			}

		if (name==null
		   ||name==''
		   ||name.length==0
		   || /\s/.test(name)){
	   		$('#name').toggleClass('is-invalid');
	   		$("#error_name").css("display","");
	   		$("#mensaje_name").empty();
			$("#mensaje_name").append("Este campo no debe estar incompleto. Porfavor, ingresa un name valido para el menu.");
			$('#btn_guardar_menu').removeAttr("onclick");
			setTimeout(function(){
				$("#name").removeClass('is-invalid');
				$("#error_name").css("display","none");
				$('#btn_guardar_menu').attr({onclick: 'guardar_menu()'});
				},3000);
			return;
			}

		if (view==null
		   ||view==''
		   ||view.length==0
		   || /\s/.test(view)){
	   		$('#view').toggleClass('is-invalid');
	   		$("#error_view").css("display","");
	   		$("#mensaje_view").empty();
			$("#mensaje_view").append("Seleccione el view valido para este menu.");
			$('#btn_guardar_menu').removeAttr("onclick");
			setTimeout(function(){
				$("#view").removeClass('is-warning');
				$("#error_view").css("display","none");
				$('#btn_guardar_menu').attr({onclick: 'guardar_menu()'});
				},3000);
			return;
			}

		var formulario_menu = document.getElementById('registrar_menu');
		var datos = new FormData(formulario_menu);


		fetch('/api_menu/',{
			method : 'POST',
			body : datos
			})
			.then(res => res.json())

			.then(function(data){

							if (data[0] === undefined){
								formulario_menu.submit();
							}
							else{
							console.log(data[0]);
		    				 if(data[0].descripcion == $('#descripcion').val()){
		    				     $('#descripcion').toggleClass('is-invalid');
	   						         $("#error_nom_menu").css("display","");
	   						             $('#btn_guardar_menu').removeAttr("onclick");
							         setTimeout(function(){
							            $("#descripcion").removeClass('is-invalid');
							                $("#error_nom_menu").css("display","none");
							                    $('#btn_guardar_menu').attr({onclick: 'guardar_menu()'});
							        },3000);
		    				 }
		    				if(data[0].url == $('#url').val()){

		    				     $('#url').toggleClass('is-invalid');
	   						         $("#error_url").css("display","");
	   						             $('#btn_guardar_menu').removeAttr("onclick");
							         setTimeout(function(){
							            $("#url").removeClass('is-invalid');
							                $("#error_url").css("display","none");
							                    $('#btn_guardar_menu').attr({onclick: 'guardar_menu()'});
							        },3000);
							     }

							if(data[0].name == $('#name').val() ){
		    				     $('#name').toggleClass('is-invalid');
	   						         $("#error_name").css("display","");
	   						             $('#btn_guardar_menu').removeAttr("onclick");
							         setTimeout(function(){
							            $("#name").removeClass('is-invalid');
							                $("#error_name").css("display","none");
							                    $('#btn_guardar_menu').attr({onclick: 'guardar_menu()'});
							        },3000);
		    				 }

		        			 if(data[0].lazy_name == $('#lazyname').val()){

		        			    	$('#lazyname').toggleClass('is-invalid');
	   		    			    	$("#error_lazyname").css("display","");
	   		    			    	$('#btn_guardar_menu').removeAttr("onclick");

			    			        setTimeout(function(){
							            $("#lazyname").removeClass('is-invalid');
							            $("#error_lazyname").css("display","none");
							            $('#btn_guardar_menu').attr({onclick: 'guardar_menu()'});
							        },3000);

		        			}


							if(data[0].view == $('#view').val()){
		        			    $('#view').toggleClass('is-invalid');
	   		    			        $("#error_view").css("display","");
	   		    			            $('#btn_guardar_menu').removeAttr("onclick");
			    			        setTimeout(function(){
							            $("#view").removeClass('is-invalid');
							                $("#error_view").css("display","none");
							                    $('#btn_guardar_menu').attr({onclick: 'guardar_menu()'});
							        },3000);
		        			}

		        }
		    })
    }

}

function guardar_unidad(){
	var $ = jQuery.noConflict();
		if ($('#editar_empresa').val()=='editar_empresa') {
			var nombre = $('#nombre').val();
			var razon_social =  $('#razon_social').val();
			var correo =  $('#correo').val();
			var identificacion = $('#identificacion').val();

			if (nombre==null){
				$('#nombre').toggleClass('is-invalid');
				$("#error_nombre").css("display","");
				$("#mensaje_nombre").empty();
			 $("#mensaje_nombre").append("Este campo no debe estar incompleto.ingresar nombre");
			 $('#btn_guardar_unidad').removeAttr("onclick");
			 setTimeout(function()
			 {
			 $("#nombre").removeClass('is-invalid');
			 $("#error_nombre").css("display","none");
			 $('#btn_guardar_unidad').attr({onclick: 'guardar_unidad()'});
			 },3000);
 
			 return;
	 }
	 if (razon_social==null
		 || razon_social==''
		 || /\s/.test(razon_social)
		 || razon_social.length==0){
		 $('#razon_social').toggleClass('is-invalid');
				$("#error_razon_social").css("display","");
				$("#mensaje_razon_social").empty();
			 $("#mensaje_razon_social").append("Este campo no debe estar incompleto");
			 $('#btn_guardar_unidad').removeAttr("onclick");
			 setTimeout(function()
			 {
			 $("#razon_social").removeClass('is-invalid');
			 $("#error_razon_social").css("display","none");
			 $('#btn_guardar_unidad').attr({onclick: 'guardar_unidad()'});
			 },3000);
 
			 return;
	 }
 
	 if (correo ==null
		 || correo==''
		 || /\s/.test(correo)
		 || correo.length==0){
		 $('#correo').toggleClass('is-invalid');
				$("#error_correo").css("display","");
				$("#mensaje_correo").empty();
			 $("#mensaje_correo").append("Este campo no debe estar incompleto");
			 $('#btn_correo').removeAttr("onclick");
			 setTimeout(function()
			 {
			 $("#correo").removeClass('is-invalid');
			 $("#error_correo").css("display","none");
			 $('#btn_correo').attr({onclick: 'guardar_unidad()'});
			 },3000);
 
			 return;
	 }
 
	 if (identificacion==null
		 || identificacion==''
		 || /\s/.test(identificacion)
		 || identificacion.length==0){
		 $('#identificacion').toggleClass('is-invalid');
				$("#error_identificacion").css("display","");
				$("#mensaje_identificacion").empty();
			 $("#mensaje_identificacion").append("Este campo no debe estar incompleto");
			 $('#btn_identificacion').removeAttr("onclick");
			 setTimeout(function()
			 {
			 $("#identificacion").removeClass('is-invalid');
			 $("#error_identificacion").css("display","none");
			 $('#btn_identificacion').attr({onclick: 'guardar_unidad()'});
			 },3000);
 
			 return;
	 }
 

		} else {

			var nombre = $('#nombre').val();
			var razon_social =  $('#razon_social').val();
			var correo =  $('#correo').val();
			var identificacion = $('#identificacion').val();
			
			if (nombre==null){
				$('#nombre').toggleClass('is-invalid');
				$("#error_nombre").css("display","");
				$("#mensaje_nombre").empty();
			 $("#mensaje_nombre").append("Este campo no debe estar incompleto.ingresar nombre");
			 $('#btn_guardar_unidad').removeAttr("onclick");
			 setTimeout(function()
			 {
			 $("#nombre").removeClass('is-invalid');
			 $("#error_nombre").css("display","none");
			 $('#btn_guardar_unidad').attr({onclick: 'guardar_unidad()'});
			 },3000);
 
			 return;
	 		}
	 		if (razon_social==null){
		 $('#razon_social').toggleClass('is-invalid');
				$("#error_razon_social").css("display","");
				$("#mensaje_razon_social").empty();
			 $("#mensaje_razon_social").append("Este campo no debe estar incompleto");
			 $('#btn_guardar_unidad').removeAttr("onclick");
			 setTimeout(function()
			 {
			 $("#razon_social").removeClass('is-invalid');
			 $("#error_razon_social").css("display","none");
			 $('#btn_guardar_unidad').attr({onclick: 'guardar_unidad()'});
			 },3000);
 
			 return;
	 		}
 
			if (correo==null|| correo==''|| /\s/.test(correo)|| correo.length==0){
		 		$('#correo').toggleClass('is-invalid');
				$("#error_correo").css("display","");
				$("#mensaje_correo").empty();
			 	$("#mensaje_correo").append("Este campo no debe estar incompleto");
			 	$('#btn_correo').removeAttr("onclick");
			 	setTimeout(function()
			 {
			 $("#correo").removeClass('is-invalid');
			 $("#error_correo").css("display","none");
			 $('#btn_correo').attr({onclick: 'guardar_unidad()'});
			 	},3000);
			 	return;
			}
		
			if (identificacion==null||identificacion==''||/\s/.test(identificacion)||identificacion.length==0){
		 $('#identificacion').toggleClass('is-invalid');
				$("#error_identificacion").css("display","");
				$("#mensaje_identificacion").empty();
			 $("#mensaje_identificacion").append("Este campo no debe estar incompleto");
			 $('#btn_identificacion').removeAttr("onclick");
			 setTimeout(function()
			 {
			 $("#identificacion").removeClass('is-invalid');
			 $("#error_identificacion").css("display","none");
			 $('#btn_identificacion').attr({onclick: 'guardar_unidad()'});
			 },3000);
 
			 return;
			}

			var formulario_unidad = document.getElementById('registrar_unidad');
			var datos = new FormData(formulario_unidad);
			fetch('/api_empresa/',{	method : 'POST',body : datos})
			.then(res => res.json())
			.then(function(data){
							if (data[0] === undefined){
								formulario_unidad.submit();
							}

							else{
		    				 if(data[0].nombre == $('#nombre').val()){
		    				     $('#nombre').toggleClass('is-invalid');
	   						         $("#error_nombre").css("display","");
	   						             $('#btn_guardar_unidad').removeAttr("onclick");
							         setTimeout(function(){
							            $("#nombre").removeClass('is-invalid');
							                $("#error_nombre").css("display","none");
							                    $('#btn_guardar_unidad').attr({onclick: 'guardar_unidad()'});
							        },3000);
		    				 }

		    				if(data[0].razon_social == $('#razon_social').val()){

		    				     $('#razon_social').toggleClass('is-invalid');
	   						         $("#error_razon_social").css("display","");
	   						             $('#btn_razon_social').removeAttr("onclick");
							         setTimeout(function(){
							            $("#razon_social").removeClass('is-invalid');
							                $("#error_razon_social").css("display","none");
							                    $('#btn_guardar_unidad').attr({onclick: 'guardar_unidad()'});
							        },3000);
							     }

							if(data[0].correo == $('#correo').val() ){
		    				     $('#correo').toggleClass('is-invalid');
	   						         $("#error_correo").css("display","");
	   						             $('#btn_guardar_unidad').removeAttr("onclick");
							         setTimeout(function(){
							            $("#correo").removeClass('is-invalid');
							                $("#error_correo").css("display","none");
							                    $('#btn_guardar_unidad').attr({onclick: 'guardar_unidad()'});
							        },3000);
		    				 }

		        			 if(data[0].identificacion == $('#identificacion').val()){

		        			    	$('#identificacion').toggleClass('is-invalid');
	   		    			    	$("#error_identificacion").css("display","");
	   		    			    	$('#btn_guardar_unidad').removeAttr("onclick");

			    			        setTimeout(function(){
							            $("#identificacion").removeClass('is-invalid');
							            $("#error_identificacion").css("display","none");
							            $('#btn_guardar_unidad').attr({onclick: 'guardar_unidad()'});
							        },3000);

		        			}

		        }
			    })
		}

	




function guardar_usuario() {
	var $ = jQuery.noConflict();
	if ($('#editar_usuario').val() == 'editar_usuario') {
		console.log('editar!!!!');
		var usuario = $('#usuario').val();
		if (usuario == null) {
			$('#nombre').toggleClass('is-invalid');
			$("#error_usuario").css("display", "");
			$("#mensaje_usuario").empty();
			$("#mensaje_usuario").append("Este campo no debe estar incompleto.Por favor ingresar usuario.");
			$('#btn_guardar_unidad').removeAttr("onclick");
			setTimeout(function () {
				$("#usuario").removeClass('is-invalid');
				$("#error_nombre").css("display", "none");
				$('#btn_guardar_unidad').attr({onclick: 'guardar_unidad()'});
				}, 3000);

				return;
			}
		}
			var formulario_usuario = document.getElementById('registrar_usuario');
			var datos = new FormData(formulario_usuario);
		}


}












