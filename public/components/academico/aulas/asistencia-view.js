class AsistenciaView {

    constructor(model) {
        this.model = model;
    }



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
                url: route('hb.academicos.aulas.listar-asistencia'),
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
                {data: 'asistencia', className: 'text-center'},
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
    eventos = () => {
        /**
         * se encargara de confirma el ingreso al aula
         */
        $("#tabla-data").on("click", "button.ingreso", (e) => {
            e.preventDefault();
            var id = $(e.currentTarget).attr('data-id');
            this.model.ingresoConfirmar(id).then((respuesta) => {
                notif({
                    msg: '<span class="alert-inner--icon"><i class="fe fe-thumbs-up"></i></span>'+
                    '<span class="alert-inner--text"><strong> '+respuesta.titulo+'!</strong> '+respuesta.mensaje+'</span>',
                    type: respuesta.tipo,
                    width: 480,
                });
                $('#tabla-data').DataTable().ajax.reload();
            }).fail((respuesta) => {
                // return respuesta;
            }).always(() => {
            });

        });
         /**
         * se encargara de confirma el ingreso al aula
         */
         $("#tabla-data").on("click", "button.abandono", (e) => {
            e.preventDefault();
            var id = $(e.currentTarget).attr('data-id');
            this.model.abandonoConfirmar(id).then((respuesta) => {
                notif({
                    msg: '<span class="alert-inner--icon"><i class="fe fe-thumbs-up"></i></span>'+
                    '<span class="alert-inner--text"><strong> '+respuesta.titulo+'!</strong> '+respuesta.mensaje+'</span>',
                    type: respuesta.tipo,
                    width: 480,
                });
                $('#tabla-data').DataTable().ajax.reload();
            }).fail((respuesta) => {
                // return respuesta;
            }).always(() => {
            });

        });
    }
}



