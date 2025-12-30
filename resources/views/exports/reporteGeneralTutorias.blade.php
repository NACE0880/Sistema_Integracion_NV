<table class="table">
    <thead class="bg-info">
        <tr><!--1-->
            <th class="text-center" colspan="9">
                {{ $datosAdts['numeroAdtsAbiertas'] ?? '-' }} ABIERTAS
            </th>
	    <th class="text-center" colspan="9">
                {{ $datosAdts['numeroAdtsInternas'] ?? '-' }} Internas
            </th>
        </tr>
    </thead>
    <tr class="table-info"><!--2-->
        <th class="text-center" colspan="5">
            {{ $datosAdts['numeroAdtsAbiertas'] ?? '-' }} Totales
        </th>
        <th class="text-center" colspan="2">
            Cerradas del mes
        </th>
        <th class="text-center" colspan="2">
            Abiertas del mes
        </th>
	<td class="text-center" colspan="9">
            {{ $datosAdts['numeroAdtsInternasPropias' ?? '-'] }} con personal interno
            @foreach($datosAdts['adtsInternasPropias'] as $adtInternaPropia)
                <br>
                ({{ $adtInternaPropia->NOMBRE }})
            @endforeach
        </td>
    </tr>
    <tr><!--3-->
        <td class="text-center" colspan="5">
            {{ $datosAdts['numeroAdtsExternas'] ?? '-' }} Externas
        </td>
        <td class="text-center" style="color: red;" colspan="2">
            -
        </td>
        <td class="text-center" style="color: red;" colspan="2">
            -
        </td>
	<td class="text-center" colspan="9">
            {{ $datosAdts['numeroAdtsInternasExternas'] ?? '-' }} con personal externo
            @foreach($datosAdts['adtsInternasExternas'] as $adtInternaExterna)
                <br>
                ({{ $adtInternaExterna->NOMBRE }})
            @endforeach
        </td>
    </tr>
    <tr><!--4-->
        <td class="text-center" colspan="5">
            {{ $datosAdts['numeroAdtsInternas'] ?? '-' }} Internas
        </td>
        <td class="text-center" style="color: red;" colspan="2">
            -
        </td>
        <td class="text-center" style="color: red;" colspan="2">
            -
        </td>
	<th class="text-center" colspan="9">
            1. Internet (uso promedio del mes: {{ number_format($datosAdts['consumoInternetLineasAdtsInternas'], 2) ?? '-' }} GB, {{ $datosAdts['consumoInternetLineasMayorAdtsInternas'] ?? '-' }} &gt; 110 GB)
        </th>
    </tr>
    <tr class="table-info"><!--5-->
        <th class="text-center" colspan="9">
            1. Internet (uso promedio del mes: {{ number_format($datosAdts['consumoInternetLineasAbiertas'], 2) ?? '-' }} GB, {{ $datosAdts['consumoInternetLineasMayorAbiertas'] ?? '-' }} &gt; 110 GB)
        </th>
	<td class="text-center" colspan="5">
            {{ $datosAdts['numeroLineasAdtsInternasExternas'] ?? '-' }} CT con <input type="text" class="d-inline-block w-auto" id="internetInfinitumPersonalInterno" name="internetInfinitumPersonalInterno" data-capturar value="{{ number_format($datosQueSeCapturan['internetInfinitumPersonalInterno'], 0, ".", ",") ?? '-' }}"> infinitum y <input type="text" class="d-inline-block w-auto" id="internetVozPersonalInterno" name="internetVozPersonalInterno" data-capturar value="{{ number_format($datosQueSeCapturan['internetVozPersonalInterno'], 0, ".", ",") ?? '-' }}"> de voz (paga Telmex)
        </td>
        <td class="text-center" colspan="4">
            {{ $datosAdts['numeroLineasAdtsInternasPropias'] ?? '-' }} CT con <input type="text" class="d-inline-block w-auto" id="internetEnlacePersonalExterno" name="internetEnlacePersonalExterno" data-capturar value="{{ number_format($datosQueSeCapturan['internetEnlacePersonalExterno'], 0, ".", ",") ?? '-' }}"> enlaces y <input type="text" class="d-inline-block w-auto" id="internetVozPersonalExterno" name="internetVozPersonalExterno" data-capturar value="{{ number_format($datosQueSeCapturan['internetVozPersonalExterno'], 0, ".", ",") ?? '-' }}"> de voz (paga Telmex)
        </td>
    </tr>
    <tr><!--6-->
        <td class="text-center" colspan="5">
            {{ $datosAdts['numeroAdtsConLineasPagaEntidad'] ?? '-' }} BDT con {{ $datosAdts['numeroLineasPagaEntidad'] ?? '-' }} líneas paga la entidad ({{ $datosAdts['numeroLineasCobre'] ?? '-'}} en cobre)
        </td>
        <td class="text-center" colspan="4">
            {{ $datosAdts['numeroAdtsConLineasPagaTelmex'] ?? '-'}} BDT con {{ $datosAdts['numeroLineasPagaTelmex'] ?? '-'}} líneas y {{ $datosAdts['numeroLineasEnlaceQuePagaTelmex'] ?? '-' }} enlaces que paga Telmex
        </td>
	<td class="text-center" colspan="5">
            {{ isset($datosAdts['costoLineasAdtsInternasExternasPagaTelmex']) ? '$' . number_format($datosAdts['costoLineasAdtsInternasExternasPagaTelmex'], 2) : '-' }}
        </td>
        <td class="text-center" colspan="4">
            {{ isset($datosAdts['costoLineasAdtsInternasPropiasPagaTelmex']) ? '$' . number_format($datosAdts['costoLineasAdtsInternasPropiasPagaTelmex'], 2) : '-' }}
        </td>
    </tr>
    <tr><!--7-->
        <td class="text-center" colspan="5">
            {{ isset($datosAdts['costoLineasPagaEntidad']) ? '$' . number_format($datosAdts['costoLineasPagaEntidad'], 2) : '-' }}
        </td>
        <td class="text-center" colspan="4">
            {{ isset($datosAdts['costoLineasPagaTelmex']) ? '$' . number_format($datosAdts['costoLineasPagaTelmex'], 2) : '-' }}
        </td>
	<td class="text-center">
            Sin consumo
        </td>
        <td class="text-center" colspan="2">
            Bajo
        </td>
        <td class="text-center" colspan="3">
            Medio
        </td>
        <td class="text-center" colspan="2">
            Alto
        </td>
        <td class="text-center">
            Heavy
        </td>
    </tr>
    <tr><!--8-->
        <td class="text-center">
            Sin consumo
        </td>
        <td class="text-center" colspan="2">
            Bajo
        </td>
        <td class="text-center" colspan="2">
            Medio
        </td>
        <td class="text-center">
            Alto
        </td>
        <td class="text-center" colspan="2">
            Heavy
        </td>
        <td class="text-center">
            Atípico
        </td>
	<td class="text-center">
            {{ $datosAdts['numeroLineasAdtsInternasConsumoSinConsumo'] ?? '-' }}
        </td>
        <td class="text-center" colspan="2">
            {{ $datosAdts['numeroLineasAdtsInternasConsumoBajo'] ?? '-' }}
        </td>
        <td class="text-center" colspan="3">
            {{ $datosAdts['numeroLineasAdtsInternasConsumoMedio'] ?? '-' }}
        </td>
        <td class="text-center" colspan="2">
            {{ $datosAdts['numeroLineasAdtsInternasConsumoAlto'] ?? '-' }}
        </td>
        <td class="text-center">
            {{ $datosAdts['numeroLineasAdtsInternasConsumoHeavy'] ?? '-' }}
        </td>
    </tr>
    <tr><!--9-->
        <td class="text-center">
            {{ $datosAdts['numeroLineasConsumoSinConsumo'] ?? '-' }}
        </td>
        <td class="text-center" colspan="2">
            {{ $datosAdts['numeroLineasConsumoBajo'] ?? '-' }}
        </td>
        <td class="text-center" colspan="2">
            {{ $datosAdts['numeroLineasConsumoMedio'] ?? '-' }}
        </td>
        <td class="text-center">
            {{ $datosAdts['numeroLineasConsumoAlto'] ?? '-' }}
        </td>
        <td class="text-center" colspan="2">
            {{ $datosAdts['numeroLineasConsumoHeavy'] ?? '-' }}
        </td>
        <td class="text-center">
            {{ $datosAdts['numeroLineasConsumoAtipico'] ?? '-' }}
        </td>
	<th class="text-center table-info" colspan="9">
            2. Equipamiento
        </th>
    </tr>
    <tr><!--10-->
        <th class="text-center table-info" colspan="9">
            2. Equipamiento
        </th>
	<td class="text-center">
            Total del proyecto
        </td>
        <td class="text-center" colspan="2">
            Funcional
        </td>
        <td class="text-center" colspan="4">
            Baja, Dañado, Obsoleto o Faltante
        </td>
        <td class="text-center" colspan="2">
            % funcional contra inicial
        </td>
    </tr>
    <tr><!--11-->
        <td class="text-center" colspan="2">
            Total del proyecto
        </td>
        <td class="text-center" colspan="2">
            Abiertas Inicial
        </td>
        <td class="text-center" colspan="2">
            Abiertas Funcional
        </td>
        <td class="text-center" colspan="3">
            % funcional contra inicial
        </td>
	<td class="text-center">
            {{ number_format($datosAdts['cantidadEquipamientoAdtsInternas'], 0, ".", ",") ?? '-' }}
        </td>
        <td class="text-center" colspan="2">
            {{ number_format($datosAdts['cantidadEquipamientoFuncionalAdtsInternas'], 0, ".", ",") ?? '-' }}
        </td>
        <td class="text-center" colspan="4">
            {{ number_format($datosAdts['cantidadEquipamientoBDOFAdtsInternas'],0 , ".", ",") ?? '-' }}
        </td>
        <td class="text-center" colspan="2">
            {{ isset($datosAdts['cantidadRelacionPorcentualEquipamientoFuncionalEntreInicialAdtsInternas']) ? number_format($datosAdts['cantidadRelacionPorcentualEquipamientoFuncionalEntreInicialAdtsInternas'], 2) . '%' : '-' }}
        </td>
    </tr>
    <tr><!--12-->
        <td class="text-center" colspan="2">
            {{ number_format($datosAdts['cantidadEquipamientoAdts'], 0, ".", ",") ?? '-' }}
        </td>
        <td class="text-center" colspan="2">
            {{ number_format($datosAdts['cantidadEquipamientoInicialAdts'], 0, ".", ",") ?? '-' }}
        </td>
        <td class="text-center" colspan="2">
            {{ number_format($datosAdts['cantidadEquipamientoFuncionalAdts'], 0, ".", ",") ?? '-'}}
        </td>
        <td class="text-center" colspan="3">
            {{ isset($datosAdts['cantidadRelacionPorcentualEquipamientoFuncionalEntreInicial']) ? number_format($datosAdts['cantidadRelacionPorcentualEquipamientoFuncionalEntreInicial'], 2) . "%" : '-' }}
        </td>
	<th class="text-center table-info" colspan="9">
            3. Mobiliario y gadgets funcionales
        </th>
    </tr>
    <tr><!--13-->
        <th class="text-center table-info" colspan="9">
            3. Mobiliario
        </th>
	<td class="text-center" colspan="2">
            Mesas
        </td>
        <td class="text-center" colspan="2">
            Sillas, bancos y puff
        </td>
        <td class="text-center" colspan="2">
            Libreros
        </td>
        <td class="text-center" colspan="3">
            Tv
        </td>
    </tr>
    <tr><!--14-->
        <td class="text-center" style="vertical-align: middle;" colspan="2" rowspan="2">
            Total del proyecto
        </td>
        <td class="text-center" colspan="7">
            BDT Abiertas
        </td>
	<td class="text-center" colspan="2">
            <input type="text" id="mobiliarioMesas" name="mobiliarioMesas" data-capturar value="{{ number_format($datosQueSeCapturan['mobiliarioMesas'], 0, ".", ",") ?? '-' }}">
        </td>
        <td class="text-center" colspan="2">
            <input type="text" id="mobiliarioSillas" name="mobiliarioSillas" data-capturar value="{{ number_format($datosQueSeCapturan['mobiliarioSillas'], 0, ".", ",") ?? '-' }}">
        </td>
        <td class="text-center" colspan="2">
            <input type="text" id="mobiliarioLibreros" name="mobiliarioLibreros" data-capturar value="{{ number_format($datosQueSeCapturan['mobiliarioLibreros'], 0, ".", ",") ?? '-' }}">
        </td>
        <td class="text-center" colspan="3" >
            <input type="text" id="mobiliarioTv" name="mobiliarioTv" data-capturar value="{{ number_format($datosQueSeCapturan['mobiliarioTv'], 0, ".", ",") ?? '-' }}">
        </td>
    </tr>
    <tr><!--15-->
        <td class="text-center" colspan="4">
            Inicial
        </td>
        <td class="text-center" colspan="3">
            Funcional
        </td>
	<td class="text-center" colspan="2">
            Archivos y lockers
        </td>
        <td class="text-center" colspan="4">
            Racks
        </td>
        <td class="text-center" colspan="3">
            Carrito cargador
        </td>
    </tr>
    <tr><!--16-->
        <td class="text-center" style="vertical-align: middle;" colspan="2">
            {{ number_format($datosAdts['cantidadMobiliarioAdts'], 0, ".", ",") ?? '-' }}
        </td>
        <td class="text-center" style="vertical-align: middle;" colspan="4">
            {{ number_format($datosAdts['cantidadMobiliarioInicialAdts'], 0, ".", ",") ?? '-' }}
        </td>
        <td class="text-center" style="vertical-align: middle;" colspan="3">
            {{ number_format($datosAdts['cantidadMobiliarioFuncionaAdts'], 0, ".", ",") ?? '-' }}
        </td>
	<td class="text-center" colspan="2">
            <input type="text" id="mobiliarioArchiveros" name="mobiliarioArchiveros" data-capturar value="{{ number_format($datosQueSeCapturan['mobiliarioArchiveros'], 0, ".", ",") ?? '-' }}">
        </td>
        <td class="text-center" colspan="4">
            <input type="text" id="mobiliarioRacks" name="mobiliarioRacks" data-capturar value="{{ number_format($datosQueSeCapturan['mobiliarioRacks'], 0, ".", ",") ?? '-' }}">
        </td>
        <td class="text-center" colspan="3">
            <input type="text" id="mobiliarioCarritoCargador" name="mobiliarioCarritoCargador" data-capturar value="{{ number_format($datosQueSeCapturan['mobiliarioCarritoCargador'], 0 , ".", ",") ?? '-' }}">
        </td>
    </tr>
    <tr><!--17-->
        <th class="text-center table-info" colspan="9">
            4. Estatus convenio
        </th>
	<th class="text-center table-info" colspan="9">
            4. Estatus convenio
        </th>
    </tr>
    <tr><!--18-->
        <td class="text-center" colspan="2">
            Indeterminado
        </td>
        <td class="text-center" colspan="3">
            Vencido
        </td>
        <td class="text-center" colspan="4">
            Vigente
        </td>
	<td class="text-center" colspan="2">
            Indeterminado
        </td>
        <td class="text-center" colspan="3">
            Vencido
        </td>
        <td class="text-center" colspan="4">
            Vigente
        </td>
    </tr>
    <tr><!--19-->
        <td class="text-center" colspan="2">
            {{ $datosAdts['numeroConveniosIndeterminadosAdts'] ?? '-' }}
        </td>
        <td class="text-center" colspan="3">
            {{ $datosAdts['numeroConveniosVencidosAdts'] ?? '-' }}
        </td>
        <td class="text-center" colspan="4">
            {{ $datosAdts['numeroConveniosVigentesAdts'] ?? '-' }}
            @foreach($datosAdts['conveniosVigentesAdts'] as $convenioVigenteAdt)
                <br>
                ({{ $convenioVigenteAdt->NOMBRE }} / 
                {{ $convenioVigenteAdt->FECHA_TERMINO_CONVENIO }}) 
            @endforeach
        </td>
	<td class="text-center" colspan="2">
            {{ $datosAdts['numeroConveniosIndeterminadosAdtsInternas'] ?? '-' }}
        </td>
        <td class="text-center" colspan="3">
            {{ $datosAdts['numeroConveniosVencidosAdtsInternas'] ?? '-' }}
        </td>
        <td class="text-center" colspan="4">
            {{ $datosAdts['numeroConveniosVigentesAdtsInternas'] ?? '-' }}
            @foreach($datosAdts['conveniosVigentesAdtsInternas'] as $convenioVigenteAdtInterna)
                <br>
                ({{ $convenioVigenteAdtInterna->NOMBRE }} / 
                {{ $convenioVigenteAdtInterna->FECHA_TERMINO_CONVENIO }}) 
            @endforeach
        </td>
    </tr>
    <tr><!--20-->
        <th class="text-center table-info" colspan="9">
            5. Usuarios BDT (acumulado: <input type="text" class="d-inline-block w-auto" id="usuariosBdtsAcumulados" name="usuariosBdtsAcumulados" data-capturar value="{{ number_format($datosQueSeCapturan['usuariosBdtsAcumulados'], 0, ".", ",") ?? '-' }}">) y Plataforma
        </th>
	<th class="text-center table-info" colspan="9">
            5. Usuarios (acumulado: <input type="text" class="d-inline-block w-auto" id="usuariosAcumulado" name="usuariosAcumulado" data-capturar value="{{ number_format($datosQueSeCapturan['usuariosAcumulado'], 0 , ".", ",") ?? '-' }}">)
        </th>
    </tr>
    <tr><!--21-->
        <td class="text-center" colspan="3">
            BDT's (<input type="text" class="d-inline-block w-auto" id="usuariosBdtsRegistraron" name="usuariosBdtsRegistraron" data-capturar value="{{ number_format($datosQueSeCapturan['usuariosBdtsRegistraron'], 0, ".", ",") ?? '-' }}">)
        </td>
        <td class="text-center" colspan="2">
            Registros
        </td>
        <td class="text-center" colspan="2">
            Inscritos
        </td>
        <td class="text-center" colspan="2">
            Constancias
        </td>
	<td class="text-center" colspan="4">
            CT Abiertas
        </td>
        <td class="text-center" colspan="2">
            Meta
        </td>
        <td class="text-center" colspan="2">
            Real
        </td>
        <td class="text-center">
            %
        </td>
    </tr>
    <tr>
        {{-- Fila inicial con totales --}}
        <td class="text-center" colspan="3">
            {{ number_format($datosQueSeCapturan['usuariosBdtsTotales'], 0, ".", ",") ?? '-' }}
        </td>
        <td class="text-center" colspan="2">
            {{ number_format($datosQueSeCapturan['usuariosBdtsRegistrados'], 0, ".", ",") ?? '-' }}
        </td>
        <td class="text-center" colspan="2">
            {{ number_format($datosQueSeCapturan['usuariosBdtsInscritos'], 0, ".", ",") ?? '-' }}
        </td>
        <td class="text-center" colspan="2">
            {{ number_format($datosQueSeCapturan['usuariosBdtsConstancias'], 0, ".", ",") ?? '-' }}
        </td>

        {{-- Primera iteración del foreach en la misma fila --}}
        @php $i = 0; @endphp
        @foreach($datosAdts['adtsAbiertasInternas'] as $adtAbiertaInterna)
            @php
                $registro = $datosQueSeCapturan['numeroDeUsuariosMetaRealAdts'][$adtAbiertaInterna->NOMBRE] ?? null;
                $idSafe = preg_replace('/[^A-Za-z0-9_-]/', '_', $adtAbiertaInterna->NOMBRE);
            @endphp

            @if($i == 0)
                <td class="text-center" colspan="4">{{ $adtAbiertaInterna->NOMBRE }}</td>
                <td class="text-center" colspan="2">
                    <input type="text" style="width:50%" id="usuarios_{{ $idSafe }}_meta"
                        name="usuarios[{{ $adtAbiertaInterna->NOMBRE }}][meta]" data-capturar
                        value="{{ $registro ? number_format((float) $registro->META, 0, '.', ',') : '' }}">
                </td>
                <td class="text-center" colspan="2">
                    <input type="text" style="width:50%" id="usuarios_{{ $idSafe }}_real"
                        name="usuarios[{{ $adtAbiertaInterna->NOMBRE }}][real]" data-capturar
                        value="{{ $registro ? number_format((float) $registro->REAL, 0, '.', ',') : '' }}">
                </td>
                <td class="text-center">-</td>
            </tr>
            @else
            <tr>
                {{-- Aquí repites la estructura de columnas iniciales pero vacías para mantener alineación --}}
                <td colspan="3"></td>
                <td colspan="2"></td>
                <td colspan="2"></td>
                <td colspan="2"></td>

                {{-- Ahora sí las columnas dinámicas --}}
                <td class="text-center" colspan="4">{{ $adtAbiertaInterna->NOMBRE }}</td>
                <td class="text-center" colspan="2">
                    <input type="text" style="width:50%" id="usuarios_{{ $idSafe }}_meta"
                        name="usuarios[{{ $adtAbiertaInterna->NOMBRE }}][meta]" data-capturar
                        value="{{ $registro ? number_format((float) $registro->META, 0, '.', ',') : '' }}">
                </td>
                <td class="text-center" colspan="2">
                    <input type="text" style="width:50%" id="usuarios_{{ $idSafe }}_real"
                        name="usuarios[{{ $adtAbiertaInterna->NOMBRE }}][real]" data-capturar
                        value="{{ $registro ? number_format((float) $registro->REAL, 0, '.', ',') : '' }}">
                </td>
                <td class="text-center">-</td>
            </tr>
            @endif

            @php $i++; @endphp
        @endforeach
    <tr><!--23-->
        <th class="text-center table-info" colspan="9">
            6. Oferta educativa
        </th>
	<th class="text-center table-info" colspan="9">
            6. Gasto mensual <input type="text" class="d-inline-block w-auto" id="gastoMensual" name="gastoMensual" data-capturar value="${{ number_format($datosQueSeCapturan['gastoMensual'], 2, '.', ',') ?? '-' }}"> / acumulado 2025 <input type="text" class="d-inline-block w-auto" id="gastoMensualAcumulado" name="gastoMensualAcumulado" data-capturar value="${{ number_format($datosQueSeCapturan['gastoMensualAcumulado'], 2, '.', ',') ?? '-' }}">
        </th>
    </tr>
    <tr><!--24-->
        <td class="text-center" colspan="2">
            Nuevos
        </td>
        <td class="text-center" colspan="2">
            Talleres
        </td>
        <td class="text-center" colspan="2">
            En línea
        </td>
        <td class="text-center" colspan="3">
            En desarrollo
        </td>
	<td class="text-center" colspan="2">
            Renta
        </td>
        <td class="text-center" colspan="2">
            Aseo
        </td>
        <td class="text-center" colspan="2">
            Luz
        </td>
        <td class="text-center" colspan="3">
            Vigilancia
        </td>
    </tr>
    <tr><!--25-->
        <td class="text-center" colspan="2">
            <input type="text" id="ofertaEducativaNuevosTalleres" name="ofertaEducativaNuevosTalleres" data-capturar value="{{ number_format($datosQueSeCapturan['ofertaEducativaNuevosTalleres'], 0, ".", ",") ?? '-' }}">
        </td>
        <td class="text-center" colspan="2">
            <input type="text" id="ofertaEducativaTalleres" name="ofertaEducativaTalleres" data-capturar value="{{ number_format($datosQueSeCapturan['ofertaEducativaTalleres'], 0, ".", ",") ?? '-' }}">
        </td>
        <td class="text-center" colspan="2">
            <input type="text" id="ofertaEducativaEnLinea" name="ofertaEducativaEnLinea" data-capturar value="{{ number_format($datosQueSeCapturan['ofertaEducativaEnLinea'], 0, ".", ",") ?? '-' }}">
        </td>
        <td class="text-center" colspan="3">
            <input type="text" id="ofertaEducativaTalleresEnDesarrollo" name="ofertaEducativaTalleresEnDesarrollo" data-capturar value="{{ number_format($datosQueSeCapturan['ofertaEducativaTalleresEnDesarrollo'], 0, ".", ",") ?? '-' }}">
        </td>
	<td class="text-center" colspan="2">
            <input type="text" id="gastoMensualRenta" name="gastoMensualRenta" data-capturar value="${{ number_format($datosQueSeCapturan['gastoMensualRenta'], 2, '.', ',') ?? '-' }}">
        </td>
        <td class="text-center" colspan="2">
            <input type="text" id="gastoMensualAseo" name="gastoMensualAseo" data-capturar value="${{ number_format($datosQueSeCapturan['gastoMensualAseo'], 2, '.', ',') ?? '-' }}">
        </td>
        <td class="text-center" colspan="2">
            <input type="text" id="gastoMensualLuz" name="gastoMensualLuz" data-capturar value="${{ number_format($datosQueSeCapturan['gastoMensualLuz'], 2, '.', ',') ?? '-' }}">
        </td>
        <td class="text-center" colspan="3">
            <input type="text" id="gastoMensualVigilancia" name="gastoMensualVigilancia" data-capturar value="${{ number_format($datosQueSeCapturan['gastoMensualVigilancia'], 2, '.', ',') ?? '-' }}">
        </td>
    </tr>
    <tr><!--26-->
        <th class="text-center table-info" colspan="9">
            7. Nuevas Solicitudes 2025 (<input type="text" class="d-inline-block w-auto" id="solicitudesRecibidas" name="solicitudesRecibidas" data-capturar value="{{ number_format($datosQueSeCapturan['solicitudesRecibidas'], 0, ".", ",") ?? '-' }}"> recibidas)
        </th>
	<td class="text-center" colspan="2">
            Agua Potable
        </td>
        <td class="text-center" colspan="4">
            Nòmina Operaciòn
        </td>
        <td class="text-center" colspan="3">
            Nòmina Gerencia
        </td>
    </tr>
    <tr><!--27-->
        <td colspan="7"> 
            Solicitud BDT o donación de equipos
        </td>
        <td class="text-center" colspan="2">
            <input type="text" id="solicitudBdt" name="solicitudBdt" data-capturar value="{{ number_format($datosQueSeCapturan['solicitudBdt'],0 , ".", ",") ?? '-' }}">
        </td>
	<td class="text-center" colspan="2">
            <input type="text" id="gastoAguaPotable" name="gastoAguaPotable" data-capturar value="${{ number_format($datosQueSeCapturan['gastoAguaPotable'], 2, '.', ',') ?? '-' }}">
        </td>
        <td class="text-center" colspan="4">
            <input type="text" id="gastoNominaOperacion" name="gastoNominaOperacion" data-capturar value="${{ number_format($datosQueSeCapturan['gastoNominaOperacion'], 2, '.', ',') ?? '-' }}">
        </td>
        <td class="text-center" colspan="3">
            <input type="text" id="gastoNominaGerencia" name="gastoNominaGerencia" data-capturar value="${{ number_format($datosQueSeCapturan['gastoNominaGerencia'], 2, '.', ',') ?? '-' }}">
        </td>
    </tr>
    <tr><!--28-->
        <td colspan="7"> 
            Solicitud BDT de reequipamiento
        </td>
        <td class="text-center" colspan="2">
            <input type="text" id="solicitudReequipamiento" name="solicitudReequipamiento" data-capturar value="{{ number_format($datosQueSeCapturan['solicitudReequipamiento'], 0, ".", ",") ?? '-' }}">
        </td>
	<th class="text-center table-info">
            Mantenimientos:
        </th>
        <th class="text-center table-info" colspan="2">
            Total:
        </th>
        <td class="text-center" colspan="2">
            <input type="text" id="gastoMantenimientosTotal" name="gastoMantenimientosTotal" data-capturar value="${{ number_format($datosQueSeCapturan['gastoMantenimientosTotal'], 2, '.', ',') ?? '-' }}">
        </td>
        <th class="text-center table-info" colspan="2">
            Ejercido:
        </th>
        <th class="text-center" colspan="2"><!-- eliminé table-info (color celda)-->
            <input type="text" id="gastoMantenimientosEjercido" name="gastoMantenimientosEjercido" data-capturar value="${{ number_format($datosQueSeCapturan['gastoMantenimientosEjercido'], 2, '.', ',') ?? '-' }}">
        </th>
    </tr>
    <tr><!--29-->
        <td colspan="7"> 
            Retiro de equipos
        </td>
        <td class="text-center" colspan="2">
            <input type="text" id="solicitudRetiro" name="solicitudRetiro" data-capturar value="{{ number_format($datosQueSeCapturan['solicitudRetiro'], 0, ".", ",") ?? '-' }}">
        </td>
	<th class="bg-secondary text-white text-center" colspan="9">
            Solicitudes relevantes del mes:
        </th>
    </tr>
    <tr><!--30-->
        <td colspan="7"> 
            Otros (visitas a museo, acuario, etc.)
        </td>
        <td class="text-center" colspan="2">
            <input type="text" id="solicitudOtros" name="solicitudOtros" data-capturar value="{{ number_format($datosQueSeCapturan['solicitudOtros'], 0, ".", ",") ?? '-' }}">
        </td>
	<th class="text-center" colspan="9">
            -
        </th>
    </tr>
</table>

<table class="table">
    <thead class="bg-secondary">
        <tr><!--1-->
            <th class="text-center" colspan="9">
                {{ $datosAdts['numeroAdtsCerradasInternas'] ?? '-' }} Internas
            </th>
        </tr>
    </thead>
    <tr><!--2-->
        <td class="text-center" colspan="9">
            @foreach($datosAdts['adtsCerradasInternas'] as $adtCerradaInterna)
                {{ $adtCerradaInterna->NOMBRE }}@if(!$loop->last), @endif
            @endforeach
        </td>
    </tr>
    <tr class="table-secondary"><!--3-->
        <th class="text-center" colspan="9">
            1. Internet (uso promedio del mes: {{ number_format($datosAdts['consumoInternetLineasAdtsInternasCerradas'], 2) ?? '-' }} GB, {{ $datosAdts['consumoInternetLineasMayorAdtsInternasCerradas'] ?? '-' }} &gt; 110 GB)
        </th>
    </tr>
    <tr><!--4-->
        <td class="text-center" colspan="5"><!--En producción seguirá siendo datos que se capturan pero las variables dentro del array al final tendrán C-->
            {{ $datosAdts['numeroLineasAdtsInternasExternasCerradas'] ?? '-' }} CT con <input type="text" class="d-inline-block w-auto" id="internetInfinitumPersonalInternoC" name="internetInfinitumPersonalInternoC" data-capturar value="{{ number_format($datosQueSeCapturan['internetInfinitumPersonalInternoC'], 0, ".", ",") ?? '-' }}"> infinitum y <input type="text" class="d-inline-block w-auto" id="internetVozPersonalInternoC" name="internetVozPersonalInternoC" data-capturar value="{{ number_format($datosQueSeCapturan['internetVozPersonalInternoC'], 0, ".", ",") ?? '-' }}"> de voz (paga Telmex)
        </td>
        <td class="text-center" colspan="4">
            {{ $datosAdts['numeroLineasAdtsInternasPropiasCerradas'] ?? '-' }} CT con <input type="text" class="d-inline-block w-auto" id="internetEnlacePersonalExternoC" name="internetEnlacePersonalExternoC" data-capturar value="{{ number_format($datosQueSeCapturan['internetEnlacePersonalExternoC'], 0, ".", ",") ?? '-' }}"> enlaces y <input type="text" class="d-inline-block w-auto" id="internetVozPersonalExternoC" name="internetVozPersonalExternoC" data-capturar value="{{ number_format($datosQueSeCapturan['internetVozPersonalExternoC'], 0, ".", ",") ?? '-' }}"> de voz (paga Telmex)
        </td>
    </tr>
    <tr><!--5-->
        <td class="text-center" colspan="5">
            {{ $datosAdts['costoLineasAdtsInternasExternasCerradasPagaTelmex'] ?? '-' }}
        </td>
        <td class="text-center" colspan="4">
            {{ isset($datosAdts['costoLineasAdtsInternasPropiasCerradasPagaTelmex']) ? '$' . number_format($datosAdts['costoLineasAdtsInternasPropiasCerradasPagaTelmex'], 2) : '-' }}
        </td>
    </tr>
    <tr><!--6-->
        <td class="text-center">
            Sin consumo
        </td>
        <td class="text-center" colspan="2">
            Bajo
        </td>
        <td class="text-center" colspan="2">
            Medio
        </td>
        <td class="text-center" colspan="2">
            Alto
        </td>
        <td class="text-center" colspan="2">
            Heavy
        </td>
    </tr>
    <tr><!--7-->
        <td class="text-center">
            {{ $datosAdts['numeroLineasAdtsInternasCerradasConsumoSinConsumo'] ?? '-' }}
        </td>
        <td class="text-center" colspan="2">
            {{ $datosAdts['numeroLineasAdtsInternasCerradasConsumoBajo'] ?? '-' }}
        </td>
        <td class="text-center" colspan="2">
            {{ $datosAdts['numeroLineasAdtsInternasCerradasConsumoMedio'] ?? '-' }}
        </td>
        <td class="text-center" colspan="2">
            {{ $datosAdts['numeroLineasAdtsInternasCerradasConsumoAlto'] ?? '-' }}
        </td>
        <td class="text-center" colspan="2">
            {{ $datosAdts['numeroLineasAdtsInternasCerradasConsumoHeavy'] ?? '-' }}
        </td>
    </tr>
    <tr><!--8-->
        <th class="text-center table-secondary" colspan="9">
            2. Equipamiento
        </th>
    </tr>
    <tr><!--9-->
        <td class="text-center" colspan="2">
            Total del proyecto
        </td>
        <td class="text-center" colspan="4">
            Abiertas Funcional
        </td>
        <td class="text-center" colspan="3">
            Baja, Dañado, Obsoleto o Faltante
        </td>
    </tr>
    <tr><!--10-->
        <td class="text-center" colspan="2">
            {{ number_format($datosAdts['cantidadEquipamientoAdtsInternasCerradas'], 0, ".", ",") ?? '-' }}
        </td>
        <td class="text-center" colspan="4">
            {{ number_format($datosAdts['cantidadEquipamientoFuncionalAdtsInternasCerradas'], 0, ".", ",") ?? '-' }}
        </td>
        <td class="text-center" colspan="3">
            {{ number_format($datosAdts['cantidadEquipamientoBDOFAdtsInternasCerradas'], 0, ".", ",") ?? '-' }}
        </td>
    </tr>
    <tr><!--11-->
        <th class="text-center table-secondary" colspan="9">
            3. Mobiliario y gadgets
        </th>
    </tr>
    <tr><!--12-->
        <td class="text-center" colspan="2">
            Mesas
        </td>
        <td class="text-center" colspan="2">
            Sillas, bancos y puff
        </td>
        <td class="text-center" colspan="2">
            Libreros
        </td>
        <td class="text-center" colspan="3">
            Tv
        </td>
    </tr>
    <tr><!--13-->
        <td class="text-center" colspan="2">
            <input type="text" id="mobiliarioMesasC" name="mobiliarioMesasC" data-capturar value="{{ number_format($datosQueSeCapturan['mobiliarioMesasC'], 0, ".", ",") ?? '-' }}">
        </td>
        <td class="text-center" colspan="2">
            <input type="text" id="mobiliarioSillasC" name="mobiliarioSillasC" data-capturar value="{{ number_format($datosQueSeCapturan['mobiliarioSillasC'], 0, ".", ",") ?? '-' }}">
        </td>
        <td class="text-center" colspan="2">
            <input type="text" id="mobiliarioLibrerosC" name="mobiliarioLibrerosC" data-capturar value="{{ number_format($datosQueSeCapturan['mobiliarioLibrerosC'], 0, ".", ",") ?? '-' }}">
        </td>
        <td class="text-center" colspan="3">
            <input type="text" id="mobiliarioTvC" name="mobiliarioTvC" data-capturar value="{{ number_format($datosQueSeCapturan['mobiliarioTvC'], 0, ".", ",") ?? '-' }}">
        </td>
    </tr>
    <tr><!--14-->
        <td class="text-center" colspan="3">
            Archiveros y Lockers
        </td>
        <td class="text-center" colspan="3">
            Racks
        </td>
        <td class="text-center" colspan="3">
            Carrito Cargador
        </td>
    </tr>
    <tr><!--15-->
        <td class="text-center" colspan="3">
            <input type="text" id="mobiliarioArchiverosC" name="mobiliarioArchiverosC" data-capturar value="{{ number_format($datosQueSeCapturan['mobiliarioArchiverosC'], 0, ".", ",") ?? '-' }}">
        </td>
        <td class="text-center" colspan="3">
            <input type="text" id="mobiliarioRacksC" name="mobiliarioRacksC" data-capturar value="{{ number_format($datosQueSeCapturan['mobiliarioRacksC'], 0, ".", ",") ?? '-' }}">
        </td>
        <td class="text-center" colspan="3">
            <input type="text" id="mobiliarioCarritoCargadorC" name="mobiliarioCarritoCargadorC" data-capturar value="{{ number_format($datosQueSeCapturan['mobiliarioCarritoCargadorC'], 0, ".", ",") ?? '-' }}">
        </td>
    </tr>
    <tr><!--16-->
        <th class="text-center table-secondary" colspan="9">
            4. Estatus convenio
        </th>
    </tr>
    <tr><!--17-->
        <td class="text-center" colspan="2">
            Vigente
        </td>
        <td class="text-center" colspan="3">
            Vencido
        </td>
        <td class="text-center" colspan="4">
            Sin convenio
        </td>
    </tr>
    <tr><!--18-->
        <td class="text-center" colspan="2">
            {{ $datosAdts['numeroConveniosVigentesAdtsInternasCerradas'] ?? '-' }}
            @foreach($datosAdts['conveniosVigentesAdtsInternasCerradas'] as $convenioVigenteAdtInternaCerrada)
                <br>
                ({{ $convenioVigenteAdtInternaCerrada->NOMBRE }} / 
                {{ $convenioVigenteAdtInternaCerrada->FECHA_TERMINO_CONVENIO }}) 
            @endforeach
        </td>
        <td class="text-center" colspan="3">
            {{ $datosAdts['numeroConveniosVencidosAdtsInternasCerradas'] ?? '-' }}
        </td>
        <td class="text-center" colspan="4">
            {{ $datosAdts['numeroConveniosIndeterminadosAdtsInternasCerradas'] ?? '-' }}
        </td>
    </tr>
    <tr><!--19-->
        <th class="text-center table-secondary" colspan="9">
            5. Usuarios (acumulado: <input type="text" class="d-inline-block w-auto" id="usuariosAcumuladoC" name="usuariosAcumuladoC" data-capturar value="{{ number_format($datosQueSeCapturan['usuariosAcumuladoC'], 0, ".", ",") ?? '-' }}">)
        </th>
    </tr>
    <tr><!--20-->
        <td class="text-center" colspan="2">
            BDT ({{ $datosAdts['numeroAdtsCerradasInternas'] ?? '-' }} Cerradas)
        </td>
        <td class="text-center" colspan="3">
            @php
                $meses = ["ene", "feb", "mar", "abr", "may", "jun", 
                        "jul", "ago", "sep", "oct", "nov", "dic"];
                $mes = $meses[date('n') - 1]; // date('n') devuelve 1-12
            @endphp
            ene-{{ $mes }} 2025
        </td>
        <td class="text-center">
            <input type="text" id="numeroUsuariosDelAnioBdts" name="numeroUsuariosDelAnioBdts" data-capturar value="{{ number_format($datosQueSeCapturan['numeroUsuariosDelAnioBdts'], 0, ".", ",") ?? '-' }}">
        </td>
        <td class="text-center" colspan="2">
            Del mes
        </td>
        <td class="text-center">
            <input type="text" id="numeroUsuariosDelMesBdts" name="numeroUsuariosDelMesBdts" data-capturar value="{{ number_format($datosQueSeCapturan['numeroUsuariosDelMesBdts'], 0, ".", ",") ?? '-' }}">
        </td>
    </tr>
    <tr><!--21-->
        <td class="text-center" colspan="2">
            FILIALES
        </td>
        <td class="text-center" colspan="3">
            ene-{{ $mes }} 2025
        </td>
        <td class="text-center">
            <input type="text" id="numeroUsuariosDelAnioFiliales" name="numeroUsuariosDelAnioFiliales" data-capturar value="{{ number_format($datosQueSeCapturan['numeroUsuariosDelAnioFiliales'], 0, ".", ",") ?? '-' }}">
        </td>
        <td class="text-center" colspan="2">
            Del mes
        </td>
        <td class="text-center">
            <input type="text" id="numeroUsuariosDelMesFiliales" name="numeroUsuariosDelMesFiliales" data-capturar value="{{ number_format($datosQueSeCapturan['numeroUsuariosDelMesFiliales'], 0, ".", ",") ?? '-' }}">
        </td>
    </tr>
    <tr><!--22-->
        <td class="text-center" colspan="9">
            SANBORNS, SEARS, Global Hitss, Sección Amarilla, TELCEL, Bienestar Social, SCITUM, RED UNO, Guarderías Telmex, INBURSA, TELESITES
        </td>
    </tr>
    <tr><!--23-->
        <th class="text-center table-secondary" colspan="9">
            6. Gasto mensual <input type="text" class="d-inline-block w-auto" id="gastoMensualC" name="gastoMensualC" data-capturar value="${{ number_format($datosQueSeCapturan['gastoMensualC'], 2, '.', ',') ?? '-' }}"> / acumulado 2025 <input type="text" class="d-inline-block w-auto" id="gastoMensualAcumuladoC" name="gastoMensualAcumuladoC" data-capturar value="${{ number_format($datosQueSeCapturan['gastoMensualAcumuladoC'], 2, '.', ',') ?? '-' }}">
        </th>
    </tr>
    <tr><!--24-->
        <td class="text-center" colspan="2">
            Renta
        </td>
        <td class="text-center" colspan="2">
            Aseo
        </td>
        <td class="text-center" colspan="2">
            Luz
        </td>
        <td class="text-center" colspan="3">
            Vigilancia
        </td>
    </tr>
    <tr><!--25-->
        <td class="text-center" colspan="2">
            <input type="text" id="gastoMensualRentaC" name="gastoMensualRentaC" data-capturar value="${{ number_format($datosQueSeCapturan['gastoMensualRentaC'], 2, '.', ',') ?? '-' }}">
        </td>
        <td class="text-center" colspan="2">
            <input type="text" id="gastoMensualAseoC" name="gastoMensualAseoC" data-capturar value="${{ number_format($datosQueSeCapturan['gastoMensualAseoC'], 2, '.', ',') ?? '-' }}">
        </td>
        <td class="text-center" colspan="2">
            <input type="text" id="gastoMensualLuzC" name="gastoMensualLuzC" data-capturar value="${{ number_format($datosQueSeCapturan['gastoMensualLuzC'], 2, '.', ',') ?? '-' }}">
        </td>
        <td class="text-center" colspan="3">
            <input type="text" id="gastoMensualVigilanciaC" name="gastoMensualVigilanciaC" data-capturar value="${{ number_format($datosQueSeCapturan['gastoMensualVigilanciaC'], 2, '.', ',') ?? '-' }}">
        </td>
    </tr>
    <tr><!--26-->
        <td class="text-center" colspan="3">
            Agua Potable
        </td>
        <td class="text-center" colspan="3">
            Nómina operación
        </td>
        <td class="text-center" colspan="3">
            Nómina total
        </td>
    </tr>
    <tr><!--27-->
        <td class="text-center" colspan="3">
            <input type="text" id="gastoAguaPotableC" name="gastoAguaPotableC" data-capturar value="${{ number_format($datosQueSeCapturan['gastoAguaPotableC'], 2, '.', ',') ?? '-' }}">
        </td>
        <td class="text-center" colspan="3">
            <input type="text" id="gastoNominaOperacionC" name="gastoNominaOperacionC" data-capturar value="${{ number_format($datosQueSeCapturan['gastoNominaOperacionC'], 2, '.', ',') ?? '-' }}">
        </td>
        <td class="text-center" colspan="3">
            <input type="text" id="gastoNominaGerenciaC" name="gastoNominaGerenciaC" data-capturar value="${{ number_format($datosQueSeCapturan['gastoNominaGerenciaC'], 2, '.', ',') ?? '-' }}">
        </td>
    </tr>
    <tr><!--28-->
        <th class="text-center table-secondary">
            Mantenimientos:
        </th>
        <th class="text-center table-secondary" colspan="2">
            Total:
        </th>
        <td class="text-center" colspan="2">
            <input type="text" id="gastoMantenimientosTotalC" name="gastoMantenimientosTotalC" data-capturar value="${{ number_format($datosQueSeCapturan['gastoMantenimientosTotalC'], 2, '.', ',') ?? '-' }}">
        </td>
        <th class="text-center table-secondary" colspan="2">
            Ejercido:
        </th>
        <td class="text-center" colspan="2">
            <input type="text" id="gastoMantenimientosEjercidoC" name="gastoMantenimientosEjercidoC" data-capturar value="${{ number_format($datosQueSeCapturan['gastoMantenimientosEjercidoC'], 2, '.', ',') ?? '-' }}">
        </td>
    </tr>
    <tr><!--29-->
        <th class="bg-secondary text-white text-center" colspan="9">
            Solicitudes relevantes del mes:
        </th>
    </tr>
    <tr class="table-secondary"><!--30-->
        <th class="text-center" colspan="9">
            -
        </th>
    </tr>
</table>