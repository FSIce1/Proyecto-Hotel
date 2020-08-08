@extends('layouts.smart')


@section('modo', 'Listado')

@section('titulo', 'Usuario')

@section('titulo-ref', 'Lista de Usuarios')

@section('texto','busca, elimina, modifica, exporta en las siguiente lista')

@section('contenido-modal')
    
    <div class="modal fade" id="default-example-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                {!! Form::open(['id' => 'form','class' => 'needs-validation']) !!}

                <div class="modal-header">
                    <h4 id="tituloModal" name="tituloModal" class="modal-title">
                        Agregar Documento
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fal fa-times"></i></span>
                    </button>
                </div>

                <div class="modal-body">

                    
                    {!! Form::hidden('id', null, ['id' => 'id']) !!}
                    
                    <div class="form-group">
                        
                        {!! Form::label('name', 'Usuario', ['class'=>'form-label']) !!}

                        {!! Form::text('name', null, ['id' => 'name', 'class' => 'form-control id-nombre',
                        'placeholder' => 'Ingrese Usuario...']) !!}
    
                        <div id='mensaje-error-nombre' class="invalid-feedback">
                        </div>

                    </div>

                    <div class="form-group">
                        
                        {!! Form::label('email', 'Email', ['class'=>'form-label']) !!}

                        {!! Form::email('email', null, ['id' => 'email', 'class' => 'form-control id-email',
                        'placeholder' => 'Ingrese Email...']) !!}
    
                        <div id='mensaje-error-email' class="invalid-feedback">
                        </div>

                    </div>

                    <div class="form-group">
                        
                        {!! Form::label('password', 'Contraseña', ['id' => 'label-password','class'=>'form-label']) !!}

                        {!! Form::text('password', null, ['id' => 'password', 'class' => 'form-control id-contraseña',
                        'placeholder' => 'Ingrese Contraseña...']) !!}
    
                        <div id='mensaje-error-contraseña' class="invalid-feedback">
                        </div>

                    </div>

                    <div class="form-group">
                        
                        {!! Form::label('password_confirmation', 'Verifica Contraseña', ['id' => 'label-password-confirmation','class'=>'form-label']) !!}

                        {!! Form::text('password_confirmation', null, ['id' => 'password_confirmation', 'class' => 'form-control id-contraseña-2',
                        'placeholder' => 'Confirme Contraseña...']) !!}
    
                        <div id='mensaje-error-contraseña-2' class="invalid-feedback">
                        </div>

                    </div>

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
                    <th WIDTH="50">Usuario</th>
                    <th WIDTH="100">Email</th>
                    <th WIDTH="30">Opciones</th>
                </tr>
            </thead>
            
            <tfoot>
                
                <tr>
                    <th WIDTH="20">Id</th>
                    <th WIDTH="50">Usuario</th>
                    <th WIDTH="100">Email</th>
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
            "ajax": "{{ route('usuario.listar') }}",
            "columns": [
                {data: 'id'},
                {data: 'name'},
                {data: 'email'},
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

                var ruta = "{{ route('usuario.store') }}";

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
                                title: "Usuario insertado correctamento",
                                showConfirmButton: false,
                                timer: 1500
                            });

                        } else {
                            Swal.fire({
                                type: "error",
                                title: "Usuario no pudo ser insertado",
                                showConfirmButton: false,
                                timer: 1500
                            });
                        }
                        
                    },
                    error: function(data){
                        
                        if(data.responseJSON.errors == null){

                        } else {

                            if(data.responseJSON.errors.name == null){
                                $('.id-nombre').removeClass('is-invalid');
                                $("#mensaje-error-nombre").html('');
                            } else {
                                $('.id-nombre').addClass('is-invalid');
                                $("#mensaje-error-nombre").html(data.responseJSON.errors.name);
                            }
                            
                            
                            if(data.responseJSON.errors.email == null){
                                $('.id-email').removeClass('is-invalid');
                                $("#mensaje-error-email").html('');    
                            } else {
                                $('.id-email').addClass('is-invalid');
                                $("#mensaje-error-email").html(data.responseJSON.errors.email);
                            }
                            
                            if(data.responseJSON.errors.password == null){
                                $('.id-contraseña').removeClass('is-invalid');
                                $("#mensaje-error-contraseña").html('');    
                            } else {
                                $('.id-contraseña').addClass('is-invalid');
                                $("#mensaje-error-contraseña").html(data.responseJSON.errors.password);
                            }

                            if(data.responseJSON.errors.password_confirmation == null){
                                $('.id-contraseña-2').removeClass('is-invalid');
                                $("#mensaje-error-contraseña-2").html('');    
                            } else {
                                $('.id-contraseña-2').addClass('is-invalid');
                                $("#mensaje-error-contraseña-2").html(data.responseJSON.errors.password_confirmation);
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
                var nombre = $("#name").val();
                var email = $("#email").val();
                
                // TOKEN
                var token = $("input[name=_token]").val();

                var ruta = "{{url('usuario')}}/"+id+"";

                var datos = "id="+id+"&name="+nombre+"&email="+email;
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
                                title: "Usuario modificado correctamente",
                                showConfirmButton: false,
                                timer: 1500
                            });

                        } else {
                            Swal.fire({
                                type: "error",
                                title: "Usuario no pudo ser modificado",
                                showConfirmButton: false,
                                timer: 1500
                            });
                        }
                    },
                    error: function(data){
                        
                        if(data.responseJSON.errors == null){

                        } else {

                            if(data.responseJSON.errors.name == null){
                                $('.id-nombre').removeClass('is-invalid');
                                $("#mensaje-error-nombre").html('');
                            } else {
                                $('.id-nombre').addClass('is-invalid');
                                $("#mensaje-error-nombre").html(data.responseJSON.errors.name);
                            }
                            
                            
                            if(data.responseJSON.errors.email == null){
                                $('.id-email').removeClass('is-invalid');
                                $("#mensaje-error-email").html('');    
                            } else {
                                $('.id-email').addClass('is-invalid');
                                $("#mensaje-error-email").html(data.responseJSON.errors.email);
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
                title: "¿Desea eliminar el usuario ' "+ nom + "'?",
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
                    var ruta = "{{url('usuario')}}/"+id+"";

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
            
            document.getElementById("tituloModal").innerHTML = "Nuevo Usuario";
            
            $("#Guardar").show();
            $("#Modificar").hide();

            // Muestro
            $("#password").show(); 
            $("#password_confirmation").show(); 
            $("#label-password").show(); 
            $("#label-password-confirmation").show(); 

        } else {
            
            document.getElementById("tituloModal").innerHTML = "Modificar Usuario";
            
            $("#Guardar").hide(); 
            $("#Modificar").show();
            
            // OCULTO MI CAMPOS DE CONTRASEÑAS :v
            $("#password").hide(); 
            $("#password_confirmation").hide(); 
            $("#label-password").hide(); 
            $("#label-password-confirmation").hide(); 

            

            var route = "{{url('usuario')}}/"+id+"/edit";

            $.get(route, function(data){
                $("#id").val(data.id);
                $("#name").val(data.name);
                $("#email").val(data.email);
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
        $('.id-nombre').removeClass('is-invalid');
        $("#mensaje-error-descripcion").html('');
        
        $('.id-email').removeClass('is-invalid');
        $("#mensaje-error-email").html(''); 

        $('.id-contraseña').removeClass('is-invalid');
        $("#mensaje-error-contraseña").html(''); 

        $('.id-contraseña-2').removeClass('is-invalid');
        $("#mensaje-error-contraseña-2").html(''); 
    }

    </script>

    <!-- PARA LOS CLICKS-->
    <script src="https://rawgit.com/jeresig/jquery.hotkeys/master/jquery.hotkeys.js"></script>

@endsection
