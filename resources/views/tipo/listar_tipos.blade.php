@extends('layouts.smart')


@section('modo', 'Listado')

@section('titulo', 'Tipo de Habitación')

@section('titulo-ref', 'Lista de Tipos de Habitación')

@section('texto','busca, elimina, modifica, exporta en las siguiente lista')

@section('contenido-modal')
    
    <div class="modal fade" id="default-example-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                {!! Form::open(['id' => 'form','class' => 'needs-validation']) !!}

                <div class="modal-header">
                    <h4 id="tituloModal" name="tituloModal" class="modal-title">
                        Agregar Tipo de Habitación
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fal fa-times"></i></span>
                    </button>
                </div>

                <div class="modal-body">

                    
                    {!! Form::hidden('id', null, ['id' => 'id']) !!}
                    
                    <div class="form-group">
                        
                        {!! Form::label('nombre_tipo', 'Tipo', ['class'=>'form-label']) !!}

                        {!! Form::text('nombre_tipo', null, ['id' => 'nombre_tipo', 'class' => 'form-control id-nombre_tipo',
                        'placeholder' => 'Ingrese Tipo...']) !!}
    
                        <div id='mensaje-error-nombre_tipo' class="invalid-feedback">
                        </div>

                    </div>
                    
                    {!! Form::text('id_usuario_fk', '1', ['id' => 'id_usuario_fk']) !!}

                </div>


                <div class="modal-footer">
                
                    {!! link_to('#', 'Guardar', ['id'=>'Guardar','class'=>'btn btn-primary ml-auto']) !!}
                    
                    {!! link_to('#', 'Modificar', ['id'=>'Modificar','class'=>'btn btn-primary ml-auto']) !!}
                
                </div>

                {!! Form::close() !!}

            </div>
        </div>
    </div>
@endsection

@section('contenido-lista')
    <div class="panel-container show">

        <div class="panel-content">

            <div class="frame-wrap">
                <div class="demo">
                    <!-- BOTON NUEVO -->
                    <a href="" onclick="Mostrar('0')" class="btn btn-outline-success" data-toggle="modal" data-target="#default-example-modal">Nuevo</a>
                </div>
            </div>

            <!-- INICIO LISTA -->
            
        <table id="dt-basic-example" class="table table-bordered table-hover table-striped w-100">
            <thead class="bg-primary-600">
                <tr>
                    <th WIDTH="20">Id</th>
                    <th WIDTH="50">Nombre</th>
                    <th WIDTH="100">Usuario</th>
                    <th WIDTH="30">Opciones</th>
                </tr>
            </thead>
            
            <tfoot>
                
                <tr>
                    <th WIDTH="20">Id</th>
                    <th WIDTH="50">Nombre</th>
                    <th WIDTH="100">Usuario</th>
                    <th WIDTH="30">Opciones</th>
                </tr>

            </tfoot>
        </table>

            <!-- FIN LISTA -->


        </div>

    </div>
@endsection

@section('scripts')

<script>


    var click= false;

    // PARA EVITAR EL ENTER
    document.addEventListener('DOMContentLoaded', () => {
      document.querySelectorAll('input[type=text]').forEach( node => node.addEventListener('keypress', e => {
        if(e.keyCode == 13) {
          e.preventDefault();
          //alert('PRESIONASTE EL ENTER :v');
        }
      }))
    });

    $(document).ready(function() {

        // PRUEBA DE ATAJOS
        $(document).on('keydown', null,'ctrl+y', function(){
            alert('Ctrl + y');
        });
        
        $(document).on('keydown', null,'ctrl+m', function(){
            $('#default-example-modal').modal('hide');
        });

        
        // INICIALIZO LISTA
        $('#dt-basic-example').dataTable({

            'processing':true,
            'serverSide': true,
            "ajax": "{{ route('tipo.listar') }}",
            "columns": [
                {data: 'id'},
                {data: 'nombre_tipo'},
                {data: 'id_usuario_fk'},
                {data: 'action', "orderable": false, searchable: false},
            ],

            responsive: true,
            lengthChange: false,
            dom: "<'row mb-3'<'col-sm-12 col-md-6 d-flex align-items-center justify-content-start'f><'col-sm-12 col-md-6 d-flex align-items-center justify-content-end'lB>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
            buttons: [
                /*{
                extend:    'colvis',
                text:      'Column Visibility',
                titleAttr: 'Col visibility',
                className: 'mr-sm-3'
                },*/
                {
                    extend: 'pdfHtml5',
                    text: 'PDF',
                    titleAttr: 'Generar PDF',
                    className: 'btn-outline-danger btn-sm mr-1'
                },
                {
                    extend: 'excelHtml5',
                    text: 'Excel',
                    titleAttr: 'Generar Excel',
                    className: 'btn-outline-success btn-sm mr-1'
                },
                {
                    extend: 'csvHtml5',
                    text: 'CSV',
                    titleAttr: 'Generar CSV',
                    className: 'btn-outline-primary btn-sm mr-1'
                },
                {
                    extend: 'copyHtml5',
                    text: 'Copiar',
                    titleAttr: 'Copiar al portapapeles',
                    className: 'btn-outline-primary btn-sm mr-1'
                },
                {
                    extend: 'print',
                    text: 'Imprimir',
                    titleAttr: 'Imprimir Tabla',
                    className: 'btn-outline-primary btn-sm'
                }
            ], 
            "language":{
                "sProcessing": "Procesando..."
            }
        });

        // GUARDAR
        $("#Guardar").click(function(event){
       
            // EL DOBLE CLICK
            
            if(click){
                //alert("Ya clickeaste mrd");
            } else {
                
                click = true;
                    
                // TOKEN
                var token = $("input[name=_token]").val();

                var ruta = "{{ route('tipo.store') }}";

                /*
                // Obtendo formulario
                var form = $('#form')[0];

                // Crea un FormData Object
                var datos = new FormData(form);
                */

                var datos = $('#form').serialize();
                //var datos = "nombre_area="+nombre+"&condicion_area="+condicion;

                //alert(datos);

                $.ajax({
                    url: ruta,
                    headers: {'X-CSRF-TOKEN': token},
                    type: 'post',
                    datatype: 'json',
                    //processData: false,
                    //contentType: false,
                    data: datos,
                    success: function(data){
                        if(data.success == 'true'){
                            // Recarga lista
                            setTimeout(function(){$('#dt-basic-example').DataTable().ajax.reload(null, false);}, 1000);
                            
                            // Cierra Modal
                            $('#default-example-modal').modal('hide');
                            
                            // Muestra alerta
                            
                            Swal.fire({
                                type: "success",
                                title: "Tipo de habitación insertado correctamento",
                                showConfirmButton: false,
                                timer: 1500
                            });

                        } else {
                            Swal.fire({
                                type: "error",
                                title: "Tipo de habitación no pudo ser insertado",
                                showConfirmButton: false,
                                timer: 1500
                            });
                        }
                        
                    },
                    error: function(data){
                        
                        if(data.responseJSON.errors == null){

                        } else {

                            if(data.responseJSON.errors.nombre_usuario == null){
                                $('.id-nombre_usuario').removeClass('is-invalid');
                                $("#mensaje-error-nombre_usuario").html('');
                            } else {
                                $('.id-nombre_usuario').addClass('is-invalid');
                                $("#mensaje-error-nombre_usuario").html(data.responseJSON.errors.nombre_usuario);
                            }
                            
                            
                            if(data.responseJSON.errors.email_usuario == null){
                                $('.id-email_usuario').removeClass('is-invalid');
                                $("#mensaje-error-email_usuario").html('');    
                            } else {
                                $('.id-email_usuario').addClass('is-invalid');
                                $("#mensaje-error-email_usuario").html(data.responseJSON.errors.email_usuario);
                            }
                            
                            if(data.responseJSON.errors.contraseña_usuario == null){
                                $('.id-contraseña_usuario').removeClass('is-invalid');
                                $("#mensaje-error-contraseña_usuario").html('');    
                            } else {
                                $('.id-contraseña_usuario').addClass('is-invalid');
                                $("#mensaje-error-contraseña_usuario").html(data.responseJSON.errors.contraseña_usuario);
                            }

                            if(data.responseJSON.errors.contraseña_usuario_confirmation == null){
                                $('.id-contraseña_usuario-2').removeClass('is-invalid');
                                $("#mensaje-error-contraseña_usuario-2").html('');    
                            } else {
                                $('.id-contraseña_usuario-2').addClass('is-invalid');
                                $("#mensaje-error-contraseña_usuario-2").html(data.responseJSON.errors.contraseña_usuario_confirmation);
                            }

                        }
                        
                        console.log(data.responseJSON.errors);
                        $("#campo-alertas").fadeIn();

                        click=false;                        
                    }
                });
            }

        });
        
        // MODIFICAR
        $("#Modificar").click(function(e){

            // EL DOBLE CLICK
            
            if(click){
                //alert("Ya clickeaste mrd");
            } else {
                // DATOS
                var id = $("#id").val();
                var nombre = $("#nombre_tipo").val();
                var id_tipo = $("#id_usuario_fk").val();
                
                // TOKEN
                var token = $("input[name=_token]").val();

                var ruta = "{{url('tipo')}}/"+id+"";

                var datos = "id="+id+"&nombre_tipo="+nombre+"&id_usuario_fk="+id_tipo;
                //alert(datos);
                
                //var datos = $('#form').serialize();
                //var datos = $('#form').serialize();
                
                $.ajax({
                    url: ruta,
                    headers: {'X-CSRF-TOKEN': token},
                    type: 'PUT',
                    datatype: 'json',
                    data: datos,
                    success: function(data){
                        if(data.success == 'true'){
                            // Recarga lista
                            setTimeout(function(){$('#dt-basic-example').DataTable().ajax.reload(null, false);}, 1000);
                            
                            // Cierra Modal
                            $('#default-example-modal').modal('hide');
                            
                            // Muestra alerta
                            Swal.fire({
                                type: "success",
                                title: "Tipo de habitación modificado correctamente",
                                showConfirmButton: false,
                                timer: 1500
                            });

                        } else {
                            Swal.fire({
                                type: "error",
                                title: "Tipo de habitación no pudo ser modificado",
                                showConfirmButton: false,
                                timer: 1500
                            });
                        }
                    },
                    error: function(data){
                        
                        if(data.responseJSON.errors == null){

                        } else {

                            if(data.responseJSON.errors.nombre_tipo == null){
                                $('.id-nombre_tipo').removeClass('is-invalid');
                                $("#mensaje-error-nombre_tipo").html('');
                            } else {
                                $('.id-nombre_tipo').addClass('is-invalid');
                                $("#mensaje-error-nombre_tipo").html(data.responseJSON.errors.nombre_tipo);
                            }
                            
                        }

                        console.log(data.responseJSON.errors);
                        //$("#campo-alertas").fadeIn();
                        
                        click=false;
                    }
                });
            }
        
        });

    });


    // ELIMINAR
    var Eliminar = function(id,nom){

        var swalWithBootstrapButtons = Swal.mixin(
        {
            customClass:
            {
                confirmButton: "btn btn-primary",
                cancelButton: "btn btn-danger mr-2"
            },
            buttonsStyling: false
        });
        swalWithBootstrapButtons
            .fire(
            {
                title: "¿Desea eliminar el tipo de habitación ' "+ nom + "'?",
                //text: "You won't be able to revert this!",
                type: "warning",
                showCancelButton: true,
                confirmButtonText: "Sí, deseo eliminar!",
                cancelButtonText: "No, cancelar!",
                reverseButtons: true
            })
            .then(function(result)
            {
                if (result.value){
                    
                    // SE ELIMINA EL REGISTRO
                    
                    var token = $("input[name=_token]").val();
                    var ruta = "{{url('tipo')}}/"+id+"";

                    $.ajax({
                        url: ruta,
                        headers: {'X-CSRF-TOKEN': token},
                        type: 'DELETE',
                        datatype: 'json',
                        success: function(data){
                            if(data.success == 'true'){
                                // Recarga lista
                                setTimeout(function(){$('#dt-basic-example').DataTable().ajax.reload(null, false);}, 1000);
                                
                                // Cierra Modal
                                $('#default-example-modal').modal('hide');
                                
                                // Muestra alerta

                                swalWithBootstrapButtons.fire(
                                    "¡Eliminado!",
                                    "",
                                    "success"
                                );
                            } else {
                                swalWithBootstrapButtons.fire(
                                    "Cancelado",
                                    "",
                                    "error"
                                );
                            }
                        },
                        error: function(data){
                        }
                    });

                }else if (
                    // Read more about handling dismissals
                    result.dismiss === Swal.DismissReason.cancel
                )
                {
                    swalWithBootstrapButtons.fire(
                        "Cancelado",
                        "",
                        "error"
                    );
                }
            });

    }

    // MANDAR DATOS
    var Mostrar = function(id){

        $('#default-example-modal').modal('show');

        limpiarDatos();
        limpiarValidaciones();
        
        click=false;
        
        if(id==0){ // hide()->cerrar, show()->abrir
            
            document.getElementById("tituloModal").innerHTML = "Nuevo Tipo";
            
            $("#Guardar").show();
            $("#Modificar").hide();

        } else {
            
            document.getElementById("tituloModal").innerHTML = "Modificar Tipo";
            
            $("#Guardar").hide(); 
            $("#Modificar").show();
            

            var route = "{{url('tipo')}}/"+id+"/edit";

            $.get(route, function(data){
                $("#id").val(data.id);
                $("#nombre_tipo").val(data.nombre_tipo);
                $("#id_usuario_fk").val(data.id_usuario_fk);
            });

        }


    }

    // CUANDO CIERRAS EL MODAL
    $("#default-example-modal").on("hidden.bs.modal", function(){
        $("#campo-alertas").fadeOut();
        limpiarDatos();
    });

    // LIMPIO FORMULARIO
    var limpiarDatos = function(){
        document.getElementById("form").reset();
    }

    // LIMPIO LAS VALIDACIONES
    var limpiarValidaciones = function(){
        $('.id-nombre_tipo').removeClass('is-invalid');
        $("#mensaje-error-nombre_tipo").html('');
        
    }

    </script>

    <!-- PARA LOS CLICKS-->
    <script src="https://rawgit.com/jeresig/jquery.hotkeys/master/jquery.hotkeys.js"></script>

@endsection
