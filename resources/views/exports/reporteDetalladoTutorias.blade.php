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
        <tr>
            <td>{{ $datosPorAdt['sede'] ?? '-' }}</td>
            <td>{{ $datosPorAdt['clave'] ?? '-' }}</td>
            <td>{{ $datosPorAdt['estado'] ?? '-' }}</td>
            <td>{{ $datosPorAdt['tipo'] ?? '-' }}</td>
            <td>{{ $datosPorAdt['internet_tecnologia'] ?? '-' }}</td>
            <td>{{ $datosPorAdt['internet_semaforo'] ?? '-' }}</td>
            <td>{{ $datosPorAdt['internet_observaciones'] ?? '-' }}</td>
            <td>{{ $datosPorAdt['senalizacion'] ?? '-'  }}</td>
            <td>{{ $datosPorAdt['electricidad'] ?? '-' }}</td>
            <td>{{ $datosPorAdt['pintura_interior'] ?? '-' }}</td>
            <td>{{ $datosPorAdt['pintura_exterior'] ?? '-' }}</td>
            <td>{{ $datosPorAdt['pc_funcional'] ?? '-' }}</td>
            <td>{{ $datosPorAdt['pc_danado'] ?? '-' }}</td>
            <td>{{ $datosPorAdt['pc_faltante'] ?? '-' }}</td>
            <td>{{ $datosPorAdt['pc_baja'] ?? '-' }}</td>
            <td>{{ $datosPorAdt['laptop_funcional'] ?? '-' }}</td>
            <td>{{ $datosPorAdt['laptop_danado'] ?? '-' }}</td>
            <td>{{ $datosPorAdt['laptop_faltante'] ?? '-' }}</td>
            <td>{{ $datosPorAdt['laptop_baja'] ?? '-' }}</td>
            <td>{{ $datosPorAdt['netbook_funcional'] ?? '-' }}</td>
            <td>{{ $datosPorAdt['netbook_danado'] ?? '-' }}</td>
            <td>{{ $datosPorAdt['netbook_faltante'] ?? '-' }}</td>
            <td>{{ $datosPorAdt['netbook_baja'] ?? '-' }}</td>
            <td>{{ $datosPorAdt['mobiliario_funcional'] ?? '-' }}</td>
            <td>{{ $datosPorAdt['mobiliario_danado'] ?? '-' }}</td>
        </tr>
    </tbody>
</table>
