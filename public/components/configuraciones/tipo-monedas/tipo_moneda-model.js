class TipoMonedaModel {

    constructor(token) {
        this.token = token;
    }

    guardar = (data) => {
        return $.ajax({
            url: route("hb.configuraciones.tipo-monedas.guardar"),
            type: "POST",
            dataType: "JSON",
            // processData: false,
            // contentType: false,
            data: data,
        });
    };
    editar = (id) => {
        return $.ajax({
            url: route("hb.configuraciones.tipo-monedas.editar",{id:id}),
            type: "GET",
            dataType: "JSON",
            // processData: false,
            // contentType: false,
            data: {_token:this.token},
        });
    };

    eliminar = (id) => {
        return $.ajax({
            url: route("hb.configuraciones.tipo-monedas.eliminar",{id: id}),
            type: "PUT",
            dataType: "JSON",
            // processData: false,
            // contentType: false,
            data: {_token:this.token},
        });
    }

}