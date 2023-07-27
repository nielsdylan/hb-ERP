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
                $input.attr('style','border-bottom-right-radius: 0px;border-top-right-radius: 0px;padding-top: 2px;');
                
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
                {data: 'nro_documento', className: 'text-center'},
                {data: 'apellido_paterno', className: 'text-center'},
                {data: 'nombres', className: 'text-center'},
                {data: 'fecha_caducidad_dni', className: 'text-center'},
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
            $('#modal-formulario').find('.modal-title').text('Nuevo Nivel')
            $('#modal-formulario').modal('show');
            $('#guardar').find('[name="id"]').val(0);
            $('#modal-formulario').addClass('effect-scale');

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
            var data =$(e.currentTarget).serialize();
            let model = this.model;
            
            swal({
                title: "Información",
                text: "Esta seguro de guardar el registro",
                type: "info",
                showCancelButton: true,
                closeOnConfirm: false,
                confirmButtonText: "Si, guardar!",
                showLoaderOnConfirm: true
              }, function () {
                model.guardar(data).then((respuesta) => {
                    swal({
                        title: respuesta.titulo,
                        text: respuesta.mensaje,
                        type: respuesta.tipo,
                        showCancelButton: false,
                        // confirmButtonClass: "btn-danger",
                        confirmButtonText: "Aceptar",
                        closeOnConfirm: true
                      },
                      function(){
                        $('#tabla-data').DataTable().ajax.reload();
                        $('#modal-formulario').modal('hide');
                        // location.href=route("erp.configuracion-general.habitaciones.lista");
                    });
                }).fail((respuesta) => {
                }).always(() => {
                });
            });
            
        });
        /**
         * EDITAR - registro por ID
         */
        $("#tabla-data").on("click", "button.editar", (e) => {
            e.preventDefault();
            let id = $(e.currentTarget).attr('data-id');
            let form = $('#guardar');

            this.model.editar(id).then((respuesta) => {
                form.find('[name="id"]').val(respuesta.id);
                form.find('[name="nombre"]').val(respuesta.nombre);
                form.find('[name="moneda_id"]').val(respuesta.moneda_id).trigger('change.select2');
                form.find('[name="precio"]').val(respuesta.precio);
                form.find('[name="nivel_id"]').val(respuesta.nivel_id).trigger('change.select2');
                form.find('[name="habitacion_estado_id"]').val(respuesta.habitacion_estado_id).trigger('change.select2');
                form.find('[name="tipo_habitacion_id"]').val(respuesta.tipo_habitacion_id).trigger('change.select2');
                form.find('[name="descripcion"]').val(respuesta.descripcion);
                $('#modal-formulario').find('.modal-title').text('Editar Nivel')
                $('#modal-formulario').modal('show');
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
            swal({
                title: "Eliminar",
                text: "¿Está seguro de eliminar?",
                type: "warning",
                showCancelButton: true,
                closeOnConfirm: false,
                confirmButtonText: "Si, eliminar!",
                showLoaderOnConfirm: true
              }, function () {
                model.eliminar(id).then((respuesta) => {
                    
                    swal(respuesta.titulo, respuesta.mensaje, respuesta.tipo);
                    $('#tabla-data').DataTable().ajax.reload();
                }).fail((respuesta) => {
                    // swal(respuesta.titlo, respuesta.mensaje, respuesta.tipo);
                }).always(() => {
                    // $boton.html();
                });
            });

           
        });
        
    }
}



