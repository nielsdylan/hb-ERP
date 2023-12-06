class AppView {

    constructor(model) {
        this.model = model;
    }
    /**
     * Se ejecutan los eventos que nacen de una accion, solo crear funcion a parte de ser necesario
     */

    eventos = () => {
        /**
         * modificar - cambiar la contraseña
         */
        $(".cambiar-contraseña").click((e) => {
            e.preventDefault();
            let id = $(e.currentTarget).attr('data-id');
            $('#modal-cambio-clave').modal('show');
            $('#cambiar-contraseña').find('[name="id"]').val(id);

            $('#cambiar-contraseña')[0].reset();
        });

        $('#cambiar-contraseña').on("submit", (e) => {
            e.preventDefault();
            var data = $(e.currentTarget).serialize();
            let model = this.model;
            let button = $(e.currentTarget).find('[type="submit"]');

            button.find('i.fe').remove();
            button.html('<i class="fa fa-spinner fa-spin"></i> Cargando...');
            button.attr('disabled','true');

            model.cambiarContrasena(data).then((respuesta) => {
                if (respuesta.tipo=='success') {
                    $('#modal-cambio-clave').modal('hide');
                }
                notif({
                    msg: `<span class="alert-inner--icon"><i class="fe fe-thumbs-up"></i></span>
                    <span class="alert-inner--text"><strong>`+respuesta.titulo+`!</strong> `+respuesta.mensaje+`</span>`,
                    type: respuesta.tipo
                });
                button.find('i.fa').remove();
                button.html('<i class="fe fe-save"></i> Guardar');
                button.removeAttr('disabled');
            }).fail((respuesta) => {
                // return respuesta;
            }).always(() => {
            });

        });
    }
}



