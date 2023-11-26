class EmpresaModel {

    constructor(token) {
        this.token = token;
    }

    guardar = (data) => {
        return $.ajax({
            url: route("hb.empresas.guardar"),
            type: "POST",
            dataType: "JSON",
            // processData: false,
            // contentType: false,
            data: data,
        });
    };
    editar = (id) => {
        return $.ajax({
            url: route("hb.empresas.editar",{id:id}),
            type: "GET",
            dataType: "JSON",
            // processData: false,
            // contentType: false,
            data: {_token:this.token},
        });
    };

    eliminar = (id) => {
        return $.ajax({
            url: route("hb.empresas.eliminar",{id: id}),
            type: "PUT",
            dataType: "JSON",
            // processData: false,
            // contentType: false,
            data: {_token:this.token},
        });
    }

    buscarEmpresa = (id,ruc) => {
        return $.ajax({
            url: route("hb.empresas.buscar"),
            type: "POST",
            dataType: "JSON",
            // processData: false,
            // contentType: false,
            data: {_token:this.token,id:id,ruc:ruc},
        });
    };
}