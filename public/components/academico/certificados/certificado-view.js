class CertificadoView {

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
                $('.select2').select2({
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
                headers: {'X-CSRF-TOKEN': csrf_token}
            },
            columns: [
                {data: 'id', className: 'text-center'},
                {data: 'cod_certificado'},
                {data: 'curso'},
                {data: 'numero_documento', className: 'text-center'},
                {data: 'apellidos_nombres', className: 'text-center'},
                {data: 'empresa'},
                {data: 'email'},
                {data: 'nota', className: 'text-center'},
                {data: 'vigencia', className: 'text-center'},
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
        $('#nuevo').click((e) => {
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
        $('#importar').click((e) => {
            e.preventDefault();
            $('#modal-importar').modal('show');
        });

        $('#guardar-certificado').on("submit", (e) => {
            e.preventDefault();
            // var data = $(e.currentTarget).serialize();
            let data = new FormData($(e.currentTarget)[0]);
            let html = '';

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
                }
                $('#tabla-data').DataTable().ajax.reload();


            }).fail((respuesta) => {
                // return respuesta;
            }).always(() => {
            });
        });
    }

}



