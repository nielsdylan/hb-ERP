class MiCursoView {

    constructor(model) {
        this.model = model;
    }

    eventos = () => {


        /**
         *  Agregar examen
         */
        $(document).on('click','.agregar-cuestionario',function (e) {
            e.preventDefault();
            $('#modal-cuestionario').modal('show');
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
        let url = window.location.origin;
        let html = '';
        this.model.listaExamenes(aula_id).then((respuesta) => {
            $.each(respuesta.data, function (index, element) { 
                html+='<div class="col-md-3">'+
                    '<div class="thumbnail">'+
                        '<a href="javascript:void(0)">'+
                            '<img src="'+url+'/images/examen/imagen_1.png" alt="thumb1" class="thumbimg" />'+
                        '</a>'+
                        '<div class="caption">'+
                            '<h4><strong>'+element.cuestionario.titulo+'</strong></h4>'+
                            '<p>Leer antes de responder.</p>'+
                            '<p>'+
                                '<a href="javascript:void(0)" class="btn btn-primary" role="button">Resultado</a>'+
                            '</p>'+
                        '</div>'+
                    '</div>'+
                '</div>';
            });
            cuestionarios_asignados.html(html);
        }).fail((respuesta) => {
            // return respuesta;
        }).always(() => {
        });


        
    }


}



