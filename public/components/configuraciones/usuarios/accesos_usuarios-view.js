class AccesosUsuariosView {

    constructor(model) {
        this.model = model;
    }

    eventos = () => {
        /**
         * busca los sub menus del menu padre
         */
        $('[name="menu"]').on("change", (e) => {
            let id = $(e.currentTarget).val();
            let html ='<option label="Seleccione..."></option>';
            $('[name="sub-menu"]').attr('disabled','true');
            this.model.buscarSubMenu(id).then((respuesta) => {

                if (respuesta.success==true) {
                   $.each(respuesta.data, function (index, element) {
                        html+='<option value="'+element.id+'">'+element.titulo+'</option>'
                    });
                    $('[name="sub-menu"]').removeAttr('disabled');
                }

                $('[name="sub-menu"]').html(html);
            }).fail((respuesta) => {
                console.log(respuesta);
            }).always(() => {
            });
        });

        /**
         * busca los accesos de cada menu
         */
        $('.menus-seleccionar').on("change", (e) => {
            let id = $(e.currentTarget).val();
            let usuario_id = $('#guardar').find('[name="usuario_id"]').val();
            let html = '';

            this.model.buscarAccesos(id, usuario_id).then((respuesta) => {
                if (respuesta.success==true) {
                    $.each(respuesta.data, function (index, element) {
                        html+=`
                        <div class="col-md-3" >
                            <div class="form-group">
                                <label class="custom-switch form-switch mb-0">
                                    <input type="checkbox"class="custom-switch-input seccionar-acceso" name="acceso" value="`+element.id+`" data-menu="`+id+`" `+(element.checked==true?'checked':'')+`>
                                    <span class="custom-switch-indicator"></span>
                                    <span class="custom-switch-description"> `+element.descripcion+`</span>
                                </label>
                            </div>

                        </div>

                        `;
                    });
                    $('[name="sub-menu"]').removeAttr('disabled');
                 }
                 $('[data-action="accesoss"]').html(html);
            }).fail((respuesta) => {
                console.log(respuesta);
            }).always(() => {
            });
        });

        // $('.seccionar-acceso').on("change", (e) => {
        $("#opciones-accesos").on("change", ".seccionar-acceso", (e) => {
            let id = $(e.currentTarget).val();
            let menu_id = $(e.currentTarget).attr('data-menu');
            let usuario_id = $('#guardar').find('[name="usuario_id"]').val();
            let marcado = ($(e.currentTarget).is(':checked')?true:false);
            let data={
                _token: csrf_token,
                acceso_id:  id,
                usuario_id: usuario_id,
                menu_id : menu_id,
                marcado:marcado
            };


            this.model.guardarAccesos(data).then((respuesta) => {
                notif({
                    msg: `<span class="alert-inner--icon"><i class="fe fe-thumbs-up"></i></span>
                    <span class="alert-inner--text"><strong>Éxito!</strong> Se guardo con éxito el cambio de acceso!</span>`,
                    type: "success"
                });
            }).fail((respuesta) => {
                console.log(respuesta);
            }).always(() => {
            });
        });

    };
}








