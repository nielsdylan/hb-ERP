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

    buscarCodigo = (id, codigo) => {
        return $.ajax({
            url: route("hb.academicos.certificados.buscar-codigo"),
            type: "POST",
            dataType: "JSON",
            // processData: false,
            // contentType: false,
            data: {_token:this.token, id:id, codigo:codigo},
        });
    };
    importarCertificadosExcel = (data) => {
        return $.ajax({
            url: route("hb.academicos.certificados.importar-certificados-excel"),
            type: "POST",
            dataType: "JSON",
            processData: false,
            contentType: false,
            data: data,
        });
    };
    exportarPDF = (id) => {
        return $.ajax({
            url: route("hb.academicos.certificados.exportar-pdf",{id: id}),
            type: "GET",
            dataType: "JSON",
            // processData: false,
            // contentType: false,
            data: {_token:this.token},
        });
    };

    alumnosCertidicadoMasivo = (data) => {
        return $.ajax({
            url: route("hb.academicos.certificados.alumnos-certidicado-masivo"),
            type: "POST",
            dataType: "JSON",
            // processData: false,
            // contentType: false,
            data: data,
        });
    };

    ver = (id) => {
        return $.ajax({
            url: route("hb.academicos.certificados.ver",{id: id}),
            type: "GET",
            dataType: "JSON",
            // processData: false,
            // contentType: false,
            data: {_token:this.token},
        });
    };
}
