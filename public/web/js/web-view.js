class WebView {

    constructor(model) {
        this.model = model;
    }

    /**
     * Se ejecutan los eventos que nacen de una accion, solo crear funcion a parte de ser necesario
     */

    eventos = () => {


        $('[data-form="certi-send"]').submit((e) => {
            e.preventDefault();
            let data = $(e.currentTarget).serialize();
            let html = '';

            this.model.buscarCertificado(data).then((respuesta) => {
                if (respuesta.tipo==true) {
                    html = ''+
                    '<div class="row">'+
                        '<div class="col-md-12 table-responsive">'+
                            '<table class="table">'+
                                '<thead>'+
                                    '<tr>'+
                                    '<th >N° Documento</th>'+
                                    '<th >Nombre</th>'+
                                    '<th>Curso</th>'+
                                    '<th >Fecha</th>'+
                                    '<th >Vigencia</th>'+
                                    '<th >Descarga</th>'+
                                    '</tr>'+
                                '</thead>'+
                                '<tbody>';

                                $.each(respuesta.data, function (index, element) {
                                    console.log(element.vigencia);
                                    html+='<tr>'+
                                        '<td>'+element.numero_documento+'</td>'+
                                        '<td>'+element.apellido_paterno + ' ' + element.apellido_materno + ' '+ element.nombres+'</td>'+
                                        '<td>'+element.curso+'</td>'+
                                        '<td>'+element.fecha_curso+'</td>'+
                                        '<td><span class="badge badge-pill badge-'+element.vigencia.color+'">'+element.fecha_vencimiento+'</span></td>'+
                                        '<td><a href="'+route('exportar-certificado-pdf',{id:element.id})+'" class="text-primary" ><i class="fas fa-cloud-download-alt"></i> PDF</a></td>'+
                                    '</tr>';
                                });
                                html+='</tbody>'+
                            '</table>'+
                        '</div>'+
                    '</div>';
                }else{
                    html = ''+
                    '<div class="alert alert-warning" role="alert">'+
                        '<p>'+
                            'Si no encuentra su certificado comuniquese con el area de soporte academico, marcando al numero telefonico'+
                            '<a href="tel:+51 951 281 025" class="email-contact" >+51 951 281 025 </a>'+
                            'o enviando un correo electronico a'+
                            '<a href="mailto:servicios@hbgroup.pe ?Subject=Consulta%20de%20su%20servicio&body=Con%20urgencia" class="email-contact">&nbsp;servicios@hbgroup.pe </a>.'+
                            ' Gracias por su comprensión.'+
                        '</p>'+
                    '</div>';
                }
                $('[data-table="table"]').closest("div.slideInUp").removeClass('d-none')
                $('[data-table="table"]').html(html);

                console.log(respuesta);
            }).fail((respuesta) => {
                // return respuesta;
            }).always(() => {
            });


        });

        /**
         * Guardar - editar - Cargar información por ID y llenar en el formulario
         */
        // console.log(UsuarioModel());
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
                // backdrop: false, allowOutsideClick: false,
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
                        $('#modal-empresa').modal('hide');
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
                form.find('[name="id"]').val(respuesta.id);
                // form.find('[name="tipo_documento_id"]').val(respuesta.persona.tipo_documento_id).trigger('change.select2');
                form.find('[name="ruc"]').val(respuesta.ruc);
                form.find('[name="razon_social"]').val(respuesta.razon_social);
                form.find('[name="direccion"]').val(respuesta.direccion);
                form.find('[name="email"]').val(respuesta.email);
                form.find('[name="celular"]').val(respuesta.celular);

                $('#modal-empresa').find('.modal-title').text('Editar Empresas')
                $('#modal-empresa').modal('show');
            }).fail((respuesta) => {
            }).always(() => {
            });
        });
    }

    cuestionario = () => {

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
                        '<input type="hidden" name="cuestionario['+numero_random+'][pregunta]" value="'+element_pregunta.pregunta+'">'+
                        ''+element_pregunta.pregunta+''+
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
                            '<textarea class="form-control form-control-sm mb-4" placeholder="Escriba su respuesta..." rows="3" name="cuestionario['+key+'][alternativas]['+id+']"></textarea>'+
                        '</div>'+
                        '';
                        this_preguntas.html(html_respuestas);
                    }
                });
            });
        }
        /**
         * Guardar - el cuestionario
         */
        $('#guardar').on("submit", (e) => {
            e.preventDefault();
            var data = $(e.currentTarget).serialize();
            let model = this.model;

            let formulario = $('#guardar');
            formulario.find('button[type="submit"]').find('i.fa').removeClass('fa-paper-plane');
            formulario.find('button[type="submit"]').find('i.fa').addClass('fa-spinner fa-spin');
            this.model.guardarCuestionario(data).then((respuesta) => {
                formulario.find('button[type="submit"]').find('i.fa').removeClass('fa-spinner fa-spin');
                formulario.find('button[type="submit"]').find('i.fa').addClass('fa-paper-plane');
                console.log(respuesta);;
            }).fail((respuesta) => {
                // return respuesta;
            }).always(() => {
            });

            // Swal.fire({
            //     title: 'Información',
            //     text: "¿Está seguro de guardar?",
            //     icon: 'warning',
            //     showCancelButton: true,
            //     confirmButtonText: 'Si, guardar',
            //     cancelButtonText: 'No, cancelar',
            //     showLoaderOnConfirm: true,
            //     // backdrop: false, allowOutsideClick: false,
            //     preConfirm: (login) => {
            //         return model.guardarCuestionario(data).then((respuesta) => {
            //             return respuesta;
            //         }).fail((respuesta) => {
            //             // return respuesta;
            //         }).always(() => {
            //         });
            //     },
            //     // allowOutsideClick: () => !Swal.isLoading()
            //   }).then((result) => {
            //     console.log(result);
            // })


        });
    }
}



