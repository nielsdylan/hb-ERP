class MiCursoModel {

    constructor(token) {
        this.token = token;
    }
    listaExamenes = (aula_id) => {
        return $.ajax({
            url: route("hb.academicos.aulas.lista-examenes",{aula_id:aula_id}),
            type: "GET",
            dataType: "JSON",
            // processData: false,
            // contentType: false,
            data: {_token:this.token},
        });
    };
    obtenerCuestionario = (id) => {
        return $.ajax({
            url: route("hb.academicos.cuestionario.obtener-cuestionario",{id:id}),
            type: "GET",
            dataType: "JSON",
            // processData: false,
            // contentType: false,
            data: {_token:this.token},
        });
    };
    guardarCuestionario = (data) => {
        return $.ajax({
            url: route("hb.mis-cursos.guardar-cuestionario"),
            type: "POST",
            dataType: "JSON",
            // processData: false,
            // contentType: false,
            data: data,
        });
    };
}
