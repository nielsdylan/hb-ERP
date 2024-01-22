class ResultadosView {

    constructor(model) {
        this.model = model;
    }

    listar = () => {
        const $tabla = $('#tabla-data').DataTable({
            destroy: true,
            // dom: 'Bfrtip',
            responsive: true,
            pageLength: 50,
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
                url: route('hb.academicos.cuestionario.resultados-listar'),
                method: 'POST',
                headers: {'X-CSRF-TOKEN': csrf_token},
                data:{
                    id: $('[name="id"]').val()
                }
            },
            columns: [
                {data: 'id', },
                {data: 'numero_documento', className: 'text-center'},
                {data: 'apellidos_nombres', className: 'text-center'},
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
    eventos = () => {
        $("#tabla-data").on("click", "button.ver", (e) => {
            e.preventDefault();
            let id = $(e.currentTarget).attr('data-id');

            this.model.resultadosVer(id).then((respuesta) => {
                console.log(respuesta);
                $('#preguntas').html('');
                renderizarRespuestas(respuesta.cuestionario);
                $('#modal-ver-respuestas').modal('show');
            }).fail((respuesta) => {
                // return respuesta;
            }).always(() => {
            });
        });
        function renderizarRespuestas(data) {

            let preguntas = $('#preguntas');
            let numero_random = 0;

            $.each(data.preguntas, function (index_pregunta, element_pregunta) {
                // numero_random = Math.random();
                numero_random = element_pregunta.id;
                let html = ''+
                '<div class="row mt-3" key="'+numero_random+'">'+
                    '<div class="col-md-12">'+
                        '<input type="hidden" name="cuestionario['+numero_random+'][tipo_pregunta_id]" value="'+element_pregunta.tipo_pregunta_id+'"></input>'+
                        '<input type="hidden" name="cuestionario['+numero_random+'][pregunta]" value="'+element_pregunta.pregunta+'">'+
                        ''+ (index_pregunta+1) + '. ' + element_pregunta.pregunta+''+
                    '</div>'+

                '</div>'+
                '<div class="row mt-3" key="'+numero_random+'" data-seccion="respuestas-'+numero_random+'">'+
                '</div>';
                preguntas.append(html);

                $.each(element_pregunta.respuestas, function (index_respuesta, element_respuesta) {

                    let key = numero_random;
                    let tipo_pregunta_id = element_pregunta.tipo_pregunta_id;
                    let this_preguntas = $('#preguntas').find('[data-seccion="respuestas-'+key+'"]');
                    // let id = Math.floor(Math.random() * 999999);
                    let id = element_respuesta.id;

                    if ( tipo_pregunta_id == '1' || tipo_pregunta_id == '2' ) {

                        let componente = 'checkbox';
                        if (tipo_pregunta_id=='1') {
                            componente = 'radio';
                        }
                        let html_respuestas = ''+
                        '<label class="custom-control custom-'+componente+'">'+
                            '<input type="'+componente+'" class="custom-control-input" name="cuestionario['+key+'][respuesta][]" value="'+id+'" '+(element_respuesta.seleccion==1?'checked':'')+' disabled>'+
                            '<span class="custom-control-label">'+element_respuesta.descripcion+'</span>'+
                            '<input type="hidden" name="cuestionario['+key+'][alternativas]['+id+']" value="'+element_respuesta.descripcion+'" >'+
                        '</label>';
                        let control = this_preguntas.find('.custom-controls-stacked');
                        if (control.length>0) {
                            this_preguntas.find('[data-key-respuestas="'+key+'"]').append(html_respuestas);
                        }else{
                            html_respuestas=''+
                            '<div class="col-md-4">'+
                                '<div class="form-group">'+
                                    '<div class="custom-controls-stacked" data-key-respuestas="'+key+'">'+html_respuestas+
                                    '</div>'+
                                '</div>'+
                            '</div>';
                            this_preguntas.html(html_respuestas);
                        }
                    }

                    if (tipo_pregunta_id == '3') {
                        let html_respuestas = ''+
                        '<div class="col-md-12">'+
                            '<textarea class="form-control form-control-sm mb-4" placeholder="Escriba su respuesta..." rows="3" name="cuestionario['+key+'][alternativas]['+id+']" disabled>'+element_respuesta.descripcion+'</textarea>'+
                        '</div>'+
                        '';
                        this_preguntas.html(html_respuestas);
                    }
                });
            });
        }
    }

}
