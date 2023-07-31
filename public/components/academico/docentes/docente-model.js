class DocenteModel {

    constructor(token) {
        this.token = token;
    }

    guardar = (data) => {
        return $.ajax({
            url: route("hb.academicos.docentes.guardar"),
            type: "POST",
            dataType: "JSON",
            processData: false,
            contentType: false,
            data: data,
        });
    };
    editar = (id) => {
        return $.ajax({
            url: route("hb.academicos.docentes.editar",{id:id}),
            type: "GET",
            dataType: "JSON",
            // processData: false,
            // contentType: false,
            data: {_token:this.token},
        });
    };

    eliminar = (id) => {
        return $.ajax({
            url: route("hb.academicos.docentes.eliminar",{id: id}),
            type: "PUT",
            dataType: "JSON",
            // processData: false,
            // contentType: false,
            data: {_token:this.token},
        });
    }
    buscarPersona = (id,nro_documento) => {
        return $.ajax({
            url: route("hb.academicos.docentes.buscar"),
            type: "POST",
            dataType: "JSON",
            // processData: false,
            // contentType: false,
            data: {_token:this.token,id:id,nro_documento:nro_documento},
        });
    };
}