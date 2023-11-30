class AlumnoModel {

    constructor(token) {
        this.token = token;
    }

    guardar = (data) => {
        return $.ajax({
            url: route("hb.academicos.alumnos.guardar"),
            type: "POST",
            dataType: "JSON",
            processData: false,
            contentType: false,
            data: data,
        });
    };
    editar = (id) => {
        return $.ajax({
            url: route("hb.academicos.alumnos.editar",{id:id}),
            type: "GET",
            dataType: "JSON",
            // processData: false,
            // contentType: false,
            data: {_token:this.token},
        });
    };

    eliminar = (id) => {
        return $.ajax({
            url: route("hb.academicos.alumnos.eliminar",{id: id}),
            type: "PUT",
            dataType: "JSON",
            // processData: false,
            // contentType: false,
            data: {_token:this.token},
        });
    }
    buscarPersona = (id,valor,tipo) => {
        return $.ajax({
            url: route("hb.academicos.alumnos.buscar"),
            type: "POST",
            dataType: "JSON",
            // processData: false,
            // contentType: false,
            data: {_token:this.token,id:id,valor:valor, tipo:tipo},
        });
    };
    importarExcel = (data) => {
        return $.ajax({
            url: route("hb.academicos.alumnos.importar-alumnos-excel"),
            type: "POST",
            dataType: "JSON",
            processData: false,
            contentType: false,
            data: data,
        });
    };
}
