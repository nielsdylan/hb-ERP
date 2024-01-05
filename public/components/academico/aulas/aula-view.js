class AulaView {

    constructor(model) {
        this.model = model;
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
                tipo ="Nueva Aula",
                form = $('<form action="'+route('hb.academicos.aulas.formulario')+'" method="POST">'+
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
        $('.editar').click((e) => {
            e.preventDefault();
            let id = $(e.currentTarget).attr('data-id'),
                tipo ="Editar Aula",
                form = $('<form action="'+route('hb.academicos.aulas.formulario')+'" method="POST">'+
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
                            window.location.href = route('hb.academicos.aulas.lista');
                        }
                    })


                }
            })
        });


        /**
         * Eliminar - Eliminar registro por ID
         */
        $('.eliminar').click((e) => {
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
                            window.location.href = route('hb.academicos.aulas.lista');
                        }
                    })
                }

            })
        });

        /*
        *
        *Agregar alumnos - ingreso
        *
        */
        $('.agregar-participantes').click((e) => {
            e.preventDefault();
            let id = $(e.currentTarget).attr('data-id'),
                tipo ="Nueva Aula",
                form = $('<form action="'+route('hb.academicos.aulas.agregar-alumnos')+'" method="POST">'+
                    '<input type="hidden" name="_token" value="'+csrf_token+'" >'+
                    '<input type="hidden" name="id" value="'+id+'" >'+
                    // '<input type="hidden" name="tipo" value="'+tipo+'" >'+
                '</form>');
            $('body').append(form);
            form.submit();
        });
        /*
        *
        *Asistencia de alumnos
        *
        */
        $('.asistencia').click((e) => {
            e.preventDefault();
            let id = $(e.currentTarget).attr('data-id'),
                tipo ="Asistencia de alumnos",
                form = $('<form action="'+route('hb.academicos.aulas.asistencia')+'" method="POST">'+
                    '<input type="hidden" name="_token" value="'+csrf_token+'" >'+
                    '<input type="hidden" name="id" value="'+id+'" >'+
                    '<input type="hidden" name="tipo" value="'+tipo+'" >'+
                '</form>');
            $('body').append(form);
            form.submit();
        });

        /*
        *
        * Buscar codigo del aula
        *
        */
        $('#guardar [name="codigo"]').change((e) => {
            e.preventDefault();
            let codigo = $(e.currentTarget).val();
            let id = $('#guardar [name="id"]').val();
            let current = $(e.currentTarget);
            this.model.buscarCodigoAula(codigo, id).then((respuesta) => {
                if (respuesta.tipo == true) {
                    current.val('');
                    Swal.fire('Información','El codigo de Aula se encuentra en uso.','info');
                }
            }).fail((respuesta) => {
                // return respuesta;
            }).always(() => {
            });

        });

        /*
        *
        * buscar cursos por asignaturas
        *
        */
       $('[name="asignatura_id"]').change((e) => {
            e.preventDefault();
            let asignatura_id = $(e.currentTarget).val();
            let html = '';
            this.model.listarCursos(asignatura_id).then((respuesta) => {
                html = '<option value="">Seleccione...</option>';
                $.each(respuesta, function (index, element) {
                    html += '<option value="'+element.id+'">'+element.nombre+'</option>';
                });
                $('[name="curso_id"]').html(html);
            }).fail((respuesta) => {
                // return respuesta;
            }).always(() => {
            });

        });
    }

}



