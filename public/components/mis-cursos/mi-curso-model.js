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
}
