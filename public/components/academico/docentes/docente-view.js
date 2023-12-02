class DocenteView {

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
            processing: true,
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
                const $paginate = $('#tabla-data_paginate');
                $paginate.find('ul.pagination').addClass('pagination-sm');

            },
            order: [[0, 'asc']],
            ajax: {
                url: route('hb.academicos.docentes.listar'),
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
                {data: 'fecha_registro', className: 'text-center'},
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
         * Nuevo - alumno
         */
        $('#nuevo').click((e) => {
            e.preventDefault();
            // $('#guardar')[0].reset();
            // $('#modal-docente').find('.modal-title').text('Nuevo Docente')
            // $('#modal-docente').modal('show');
            // $('#guardar').find('[name="id"]').val(0);
            // $('#guardar').find('[name="tipo_documento_id"]').val("").trigger('change.select2');
            // $('#guardar').find('[name="empresa_id"]').val("").trigger('change.select2');
            // $('#guardar').find('[name="sexo"]').val("").trigger('change.select2');
            // $('[name="empresa_id"]').select2({
            //     dropdownParent: $('#modal-formulario')
            // });

            let id = 0,
                tipo ="Nuevo Docente",
                form = $('<form action="'+route('hb.academicos.docentes.formulario')+'" method="POST">'+
                    '<input type="hidden" name="_token" value="'+csrf_token+'" >'+
                    '<input type="hidden" name="id" value="'+id+'" >'+
                    '<input type="hidden" name="tipo" value="'+tipo+'" >'+
                '</form>');
            $('body').append(form);
            form.submit();
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
                // allowOutsideClick: () => !Swal.isLoading()
              }).then((result) => {
                if (result.isConfirmed) {
                    // Swal.fire(
                    //     'Éxito!',
                    //     'Se guardo con éxito!',
                    //     'success'
                    // );
                    window.location.href = route('hb.academicos.docentes.lista');
                }
            })


        });
        /**
         * EDITAR - registro por ID
         */
        $("#tabla-data").on("click", "button.editar", (e) => {
            e.preventDefault();
            let id = $(e.currentTarget).attr('data-id'),
                tipo ="Editar Docente",
                    form = $('<form action="'+route('hb.academicos.docentes.formulario')+'" method="POST">'+
                        '<input type="hidden" name="_token" value="'+csrf_token+'" >'+
                        '<input type="hidden" name="id" value="'+id+'" >'+
                        '<input type="hidden" name="tipo" value="'+tipo+'" >'+
                    '</form>');
                $('body').append(form);
            form.submit();
        });

        /**
         * Eliminar - Eliminar registro por ID
         */
        $("#tabla-data").on("click", "button.eliminar", (e) => {
            let model = this.model;
            let id = $(e.currentTarget).attr('data-id');

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
                // allowOutsideClick: () => !Swal.isLoading()
              }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire(
                        'Éxito!',
                        'Se elimino con éxito!',
                        'success'
                    );
                    $('#tabla-data').DataTable().ajax.reload();
                    $('#modal-docente').modal('hide');
                }
            })
        });
        /*
        *
        *Buscador de docentes por numero de documento
        *
        */
        $("#guardar").on("change", '[data-search="numero_documento"]', (e) => {
            let id = $('#guardar').find('input[name="id"]').val();
            let nro_documento = $(e.currentTarget).val();
            let form = $('#guardar');

            this.model.buscarPersona(id,nro_documento).then((respuesta) => {
                if (respuesta.success === true) {
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
                    // form.find('[name="fecha_cumpleaños"]').val(respuesta.persona.fecha_cumpleaños);
                    // form.find('[name="fecha_caducidad_dni"]').val(respuesta.persona.fecha_caducidad_dni);

                    form.find('[name="email"]').val(respuesta.usuario.email);
                    form.find('[name="empresa_id"]').val(respuesta.usuario.empresa_id).trigger('change.select2');
                    // if (respuesta.success === true) {
                    //     Swal.fire(
                    //         'Alerta!',
                    //         'Este número de documento ya se encuentra en uso!',
                    //         'warning'
                    //     );
                    //     $(e.currentTarget).val('');
                    // }
                }else{
                    form.find('[name="id"]').val(0);
                }

            }).fail((respuesta) => {
                // return respuesta;
            }).always(() => {
            });
        });

    }
}



