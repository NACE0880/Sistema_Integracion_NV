<table border="1">
  <thead>
    <tr>
        <th valign='middle' align='center' style= "background-color: #44546a; color:#fffff;">
            Internet
        </th>
        <th valign='middle' align='center' style= "background-color: #44546a; color:#fffff;">
            Infraestructura
        </th>
        <th valign='middle' align='center' style= "background-color: #44546a; color:#fffff;">
            Señaléctica
        </th>
        <th valign='middle' align='center' style= "background-color: #44546a; color:#fffff;">
            Equipamiento Inicial
        </th>
        <th valign='middle' align='center' style= "background-color: #44546a; color:#fffff;">
            Equipamiento Funcional
        </th>
        <th valign='middle' align='center' style= "background-color: #44546a; color:#fffff;">
            Equipamiento Dañado
        </th>
        <th valign='middle' align='center' style= "background-color: #44546a; color:#fffff;">
            Equipamiento Faltante
        </th>
        <th valign='middle' align='center' style= "background-color: #44546a; color:#fffff;">
            Equipamiento Baja
        </th>
        <th valign='middle' align='center' style= "background-color: #44546a; color:#fffff;">
            Mobiliario Inicial
        </th>
        <th valign='middle' align='center' style= "background-color: #44546a; color:#fffff;">
            Mobiliario Funcional
        </th>
    </tr>
  </thead>
  <tbody>
    <tr>
        <td>
            Internet
        </td>
        <td>
            Internet
        </td>
        <td>
            Internet
        </td>
        <td>
            Internet
        </td>
        <td>
            Internet
        </td>
        <td>
            Internet
        </td>
        <td>
            Internet
        </td>
        <td>
            Internet
        </td>
        <td>
            Internet
        </td>
        <td>
            Internet
        </td>
        <td>
            {{ $total['total_senalizacion_colocada'] }}
        </td>
    </tr>
    <tr>
        <td>
            Kit Señalización Despegada
        </td>
        <td>
            {{ $total['total_senalizacion_despegada'] }}
        </td>
    </tr>
    <tr>
        <td>
            Electricidad Funcional
        </td>
        <td>
            {{ $total['total_electricidad_funcional'] }}
        </td>
    </tr>
    <tr>
        <td>
            Electricidad intermitente
        </td>
        <td>
            {{ $total['total_electricidad_intermitente'] }}
        </td>
    </tr>
    <tr>
        <td>
            Electricidad Sin Servicio
        </td>
        <td>
            {{ $total['total_electricidad_sin_servicio'] }}
        </td>
    </tr>
    <tr>
        <td>
            Pintura Interior Sin cambios
        </td>
        <td>
            {{ $total['total_pintura_interior_sin_cambios'] }}
        </td>
    </tr>
    <tr>
        <td>
            Pintura Interior Dañado
        </td>
        <td>
            {{ $total['total_pintura_interior_danado'] }}
        </td>
    </tr>
    <tr>
        <td>
            Pintura Interior Filtración
        </td>
        <td>
            {{ $total['total_pintura_interior_filtracion'] }}
        </td>
    </tr>
    <tr>
        <td>
            Pintura Exterior Sin Cambios
        </td>
        <td>
            {{ $total['total_pintura_exterior_sin_cambios'] }}
        </td>
    </tr>
    <tr>
        <td>
            Pintura Exterior Dañados
        </td>
        <td>
            {{ $total['total_pintura_exterior_danado'] }}
        </td>
    </tr>
    <tr>
        <td>
            Pintura Exterior Filtración
        </td>
        <td>
            {{ $total['total_pintura_exterior_filtracion'] }}
        </td>
    </tr>
    <tr>
        <td>
            Tipo de Uso: Aula
        </td>
        <td>
            {{ $total['total_tipo_uso_aula'] }}
        </td>
    </tr>
    <tr>
        <td>
            Tipo de Uso: Maestros
        </td>
        <td>
            {{ $total['total_tipo_uso_maestros'] }}
        </td>
    </tr>
    <tr>
        <td>
            Tipo de Uso: Navegación Libre
        </td>
        <td>
            {{ $total['total_tipo_navegación_libre'] }}
        </td>
    </tr>
    <tr>
        <td>
            Mayoría de Población Niños
        </td>
        <td>
            {{ $total['total_mayoría_poblacion_ninos'] }}
        </td>
    </tr>
    <tr>
        <td>
            Mayoría de Población Adolescentes
        </td>
        <td>
            {{ $total['total_mayoría_poblacion_adolescentes'] }}
        </td>
    </tr>
    <tr>
        <td>
            Mayoría de Población Adultos
        </td>
        <td>
            {{ $total['total_mayoría_poblacion_adultos'] }}
        </td>
    </tr>
    <tr>
        <td>
            PC Funcional
        </td>
        <td>
            {{ $total['total_pc_funcional'] }}
        </td>
    </tr>
    <tr>
        <td>
            PC Dañado
        </td>
        <td>
            {{ $total['total_pc_danado'] }}
        </td>
    </tr>
    <tr>
        <td>
            PC Faltante
        </td>
        <td>
            {{ $total['total_pc_faltante'] }}
        </td>
    </tr>
    <tr>
        <td>
            PC Baja
        </td>
        <td>
            {{ $total['total_pc_baja'] }}
        </td>
    </tr>
    <tr>
        <td>
            Laptop Funcional
        </td>
        <td>
            {{ $total['total_laptop_funcional'] }}
        </td>
    </tr>
    <tr>
        <td>
            Laptop Dañado
        </td>
        <td>
            {{ $total['total_laptop_danado'] }}
        </td>
    </tr>
    <tr>
        <td>
            Laptop Faltante
        </td>
        <td>
            {{ $total['total_laptop_faltante'] }}
        </td>
    </tr>
    <tr>
        <td>
            Laptop Baja
        </td>
        <td>
            {{ $total['total_laptop_baja'] }}
        </td>
    </tr>
    <tr>
        <td>
            Netbook Funcional
        </td>
        <td>
            {{ $total['total_netbook_funcional'] }}
        </td>
    </tr>
    <tr>
        <td>
            Netbook Dañado
        </td>
        <td>
            {{ $total['total_netbook_danado'] }}
        </td>
    </tr>
    <tr>
        <td>
            Netbook Faltante
        </td>
        <td>
            {{ $total['total_netbook_faltante'] }}
        </td>
    </tr>
    <tr>
        <td>
            Netbook Baja
        </td>
        <td>
            {{ $total['total_netbook_baja'] }}
        </td>
    </tr>
  </tbody>
</table>
