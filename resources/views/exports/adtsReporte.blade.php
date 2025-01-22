<table>
    <thead>

    </thead>

    <tbody>
    <tr>
            <th width="40" colspan="3" valign='middle' align='center'></th>
            <th width="30" colspan="1" valign='middle' align='center'></th>
            <th width="30" colspan="1" valign='middle' align='center'></th>
            <th width="30" colspan="2" valign='middle' align='center'></th>
        </tr>
        <tr>
            <th colspan="2" valign='middle' align='center'><img src="img/logo-telmex-edu.jpeg" alt=""></th>
            <th colspan="1" valign='middle' align='center'></th>

            <th colspan="1" valign='middle' align='center'>Clave de sitio:</th>
            <th colspan="1" valign='middle' align='center' style= "background-color: #ffff99;">{{$adt->CLAVE_SITIO}}</th>

            <th colspan="1" valign='middle' align='center'></th>
            <th colspan="1" valign='middle' align='center'><img src="img/departamento.png" alt=""></th>
        </tr>
        <tr>
            <th colspan="3" valign='middle' align='center'></th>
            <th colspan="1" valign='middle' align='center'></th>
            <th colspan="1" valign='middle' align='center'></th>
            <th colspan="2" valign='middle' align='center'></th>
        </tr>

        <tr>
            <td colspan="7" valign='middle' align='center' style= "background-color: #44546a; color:#fffff;">
                BIBLIOTECAS DIGITALES TELMEX
            </td>
        </tr>

        <tr>
            <td colspan="1" valign='middle' style= "color:blue">
                Nombre de la BDT
            </td>
            <td colspan="6" valign='middle'>
                {{$adt->NOMBRE}}
            </td>
        </tr>

        <tr>
            <td colspan="1" valign='middle' style= "color:blue">
                Estado
            </td>
            <td colspan="2" valign='middle'>
                {{$adt->ESTADO}}
            </td>

            <td colspan="1" valign='middle' style= "color:blue">
                Municipio
            </td>
            <td colspan="1" valign='middle'>
                {{$adt->MUNICIPIO}}
            </td>

            <td colspan="1" valign='middle' style= "color:blue">
                Localidad
            </td>
            <td colspan="1" valign='middle'>
                {{$adt->LOCALIDAD}}
            </td>
        </tr>

        <tr>
            <td colspan="1" valign='middle' style= "color:blue">
                Dirección completa
            </td>
            <td colspan="6" valign='middle'>
                {{$adt->DOMICILIO}}
            </td>
        </tr>
        <tr>
            <td colspan="1" valign='middle' style= "color:blue">
                C.P.
            </td>
            <td colspan="6" valign='middle'>
                {{$adt->CP}}
            </td>
        </tr>

        <tr>
            <td colspan="7" valign='middle' align='center' style= "background-color: #44546a; color:#fffff;">
                DATOS DEL RESPONSABLE DEL AULA O BDT
            </td>
        </tr>

        <tr>
            <td colspan="1" valign='middle' style= "color:blue">
                Nombre completo
            </td>
            <td colspan="4" valign='middle'>
                {{ $adt->responsableAula($adt->ID_ADT)->NOMBRE }}
            </td>

            <td colspan="1" valign='middle' style= "color:blue">
                Cargo
            </td>
            <td colspan="1" valign='middle'>
                {{ $adt->responsableAula($adt->ID_ADT)->CARGO }}
            </td>
        </tr>

        <tr>
            <td colspan="1" valign='middle' style= "color:blue">
                Teléfono fijo
            </td>
            <td colspan="2" valign='middle'>
                {{ $adt->responsableAula($adt->ID_ADT)->TELEFONO }}
            </td>

            <td colspan="1" valign='middle' style= "color:blue">
                Celular
            </td>
            <td colspan="1" valign='middle'>
                {{ $adt->responsableAula($adt->ID_ADT)->CELULAR }}
            </td>

            <td colspan="1" valign='middle' style= "color:blue">
                Correo electrónico
            </td>
            <td colspan="1" valign='middle'>
                {{ $adt->responsableAula($adt->ID_ADT)->CORREO }}
            </td>
        </tr>

        <tr>
            <td colspan="7" valign='middle' align='center' style= "background-color: #44546a; color:#fffff;">
                DATOS DEL RESPONSABLE DEL AULA O BDT EXTRA
            </td>
        </tr>

        <tr>
            <td colspan="1" valign='middle' style= "color:blue">
                Nombre completo
            </td>
            <td colspan="4" valign='middle'>
                {{ $adt->responsableAulaExtra($adt->ID_ADT)->NOMBRE }}
            </td>

            <td colspan="1" valign='middle' style= "color:blue">
                Cargo
            </td>
            <td colspan="1" valign='middle'>
                {{ $adt->responsableAulaExtra($adt->ID_ADT)->CARGO }}
            </td>
        </tr>

        <tr>
            <td colspan="1" valign='middle' style= "color:blue">
                Teléfono fijo
            </td>
            <td colspan="2" valign='middle'>
                {{ $adt->responsableAulaExtra($adt->ID_ADT)->TELEFONO }}
            </td>

            <td colspan="1" valign='middle' style= "color:blue">
                Celular
            </td>
            <td colspan="1" valign='middle'>
                {{ $adt->responsableAulaExtra($adt->ID_ADT)->CELULAR }}
            </td>

            <td colspan="1" valign='middle' style= "color:blue">
                Correo electrónico
            </td>
            <td colspan="1" valign='middle'>
                {{ $adt->responsableAulaExtra($adt->ID_ADT)->CORREO }}
            </td>
        </tr>

        <tr>
            <td colspan="7" valign='middle' align='center' style= "background-color: #44546a; color:#fffff;">
                DATOS DEL CONTACTO MUNICIPAL O DIRECTOR DE LA ESCUELA/SITIO (OPCIONAL)
            </td>
        </tr>

        <tr>
            <td colspan="1" valign='middle' style= "color:blue">
                Nombre completo
            </td>
            <td colspan="4" valign='middle'>
                {{ $adt->contactoMunicipal($adt->ID_ADT)->NOMBRE }}
            </td>

            <td colspan="1" valign='middle' style= "color:blue">
                Cargo
            </td>
            <td colspan="1" valign='middle'>
                {{ $adt->contactoMunicipal($adt->ID_ADT)->CARGO }}
            </td>
        </tr>

        <tr>
            <td colspan="1" valign='middle' style= "color:blue">
                Teléfono fijo
            </td>
            <td colspan="2" valign='middle'>
                {{ $adt->contactoMunicipal($adt->ID_ADT)->TELEFONO }}
            </td>

            <td colspan="1" valign='middle' style= "color:blue">
                Celular
            </td>
            <td colspan="1" valign='middle'>
                {{ $adt->contactoMunicipal($adt->ID_ADT)->CELULAR }}
            </td>

            <td colspan="1" valign='middle' style= "color:blue">
                Correo electrónico
            </td>
            <td colspan="1" valign='middle'>
                {{ $adt->contactoMunicipal($adt->ID_ADT)->CORREO }}
            </td>
        </tr>

        <tr>
            <td colspan="7" valign='middle' align='center' style= "background-color: #44546a; color:#fffff;">
                UTILIZACIÓN DEL AULA O BDT
            </td>
        </tr>

        <tr>
            <td colspan="1" valign='middle' style= "color:blue">
                Visitantes diarios
            </td>
            <td colspan="2" valign='middle'>
                {{-- {{ $adt->visitantes($adt->ID_ADT) }} --}}
            </td>

            <td colspan="2" valign='middle' style= "color:blue">
                Que talleres se imparten
            </td>
            <td colspan="2" valign='middle'>
                {{-- {{ $adt->talleresimpartidos($adt->ID_ADT) }} --}}
            </td>
        </tr>

        <tr>
            <td colspan="1" valign='middle' style= "color:blue">
                Tipo de actividades:
            </td>
            <td colspan="2" valign='middle'>
                {{-- {{ $adt->actividades($adt->ID_ADT) }} --}}
            </td>

            <td colspan="2" valign='middle' style= "color:blue">
                Necesidades adicionales
            </td>
            <td colspan="2" valign='middle'>
                {{-- {{ $adt->necesidades($adt->ID_ADT) }} --}}
            </td>
        </tr>

        <tr>
            <td colspan="1" valign='middle' align='center' style= "background-color: #44546a; color:#fffff;">
                EQUIPOS
            </td>
            <td colspan="2" valign='middle' align='center' style= "background-color: #44546a; color:#fffff;">
                INVENTARIO INICIAL
            </td>
            <td colspan="1" valign='middle' align='center' style= "background-color: #44546a; color:#fffff;">
                FUNCIONAL
            </td>
            <td colspan="1" valign='middle' align='center' style= "background-color: #44546a; color:#fffff;">
                DAÑADO
            </td>
            <td colspan="1" valign='middle' align='center' style= "background-color: #44546a; color:#fffff;">
                FALTANTE
            </td>
            <td colspan="1" valign='middle' align='center' style= "background-color: #44546a; color:#fffff;">
                BAJA
            </td>
        </tr>

        <tr>
            <td colspan="1" valign='middle' style= "color:blue">
                PC's Escritorio:
            </td>
            <td colspan="2" valign='middle' align='center' align='center'>
                {{ $adt->equipamientoInicial($adt->ID_ADT)->PC }}
            </td>
            <td colspan="1" valign='middle' align='center' align='center'>
                {{ $adt->equipamientoFuncional($adt->ID_ADT)->PC }}
            </td>
            <td colspan="1" valign='middle' align='center' align='center'>
                {{ $adt->equipamientoDañado($adt->ID_ADT)->PC }}
            </td>
            <td colspan="1" valign='middle' align='center' align='center'>
                {{ $adt->equipamientoFaltante($adt->ID_ADT)->PC }}
            </td>
            <td colspan="1" valign='middle' align='center' align='center'>
                {{ $adt->equipamientoBaja($adt->ID_ADT)->PC }}
            </td>
        </tr>

        <tr>
            <td colspan="1" valign='middle' style= "color:blue">
                Laptop:
            </td>
            <td colspan="2" valign='middle' align='center'>
                {{ $adt->equipamientoInicial($adt->ID_ADT)->LAPTOP }}
            </td>
            <td colspan="1" valign='middle' align='center'>
                {{ $adt->equipamientoFuncional($adt->ID_ADT)->LAPTOP }}
            </td>
            <td colspan="1" valign='middle' align='center'>
                {{ $adt->equipamientoDañado($adt->ID_ADT)->LAPTOP }}
            </td>
            <td colspan="1" valign='middle' align='center'>
                {{ $adt->equipamientoFaltante($adt->ID_ADT)->LAPTOP }}
            </td>
            <td colspan="1" valign='middle' align='center'>
                {{ $adt->equipamientoBaja($adt->ID_ADT)->LAPTOP }}
            </td>
        </tr>

        <tr>
            <td colspan="1" valign='middle' style= "color:blue">
                Netbook:
            </td>
            <td colspan="2" valign='middle' align='center'>
                {{ $adt->equipamientoInicial($adt->ID_ADT)->NETBOOK }}
            </td>
            <td colspan="1" valign='middle' align='center'>
                {{ $adt->equipamientoFuncional($adt->ID_ADT)->NETBOOK }}
            </td>
            <td colspan="1" valign='middle' align='center'>
                {{ $adt->equipamientoDañado($adt->ID_ADT)->NETBOOK }}
            </td>
            <td colspan="1" valign='middle' align='center'>
                {{ $adt->equipamientoFaltante($adt->ID_ADT)->NETBOOK }}
            </td>
            <td colspan="1" valign='middle' align='center'>
                {{ $adt->equipamientoBaja($adt->ID_ADT)->NETBOOK }}
            </td>
        </tr>

        <tr>
            <td colspan="1" valign='middle' style= "color:blue">
                CLASSMATE
            </td>
            <td colspan="2" valign='middle' align='center'>
                {{ $adt->equipamientoInicial($adt->ID_ADT)->CLASSMATE }}
            </td>
            <td colspan="1" valign='middle' align='center'>
                {{ $adt->equipamientoFuncional($adt->ID_ADT)->CLASSMATE }}
            </td>
            <td colspan="1" valign='middle' align='center'>
                {{ $adt->equipamientoDañado($adt->ID_ADT)->CLASSMATE }}
            </td>
            <td colspan="1" valign='middle' align='center'>
                {{ $adt->equipamientoFaltante($adt->ID_ADT)->CLASSMATE }}
            </td>
            <td colspan="1" valign='middle' align='center'>
                {{ $adt->equipamientoBaja($adt->ID_ADT)->CLASSMATE }}
            </td>
        </tr>

        <tr>
            <td colspan="1" valign='middle' style= "color:blue">
                XO
            </td>
            <td colspan="2" valign='middle' align='center'>
                {{ $adt->equipamientoInicial($adt->ID_ADT)->XO }}
            </td>
            <td colspan="1" valign='middle' align='center'>
                {{ $adt->equipamientoFuncional($adt->ID_ADT)->XO }}
            </td>
            <td colspan="1" valign='middle' align='center'>
                {{ $adt->equipamientoDañado($adt->ID_ADT)->XO }}
            </td>
            <td colspan="1" valign='middle' align='center'>
                {{ $adt->equipamientoFaltante($adt->ID_ADT)->XO }}
            </td>
            <td colspan="1" valign='middle' align='center'>
                {{ $adt->equipamientoBaja($adt->ID_ADT)->XO }}
            </td>
        </tr>

        <tr>
            <td colspan="1" valign='middle' align='center' style= "background-color: #44546a; color:#fffff;">
                MOBILIARIO
            </td>
            <td colspan="3" valign='middle' align='center' style= "background-color: #44546a; color:#fffff;">
                INVENTARIO INICIAL
            </td>
            <td colspan="3" valign='middle' align='center' style= "background-color: #44546a; color:#fffff;">
                FUNCIONAL
        </tr>

        <tr>
            <td colspan="1" valign='middle' style= "color:blue">
                Mesa rectangular grande
            </td>
            <td colspan="3" valign='middle' align='center'>
                {{ $adt->mobiliarioInicial($adt->ID_ADT)->MESA_RECTANGULAR_GRANDE }}
            </td>
            <td colspan="3" valign='middle' align='center'>
                {{ $adt->mobiliarioFuncional($adt->ID_ADT)->MESA_RECTANGULAR_GRANDE }}
            </td>
        </tr>

        <tr>
            <td colspan="1" valign='middle' style= "color:blue">
                Mesa rectangular mediana
            </td>
            <td colspan="3" valign='middle' align='center'>
                {{ $adt->mobiliarioInicial($adt->ID_ADT)->MESA_RECTANGULAR_MEDIANA }}
            </td>
            <td colspan="3" valign='middle' align='center'>
                {{ $adt->mobiliarioFuncional($adt->ID_ADT)->MESA_RECTANGULAR_MEDIANA }}
            </td>
        </tr>

        <tr>
            <td colspan="1" valign='middle' style= "color:blue">
                Mesa circular
            </td>
            <td colspan="3" valign='middle' align='center'>
                {{ $adt->mobiliarioInicial($adt->ID_ADT)->MESA_CIRCULAR }}
            </td>
            <td colspan="3" valign='middle' align='center'>
                {{ $adt->mobiliarioFuncional($adt->ID_ADT)->MESA_CIRCULAR }}
            </td>
        </tr>

        <tr>
            <td colspan="1" valign='middle' style= "color:blue">
                Sillas
            </td>
            <td colspan="3" valign='middle' align='center'>
                {{ $adt->mobiliarioInicial($adt->ID_ADT)->SILLAS }}
            </td>
            <td colspan="3" valign='middle' align='center'>
                {{ $adt->mobiliarioFuncional($adt->ID_ADT)->SILLAS }}
            </td>
        </tr>

        <tr>
            <td colspan="1" valign='middle' style= "color:blue">
                Mueble de resguardo
            </td>
            <td colspan="3" valign='middle' align='center'>
                {{ $adt->mobiliarioInicial($adt->ID_ADT)->MUEBLE_RESGUARDO }}
            </td>
            <td colspan="3" valign='middle' align='center'>
                {{ $adt->mobiliarioFuncional($adt->ID_ADT)->MUEBLE_RESGUARDO }}
            </td>
        </tr>

        <tr>
            <td colspan="7" valign='middle' align='center' style= "background-color: #44546a; color:#fffff;">
                OBSERVACIONES EN INFRAESTRUCTURA
            </td>
        </tr>

        <tr>
            <td colspan="1" valign='middle' style= "color:blue">
                Pintura Interior
            </td>
            <td colspan="3" valign='middle' align='center'>
                {{ $adt->infraestructura($adt->ID_ADT)->PINTURA_INTERIOR }}
            </td>
            <td colspan="1" valign='middle' style= "color:blue">
                Pintura Exterior
            </td>
            <td colspan="2" valign='middle' align='center'>
                {{ $adt->infraestructura($adt->ID_ADT)->PINTURA_EXTERIOR }}
            </td>
        </tr>

        <tr>
            <td colspan="1" valign='middle' style= "color:blue">
                Estatus Kit
            </td>
            <td colspan="3" valign='middle' align='center'>
                {{ $adt->infraestructura($adt->ID_ADT)->KIT_SENALIZACION }}
            </td>
            <td colspan="1" valign='middle' style= "color:blue">
                Electricidad
            </td>
            <td colspan="2" valign='middle' align='center'>
                {{ $adt->infraestructura($adt->ID_ADT)->ELECTRICIDAD }}
            </td>
        </tr>

        <tr>
            <td colspan="7" valign='middle' align='center' style= "background-color: #44546a; color:#fffff;">
                OBSERVACIONES GENERALES
            </td>
        </tr>
        <tr>
            <td colspan="7" valign='middle' align='center'>
                {{ $adt->observacionesUltimoContacto($adt->ID_ADT) }}
            </td>
        </tr>

    </tbody>
</table>
