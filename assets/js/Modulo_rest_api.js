    function traer(){
        //var table = $('#dataTable').attr('data-url');
        var contenido = $('#dataTable tbody');
        fetch('../api_modulo/')
         .then(function(res){
             if(res.ok){
                 return res.json();
             }else{
                 throw "Error :'v";
             }
         })
         .then(data => {
                let tabla_contenido = ''; 
                    data.forEach(data => {
                        tabla_contenido += `<tr>
                                            <td><strong>${data.id_modulo}</strong></td>
                                            <td><strong>${data.codigo}</strong></td>
                                            <td>
                                            <strong>${data.nombre}</strong></td>
                                            <td>
                                            <button onclick="modal('{% url 'Academico:editar_modulo' ${data.id_modulo} %}')" class='btn-info btn-circle' title='Editar ${data.nombre}'><i class='fas fa-info-circle'></i></button>
                                            <button onclick="modal('{% url 'Academico:editar_eliminar' ${data.id_modulo} %}')" class="btn btn-danger btn-circle" title="Eliminar ${data.nombre}"><i class="fas fa-trash"></i></button>
                                            </td>
                                            </tr>`;
                        $('#cuerpo').html(tabla_contenido);
                        
                    });
                })
        .catch(function(err){
                console.log(err);
        })
       
        }

    traer();
   



   