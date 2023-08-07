class AulaModel {

    constructor(token) {
        this.token = token;
    }

    guardar = (data) => {
        return $.ajax({
            url: route("hb.academicos.aulas.guardar"),
            type: "POST",
            dataType: "JSON",
            // processData: false,
            // contentType: false,
            data: data,
        });
    };
    editar = (id) => {
        return $.ajax({
            url: route("hb.academicos.aulas.editar",{id:id}),
            type: "GET",
            dataType: "JSON",
            // processData: false,
            // contentType: false,
            data: {_token:this.token},
        });
    };

    eliminar = (id) => {
        return $.ajax({
            url: route("hb.academicos.aulas.eliminar",{id: id}),
            type: "PUT",
            dataType: "JSON",
            // processData: false,
            // contentType: false,
            data: {_token:this.token},
        });
    }
    guardarAlumnos = (data) => {
        return $.ajax({
            url: route("hb.academicos.aulas.guardar-alumnos"),
            type: "POST",
            dataType: "JSON",
            // processData: false,
            // contentType: false,
            data: data,
        });
    };
    eliminarAlumnos = (id) => {
        return $.ajax({
            url: route("hb.academicos.aulas.eliminar-alumno",{id: id}),
            type: "PUT",
            dataType: "JSON",
            // processData: false,
            // contentType: false,
            data: {_token:this.token},
        });
    }
    confirmarAlumnos = (id) => {
        return $.ajax({
            url: route("hb.academicos.aulas.confirmar-alumno",{id:id}),
            type: "GET",
            dataType: "JSON",
            // processData: false,
            // contentType: false,
            data: {_token:this.token},
        });
    };

}