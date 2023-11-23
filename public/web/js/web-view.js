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
                                    html+='<tr>'+
                                        '<td>'+element.numero_documento+'</td>'+
                                        '<td>'+element.apellido_paterno + ' ' + element.apellido_materno + ' '+ element.nombres+'</td>'+
                                        '<td>'+element.curso+'</td>'+
                                        '<td>'+element.fecha_curso+'</td>'+
                                        '<td><span class="badge badge-pill badge-primary">'+element.fecha_vencimiento+'</span></td>'+
                                        '<td><a href="'+route('exportar-certificado-pdf',{id:element.id})+'" class="text-primary" ><i class="fas fa-cloud-download-alt"></i> PDF</a></td>'+
                                    '</tr>';
                                });
                                html+='</tbody>'+
                            '</table>'+
                        '</div>'+
                    '</div>';
                }else{

                }

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
}



