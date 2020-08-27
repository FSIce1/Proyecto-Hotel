@extends('layouts.smart')


@section('modo', 'Listado')

@section('titulo', 'Cliente')

@section('titulo-ref', 'Lista de Clientes')

@section('texto','busca, elimina, modifica, exporta en las siguiente lista')

@section('contenido-modal')
    
    <div class="modal fade" id="default-example-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                {!! Form::open(['id' => 'form','class' => 'needs-validation']) !!}

                <div class="modal-header">
                    <h4 id="tituloModal" name="tituloModal" class="modal-title">
                        Agregar CLiente
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fal fa-times"></i></span>
                    </button>
                </div>

                <div class="modal-body">

                    
                    {!! Form::hidden('id', null, ['id' => 'id']) !!}
                    
                    <div class="form-group">
                        
                        {!! Form::label('nombre_cliente', 'Nombre', ['class'=>'form-label']) !!}

                        {!! Form::text('nombre_cliente', null, ['id' => 'nombre_cliente', 'class' => 'form-control id-nombre_cliente',
                        'placeholder' => 'Ejemplo: Juan Pedrito']) !!}
    
                        <div id='mensaje-error-nombre_cliente' class="invalid-feedback">
                        </div>

                    </div>

                    <div class="form-group">
                        
                        {!! Form::label('apellido_cliente', 'Apellido', ['class'=>'form-label']) !!}

                        {!! Form::text('apellido_cliente', null, ['id' => 'apellido_cliente', 'class' => 'form-control id-apellido_cliente',
                        'placeholder' => 'Ejemplo: Villa Salazar']) !!}
    
                        <div id='mensaje-error-apellido_cliente' class="invalid-feedback">
                        </div>

                    </div>

                    <div class="form-group">
                        
                        {!! Form::label('tipo_cliente', 'Tipo', ['class'=>'form-label']) !!}

                        {!! Form::select('tipo_cliente', ['Dni' => 'Dni', 'Ruc' => 'Ruc','Pasaporte' => 'Pasaporte', 'Carnet Extranjero' => 'Carnet Extranjero'], null, ['placeholder' => 'Seleccionar...', 'class' => 'custom-select id-tipo_cliente'])!!}
                        
                        <div id='mensaje-error-tipo_cliente' class="invalid-feedback">
                        </div>
                        
                    </div>

                    <div class="form-group">
                        
                        {!! Form::label('n_documento_cliente', 'Documento', ['n_documento_cliente' => 'label-password','class'=>'form-label']) !!}

                        {!! Form::text('n_documento_cliente', null, ['id' => 'n_documento_cliente', 'class' => 'form-control id-n_documento_cliente',
                        'placeholder' => 'Ejemplo: 72453123']) !!}
    
                        <div id='mensaje-error-n_documento_cliente' class="invalid-feedback">
                        </div>

                    </div>

                    <div class="form-group">
                        
                        {!! Form::label('n_celular_cliente', 'Celular', ['class'=>'form-label']) !!}

                        {!! Form::text('n_celular_cliente', null, ['id' => 'n_celular_cliente', 'class' => 'form-control id-n_celular_cliente',
                        'placeholder' => 'Ejemplo: 979532453']) !!}
    
                        <div id='mensaje-error-n_celular_cliente' class="invalid-feedback">
                        </div>

                    </div>

                    <div class="form-group">
                        
                        {!! Form::label('email_cliente', 'Email', ['class'=>'form-label']) !!}

                        {!! Form::text('email_cliente', null, ['id' => 'email_cliente', 'class' => 'form-control id-email_cliente',
                        'placeholder' => 'Ejemplo: luisfe@gmail.com']) !!}
    
                        <div id='mensaje-error-email_cliente' class="invalid-feedback">
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
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Tipo</th>
                    <th>N° Documento</th>
                    <th>Celular</th>
                    <th>Email</th>
                    <th>Id Usuario</th>
                    <th>Opciones</th>
                </tr>
            </thead>
            
            <tfoot>
                
                <tr>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Tipo</th>
                    <th>N° Documento</th>
                    <th>Celular</th>
                    <th>Email</th>
                    <th>Id Usuario</th>
                    <th>Opciones</th>
                </tr>

            </tfoot>
        </table>

            <!-- FIN LISTA -->


        </div>

    </div>
@endsection

@section('scripts')

    <script>

    /*
        !! Form::select('tipo_cliente', $marcas, null, ['id' => 'tipo_cliente', 'class' =>
    'form-control id-tipo_cliente']) !!

    */


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
            "ajax": "{{ route('cliente.listar') }}",
            "columns": [
                {data: 'id'},
                {data: 'nombre_cliente'},
                {data: 'apellido_cliente'},
                {data: 'tipo_cliente'},
                {data: 'n_documento_cliente'},
                {data: 'n_celular_cliente'},
                {data: 'email_cliente'},
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

                var ruta = "{{ route('cliente.store') }}";

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
                                title: "Cliente insertado correctamento",
                                showConfirmButton: false,
                                timer: 1500
                            });

                        } else {
                            Swal.fire({
                                type: "error",
                                title: "Cliente no pudo ser insertado",
                                showConfirmButton: false,
                                timer: 1500
                            });
                        }
                        
                    },
                    error: function(data){
                        
                        if(data.responseJSON.errors == null){

                        } else {

                            if(data.responseJSON.errors.nombre_cliente == null){
                                $('.id-nombre_cliente').removeClass('is-invalid');
                                $("#mensaje-error-nombre_cliente").html('');
                            } else {
                                $('.id-nombre_cliente').addClass('is-invalid');
                                $("#mensaje-error-nombre_cliente").html(data.responseJSON.errors.nombre_cliente);
                            }
                            
                            if(data.responseJSON.errors.apellido_cliente == null){
                                $('.id-apellido_cliente').removeClass('is-invalid');
                                $("#mensaje-error-email").html('');    
                            } else {
                                $('.id-apellido_cliente').addClass('is-invalid');
                                $("#mensaje-error-apellido_cliente").html(data.responseJSON.errors.apellido_cliente);
                            }
                            
                            if(data.responseJSON.errors.tipo_cliente == null){
                                $('.id-tipo_cliente').removeClass('is-invalid');
                                $("#mensaje-error-tipo_cliente").html('');    
                            } else {
                                $('.id-tipo_cliente').addClass('is-invalid');
                                $("#mensaje-error-tipo_cliente").html(data.responseJSON.errors.tipo_cliente);
                            }

                            if(data.responseJSON.errors.n_documento_cliente == null){
                                $('.id-n_documento_cliente').removeClass('is-invalid');
                                $("#mensaje-error-n_documento_cliente").html('');    
                            } else {
                                $('.id-n_documento_cliente').addClass('is-invalid');
                                $("#mensaje-error-n_documento_cliente").html(data.responseJSON.errors.n_documento_cliente);
                            }

                            if(data.responseJSON.errors.n_celular_cliente == null){
                                $('.id-n_celular_cliente').removeClass('is-invalid');
                                $("#mensaje-error-n_celular_cliente").html('');    
                            } else {
                                $('.id-n_celular_cliente').addClass('is-invalid');
                                $("#mensaje-error-n_celular_cliente").html(data.responseJSON.errors.n_celular_cliente);
                            }

                            if(data.responseJSON.errors.email_cliente == null){
                                $('.id-email_cliente').removeClass('is-invalid');
                                $("#mensaje-error-email_cliente").html('');    
                            } else {
                                $('.id-email_cliente').addClass('is-invalid');
                                $("#mensaje-error-email_cliente").html(data.responseJSON.errors.email_cliente);
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
                var nombre = $("#nombre_cliente").val();
                var apellido = $("#apellido_cliente").val();
                var tipo = $("#tipo_cliente").val();
                var documento = $("#n_documento_cliente").val();
                var celular = $("#n_celular_cliente").val();
                var email = $("#email_cliente").val();
                var id_usuario = $("#id_usuario_fk").val();
                
                
                // TOKEN
                var token = $("input[name=_token]").val();

                var ruta = "{{url('cliente')}}/"+id+"";

                /*
                var datos = "id="+id
                +"&nombre_cliente="+nombre
                +"&apellido_cliente="+apellido
                +"&tipo_cliente="+tipo
                +"&n_documento_cliente="+documento
                +"&n_celular_cliente="+celular
                +"&email_cliente="+email
                +"&id_usuario_fk="+id_usuario
                ;
                */
                //alert(datos);
                var datos = $('#form').serialize();
                
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
                                title: "Cliente modificado correctamente",
                                showConfirmButton: false,
                                timer: 1500
                            });

                        } else {
                            Swal.fire({
                                type: "error",
                                title: "Cliente no pudo ser modificado",
                                showConfirmButton: false,
                                timer: 1500
                            });
                        }
                    },
                    error: function(data){
                        
                        if(data.responseJSON.errors == null){

                        } else {

                            if(data.responseJSON.errors.nombre_cliente == null){
                                $('.id-nombre_cliente').removeClass('is-invalid');
                                $("#mensaje-error-nombre_cliente").html('');
                            } else {
                                $('.id-nombre_cliente').addClass('is-invalid');
                                $("#mensaje-error-nombre_cliente").html(data.responseJSON.errors.nombre_cliente);
                            }
                            
                            if(data.responseJSON.errors.apellido_cliente == null){
                                $('.id-apellido_cliente').removeClass('is-invalid');
                                $("#mensaje-error-email").html('');    
                            } else {
                                $('.id-apellido_cliente').addClass('is-invalid');
                                $("#mensaje-error-apellido_cliente").html(data.responseJSON.errors.apellido_cliente);
                            }
                            
                            if(data.responseJSON.errors.tipo_cliente == null){
                                $('.id-tipo_cliente').removeClass('is-invalid');
                                $("#mensaje-error-tipo_cliente").html('');    
                            } else {
                                $('.id-tipo_cliente').addClass('is-invalid');
                                $("#mensaje-error-tipo_cliente").html(data.responseJSON.errors.tipo_cliente);
                            }

                            if(data.responseJSON.errors.n_documento_cliente == null){
                                $('.id-n_documento_cliente').removeClass('is-invalid');
                                $("#mensaje-error-n_documento_cliente").html('');    
                            } else {
                                $('.id-n_documento_cliente').addClass('is-invalid');
                                $("#mensaje-error-n_documento_cliente").html(data.responseJSON.errors.n_documento_cliente);
                            }

                            if(data.responseJSON.errors.n_celular_cliente == null){
                                $('.id-n_celular_cliente').removeClass('is-invalid');
                                $("#mensaje-error-n_celular_cliente").html('');    
                            } else {
                                $('.id-n_celular_cliente').addClass('is-invalid');
                                $("#mensaje-error-n_celular_cliente").html(data.responseJSON.errors.n_celular_cliente);
                            }

                            if(data.responseJSON.errors.email_cliente == null){
                                $('.id-email_cliente').removeClass('is-invalid');
                                $("#mensaje-error-email_cliente").html('');    
                            } else {
                                $('.id-email_cliente').addClass('is-invalid');
                                $("#mensaje-error-email_cliente").html(data.responseJSON.errors.email_cliente);
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
                title: "¿Desea eliminar el cliente ' "+ nom + "'?",
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
                    var ruta = "{{url('cliente')}}/"+id+"";

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
            
            document.getElementById("tituloModal").innerHTML = "Nuevo Cliente";
            
            $("#Guardar").show();
            $("#Modificar").hide();

        } else {
            
            document.getElementById("tituloModal").innerHTML = "Modificar Cliente";
            
            $("#Guardar").hide(); 
            $("#Modificar").show();

            var route = "{{url('cliente')}}/"+id+"/edit";

            $.get(route, function(data){
                $("#id_cliente").val(data.id);
                $("#nombre_cliente").val(data.nombre_cliente);
                $("#apellido_cliente").val(data.apellido_cliente);
                $("#tipo_cliente").val(data.tipo_cliente);
                $("#n_documento_cliente").val(data.n_documento_cliente);
                $("#n_celular_cliente").val(data.n_celular_cliente);
                $("#email_cliente").val(data.email_cliente);
            });

        }
        
        $("#descripcion_documento").focus();

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

        $('.id-nombre_cliente').removeClass('is-invalid');
        $("#mensaje-error-nombre_cliente").html('');
        
        $('.id-apellido_cliente').removeClass('is-invalid');
        $("#mensaje-error-apellido_cliente").html(''); 

        $('.id-tipo_cliente').removeClass('is-invalid');
        $("#mensaje-error-tipo_cliente").html(''); 

        $('.id-n_documento_cliente').removeClass('is-invalid');
        $("#mensaje-error-n_documento_cliente").html(''); 
        
        $('.id-n_celular_cliente').removeClass('is-invalid');
        $("#mensaje-error-n_celular_cliente").html(''); 

        $('.id-email_cliente ').removeClass('is-invalid');
        $("#mensaje-error-email_cliente").html(''); 

    }

    </script>

    <!-- PARA LOS CLICKS-->
    <script src="https://rawgit.com/jeresig/jquery.hotkeys/master/jquery.hotkeys.js"></script>

@endsection
