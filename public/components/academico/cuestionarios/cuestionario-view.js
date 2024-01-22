class CuestionarioView {

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
                url: route('hb.academicos.cuestionario.listar'),
                method: 'POST',
                headers: {'X-CSRF-TOKEN': csrf_token}
            },
            columns: [
                {data: 'id', },
                {data: 'codigo', className: 'text-center'},
                {data: 'titulo', className: 'text-center'},
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
                    window.location.href = route('hb.academicos.cuestionario.lista');
                }
            })


        });
        /**
         * EDITAR - registro por ID
         */
        $("#tabla-data").on("click", "button.editar", (e) => {
            e.preventDefault();
            let id = $(e.currentTarget).attr('data-id');
            window.location.href = route('hb.academicos.cuestionario.formulario-editar',{id: id});
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
                }
            })
        });
        $("#tabla-data").on("click", "button.generar-link", (e) => {
            let id = $(e.currentTarget).attr('data-id');

            this.model.link(id).then((respuesta) => {
                navigator.clipboard.writeText(respuesta.data)
                .then(() => {
                    Swal.fire(
                        'Éxito!',
                        'Se a copiado el link al portapapeles!',
                        'success'
                    );
                })
                .catch(err => {
                    Swal.fire(
                        'Alerta!',
                        'Ocurrio un error al generar el link.!',
                        'warning'
                    );
                })
            }).fail((respuesta) => {
                // return respuesta;
            }).always(() => {
            });
        });

        /**
         * VER RESULTADOS DEL CUESTIONARIO
         */
        $("#tabla-data").on("click", "button.ver-resultados", (e) => {
            e.preventDefault();
            let id = $(e.currentTarget).attr('data-id');
            window.location.href = route('hb.academicos.cuestionario.resultados',{id: id});
        });

    }

    cuestionario = () => {
        /*
        *   agregamos la pregunta
        */
        $('.nueva-pregunta').click((e) => {
            e.preventDefault();
            let preguntas = $('#preguntas');
            let numero_random = Math.random();
            let html = ''+
            '<div class="row mt-3" key="'+numero_random+'">'+

                '<div class="col-md-8">'+
                    '<input type="hidden" name="cuestionario['+numero_random+'][tipo_pregunta_id]" value=""></input>'+
                    '<input type="text" class="form-control form-control-sm" placeholder="Ingrese su pregunta" name="cuestionario['+numero_random+'][pregunta]">'+
                '</div>'+
                '<div class="col-md-2">'+
                    '<input type="number" class="form-control form-control-sm" placeholder="Ingrese el puntaje" name="cuestionario['+numero_random+'][puntaje]" value="1">'+
                '</div>'+

                '<div class="col-md-2">'+
                    '<div class="btn-group">'+
                        '<button type="button" class="btn btn-sm btn-default dropdown-toggle" data-bs-toggle="dropdown">'+
                                'Tipo de alternativas <span class="caret"></span>'+
                            '</button>'+
                        '<ul class="dropdown-menu" role="menu">'+
                            '<li><a class="agregar-respuesta" href="javascript:void(0)" data-action="agregar-respuesta" data-key="'+numero_random+'" data-tipo-pregunta="1"> Una sola alternativa</a></li>'+
                            '<li><a class="agregar-respuesta" href="javascript:void(0)" data-action="agregar-respuesta" data-key="'+numero_random+'" data-tipo-pregunta="2"> Multi alternativas</a></li>'+
                            '<li><a class="agregar-respuesta" href="javascript:void(0)" data-action="agregar-respuesta" data-key="'+numero_random+'" data-tipo-pregunta="3"> Escritura</a></li>'+
                            '<li class="divider"></li>'+
                            '<li><a class="eliminar-pregunta" href="javascript:void(0)" data-key="'+numero_random+'">Eliminar</a></li>'+
                       ' </ul>'+
                    '</div>'+
                '</div>'+
            '</div>'+
            '<div class="row mt-3" key="'+numero_random+'" data-seccion="respuestas-'+numero_random+'">'+
            '</div>';
            preguntas.append(html);
        });
        /*
        *   agregamos las respuestas dec ada pregunta
        */
        $('#preguntas').on("click", ".agregar-respuesta", (e) => {
            e.preventDefault();
            let tipo_pregunta_id = $(e.currentTarget).attr('data-tipo-pregunta');
            let key = $(e.currentTarget).attr('data-key');
            let this_respuestas = $('#preguntas').find('[data-seccion="respuestas-'+key+'"]');
            let html = '';
            let id = Math.floor(Math.random() * 999999);

            $('#preguntas').find('[key="'+key+'"]').find('[type="hidden"][name="cuestionario['+key+'][tipo_pregunta_id]"]').val(tipo_pregunta_id);
            if ( tipo_pregunta_id == '1' || tipo_pregunta_id == '2' ) {

                let control = this_respuestas.find('.custom-controls-stacked');

                if (control.length>0) {
                    // transformamos las respuesta segun se seleccione
                    if (tipo_pregunta_id == '1') {

                        control.find('.custom-control').removeClass('custom-checkbox');
                        control.find('.custom-control').addClass('custom-radio');
                        control.find('.custom-control-input').removeAttr('type');
                        control.find('.custom-control-input').attr('type','radio');

                    }

                    if (tipo_pregunta_id == '2') {

                        control.find('.custom-control').removeClass('custom-radio');
                        control.find('.custom-control').addClass('custom-checkbox');
                        control.find('.custom-control-input').removeAttr('type');
                        control.find('.custom-control-input').attr('type','checkbox');

                    }
                    this_respuestas.find('button.nueva-alternativa').attr('data-tipo-pregunta',tipo_pregunta_id);
                }else{
                    let componente = 'checkbox';
                    if (tipo_pregunta_id=='1') {
                        componente = 'radio';
                    }

                    html=''+
                    '<div class="col-md-4">'+
                        '<div class="form-group">'+
                            '<div class="custom-controls-stacked" data-key-respuestas="'+key+'">'+
                                '<label class="custom-control custom-'+componente+'">'+
                                    '<input type="'+componente+'" class="custom-control-input" name="cuestionario['+key+'][respuesta][]" value="'+id+'">'+
                                    '<span class="custom-control-label"><input class="form-control form-control-sm" type="text" name="cuestionario['+key+'][alternativas]['+id+']" placeholder="Ingrese su alternativa"></span>'+
                                '</label>'+
                            '</div>'+
                        '</div>'+
                    '</div>'+
                    '<div class="col-md-4 mt-auto">'+
                        '<button type="button" class="btn btn-info btn-sm nueva-alternativa mb-4" data-key="'+key+'" data-tipo-pregunta="'+tipo_pregunta_id+'"><i class="fe fe-plus"></i></button>'
                    '</div>';
                    this_respuestas.html(html);

                }
            }
            // alternaviva donde va el text area
            if ( tipo_pregunta_id == '3' ) {
                html = ''+
                '<div class="col-md-12">'+
                    '<textarea class="form-control form-control-sm mb-4" placeholder="Escriba su respuesta..." rows="2" name="cuestionario['+key+'][alternativas]['+id+']"></textarea>'+
                '</div>'+
                '';
                this_respuestas.html(html);
            }
        });

        /*
        *   agregamos una nueva respuesta
        */
        $('#preguntas').on("click", ".nueva-alternativa", (e) => {
            e.preventDefault();
            let key = $(e.currentTarget).attr('data-key');
            let tipo_pregunta_id = $(e.currentTarget).attr('data-tipo-pregunta');
            let this_preguntas = $('#preguntas').find('[data-seccion="respuestas-'+key+'"]');
            let id = Math.floor(Math.random() * 999999);
            let componente = 'checkbox';
            if (tipo_pregunta_id=='1') {
                componente = 'radio';
            }
            let html = ''+
            '<label class="custom-control custom-'+componente+'">'+
                '<input type="'+componente+'" class="custom-control-input" name="cuestionario['+key+'][respuesta][]" value="'+id+'">'+
                '<span class="custom-control-label"><input class="form-control form-control-sm" type="text" name="cuestionario['+key+'][alternativas]['+id+']" placeholder="Ingrese su alternativa"></span>'+
            '</label>';
            this_preguntas.find('[data-key-respuestas="'+key+'"]').append(html);
            console.log(componente);
        });

        /*
            Se procedera a guardar la data del cuestionario
        */
        $('#guardar').on("submit", (e) => {
            e.preventDefault();
            var data = $(e.currentTarget).serialize();
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
                    Swal.fire(
                        'Éxito!',
                        'Se guardo con éxito!',
                        'success'
                    );

                    Swal.fire({
                        title: "Éxito!",
                        text: "Se guardo con éxito!",
                        icon: "success",
                        showCancelButton: false,
                        confirmButtonColor: "#3085d6",
                        confirmButtonText: "Entendido!"
                      }).then((resultado) => {
                        if (resultado.isConfirmed) {
                            window.location.href = route('hb.academicos.cuestionario.lista');
                        }
                    });
                }
            })


        });
        /*
            Se procedera a eliminar una pregunta co sus alternativas
        */
        $('#preguntas').on("click", ".eliminar-pregunta", (e) => {
            e.preventDefault();
            let key = $(e.currentTarget).attr('data-key');
            $('.row[key="'+key+'"]').remove();
            console.log(key);
        });
    }

    obtenerPreguntas = () => {
        let id = $('#guardar').find('[name="id"]').val();
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
                    '<div class="col-md-8">'+
                        '<input type="hidden" name="cuestionario['+numero_random+'][tipo_pregunta_id]" value="'+element_pregunta.tipo_pregunta_id+'"></input>'+
                        '<input type="text" class="form-control form-control-sm" placeholder="Ingrese su pregunta" name="cuestionario['+numero_random+'][pregunta]" value="'+element_pregunta.pregunta+'">'+
                    '</div>'+
                    '<div class="col-md-2">'+
                        '<input type="number" class="form-control form-control-sm" placeholder="Ingrese el puntaje" name="cuestionario['+numero_random+'][puntaje]" value="'+element_pregunta.puntaje+'">'+
                    '</div>'+

                    '<div class="col-md-2">'+
                        '<div class="btn-group">'+
                            '<button type="button" class="btn btn-sm btn-default dropdown-toggle" data-bs-toggle="dropdown">'+
                                    'Tipo de alternativas <span class="caret"></span>'+
                                '</button>'+
                            '<ul class="dropdown-menu" role="menu">'+
                                '<li><a class="agregar-respuesta" href="javascript:void(0)" data-action="agregar-respuesta" data-key="'+numero_random+'" data-tipo-pregunta="1"> Una sola alternativa</a></li>'+
                                '<li><a class="agregar-respuesta" href="javascript:void(0)" data-action="agregar-respuesta" data-key="'+numero_random+'" data-tipo-pregunta="2"> Multi alternativas</a></li>'+
                                '<li><a class="agregar-respuesta" href="javascript:void(0)" data-action="agregar-respuesta" data-key="'+numero_random+'" data-tipo-pregunta="3"> Escritura</a></li>'+
                                '<li class="divider"></li>'+
                                '<li><a class="eliminar-pregunta" href="javascript:void(0)" data-key="'+numero_random+'">Eliminar</a></li>'+
                        ' </ul>'+
                        '</div>'+
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
                            '<input type="'+componente+'" class="custom-control-input" name="cuestionario['+key+'][respuesta][]" value="'+id+'" '+(element_respuesta.verdadero==1?'checked':'')+'>'+
                            '<span class="custom-control-label"><input class="form-control form-control-sm" type="text" name="cuestionario['+key+'][alternativas]['+id+']" value="'+element_respuesta.descripcion+'" placeholder="Ingrese su alternativa"></span>'+
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
                            '</div>'+
                            '<div class="col-md-4 mt-auto">'+
                                '<button type="button" class="btn btn-info btn-sm nueva-alternativa mb-4" data-key="'+key+'" data-tipo-pregunta="'+tipo_pregunta_id+'"><i class="fe fe-plus"></i></button>'
                            '</div>';
                            this_preguntas.html(html_respuestas);
                        }
                    }

                    if (tipo_pregunta_id == '3') {
                        let html_respuestas = ''+
                        '<div class="col-md-12">'+
                            '<textarea class="form-control form-control-sm mb-4" placeholder="Escriba su respuesta..." rows="2" name="cuestionario['+key+'][alternativas]['+id+']">'+element_respuesta.descripcion+'</textarea>'+
                        '</div>'+
                        '';
                        this_preguntas.html(html_respuestas);
                    }
                });
            });
        }
    }
}



