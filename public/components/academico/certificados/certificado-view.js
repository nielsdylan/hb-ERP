
class CertificadoView {

    // var $filtros = {
    //     curso:'-',
    //     empresa:'-',
    //     documento:'-',
    //     fecha_inicio:'-',
    //     fecha_final:'-',
    // }
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
            // buttons: ['copy', 'excel', 'pdf', 'colvis'],
            // pagingType: 'full_numbers',
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
                $('[name="tabla-data_length"]').select2({
                    minimumResultsForSearch: Infinity
                });
                // const $paginate = $('#tabla-data_paginate');
                // $paginate.find('ul.pagination').addClass('pagination-sm');

            },
            drawCallback: function (settings) {
                $('#tabla-data_filter input').prop('disabled', false);
                $('#btnBuscar').html('<i class="fa fa-search"></i>').prop('disabled', false);
                $('#tabla-data_filter input').trigger('focus');
                const $paginate = $('#tabla-data_paginate');
                $paginate.find('ul.pagination').addClass('pagination-sm');

            },
            order: [[0, 'desc']],
            ajax: {
                url: route('hb.academicos.certificados.listar'),
                method: 'POST',
                // headers: {'X-CSRF-TOKEN': csrf_token},
                dataType: "JSON",
                // data: JSON.parse(localStorage.getItem('filtros'))
                data: filtros
            },
            columns: [
                {data: 'id', className: 'text-center'},
                {data: 'cod_certificado'},
                {data: 'curso'},
                {data: 'numero_documento', className: 'text-center'},
                {data: 'apellidos_nombres',},
                {data: 'empresa'},
                {data: 'vigencia', className: 'text-center'},

                {data: 'nota', className: 'text-center'},
                {data: 'email'},
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
         * Nueva aula - información
         */
        $('[data-action="nuevo"]').click((e) => {
            e.preventDefault();
            let id = 0,
                tipo ="Nuevo Certificado",
                form = $('<form action="'+route('hb.academicos.certificados.formulario')+'" method="POST">'+
                    '<input type="hidden" name="_token" value="'+csrf_token+'" >'+
                    '<input type="hidden" name="id" value="'+id+'" >'+
                    '<input type="hidden" name="tipo" value="'+tipo+'" >'+
                '</form>');
            $('body').append(form);
            form.submit();

        });
        /**
         * Editar aula - información
         */
        $("#tabla-data").on("click", "button.editar", (e) => {
            e.preventDefault();
            let id = $(e.currentTarget).attr('data-id'),
                tipo ="Editar Aula",
                form = $('<form action="'+route('hb.academicos.certificados.formulario')+'" method="POST">'+
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
                allowOutsideClick: false,
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
                            window.location.href = route('hb.academicos.certificados.lista');
                        }
                    })


                }
            })
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
                            $('#tabla-data').DataTable().ajax.reload();
                        }
                    })
                }

            })
        });

        /*
        *
        * verifica que el codigo sea unico
        *
        */
        $('[data-action="unico"]').change((e) => {
            e.preventDefault();
            let id = $('#guardar').find('[name="id"]').val(),
                codigo = $(e.currentTarget).val(),
                input_this = $(e.currentTarget);
            this.model.buscarCodigo(id,codigo).then((respuesta) => {
                if (respuesta.success==true) {
                    input_this.val('');
                    Swal.fire('Información','El codigo de certificado se encuentra en uso.','info');
                }
            }).fail((respuesta) => {
                // return respuesta;
            }).always(() => {
            });
        });

        /*
        *
        * funsiones para importar excel de certificados
        *
        */
        $('[data-action="importar"]').click((e) => {
            e.preventDefault();
            $('#tabla-excluido').addClass('d-none');
            $('#modal-importar').modal('show');
        });

        $('#guardar-certificado').on("submit", (e) => {
            e.preventDefault();
            // var data = $(e.currentTarget).serialize();

            let data = new FormData($(e.currentTarget)[0]);
            let html = '';
            let button = $(e.currentTarget).find('button[type="submit"]');

            button.find('i.fe').remove();
            button.html('<i class="fa fa-spinner fa-spin"></i> Cargando...');
            button.attr('disabled','true');

            this.model.importarCertificadosExcel(data).then((respuesta) => {

                // $('#modal-importar').modal('hide');
                $("#guardar-certificado")[0].reset();

                notif({
                    msg: '<span class="alert-inner--icon"><i class="fe fe-thumbs-up"></i></span>'+
                    '<span class="alert-inner--text"><strong> '+respuesta.titulo+'!</strong> '+respuesta.mensaje+'</span>',
                    type: respuesta.tipo,
                    width: 480,
                });

                if (respuesta.tipo=="warning") {
                    $.each(respuesta.data, function (index, element) {
                        html+='<tr>'+
                            '<td>'+element.FECHA_DE_CURSO+'</td>'+
                            '<td>'+element.CURSO+'</td>'+
                            '<td>'+element.TIPO_DE_DOCUMENTO+'</td>'+
                            '<td>'+element.N_DE_DOCUMENTO+'</td>'+
                            '<td>'+element.APELLIDO_PATERNO+'</td>'+
                            '<td>'+element.APELLIDO_MATERNO+'</td>'+
                            '<td>'+element.NOMBRES+'</td>'+
                            '<td>'+element.CODIGO_DEL_CURSO+'</td>'+
                            '<td>'+element.COD+'</td>'+
                            '<td>'+element.NOTA+'</td>'+
                            '<td>'+element.CODIGO_CERTIFICADO+'</td>'+
                            '<td>'+element.DURACION+'</td>'+
                            '<td>'+element.FECHA_VENCIMIENTO+'</td>'+
                        '</tr>';
                    });
                    $('[data-table="excluidos"]').html(html);
                    $('#tabla-excluido').removeClass('d-none');

                }
                $('#tabla-data').DataTable().ajax.reload();
                button.find('i.fa').remove();
                button.html('<i class="fe fe-save"></i> Guardar');
                button.removeAttr('disabled');

            }).fail((respuesta) => {
                // return respuesta;
            }).always(() => {
            });
        });

        $('[data-action="pdf-masivo"]').click((e) => {
            e.preventDefault();
            let model = this.model;

            // var filtros = {
            //     _token:csrf_token,
            //     curso:'-',
            //     empresa:'-',
            //     documento:'-',
            //     fecha_inicio:'-',
            //     fecha_final:'-',
            // };

            let id = $(e.currentTarget).attr('data-id'),
                tipo ="Editar Aula",
                form = $('<form action="'+route('hb.academicos.certificados.alumnos-certidicado-masivo')+'" method="GET" target="_blanck">'+
                    '<input type="hidden" name="_token" value="'+csrf_token+'" >'+
                    // '<input type="hidden" name="id" value="'+id+'" >'+
                    '<input type="hidden" name="curso" value="'+filtros.curso+'" >'+
                    '<input type="hidden" name="empresa" value="'+filtros.empresa+'" >'+
                    '<input type="hidden" name="documento" value="'+filtros.documento+'" >'+
                    '<input type="hidden" name="fecha_inicio" value="'+filtros.fecha_inicio+'" >'+
                    '<input type="hidden" name="fecha_final" value="'+filtros.fecha_final+'" >'+
                '</form>');
            $('body').append(form);
            form.submit();

            // model.alumnosCertidicadoMasivo(filtros).then((respuesta) => {
            //     $.each(respuesta, function (index, element) {
            //         window.open(route('hb.academicos.certificados.exportar-pdf-masivo',{'id':element.id, 'masivo':2 }));
            //     });

            // }).fail((respuesta) => {
            //     // return respuesta;
            // }).always(() => {
            // });
        });

        /*
        *
        * funsiones para ver el registro del certificado
        *
        */
        $("#tabla-data").on("click", "button.ver", (e) => {
            e.preventDefault();
            $('#modal-ver').modal('show');
            let id = $(e.currentTarget).attr('data-id');

            this.model.ver(id).then((respuesta) => {
                $('#modal-ver').find('#cod_certificado').text(respuesta.data.cod_certificado);
                $('#modal-ver').find('#fecha_curso').text(respuesta.data.fecha_curso);
                $('#modal-ver').find('#duracion').text(respuesta.data.duracion);
                $('#modal-ver').find('#nota').text(respuesta.data.nota);
                $('#modal-ver').find('#tipo_curso').text(respuesta.data.tipo_curso);
                $('#modal-ver').find('#curso').text(respuesta.data.curso);
                $('#modal-ver').find('#fecha_vencimiento').text(respuesta.data.fecha_vencimiento);

                $('#modal-ver').find('#tipo_documento_id').text(respuesta.data.documentos.descripcion);
                $('#modal-ver').find('#numero_documento').text(respuesta.data.numero_documento);
                $('#modal-ver').find('#empresa').text(respuesta.data.empresa);
                $('#modal-ver').find('#apellido_paterno').text(respuesta.data.apellido_paterno);
                $('#modal-ver').find('#apellido_materno').text(respuesta.data.apellido_materno);
                $('#modal-ver').find('#nombres').text(respuesta.data.nombres);
                $('#modal-ver').find('#cargo').text(respuesta.data.cargo);
                $('#modal-ver').find('#email').text(respuesta.data.email);
                $('#modal-ver').find('#supervisor_responsable').text(respuesta.data.supervisor_responsable);
                $('#modal-ver').find('#observaciones').text(respuesta.data.observaciones);
                $('#modal-ver').find('#comentario').text(respuesta.data.comentario);

            }).fail((respuesta) => {
                // return respuesta;
            }).always(() => {
            });
        });
    }

    filtros = () => {
        /*
        *
        * Filtros
        */
        $('[data-action="filtros"]').click((e) => {
            e.preventDefault();
            $('#modal-filtros').modal('show');
        });

        $('#form-filtros [type="checkbox"]').click((e) => {
            let objeto = $(e.currentTarget);
            let model = this.filtros;
            // $('[data-disabled="cheked"]').attr('disabled','true');
            if(objeto.prop("checked") == true) {
                objeto.closest('.row').find('[data-disabled="cheked"]').removeAttr('disabled');
            }else{
                objeto.closest('.row').find('[data-disabled="cheked"]').attr('disabled','true');
            }

            let objeto_row = $(e.currentTarget).closest('.row');
            let key = objeto_row.attr('data-section');

            dataFiltros(key, objeto_row, objeto.prop("checked"));
        });

        $('#form-filtros [data-disabled="cheked"]').change((e) => {
            let objeto = $(e.currentTarget).closest('.row');
            let key = objeto.attr('data-section');
            let model = this.filtros;
            let check = objeto.find('[type="checkbox"]').prop("checked");

            dataFiltros(key, objeto, check);
        });


        function dataFiltros(key, objeto, check) {
            switch (key) {
                case 'curso':
                    if (check) {
                        filtros.curso = objeto.find('[data-disabled="cheked"][name="curso"]').val();
                    }else{
                        filtros.curso = '-';
                    }

                break;
                case 'empresa':
                    if (check) {
                        filtros.empresa = objeto.find('[data-disabled="cheked"][name="empresa"]').val();
                    }else{
                        filtros.empresa = '-';
                    }
                break;
                case 'documento':
                    if (check) {
                        filtros.documento = objeto.find('[data-disabled="cheked"][name="numero"]').val();
                    }else{
                        filtros.documento = '-';
                    }
                break;
                case 'fecha':
                    if (check) {
                        filtros.fecha_inicio = objeto.find('[data-disabled="cheked"][name="fecha_inicio"]').val();
                        filtros.fecha_final = objeto.find('[data-disabled="cheked"][name="fecha_final"]').val();
                    }else{
                        filtros.fecha_inicio = '-';
                        filtros.fecha_final = '-';
                    }
                break;
            }
        }
        $('#aplicar').click((e) => {
            this.listar();
        });

    }

}



