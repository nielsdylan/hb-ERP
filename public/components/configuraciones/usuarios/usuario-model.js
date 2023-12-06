class UsuarioModel {

    constructor(token) {
        this.token = token;
    }

    guardar = (data) => {
        return $.ajax({
            url: route("hb.configuraciones.usuarios.guardar"),
            type: "POST",
            dataType: "JSON",
            // processData: false,
            // contentType: false,
            data: data,
        });
    };
    editar = (id) => {
        return $.ajax({
            url: route("hb.configuraciones.usuarios.editar",{id:id}),
            type: "GET",
            dataType: "JSON",
            // processData: false,
            // contentType: false,
            data: {_token:this.token},
        });
    };

    eliminar = (id) => {
        return $.ajax({
            url: route("hb.configuraciones.usuarios.eliminar",{id: id}),
            type: "PUT",
            dataType: "JSON",
            // processData: false,
            // contentType: false,
            data: {_token:this.token},
        });
    };

    buscarSubMenu = (id) => {
        return $.ajax({
            url: route("hb.configuraciones.usuarios.buscar-sub-menu",{id: id}),
            type: "GET",
            dataType: "JSON",
            // processData: false,
            // contentType: false,
            data: {
                _token:this.token,
            },
        });
    };

    buscarAccesos = (id, usuario_id) => {
        return $.ajax({
            url: route("hb.configuraciones.usuarios.buscar-accesos",{id: id, usuario_id:usuario_id}),
            type: "GET",
            dataType: "JSON",
            // processData: false,
            // contentType: false,
            data: {_token:this.token},
        });
    };

    guardarAccesos = (data) => {
        return $.ajax({
            url: route("hb.configuraciones.usuarios.guardar-accesos"),
            type: "POST",
            dataType: "JSON",
            // processData: false,
            // contentType: false,
            data: data,
        });
    };
    buscarUsuario = (data) => {
        return $.ajax({
            url: route("hb.configuraciones.usuarios.buscar-usuario"),
            type: "POST",
            dataType: "JSON",
            // processData: false,
            // contentType: false,
            data: data,
        });
    };
}
