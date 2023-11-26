//My Functions
$(document).on("submit","[data-action='add-product-fast']",function(event) {
    event.preventDefault();
    var input_id,process = true;
    input_id = $('#inputProductCart').val();
    $('[data-section="btn-view"]').addClass('d-none');
    var cantidad = $('#qty').val();
    $("#qty-item-cart").html('');
    $('#qty-item-cart').text(' ');
    if ($.isNumeric(cantidad) && parseInt(cantidad) > 0)
    {
        if (process)
        {
            var data = {
                'enviar_form': '1',
                'id_product': input_id,
                'qty': cantidad,
            };

            $.ajax({
                type: 'POST',
                url: base_url+'frontend/ajax/insertProductCart',
                data: data,
                dataType: 'json',
            })
            .done(function(response){
                console.log(response);

                    // setTimeout(function(){ 
                    // $('#modalShoppingSuccess').modal('hide'); 
                    // }, 2000);
                if (response.success) {
                    $('[cart-cant-="cart_cant"]').html(response.num_items);
                    $('[cart-total="cart_total"]').html('$ ' + response.total);
                    if($('#modalShoppingFast').length>0){
                        $('#modalShoppingFast').modal('hide');
                        $('#qty').val(1);
                    }
                    $('#modalShoppingSuccess').modal('show');
                    $('[data-section="btn-view"]').removeClass('d-none');
                }else{
                    $('#qty-item-cart').text('Sin stock');
                }

            })
            .fail(function (error) {
                messageError("No se pudo agregar este producto.", 'error');
            }).always(function(){
                console.log('complete');
            })
        }
    } else {
        $("#qty-item-cart").html('<small>* Ingrese una cantidad válida.</small>');
    }
});
$(document).on("click","[data-action='showOrderDetail']",function(event) {
    event.preventDefault();
    var input_id,process = true;
    if (process) {
        var data = {
            'enviar_form': '1',
            'id_order': $(this).attr('data-id'),
        }
        $.ajax({
            type: 'POST',
            url: base_url+'frontend/ecommerce/getOrderProducts',
            data: data,
            dataType: 'json',
        })
        .done(function(response){
            $('#order_detail').modal('show');
            var html = '';
            var total = 0;
            $.each( response.response, function( k, v ) {
                total = total + (v.price*v.qty);
                html = html + '<tr><td>'+(k+1)+'</td><td>'+(v.producto)+'</td><td>'+(v.qty)+'</td><td>'+(v.price)+'</td><td>'+(v.qty*v.price)+'</td></tr>';
            });
            $('table#detail_table tbody').html(html);
            $('#total_detail').html(parseFloat(total).toFixed(2)); 
        })
        .fail(function (error) {
            messageError("No se pudo agregar este producto.", 'error');
        }).always(function(){
            console.log('complete');
        })
    }
});

$(document).on("click","[data-action='add-product']",function(event)
{
    event.preventDefault();

    var cantidad = $('#qty').val();

    if ($.isNumeric(cantidad) && parseInt(cantidad) > 0)
    {
        var id, process = true;
        id = $(this).attr('data-id');
        $("#qty-message-validation").html('');
        if (process)
        {
            var data = {
                'enviar_form': '1',
                'id_product': id,
                'qty': $('#qty').val(),
            };

            $.ajax({
                type: 'POST',
                url: base_url+'frontend/ajax/insertProductCart',
                data: data,
                dataType: 'json',
            })
            .done(function(response)
            {
                if (response.success) {
                    $('[cart-cant-="cart_cant"]').html(response.num_items);
                    $('[cart-total="cart_total"]').html('$ ' + response.total);
                    if($('#modalShoppingSuccess').length>0){
                        $('#modalShoppingSuccess').modal('show');
                        
                    }
                    $('[data-section="btn-view"]').removeClass('d-none');
                    $('#stock_inpt').text('EN STOCK');
                }else{
                    $('#stock_inpt').text('SIN STOCK');
                    $('#stock_inpt').addClass('text-danger');
                }

            })
            .fail(function (error) {
                messageError("No se pudo agregar este producto.", 'error');
            }).always(function(){
                console.log('complete');
            });
        }
    } else {
        $("#qty-message-validation").html('<small>* Ingrese una cantidad válida.</small>');
    }
});

$(document).on("click","[data-action='open-shopping-modal']",function(event) {
    event.preventDefault();
    $('#inputProductCart').val($(this).attr('data-id'));
    $('#qty').val(1);
    $('#qty-item-cart').text(' ');
});
$(document).on("click","[data-action='delete_product']",function(event) {
    event.preventDefault();
    var element = $(this);
    var data = {
        delete_form: '1',
        id: $(element).attr('data-id'),
    };
    $.ajax({
        type: "POST",
        url: base_url + 'frontend/ajax/deleteProduct',
        data: data,
        dataType: 'JSON',
        cache: false,
        success: function(response) {
            $(element).closest('tr').remove();
            var cart_total  = parseFloat(response.total);
            $("#cart_total").text('$'+(cart_total.toFixed(2).toString()));

            $("#shipping_cost").html('ENVÍO: $ 0.00');
            $("#total").text(cart_total.toFixed(2).toString());
            $("#shipping_total").text('TOTAL: $ '+(cart_total.toFixed(2).toString()));

            $('#cart_menu_num').html(response.num_items);
            if (!$("table tbody tr").length) {
                location.reload();
            }

            calculoEnvioGratis();
        },
        error: function(){
            /*$("#modalKoEliminar").modal();
            window.setTimeout(cerrarModalKo, 2400);*/
        }
    });
});
$(document).on("ifChanged","input[data-action='applyFilters']",function(event) {
    //event.preventDefault();
    window.location.href = $(this).attr('data-url');
});
$(document).on('change', 'select#shipping_method', function (event) {
    event.preventDefault();
    changeMetodoEntrega();
});
function changeMetodoEntrega()
{
    var select = $('select#shipping_method');
    $("div#shipping_container").html('');
    $('#shipping_id').val(0);
    $('#shipping').val(0);
    var total = parseFloat($('#total').html());
    $("#shipping_cost").html('ENVÍO: $ 0.00');
    $("#shipping_total").html('TOTAL: $ '+(total.toFixed(2)));
    var shipping_method = select.val();
    if (shipping_method != "")
    {
        switch (shipping_method)
        {
            case '1':
                calculadorMercadoEnvios();
                break;
            case '3':
                createSpecificShipping();
            default:
                break;
        }
    }
}
function calculadorMercadoEnvios()
{
    var htm = '';
    var elemento = $("div#shipping_container");
    htm += '<div class="form-group">' +
        '<input type="text" id="postal_code" class="form-control" placeholder="Código postal" name="postal_code">' +
        '</div>';
    htm += '<div class="form-group text-center">' +
        '<button type="button" onclick="getShippingCost(event)" class="btn btn-send">CALCULAR</button>' +
        '<div class="mt-2" id="shipping_spinner"></div>' +
        '</div>';
    htm += '<div id="shipping_alert" class="form-group">' +
        '</div>';
    elemento.html(htm);
}
function createSpecificShipping()
{
    var htm = '';
    var elemento = $("div#shipping_container");
    htm += '<div class="form-group">' +
        '<input type="text" id="postal_code" class="form-control" placeholder="Código postal" name="postal_code">' +
        '<input value="0" type="hidden" id="shipping_id" name="shipping_id">' +
        '</div>';
    htm += '<div class="form-group text-center">' +
        '<button type="button" onclick="getShippingSpecific(event)" class="btn btn-send">CALCULAR</button>' +
        '<div class="mt-2" id="shipping_spinner"></div>' +
        '</div>';
    htm += '<div id="shipping_alert" class="form-group">' +
        '</div>';
    elemento.html(htm);
}
function getShippingSpecific()
{
    var postal_code = $("input#postal_code").val();
    var total = parseFloat($('#total').html());
    $.ajax({
        type: 'post',
        url: base_url + 'frontend/ecommerce/getShippingSpecific',
        data: { postal_code: postal_code },
        dataType: 'json',
        beforeSend: function () {
            $("div#shipping_spinner").html('<p align="center"><i class="fa fa-spin fa-spinner fa-2x"></i></p>');
        }
    }).done(function (data) {
        var htm = '';
        var htm2 = '';
        var htm3 = '';
        if (data.success) {
            var shipping_cost = parseFloat(data.response.price);
            $('#shipping_id').val(data.response.shipping_id);
            var freeShipping = $("input#freeShipping").val();
            if(total>= freeShipping){
                htm2 = '' +
                'ENVIO GRATIS ¡por superar el minino coste para el envio!';
                htm3 = 'TOTAL: $ '+ (total).toFixed(2);
            }else{
                htm2 = '' +
                'ENVÍO: $ ' + shipping_cost.toFixed(2);
                htm3 = 'TOTAL: $ '+ (total+shipping_cost).toFixed(2);
            }    
        }
        else {
            htm = '<div class="alert alert-warning"><strong>No se puede enviar a este código postal.</strong><br> Por favor, intente con otra forma de entrega.</div>';
            htm2 = 'ENVÍO: $ 0.00';
            htm3 = 'TOTAL: $ '+(total.toFixed(2));
        }
        $("div#shipping_alert").html(htm);
        $("div#shipping_spinner").html('');
        $("#shipping_cost").html(htm2);
        $("#shipping_total").html(htm3);
    }).fail(function (error) {
        console.log('error');
    }).always(function () {
        console.log('complete');
    })
}
function calcularMercadoEnvios()
{
    var elemento = $("div#shipping_cost_container");
    var postal_code = $("input#postal_code").val();
    var total = parseFloat($('#total').html());
    $.ajax({
        type: 'post',
        url: base_url + 'frontend/ecommerce/mercadoEnvio',
        data: { postal_code: postal_code },
        dataType: 'json',
        beforeSend: function () {
            $("div#shipping_spinner").html('<p align="center"><i class="fa fa-spin fa-spinner fa-2x"></i></p>');
        }
    }).done(function (data) {
        var htm = '';
        var htm2 = '';
        var htm3 = '';
        if (data.success) {
            var shipping_cost = parseFloat(data.response.response.options[0].cost);
            var shipping_time = data.response.response.options[0].estimated_delivery_time.shipping;
            htm2 = '' +
            'ENVÍO: $ ' + shipping_cost.toFixed(2);
            htm3 = 'TOTAL: $ '+ (total+shipping_cost).toFixed(2);
            $('#shipping').val(shipping_cost);
        }
        else {
            htm = '<div class="alert alert-warning"><strong>No se puede enviar a este código postal.</strong><br> Por favor, intente con otra forma de entrega.</div>';
            htm2 = 'ENVÍO: $ 0.00';
            htm3 = 'TOTAL: $ '+(total.toFixed(2));
            $('#shipping').val(0);
        }
        $("div#shipping_alert").html(htm);
        $("div#shipping_spinner").html('');
        $("#shipping_cost").html(htm2);
        $("#shipping_total").html(htm3);
    }).fail(function (error) {
        console.log('error');
    }).always(function () {
        console.log('complete');
    })
}
function getShippingCost(event)
{
    event.preventDefault();
    var input = $("input#postal_code");
    if (input.val() != "")
    {
        var datos = calcularMercadoEnvios();
    }
    else {
        document.getElementById("postal_code").focus();
    }
}
$(document).on('change','#document',function(event){
    var fileName = $(this).val();
    $(this).next('.custom-file-label').html(fileName);
})


function calcularSubtotalPedido(input)
{
    var elemento = $(input);
    var qty = elemento.val();

    if (elemento.val() > 0 && $.isNumeric(elemento.val())) {

        $.ajax({
            url: base_url + 'frontend/ajax/edicionProductCart',
            type: 'POST',
            data: {
                enviar_form: '1',
                cantidad: elemento.val(),
                rowid: elemento.attr('id')
            },
            dataType: 'json',
            beforeSend: function () {
                elemento.attr('readonly', '');
            },
            success: function (data)
            {
                var dataJson = eval(data);
                var precio_unitario = elemento.attr('data-price');

                elemento.removeAttr('readonly');
                precio_unitario = parseFloat(precio_unitario);
                qty = parseInt(qty);
                precio_unitario = precio_unitario * qty;
                
                if (data.success)
                {
                    elemento.closest('tr').find('td .price').text('$' + precio_unitario.toFixed(2));
                }

                $("#total_carrito_envio").attr("total", dataJson.total);
                $("span#total_carrito_envio").text(dataJson.total);
                $("#gastos_envio").html("0.00");
                total_carrito = dataJson.total;
                $("#cart_total").html('$ ' + dataJson.total);
                $("#total").html(dataJson.total);
                $("#shipping_cost").html('ENVÍO: $ 0.00');
                $("#shipping_total").html('TOTAL: $ ' + dataJson.total);

                $("div#section-costo-envio").html('');
                $("div#section-costo-total").html('');
                $("input#codigo_postal").val('');
                $("span.items-cart").text(data.num_items);

                elemento.val(data.cantidad);
                elemento.blur();
                calcularTotalCompra();
                calculoEnvioGratis();

            },
            error: function () {
                console.log("error");
            }
        });

    }
}

function calcularTotalCompra()
{
    var subtotal = getSubotal();
    var descuento = getDescuento();
    var envio = getCostoEnvio();
    if (descuento > 0 || envio > 0)
    {
        var pagoTotal = subtotal - descuento + envio;
        showTotal(pagoTotal);
    }
}

function getDescuento()
{
    var descuento = 0;
    if ($("input#montoDescuento").length)
    {
        descuento = $("input#montoDescuento").val();
        descuento = parseFloat(descuento);
    }
    return descuento;
}

function getCostoEnvio()
{
    var envio = 0;
    if ($("input#costo_envio").val())
    {
        envio = $("input#costo_envio").val();
        envio = parseFloat(envio);
    }
    return envio;
}

function getSubotal()
{
    var subtotal = $("#total_pagar").text().trim();
    subtotal = parseFloat(subtotal.replace(',', ''));
    return subtotal;
}

function showTotal(pagoTotal)
{
    var total = pagoTotal.toFixed(2);

    var innerHtml = [
        '<div class="pull-right">',
            '<h2 align="right">',
                '<p style="font-size:16px;">TOTAL A PAGAR:</p>',
                '$<span>' + total + '</span>',
            '</h2>',
        '</div>',
    ];

    $("div#section-costo-total").html(innerHtml.join(''));

}