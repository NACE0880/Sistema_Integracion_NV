<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PruebasController extends Controller
{
    public function index(){
        $mensaje = 'Funciona?';
        return view('Pruebas.index',compact('mensaje'));
    }

// Metodo de obtencion de registros totales por repetición de registros por zona y entidad
/*
    public function  detalle_general (){
        $chunk  = self::cargarJson('app/archivos/general.json', 1000);

        $sedena         = [];
        $gn             = [];

        $regiones_sdn   = [];
        $estructura_regiones =
                        [
                        ''=>0,
                        'i'=>0,
                        'ii' =>0,
                        'iii' =>0,
                        'iv' =>0,
                        'v' =>0,
                        'vi' =>0,
                        'vii' =>0,
                        'viii' =>0,
                        'ix' =>0,
                        'x' =>0,
                        'xi' =>0,
                        'xii' =>0];
        $regiones_gn    = []; $reg_gn_estr = [];

        $zonas_sdn      = []; $zon_sdn_estr = [];
        $zonas_gn       = []; $zon_gn_estr = [];

        $estados_gn     = []; $est_gn_estr = [];

        // 5 entidad - 6 region - 7 zona militar - 8 estado
        foreach ($chunk as $dato) {
            if(mb_strtolower($dato[5]) == 'sedena'){
                $sedena         = self::union($dato[5], $sedena);
                $regiones_sdn   = self::union($dato[6], $regiones_sdn);
                $zonas_sdn      = self::union($dato[7], $zonas_sdn);
            }
            if(mb_strtolower($dato[5]) == 'guardia nacional'){
                $gn             = self::union($dato[5], $gn);
                $regiones_gn    = self::union($dato[6], $regiones_gn);
                $zonas_gn       = self::union($dato[7], $zonas_gn);
                $estados_gn     = self::union($dato[8], $estados_gn);
            }
        }

        // Cuenta de resultados filtrados por su estructura (estr) clave valor
        $sedena         = self::cuentaFiltrada($sedena, $sedena);
        $regiones_sdn   = self::cuentaFiltrada($regiones_sdn,$estructura_regiones );
        $zonas_sdn      = self::cuentaFiltrada($zonas_sdn, $zon_sdn_estr);


        $gn             = self::cuentaFiltrada($gn, $gn);
        $regiones_gn    = self::cuentaFiltrada($regiones_gn, $estructura_regiones);
        $zonas_gn       = self::cuentaFiltrada($zonas_gn, $zon_gn_estr);
        $estados_gn     = self::cuentaFiltrada($estados_gn, $est_gn_estr);


        return view('Pruebas.index',compact(
            'sedena', 'regiones_sdn', 'zonas_sdn',
            'gn', 'regiones_gn', 'zonas_gn','estados_gn',

        ));
    }

    public function union($dato, $arreglo){
        if (is_string($dato)) {
            $aux = [mb_strtolower($dato)];
            return array_merge($arreglo,$aux);
        }
    }

    public function cuentaFiltrada($arreglo , $estructura_arr){
        $palabras = [];
        $resultado = 0;

        $cuenta = array_count_values($arreglo);
        $palabras = array_filter($cuenta, function($count){
            return $count > 0 ;
        });

        //  Eliminar valores vacíos
        // foreach ($palabras as $key => $value) {
        //     if ($key == "") {
        //         unset($palabras[$key]);
        //     }
        // }

        ksort($palabras, SORT_NATURAL);
        foreach ($palabras as $key => $value) {
            $resultado += $value;
            $estructura_arr[$key] = $value;
        }
        $estructura_arr["TOTAL:"] = $resultado;
        return $estructura_arr;
    }
*/
    public function cargarJson($ruta, $chunksize){
        $archivoJson = file_get_contents(storage_path($ruta));

        if ($archivoJson === false){
            die('Error al cargar el JSON');
        }

        $datos = json_decode($archivoJson, true);

        // Asignar tamño del chunk - 61,084 -> 5s (soportado)
        // datos[0] por ser inecesariamente una matriz de 3 dimensiones
        $datos  = array_chunk($datos[0], $chunksize);
        if($datos === null){
            die('Error al decodificar JSON.');
        }
        return $datos[0];
    }

    public function asignarIndice($arreglo) {
        $data = array();

        foreach( $arreglo as $registro){
            $data[mb_strtolower($registro[0])] = $registro;
        }

        return $data;
    }


//Vista real
    public function reporte(){
        $chunksize = 10000;
        // Cuncks de datos Contenidos Especializados - General (PLATAFORMA) - Oferta Educativa
        $chunk_CE  = self::cargarJson('app/archivos/matriculas.json', $chunksize);
        $chunk_GENERAL_GN   = self::asignarIndice(self::cargarJson('app/archivos/GN.json', $chunksize));
        $chunk_GENERAL_SDN  = self::asignarIndice(self::cargarJson('app/archivos/SDN.json', $chunksize));


        $gn_CE = 0; $sdn_CE = 0; $Contenidos_Especializados = 0;
        $gn_periodo = 0; $gn_historico = 0; $gn_GENERAL = 0;
        $sdn_periodo = 0; $sdn_historico = 0; $sdn_GENERAL = 0;




        foreach ($chunk_CE as $dato) {
            $sdn_CE += $dato[2];
            $gn_CE += $dato[3];
            $Contenidos_Especializados += $dato[4];
        }

        foreach ($chunk_GENERAL_GN as $dato) {
            $gn_periodo += $dato[1];
            $gn_historico += $dato[2];
            $gn_GENERAL += $dato[3];
        }

        foreach ($chunk_GENERAL_SDN as $dato) {
            $sdn_periodo += $dato[1];
            $sdn_historico += $dato[2];
            $sdn_GENERAL += $dato[3];
        }


        $totales = [
            'sdn_CE' => $sdn_CE,
            'gn_CE' => $gn_CE,
            'Contenidos_Especializados' => $Contenidos_Especializados,

            'gn_periodo' => $gn_periodo,
            'gn_historico' => $gn_historico,
            'gn_GENERAL' => $gn_GENERAL,

            'sdn_periodo' => $sdn_periodo,
            'sdn_historico' => $sdn_historico,
            'sdn_GENERAL' => $sdn_GENERAL,
        ];

        // print_r($chunk_GENERAL_SDN);
        return view('Pruebas.reporte_sdn_gn',compact('chunk_CE','chunk_GENERAL_GN', 'chunk_GENERAL_SDN', 'totales'));
    }

    public function propuesta(){
        $mensaje = 'mensaje';
        return view('Pruebas.propuesta', compact('mensaje'));
    }
}
