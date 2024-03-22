class CuestionarioView {

    constructor(model) {
        this.model = model;
    }

    cuestionario = () => {
        let id = $('[name="cuestionario_id"]').val();

        if (parseInt(id)>0) {
            this.model.obtenerCuestionario(id).then((respuesta) => {

                renderizarCuestionario(respuesta.cuestionario)
            }).fail((respuesta) => {
                // return respuesta;
            }).always(() => {
            });
        }
        function renderizarCuestionario(data) {

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
                        ''+(index_pregunta+1)+' '+element_pregunta.pregunta+''+
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
                            '<input type="'+componente+'" class="custom-control-input" name="cuestionario['+key+'][respuesta][]" value="'+id+'" >'+
                            '<span class="custom-control-label">'+element_respuesta.descripcion+'</span>'+
                            '<input type="hidden" name="cuestionario['+key+'][alternativas]['+id+']" value="'+element_respuesta.descripcion+'" >'+
                        '</label>';
                        let control = this_preguntas.find('.custom-controls-stacked');
                        if (control.length>0) {
                            this_preguntas.find('[data-key-respuestas="'+key+'"]').append(html_respuestas);
                        }else{
                            html_respuestas=''+
                            '<div class="col-md-12">'+
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
                            '<textarea class="form-control form-control-sm mb-4" placeholder="Escriba su respuesta..." rows="3" name="cuestionario['+key+'][alternativas]['+id+']"></textarea>'+
                        '</div>'+
                        '';
                        this_preguntas.html(html_respuestas);
                    }
                });
            });
        }
    }

    eventos = () => {
        $('#guardar').submit((e) => {
            e.preventDefault();
            let data = $(e.currentTarget).serialize();
            let curren = $(e.currentTarget);
            this.model.guardarCuestionario(data).then((respuesta) => {
                if (respuesta.tipo == "success") {
                    $('#car-cuestionario').addClass('d-none');
                    $('#cantidad-preguntas').text(respuesta.numero_preguntas);
                    $('#aciertos').text(respuesta.aciertos);
                    $('#notas').text(respuesta.nota);
                    $('#reporte-notas').removeClass('d-none');
                    console.log(respuesta);
                }

            }).fail((respuesta) => {
                // return respuesta;
            }).always(() => {
            });
        });
    }
}
