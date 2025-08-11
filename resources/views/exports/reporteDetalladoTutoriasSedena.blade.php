<table>
    <thead>
        <tr>
            <th valign='middle' align='center' style= "background-color: #44546a; color:#fffff;">
                Sede
            </th>
            <th valign='middle' align='center' style= "background-color: #44546a; color:#fffff;">
                Clave
            </th>
            <th valign='middle' align='center' style= "background-color: #44546a; color:#fffff;">
                Estado
            </th>
            <th valign='middle' align='center' style= "background-color: #44546a; color:#fffff;">
                Estatal/Sedena
            </th>
            <th valign='middle' align='center' style= "background-color: #44546a; color:#fffff;">
                Tecnología Internet
            </th>
            <th valign='middle' align='center' style= "background-color: #44546a; color:#fffff;">
                Semáforo de Uso de Internet
            </th>
            <th valign='middle' align='center' style= "background-color: #44546a; color:#fffff;">
                Observaciones Internet
            </th>
            <th valign='middle' align='center' style= "background-color: #44546a; color:#fffff;">
                Señalización
            </th>
            <th valign='middle' align='center' style= "background-color: #44546a; color:#fffff;">
                Electricidad
            </th>
            <th valign='middle' align='center' style= "background-color: #44546a; color:#fffff;">
                Pintura Interior
            </th>
            <th valign='middle' align='center' style= "background-color: #44546a; color:#fffff;">
                Pintura Exterior
            </th>
            <th valign='middle' align='center' style= "background-color: #44546a; color:#fffff;">
                PC's Funcionales
            </th>
            <th valign='middle' align='center' style= "background-color: #44546a; color:#fffff;">
                PC's Dañadas
            </th>
            <th valign='middle' align='center' style= "background-color: #44546a; color:#fffff;">
                PC's Faltantes
            </th>
            <th valign='middle' align='center' style= "background-color: #44546a; color:#fffff;">
                PC's Baja
            </th>
            <th valign='middle' align='center' style= "background-color: #44546a; color:#fffff;">
                Laptops Funcionales
            </th>
            <th valign='middle' align='center' style= "background-color: #44546a; color:#fffff;">
                Laptops Dañadas
            </th>
            <th valign='middle' align='center' style= "background-color: #44546a; color:#fffff;">
                Laptops Faltantes
            </th>
            <th valign='middle' align='center' style= "background-color: #44546a; color:#fffff;">
                Laptops Baja
            </th>
            <th valign='middle' align='center' style= "background-color: #44546a; color:#fffff;">
                Netbooks Funcionales
            </th>
            <th valign='middle' align='center' style= "background-color: #44546a; color:#fffff;">
                Netbooks Dañadas
            </th>
            <th valign='middle' align='center' style= "background-color: #44546a; color:#fffff;">
                Netbooks Faltantes
            </th>
            <th valign='middle' align='center' style= "background-color: #44546a; color:#fffff;">
                Netbooks Baja
            </th>
            <th valign='middle' align='center' style= "background-color: #44546a; color:#fffff;">
                Mobiliario Funcional
            </th>
            <th valign='middle' align='center' style= "background-color: #44546a; color:#fffff;">
                Mobiliario Dañado
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach($datosPorAdtSedena as $adt)
            <tr>
                <td>{{ $adt['sede'] ?? '-' }}</td>
                <td>{{ $adt['clave'] ?? '-' }}</td>
                <td>{{ $adt['estado'] ?? '-' }}</td>
                <td>{{ $adt['tipo'] ?? '-' }}</td>
                <td>{{ $adt['internet_tecnologia'] ?? '-' }}</td>
                <td>{{ $adt['internet_semaforo'] ?? '-' }}</td>
                <td>{{ $adt['internet_observaciones'] ?? '-' }}</td>
                <td>{{ $adt['senalizacion'] ?? '-'  }}</td>
                <td>{{ $adt['electricidad'] ?? '-' }}</td>
                <td>{{ $adt['pintura_interior'] ?? '-' }}</td>
                <td>{{ $adt['pintura_exterior'] ?? '-' }}</td>
                <td>{{ $adt['pc_funcional'] ?? '-' }}</td>
                <td>{{ $adt['pc_danado'] ?? '-' }}</td>
                <td>{{ $adt['pc_faltante'] ?? '-' }}</td>
                <td>{{ $adt['pc_baja'] ?? '-' }}</td>
                <td>{{ $adt['laptop_funcional'] ?? '-' }}</td>
                <td>{{ $adt['laptop_danado'] ?? '-' }}</td>
                <td>{{ $adt['laptop_faltante'] ?? '-' }}</td>
                <td>{{ $adt['laptop_baja'] ?? '-' }}</td>
                <td>{{ $adt['netbook_funcional'] ?? '-' }}</td>
                <td>{{ $adt['netbook_danado'] ?? '-' }}</td>
                <td>{{ $adt['netbook_faltante'] ?? '-' }}</td>
                <td>{{ $adt['netbook_baja'] ?? '-' }}</td>
                <td>{{ $adt['mobiliario_funcional'] ?? '-' }}</td>
                <td>{{ $adt['mobiliario_danado'] ?? '-' }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
