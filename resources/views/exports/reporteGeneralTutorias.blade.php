<table border="1">
  <thead>
    <tr>
        <th valign='middle' align='center' style= "background-color: #44546a; color:#fffff;">
            Señaléctica Colocada
        </th>
        <th valign='middle' align='center' style= "background-color: #44546a; color:#fffff;">
            Señaléctica Despegada
        </th>
        <th valign='middle' align='center' style= "background-color: #44546a; color:#fffff;">
            Electricidad Funcional
        </th>
        <th valign='middle' align='center' style= "background-color: #44546a; color:#fffff;">
            Electricidad Intermitente
        </th>
        <th valign='middle' align='center' style= "background-color: #44546a; color:#fffff;">
            Electricidad Sin Servicio
        </th>
        <th valign='middle' align='center' style= "background-color: #44546a; color:#fffff;">
            Pintura Interior Sin Cambios
        </th>
        <th valign='middle' align='center' style= "background-color: #44546a; color:#fffff;">
            Pintura Interior Dañada
        </th>
        <th valign='middle' align='center' style= "background-color: #44546a; color:#fffff;">
            Pintura Interior con Filtración
        </th>
        <th valign='middle' align='center' style= "background-color: #44546a; color:#fffff;">
            Pintura Exterior Sin Cambios
        </th>
        <th valign='middle' align='center' style= "background-color: #44546a; color:#fffff;">
            Pintura Exterior Dañada
        </th>
        <th valign='middle' align='center' style= "background-color: #44546a; color:#fffff;">
            Pintura Exterior con Filtración
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
            Mobiliario Funcional|
        </th>
        <th valign='middle' align='center' style= "background-color: #44546a; color:#fffff;">
            Mobiliario Dañado
        </th>
    </tr>
  </thead>
  <tbody>
    <tr>
        <td>
            {{ $total['total_senalizacion_colocada'] }}
        </td>
        <td>
            {{ $total['total_senalizacion_despegada'] }}
        </td>
        <td>
            {{ $total['total_electricidad_funcional'] }}
        </td>
        <td>
            {{ $total['total_electricidad_intermitente'] }}
        </td>
        <td>
            {{ $total['total_electricidad_sin_servicio'] }}
        </td>
        <td>
            {{ $total['total_pintura_interior_sin_cambios'] }}
        </td>
        <td>
            {{ $total['total_pintura_interior_danado'] }}
        </td>
        <td>
            {{ $total['total_pintura_interior_filtracion'] }}
        </td>
        <td>
            {{ $total['total_pintura_exterior_sin_cambios'] }}
        </td>
        <td>
            {{ $total['total_pintura_exterior_danado'] }}
        </td>
        <td>
            {{ $total['total_pintura_exterior_filtracion'] }}
        </td>
        <td>
            {{ $total['total_equipamiento_funcional'] }}
        </td>
        <td>
            {{ $total['total_equipamiento_danado'] }}
        </td>
        <td>
            {{ $total['total_equipamiento_faltante'] }}
        </td>
        <td>
            {{ $total['total_equipamiento_baja'] }}
        </td>
        <td>
            {{ $total['total_mobiliario_funcional'] }}
        </td>
        <td>
            {{ $total['total_mobiliario_danado'] }}
        </td>
    </tr>
  </tbody>
</table>
