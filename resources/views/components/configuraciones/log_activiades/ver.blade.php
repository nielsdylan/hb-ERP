@extends('components.configuraciones.app-configuraciones')
@section('titulo')
HB GROUP - Gestion de Actividades
@endsection
@section('css')
<link href="{{ asset('template/plugins/prism/prism.css') }}" rel="stylesheet">
<link href="{{ asset('template/plugins/treeview-prism/prism.css') }}" rel="stylesheet">
<link href="{{ asset('template/plugins/treeview-prism/prism-treeview.css') }}" rel="stylesheet">
{{-- <link href="{{ asset('template/css/themes/all-themes.css') }}" rel="stylesheet"> --}}

@endsection
@section('content')
@section('configuracion-page-header')

<div class="page-header">
    <h1 class="page-title">Gestion de Actividades</h1>
    <div>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Configuraciones</a></li>
            <li class="breadcrumb-item active" aria-current="page">Gestion de Actividades</li>
        </ol>
    </div>
</div>

@endsection
@section('configuracion-content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            {{-- <div class="card-status bg-blue br-te-7 br-ts-7"></div> --}}
            <div class="card-header">
                <h3 class="card-title">Ver de Actividad</h3>
                <div class="card-options">
                    {{-- <a href="javascript:void(0)" class="btn btn-success btn-sm" id="nuevo" ><i class="fe fe-plus"></i> Nuevo Accesos</a> --}}
                </div>
            </div>
            <div class="card-body">
                <div class="row justify-content-md-center">
                    <div class="col-md-12">
                    </div>
                </div>

                <div class="row">
                        
                    <div class="col-md-4">
                        <div class="form-group ">
                            <label class="form-label">Fecha :</label>
                            <input type="text" name="fecha" class="form-control form-control-sm" value="{{ $actividad->fecha }}" disabled>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group ">
                            <label class="form-label">Usuario :</label>
                            <input type="text" name="usuario" class="form-control form-control-sm" value="{{ $actividad->usuario->nombre_corto }}" disabled>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group ">
                            <label class="form-label">Tipo de actividad :</label>
                            <input type="text" name="tipo_actividad" class="form-control form-control-sm" value="{{ $actividad->tipoActividades->descripcion }}" disabled>
                        </div>
                    </div>
                </div>
                <div class="row">
                    
                    <div class="col-md-4">
                        <div class="form-group ">
                            <label class="form-label">Formulario :</label>
                            <input type="text" name="formulario" class="form-control form-control-sm" value="{{ $actividad->formulario }}"  disabled>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group ">
                            <label class="form-label">Tabla :</label>
                            <input type="text" name="tabla" class="form-control form-control-sm" value="{{ $actividad->tabla }}" disabled>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label class="form-label">Valor Anterior :</label>
                        <textarea name="" class="form-control form-control-sm" id="" cols="30" rows="10">{!! $actividad->valor_anterior !!}</textarea>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Valor Nuevo :</label>
                        <textarea name="" class="form-control form-control-sm" id="" cols="30" rows="10">{!! $actividad->nuevo_valor !!}</textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ROW-1 END -->

@endsection

@section('script')

    <!-- INTERNAL SELECT2 JS -->
    <script src="{{asset('template/plugins/select2/select2.full.min.js')}}"></script>
    {{-- <script src="{{asset('template/js/select2.js')}}"></script> --}}

    
    
    <!-- Internal Prism js-->
    <script src="{{asset('template/plugins/prism/prism.js')}} "></script>
    <!-- Treeview js-->
    <script src="{{asset('template/plugins/treeview-prism/prism.js')}} "></script>
    <script src="{{asset('template/plugins/treeview-prism/prism-treeview.js')}} "></script>

    <!-- Custom js-->
    {{-- <script src="{{asset('template/js/custom.js')}} "></script> --}}
    
    <script>
        $(function() {
            $('.main-sidebar .with-sub').on('click', function(e) {
                e.preventDefault();
                $(this).parent().toggleClass('show');
                $(this).parent().siblings().removeClass('show');
            })	

            // FOOTER
            document.getElementById("year").innerHTML = new Date().getFullYear();
        });

        $(document).ready(function() {
            var url = window.location; 
            var element = $('.menu.main-sidebar .list .nav-item a').filter(function() {
            return this.href == url || url.href.indexOf(this.href) == 0; }).parent().addClass('active');
            if (element.is('li a')) { 
                    element.addClass('active').parent().parent('li').addClass('active')
                }
        });

        // Toggle Sidebar
        $('[data-toggle="sidebar"]').click(function(event) { 
            event.preventDefault();
            $('body').toggleClass('ls-closed');
        });
    </script>
    <script src="{{asset('template/js/menuspy.min.js')}} "></script>



<script>
    var elm = document.querySelector('#main-menu');
    var ms = new MenuSpy(elm);

	(function () {

        if (typeof self === 'undefined' || !self.Prism || !self.document) {
            return;
        }

        /**
         * Class name for <pre> which is activating the plugin
         * @type {String}
         */
        var PLUGIN_CLASS = 'line-numbers';

        /**
         * Resizes line numbers spans according to height of line of code
         * @param  {Element} element <pre> element
         */
        var _resizeElement = function (element) {
            var codeStyles = getStyles(element);
            var whiteSpace = codeStyles['white-space'];

            if (whiteSpace === 'pre-wrap' || whiteSpace === 'pre-line') {
                var codeElement = element.querySelector('code');
                var lineNumbersWrapper = element.querySelector('.line-numbers-rows');
                var lineNumberSizer = element.querySelector('.line-numbers-sizer');
                var codeLines = element.textContent.split('\n');

                if (!lineNumberSizer) {
                    lineNumberSizer = document.createElement('span');
                    lineNumberSizer.className = 'line-numbers-sizer';

                    codeElement.appendChild(lineNumberSizer);
                }

                lineNumberSizer.style.display = 'block';

                codeLines.forEach(function (line, lineNumber) {
                    lineNumberSizer.textContent = line || '\n';
                    var lineSize = lineNumberSizer.getBoundingClientRect().height;
                    lineNumbersWrapper.children[lineNumber].style.height = lineSize + 'px';
                });

                lineNumberSizer.textContent = '';
                lineNumberSizer.style.display = 'none';
            }
        };

        /**
         * Returns style declarations for the element
         * @param {Element} element
         */
        var getStyles = function (element) {
            if (!element) {
                return null;
            }

            return window.getComputedStyle ? getComputedStyle(element) : (element.currentStyle || null);
        };

        window.addEventListener('resize', function () {
            Array.prototype.forEach.call(document.querySelectorAll('pre.' + PLUGIN_CLASS), _resizeElement);
        });

        Prism.hooks.add('complete', function (env) {
            if (!env.code) {
                return;
            }

            // works only for <code> wrapped inside <pre> (not inline)
            var pre = env.element.parentNode;
            // Original regex check for class, leaving it here
            // for its redundancy check
            var clsReg = /\s*\bline-numbers\b\s*/;
            // New regex check for opt-out class
            var clsRegB = /\s*\bno-line-numbers\b\s*/;

            if (env.element.querySelector(".line-numbers-rows")) {
                // Abort if line numbers already exists
                return;
            }

            // Added to facilitate opting out
            if (clsRegB.test(pre.className)) {
                // Respect the opt-out
                return;
            }

            if (clsReg.test(env.element.className)) {
                // Remove the class "line-numbers" from the <code>
                env.element.className = env.element.className.replace(clsReg, ' ');
            }
            if (!clsReg.test(pre.className)) {
                // Add the class "line-numbers" to the <pre>
                pre.className += ' line-numbers';
            }

            var match = env.code.match(/\n(?!$)/g);
            var linesNum = match ? match.length + 1 : 1;
            var lineNumbersWrapper;

            var lines = new Array(linesNum + 1);
            lines = lines.join('<span></span>');

            lineNumbersWrapper = document.createElement('span');
            lineNumbersWrapper.setAttribute('aria-hidden', 'true');
            lineNumbersWrapper.className = 'line-numbers-rows';
            lineNumbersWrapper.innerHTML = lines;

            if (pre.hasAttribute('data-start')) {
                pre.style.counterReset = 'linenumber ' + (parseInt(pre.getAttribute('data-start'), 10) - 1);
            }

            env.element.appendChild(lineNumbersWrapper);

            _resizeElement(pre);
        });

    }());
</script>
@endsection