class WebModel {

    constructor(token) {
        this.token = token;
    }

    buscarCertificado = (data) => {
        return $.ajax({
            url: route("buscar-certificado"),
            type: "POST",
            dataType: "JSON",
            // processData: false,
            // contentType: false,
            data: data,
        });
    };
    obtenerCuestionario = (id) => {
        return $.ajax({
            url: route("link.obtener-cuestionario",{id:id}),
            type: "GET",
            dataType: "JSON",
            // processData: false,
            // contentType: false,
            data: {_token:this.token},
        });
    };
    guardarCuestionario = (data) => {
        return $.ajax({
            url: route("link.guardar-cuestionario"),
            type: "POST",
            dataType: "JSON",
            // processData: false,
            // contentType: false,
            data: data,
        });
    };
}
