class AlumnosView {

    constructor(model) {
        this.model = model;
    }

    alumnos = () => {
        /*
        *
        *Guardar a los alumnos
        *
        */
        $('[name="usuarios"]').on("change", (e) => {
            let data = $('#guardar-alumno').serialize();
            let model = this.model;
            Swal.fire({
                title: 'Información',
                text: "¿Está seguro de guardar?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Si, guardar',
                cancelButtonText: 'No, cancelar',
                showLoaderOnConfirm: true,
                allowOutsideClick: false,
                // backdrop: false, allowOutsideClick: false,
                preConfirm: (login) => {
                    return model.guardarAlumnos(data).then((respuesta) => {
                        return respuesta;
                    }).fail((respuesta) => {
                        // return respuesta;
                    }).always(() => {
                    });
                },
                // allowOutsideClick: () => !Swal.isLoading()
              }).then((result) => {
                if (result.isConfirmed) {
                    if (result.isConfirmed) {

                        Swal.fire({
                            title: result.value.titulo,
                            text: result.value.mensaje,
                            icon: result.value.tipo,
                            showCancelButton: false,
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'Aceptar',
                            allowOutsideClick: false,
                        }).then((resultado) => {
                            if (resultado.isConfirmed) {
                                // window.location.href = route('hb.academicos.aulas.lista');
                                $('#tabla-data').DataTable().ajax.reload();
                            }
                        })
                    }
                }

            })
        });
        $('#guardar-alumno').on("submit", (e) => {
            e.preventDefault();
            let data = $(e.currentTarget).serialize();
            let model = this.model;

            Swal.fire({
                title: 'Información',
                text: "¿Está seguro de guardar?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Si, guardar',
                cancelButtonText: 'No, cancelar',
                showLoaderOnConfirm: true,
                allowOutsideClick: false,
                // backdrop: false, allowOutsideClick: false,
                preConfirm: (login) => {
                    return model.guardarAlumnos(data).then((respuesta) => {
                        return respuesta;
                    }).fail((respuesta) => {
                        // return respuesta;
                    }).always(() => {
                    });
                },
                // allowOutsideClick: () => !Swal.isLoading()
              }).then((result) => {
                if (result.isConfirmed) {
                    if (result.isConfirmed) {

                        Swal.fire({
                            title: result.value.titulo,
                            text: result.value.mensaje,
                            icon: result.value.tipo,
                            showCancelButton: false,
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'Aceptar',
                            allowOutsideClick: false,
                        }).then((resultado) => {
                            if (resultado.isConfirmed) {
                                // window.location.href = route('hb.academicos.aulas.lista');
                                $('#tabla-data').DataTable().ajax.reload();
                            }
                        })


                    }
                }

            })
        });

        /**
         * EDITAR - registro por ID
         */
        $("#tabla-data").on("click", "button.confirmar", (e) => {
            e.preventDefault();
            let model = this.model;
            let id = $(e.currentTarget).attr('data-id');

            model.confirmarAlumnos(id).then((respuesta) => {
                notif({
                    msg: '<span class="alert-inner--icon"><i class="fe fe-thumbs-up"></i></span>'+
                    '<span class="alert-inner--text"><strong> '+respuesta.titulo+'!</strong> '+respuesta.mensaje+'</span>',
                    type: respuesta.tipo,
                    width: 480,
                });
                $('#tabla-data').DataTable().ajax.reload();

                // return respuesta;
            }).fail((respuesta) => {
                // return respuesta;
            }).always(() => {
                // return respuesta;
            });

        });

        /**
         * ELIMINAR
         */
        $("#tabla-data").on("click", "button.eliminar", (e) => {
            e.preventDefault();
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
                    return model.eliminarAlumnos(id).then((respuesta) => {
                        return respuesta;
                    }).fail((respuesta) => {
                        // return respuesta;
                    }).always(() => {
                    });
                },
              }).then((result) => {

                if (result.isConfirmed) {

                    Swal.fire({
                        title: result.value.titulo,
                        text: result.value.mensaje,
                        icon: result.value.tipo,
                        showCancelButton: false,
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Aceptar',
                        allowOutsideClick: false,
                    }).then((resultado) => {
                        if (resultado.isConfirmed) {
                            // window.location.href = route('hb.academicos.aulas.lista');
                            $('#tabla-data').DataTable().ajax.reload();
                        }
                    })
                }

            })
        });



    }

    listarAlumno = () => {
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
                const $selct_registro = $('[name="tabla-data_length"]');
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
                $selct_registro.select2({
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
                url: route('hb.academicos.aulas.listar-alumnos'),
                method: 'POST',
                headers: {'X-CSRF-TOKEN': csrf_token},
                data:{
                    aula_id:$('#guardar-alumno').find('[name="aula_id"]').val()
                }
            },
            columns: [
                {data: 'id', },
                {data: 'numero_documento', className: 'text-center'},
                {data: 'apellidos_nombres', className: 'text-center'},
                {data: 'fecha_registro', className: 'text-center'},
                {data: 'documento', className: 'text-center'},
                {data: 'reservacion', className: 'text-center'},
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

}



