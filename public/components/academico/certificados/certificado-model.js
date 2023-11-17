class CertificadoModel {

    constructor(token) {
        this.token = token;
    }

    guardar = (data) => {
        return $.ajax({
            url: route("hb.academicos.certificados.guardar"),
            type: "POST",
            dataType: "JSON",
            // processData: false,
            // contentType: false,
            data: data,
        });
    };
    editar = (id) => {
        return $.ajax({
            url: route("hb.academicos.certificados.editar",{id:id}),
            type: "GET",
            dataType: "JSON",
            // processData: false,
            // contentType: false,
            data: {_token:this.token},
        });
    };

    eliminar = (id) => {
        return $.ajax({
            url: route("hb.academicos.certificados.eliminar",{id: id}),
            type: "PUT",
            dataType: "JSON",
            // processData: false,
            // contentType: false,
            data: {_token:this.token},
        });
    }
    guardarAlumnos = (data) => {
        return $.ajax({
            url: route("hb.academicos.certificados.guardar-alumnos"),
            type: "POST",
            dataType: "JSON",
            // processData: false,
            // contentType: false,
            data: data,
        });
    };
    eliminarAlumnos = (id) => {
        return $.ajax({
            url: route("hb.academicos.certificados.eliminar-alumno",{id: id}),
            type: "PUT",
            dataType: "JSON",
            // processData: false,
            // contentType: false,
            data: {_token:this.token},
        });
    }
    confirmarAlumnos = (id) => {
        return $.ajax({
            url: route("hb.academicos.certificados.confirmar-alumno",{id:id}),
            type: "GET",
            dataType: "JSON",
            // processData: false,
            // contentType: false,
            data: {_token:this.token},
        });
    };

}
