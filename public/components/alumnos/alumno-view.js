class AlumnoView {

    constructor(model) {
        this.model = model;
    }

    /**
     * Listar mediante DataTables
     */
    listar = () => {
        const $tabla = $('#tabla-data').DataTable({
            destroy: true,
            // dom: 'Bfrtip',
            responsive: true,
            pageLength: 10,
            language: idioma,
            serverSide: true,
            initComplete: function (settings, json) {
                const $filter = $('#tabla-data_filter');
                const $input = $filter.find('input');
                $filter.append('<button id="btnBuscar" class="btn btn-default btn-sm" type="button" style="border-bottom-left-radius: 0px;border-top-left-radius: 0px;"><i class="fa fa-search"></i></button>');
                $input.addClass('form-control-sm');
                $input.attr('style','border-bottom-right-radius: 0px;border-top-right-radius: 0px;padding-top: 3px;');
                
                $input.off();
                $input.on('keyup', (e) => {
                    if (e.key == 'Enter') {
                        $('#btnBuscar').trigger('click');
                    }
                });
                $('#btnBuscar').on('click', (e) => {
                    $tabla.search($input.val()).draw();
                });
                $('#tabla-data_length label').addClass('select2-sm');
                //______Select2 
                $('.select2').select2({
                    minimumResultsForSearch: Infinity
                });
            },
            drawCallback: function (settings) {
                $('#tabla-data_filter input').prop('disabled', false);
                $('#btnBuscar').html('<i class="fa fa-search"></i>').prop('disabled', false);
                $('#tabla-data_filter input').trigger('focus');

            },
            order: [[0, 'asc']],
            ajax: {
                url: route('hb.academicos.alumnos.listar'),
                method: 'POST',
                headers: {'X-CSRF-TOKEN': csrf_token}
            },
            columns: [
                {data: 'id', },
                {data: 'documento', className: 'text-center'},
                {data: 'apellidos_nombres', className: 'text-center'},
                {data: 'email', className: 'text-center'},
                {data: 'cargo', className: 'text-center'},
                {data: 'celular', className: 'text-center'},
                {data: 'sexo', className: 'text-center'},
                {data: 'fecha_caducidad', className: 'text-center'},
                {data: 'accion', orderable: false, searchable: false, className: 'text-center'}
            ]
        });
        $tabla.on('search.dt', function() {
            $('#tabla-data_filter input').attr('disabled', true);
            $('#btnBuscar').html('<i class="fa fa-clock" aria-hidden="true"></i>').prop('disabled', true);
        });
        $tabla.on('init.dt', function(e, settings, processing) {
            // $('#tabla-data_length label').addClass('select2-sm');
            // $(e.currentTarget).LoadingOverlay('show', { imageAutoResize: true, progress: true, imageColor: '#3c8dbc' });
        });
        $tabla.on('processing.dt', function(e, settings, processing) {
            if (processing) {
                // $(e.currentTarget).LoadingOverlay('show', { imageAutoResize: true, progress: true, imageColor: '#3c8dbc' });
            } else {
                // $(e.currentTarget).LoadingOverlay("hide", true);
            }
        });
        $tabla.buttons().container().appendTo('#tabla-data_wrapper .col-md-6:eq(0)');
    }
    /**
     * Se ejecutan los eventos que nacen de una accion, solo crear funcion a parte de ser necesario
     */

    eventos = () => {


        /**
         * Nuevo - información 
         */
        // $(document).on("click",'[data-action="nuevo"]', (e) => {
        //     e.preventDefault();
        //     // $('#guardar-usuario')[0].reset();
        //     $('#modal-formulario').modal('show');
        //     // $('#modal-formulario').addClass('effect-scale');
            
        // });
        // $(document).on('click','[data-action="nuevo"]',function () {
        //     $('#modal-formulario').modal('show');
        // });
        $('#nuevo').click((e) => {
            e.preventDefault();
            $('#guardar')[0].reset();
            $('#modal-alumno').find('.modal-title').text('Nuevo Alumno')
            $('#modal-alumno').modal('show');
            $('#guardar').find('[name="id"]').val(0);

            // $('[name="empresa_id"]').select2({
            //     dropdownParent: $('#modal-formulario')
            // });
            
        });

        /**
         * Guardar - editar - Cargar información por ID y llenar en el formulario
         */
        // console.log(UsuarioModel());
        $('#guardar').on("submit", (e) => {
            e.preventDefault();
            var data =new FormData($(e.currentTarget)[0]);
            let model = this.model;
            
            Swal.fire({
                title: 'Información',
                text: "¿Está seguro de guardar?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Si, guardar',
                cancelButtonText: 'No, cancelar',
                showLoaderOnConfirm: true,
                preConfirm: (login) => {
                    return model.guardar(data).then((respuesta) => {
                        return respuesta;
                    }).fail((respuesta) => {
                        // return respuesta;
                    }).always(() => {
                    });
                },
                allowOutsideClick: () => !Swal.isLoading()
              }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire(
                        'Éxito!',
                        'Se guardo con éxito!',
                        'success'
                    );
                    // swal({
                    //     title: respuesta.titulo,
                    //     text: respuesta.mensaje,
                    //     type: respuesta.tipo,
                    //     showCancelButton: false,
                    //     // confirmButtonClass: "btn-danger",
                    //     confirmButtonText: "Aceptar",
                    //     closeOnConfirm: true
                    // },
                    // function(){
                        $('#tabla-data').DataTable().ajax.reload();
                        $('#modal-alumno').modal('hide');
                    // });
                }
            })

            
        });
        /**
         * EDITAR - registro por ID
         */
        $("#tabla-data").on("click", "button.editar", (e) => {
            e.preventDefault();
            let id = $(e.currentTarget).attr('data-id');
            let form = $('#guardar');

            this.model.editar(id).then((respuesta) => {
                form.find('[name="id"]').val(respuesta.persona.id);
                form.find('[name="tipo_documento_id"]').val(respuesta.persona.tipo_documento_id).trigger('change.select2');
                form.find('[name="nro_documento"]').val(respuesta.persona.nro_documento);
                form.find('[name="apellido_paterno"]').val(respuesta.persona.apellido_paterno);
                form.find('[name="apellido_materno"]').val(respuesta.persona.apellido_materno);
                form.find('[name="nombres"]').val(respuesta.persona.nombres);
                form.find('[name="sexo"]').val(respuesta.persona.sexo).trigger('change.select2');
                form.find('[name="nacionalidad"]').val(respuesta.persona.nacionalidad);
                form.find('[name="cargo"]').val(respuesta.persona.cargo);
                form.find('[name="telefono"]').val(respuesta.persona.telefono);
                form.find('[name="whatsapp"]').val(respuesta.persona.whatsapp);
                // form.find('[name="path_dni"]').val(respuesta.persona.path_dni);
                form.find('[name="fecha_cumpleaños"]').val(respuesta.persona.fecha_cumpleaños);
                form.find('[name="fecha_caducidad_dni"]').val(respuesta.persona.fecha_caducidad_dni);

                form.find('[name="email"]').val(respuesta.usuario.email);
                form.find('[name="empresa_id"]').val(respuesta.usuario.empresa_id).trigger('change.select2');

                form.find('[name="path_dni"]').removeAttr('required')
                $('#modal-alumno').find('.modal-title').text('Editar Alumno')
                $('#modal-alumno').modal('show');
            }).fail((respuesta) => {
            }).always(() => {
            });
        });

        /**
         * Eliminar - Eliminar registro por ID
         */
        $("#tabla-data").on("click", "button.eliminar", (e) => {
            let model = this.model;
            let id = $(e.currentTarget).attr('data-id');
            // swal({
            //     title: "Eliminar",
            //     text: "¿Está seguro de eliminar?",
            //     type: "warning",
            //     showCancelButton: true,
            //     closeOnConfirm: false,
            //     confirmButtonText: "Si, eliminar!",
            //     showLoaderOnConfirm: true
            //   }, function () {
            //     model.eliminar(id).then((respuesta) => {
                    
            //         swal(respuesta.titulo, respuesta.mensaje, respuesta.tipo);
            //         $('#tabla-data').DataTable().ajax.reload();
            //     }).fail((respuesta) => {
            //     }).always(() => {
            //     });
            // });

            Swal.fire({
                title: 'Eliminar',
                text: "¿Está seguro de eliminar?",
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Si, eliminar',
                cancelButtonText: 'No, cancelar',
                showLoaderOnConfirm: true,
                preConfirm: (login) => {
                    return model.eliminar(id).then((respuesta) => {
                        return respuesta;
                    }).fail((respuesta) => {
                        // return respuesta;
                    }).always(() => {
                    });
                },
                allowOutsideClick: () => !Swal.isLoading()
              }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire(
                        'Éxito!',
                        'Se elimino con éxito!',
                        'success'
                    );
                    $('#tabla-data').DataTable().ajax.reload();
                    $('#modal-alumno').modal('hide');
                }
            })
        });
        
    }
}



