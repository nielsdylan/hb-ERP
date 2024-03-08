class ExamenView {

    constructor(model) {
        this.model = model;
    }

    listarCuestionario = () => {
        const $tabla = $('#tabla-data-cuestionario').DataTable({
            destroy: true,
            // dom: 'Bfrtip',
            responsive: true,
            pageLength: 10,
            language: idioma,
            serverSide: true,
            processing: true,
            initComplete: function (settings, json) {
                const $filter = $('#tabla-data-cuestionario_filter');
                const $input = $filter.find('input');
                $filter.append('<button id="btnBuscar" class="btn btn-default btn-sm" type="button" style="border-bottom-left-radius: 0px;border-top-left-radius: 0px;"><i class="fa fa-search"></i></button>');
                $input.addClass('form-control-sm');
                $input.attr('style','border-bottom-right-radius: 0px;border-top-right-radius: 0px;padding-top: 3px;');

                $input.off();
                $input.on('keyup', (e) => {
                    if (e.key == 'Enter') {
                        $('#modal-cuestionario #btnBuscar').trigger('click');
                    }
                });
                $('#modal-cuestionario #btnBuscar').on('click', (e) => {
                    $tabla.search($input.val()).draw();
                });
                $('#tabla-data-cuestionario_length label').addClass('select2-sm');
                //______Select2
                $('.select2').select2({
                    minimumResultsForSearch: Infinity
                });
            },
            drawCallback: function (settings) {
                $('#tabla-data-cuestionario_filter input').prop('disabled', false);
                $('#modal-cuestionario #btnBuscar').html('<i class="fa fa-search"></i>').prop('disabled', false);
                $('#tabla-data-cuestionario_filter input').trigger('focus');
                const $paginate = $('#tabla-data-cuestionario_paginate');
                $paginate.find('ul.pagination').addClass('pagination-sm');
            },
            order: [[0, 'desc']],
            ajax: {
                url: route('hb.academicos.cuestionario.listar'),
                method: 'POST',
                headers: {'X-CSRF-TOKEN': csrf_token}
            },
            columns: [
                {data: 'id', },
                {data: 'codigo', className: 'text-center'},
                {data: 'titulo', className: 'text-center'},
                {data: 'fecha_registro', className: 'text-center'},
                {data: 'seleccionar', orderable: false, searchable: false, className: 'text-center'}
            ]
        });
        $tabla.on('search.dt', function() {
            $('#tabla-data-cuestionario_filter input').attr('disabled', true);
            $('#modal-cuestionario #btnBuscar').html('<i class="fa fa-clock" aria-hidden="true"></i>').prop('disabled', true);
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
        $tabla.buttons().container().appendTo('#tabla-data-cuestionario_wrapper .col-md-6:eq(0)');
    }

    /**
     * Se ejecutan los eventos que nacen de una accion, solo crear funcion a parte de ser necesario
     */

    eventos = () => {


        /**
         *  Agregar examen
         */
        $('.agregar-cuestionario').click((e) => {
            e.preventDefault();
            $('#modal-cuestionario').modal('show');
            // this.listarCuestionario();
        });
        /**
         *  Asignar cuestionario
         */

        $("#tabla-data-cuestionario").on("click", "button.asignar-cuestionario", (e) => {
            e.preventDefault();
            let aula_id = $('[name="aula_id"]').val();
            let cuestionario_id = $(e.currentTarget).attr('data-id');

            let btn_curren = $(e.currentTarget);

            btn_curren.find('i').remove();
            btn_curren.html('<i class="fa fs-14 fa-spinner fa-spin"></i> Cargando...')
            btn_curren.attr('disabled','true');
            this.model.agregarExamen(aula_id, cuestionario_id).then((respuesta) => {
                btn_curren.find('i').remove();
                btn_curren.html('<i class="fa fs-14 fa-check"></i> Seleccionar')
                btn_curren.removeAttr('disabled');
                this.examenes();
            }).fail((respuesta) => {
                // return respuesta;

            }).always(() => {
            });

        });

    }
    examenes = () => {
        let cuestionarios_asignados = $('#cuestionarios-asignados');
        let aula_id = $('[name="aula_id"]').val();
        let html = '';
        this.model.listaExamenes(aula_id).then((respuesta) => {
            console.log(respuesta.data);
            $.each(respuesta.data, function (index, element) {
                console.log(element.aula);
            });

        }).fail((respuesta) => {
            // return respuesta;

        }).always(() => {
        });
    }

}



