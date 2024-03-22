class MiCursoView {

    constructor(model) {
        this.model = model;
    }

    eventos = () => {

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
                                '<a href="'+ route("hb.mis-cursos.cuestionario",{id:element.cuestionario_id, aula_id:element.aula_id}) +'" class="btn btn-primary" role="button">Resultado</a>'+
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



