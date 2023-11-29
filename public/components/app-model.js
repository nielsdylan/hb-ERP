class AppModel {

    constructor(token) {
        this.token = token;
    }

    cambiarContrasena = (data) => {
        return $.ajax({
            url: route("hb.configuraciones.usuarios.cambiar-contrasena"),
            type: "POST",
            dataType: "JSON",
            // processData: false,
            // contentType: false,
            data: data,
        });
    };
}
