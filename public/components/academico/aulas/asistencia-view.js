class AsistenciaView {

    constructor(model) {
        this.model = model;
    }



    listar = () => {
        const $tabla = $('#tabla-data-asistencia').DataTable({
            destroy: true,
            dom: 'Bfrtip',
            responsive: true,
            pageLength: 50,
            language: idioma,
            serverSide: true,
            processing: true,
            autoFill: {
                enable: false
            },
            buttons:[
                {
                    text: '<span class="fa fa-download text-default"></span> Descargar Asistencia',
                    className:'btn btn-default btn-sm',
                    init: function(api, node, config) {
                        $(node).removeClass('btn-primary')
                    },
                    action: function (e, dt, node, config) {
                        window.open(route('hb.academicos.aulas.descargar-asistencia',{ id: $('[name="aula_id"]').val() }), "Reporte")
                    }
                },
                {
                    text: '<span class="fa fa-file-pdf-o text-default"></span> Reporte de Asistencia',
                    className:'btn btn-default btn-sm',
                    init: function(api, node, config) {
                        $(node).removeClass('btn-primary')
                    },
                    action: function (e, dt, node, config) {
                        window.open(route('hb.academicos.aulas.reporte-asistencia',{ id: $('[name="aula_id"]').val() }), "Reporte")
                    }
                }
            ],
            initComplete: function (settings, json) {
                const $filter = $('#tabla-data-asistencia_filter');
                const $input = $filter.find('input');
                // const $selct_registro = $('[name="tabla-data-asistencia_length"]');
                $filter.append('<button id="btnBuscar" class="btn btn-default btn-sm" type="button" style="border-bottom-left-radius: 0px;border-top-left-radius: 0px;"><i class="fa fa-search text-dark"></i></button>');
                $input.addClass('form-control-sm');
                $input.attr('style','border-bottom-right-radius: 0px;border-top-right-radius: 0px;padding-top: 3px;');

                $('#tabla-data-asistencia_wrapper .dt-buttons.btn-group.flex-wrap').removeAttr('style');
                $('#tabla-data-asistencia_wrapper .dt-buttons.btn-group.flex-wrap').attr('style','position: absolute; inset-block-start: 0;inset-inline-start: 12px;');

                $input.off();
                $input.on('keyup', (e) => {
                    if (e.key == 'Enter') {
                        $('#asistencia-alumnos #btnBuscar').trigger('click');
                    }
                });
                $('#asistencia-alumnos #btnBuscar').on('click', (e) => {
                    $tabla.search($input.val()).draw();
                });
                // $('#tabla-data-asistencia_length label').addClass('select2-sm');
                // //______Select2
                // $selct_registro.select2({
                //     minimumResultsForSearch: Infinity
                // });
            },
            drawCallback: function (settings) {
                $('#tabla-data-asistencia_filter input').prop('disabled', false);
                $('#asistencia-alumnos #btnBuscar').html('<i class="fa fa-search text-dark"></i>').prop('disabled', false);
                $('#tabla-data-asistencia_filter input').trigger('focus');
                const $paginate = $('#tabla-data-asistencia_paginate');
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
            $('#tabla-data-asistencia_filter input').attr('disabled', true);
            $('#asistencia-alumnos #btnBuscar').html('<i class="fa fa-clock text-dark" aria-hidden="true"></i>').prop('disabled', true);
        });
        $tabla.on('init.dt', function(e, settings, processing) {
            // $('#tabla-data-asistencia_length label').addClass('select2-sm');
            // $(e.currentTarget).LoadingOverlay('show', { imageAutoResize: true, progress: true, imageColor: '#3c8dbc' });
        });
        $tabla.on('processing.dt', function(e, settings, processing) {
            if (processing) {
                // $(e.currentTarget).LoadingOverlay('show', { imageAutoResize: true, progress: true, imageColor: '#3c8dbc' });
            } else {
                // $(e.currentTarget).LoadingOverlay("hide", true);
            }
        });
        $tabla.buttons().container().appendTo('#tabla-data-asistencia_wrapper .col-md-6:eq(0)');
    }
    eventos = () => {
        /**
         * se encargara de confirma el ingreso al aula
         */
        $("#tabla-data-asistencia").on("click", "button.ingreso", (e) => {
            e.preventDefault();
            var id = $(e.currentTarget).attr('data-id');
            this.model.ingresoConfirmar(id).then((respuesta) => {
                notif({
                    msg: '<span class="alert-inner--icon"><i class="fe fe-thumbs-up"></i></span>'+
                    '<span class="alert-inner--text"><strong> '+respuesta.titulo+'!</strong> '+respuesta.mensaje+'</span>',
                    type: respuesta.tipo,
                    width: 480,
                });
                $('#tabla-data-asistencia').DataTable().ajax.reload();
            }).fail((respuesta) => {
                // return respuesta;
            }).always(() => {
            });

        });
         /**
         * se encargara de confirma el ingreso al aula
         */
         $("#tabla-data-asistencia").on("click", "button.abandono", (e) => {
            e.preventDefault();
            var id = $(e.currentTarget).attr('data-id');
            this.model.abandonoConfirmar(id).then((respuesta) => {
                notif({
                    msg: '<span class="alert-inner--icon"><i class="fe fe-thumbs-up"></i></span>'+
                    '<span class="alert-inner--text"><strong> '+respuesta.titulo+'!</strong> '+respuesta.mensaje+'</span>',
                    type: respuesta.tipo,
                    width: 480,
                });
                $('#tabla-data-asistencia').DataTable().ajax.reload();
            }).fail((respuesta) => {
                // return respuesta;
            }).always(() => {
            });

        });
    }
}



