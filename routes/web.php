<?php

use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TelegramWebhookController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/storage-link', function () {
    Artisan::call('storage:link');
});

Route::post('/telegram-webhook', 'TelegramWebhookController@handleWebhook');


Route::get('/portal/aldea','LandingController@landingAldea')->name('landing.aldea');
Route::get('/portal/general','LandingController@landingGeneral')->name('landing.general');
Route::get('/portal/videos','LandingController@cardAldea')->name('landing.card');
Route::get('/portal/propuestas','LandingController@propuestas')->name('landing.propuestas');



// MIDLEWARE POR POSIBLES ATAQUES XSS
Route::group(['middleware'=>'XSS'], function() {
// PANEL CONTROL DE MENSAJERIA
    Route::get('/panel-control','WhatsappController@panelControl')->name('panel.whatsapp');
    Route::get('/panel-control/mensajes-whatsapp','WhatsappController@mensajeriaWhatsapp')->name('mensajeria.whatsapp');
    Route::get('/panel-control/mensajes-telegram','TelegramController@mensajeriaTelegram')->name('mensajeria.telegram');
    Route::get('/panel-control/mensajes-gmail','GmailController@base')->name('mensajeria.gmail');

// PROBAR NUEVOS COMPONENTES
    // Route::get('/pruebas','PruebasController@index')->name('pruebas');
    Route::get('/pruebas','PruebasController@mensajeDesarrollo')->name('pruebas');

// TICKETS
    // Solicitud de colecciones
    Route::get('/tickets/creacion/{id}/Casas','TicketsController@obtenerCasas');
    Route::get('/tickets/creacion/{id}/Directores','TicketsController@obtenerDirectores');
    Route::get('/tickets/creacion/{id}/Drives','TicketsController@obtenerDrives');
    Route::get('/tickets/creacion/{id}/Afecciones','TicketsController@obtenerAfecciones');
    Route::get('/tickets/creacion/{id}/Areas','TicketsController@obtenerAreas');
    Route::get('/tickets/creacion/{id}/Encargados','TicketsController@obtenerEncargados');
    Route::get('/tickets/creacion/{id_casa}/{id_afeccion}/Supervisores','TicketsController@obtenerSupervisores');
    Route::get('/tickets/creacion/{id_casa}/{id_afeccion}/Subgerentes','TicketsController@obtenerSubgerentes');
    Route::get('/tickets/creacion/{id_casa}/{id_afeccion}/Gerentes','TicketsController@obtenerGerentes');

    Route::get('/tickets/creacion/{id_entornos}/{id_casa}/Sitios','TicketsController@obtenerSitios');
    Route::get('/tickets/creacion/{id}/Espacio','TicketsController@obtenerEspacio');
    Route::get('/tickets/creacion/{id}/Objetos','TicketsController@obtenerObjetos');
    Route::get('/tickets/creacion/{id}/Elementos','TicketsController@obtenerElementos');
    Route::get('/tickets/creacion/{id}/Prioridades','TicketsController@obtenerPrioridades');

    // Solicitud de Excel
    Route::get('/exportar/cotizacion/{nombre}', 'TicketsController@exportCotizacion')->name('exportar.cotizacion');
    Route::get('/exportar/autorizacion/{nombre}', 'TicketsController@exportAutorizacion')->name('exportar.autorizacion');
    Route::get('/exportar/evidenciaPago/{nombre}', 'TicketsController@exportEvidenciaPago')->name('exportar.evidencia.pago');


    // Procesos sin login
    Route::get('/tickets/{ticket}/actualizacion','TicketsController@actualizarTickets')->name('actualizar.ticket');
    Route::get('/tickets/{ticket}/historial','TicketsController@historialTickets')->name('historial.ticket');

    Route::get('/tickets/{ticket}/{encargado}/validacion','TicketsController@validarTickets')->name('validar.ticket');
    Route::get('/tickets/{ticket}/{encargado}/cotizacion','TicketsController@cotizarTickets')->name('cotizar.ticket');
    Route::get('/tickets/{ticket}/{encargado}/modificar/cotizacion','TicketsController@modificarCotizacion')->name('modificar.cotizacion.ticket');
    Route::get('/tickets/{ticket}/{encargado}/autorizar','TicketsController@autorizarTicket')->name('autorizar.ticket');


    Route::get('/tickets/{ticket}/{encrypted}/actualizacion/finalizado','TicketsController@actualizarTicketsFinalizados')->name('actualizar.ticket.finalizado');
    Route::get('/tickets/{ticket}/{encrypted}/cotización/pendientes','TicketsController@cotizarTicketsPendientes')->name('cotizar.ticket.pendiente');

    Route::get('/tickets/{ticket}/actualizacion/pasados','TicketsController@actualizarTicketsPasados')->name('actualizar.ticket.pasado');



    // FORMULARIOS TICKETS
    // CRUD Tickets
    Route::post('tickets/create','TicketsController@crear')->name('create.ticket');
    Route::post('tickets/consult','TicketsController@consultar')->name('consult.ticket');
    Route::post('tickets/consult/historic','TicketsController@consultarHistorico')->name('consult.historic.ticket');
    Route::post('tickets/consult/all','TicketsController@consultaCompleta')->name('consult.all.tickets');

    Route::patch('tickets/validate/{ticket}/{usuario}','TicketsController@validar')->name('validate.ticket');
    Route::post('tickets/cancel/{ticket}','TicketsController@cancelar')->name('cancel.ticket');
    Route::patch('tickets/quote/{ticket}/{usuario}','TicketsController@cotizar')->name('quote.ticket');

    Route::patch('tickets/authorize/{ticket}/{usuario}','TicketsController@autorizar')->name('authorize.ticket');
    Route::post('tickets/invalidate/{ticket}/{usuario}','TicketsController@anular')->name('invalidate.ticket');

    Route::patch('tickets/update/{ticket}','TicketsController@actualizar')->name('update.ticket');
    Route::patch('tickets/update/{ticket}/{usuario}/finalizado','TicketsController@actualizarFinalizado')->name('update.ticket.finalized');
    Route::patch('tickets/update/{ticket}/pasado','TicketsController@actualizarPasado')->name('update.ticket.past');

    // CRUD Personal Registrado
    Route::post('tickets/update/personal/delete/relations','TicketsController@eliminarRelacionPersonal')->name('eliminar.relacion.personal');
    Route::post('tickets/update/personal/delete/person','TicketsController@eliminarPersonal')->name('eliminar.personal');
    Route::post('tickets/update/personal/assign/person','TicketsController@asignarPersonal')->name('asignar.personal');
    Route::patch('tickets/update/personal/assign/mail','TicketsController@asignarCorreo')->name('asignar.correo.casa');
    Route::post('tickets/update/personal/create/person','TicketsController@crearPersonal')->name('crear.personal');

//TUTORIAS
    // FORMULARIOS TUTORIAS
    // Telegram
    Route::post('tutorias/send/contact/{adt}','TutoriasController@enviarContactosCoordinadores')->name('send.contact.adt');

    // CRUD
    Route::patch('tutorias/update/contact/{adt}','TutoriasController@actualizarContactoForm')->name('update.contact.adt');
    Route::post('tutorias/call/fail/{adt}','TutoriasController@llamadaNoEfectivaForm')->name('call.fail.adt');
    Route::post('tutorias/panel/call/{adt}','TutoriasController@panelLlamadaForm')->name('panel.call.adt');
    Route::patch('tutorias/update/internet/{adt}','TutoriasController@actualizarInternetForm')->name('update.internet.adt');
    Route::patch('tutorias/update/infrastructure/{adt}','TutoriasController@actualizarInfraestructuraForm')->name('update.infrastructure.adt');
    Route::patch('tutorias/update/use/{adt}','TutoriasController@actualizarUsoBdtForm')->name('update.use.adt');
    Route::patch('tutorias/update/equipment/{adt}','TutoriasController@actualizarEquipamientoForm')->name('update.equipment.adt');
    Route::patch('tutorias/update/furniture/{adt}','TutoriasController@actualizarMobiliarioForm')->name('update.furniture.adt');

    // Solicitud de Excel
    Route::get('/exportar/reporte/{adt}', 'TutoriasController@exportReporte')->name('exportar.reporte.adt');
    Route::post('/exportar/reporte/general/tutorias', 'TutoriasController@exportarReporteGeneral')->name('exportar.reporte.general.tutorias');

});

// MIDDLEWARE VISTAS
Route::middleware('auth')->group(function () {
// Tickets
    Route::get('/tickets/creacion','TicketsController@crearTickets')->name('crear.tickets');
    Route::get('/tickets/consultar','TicketsController@consultarTickets')->name('consultar.ticket');
    Route::get('/tickets/reporte','TicketsController@generaReporteTickets')->name('reporte.ticket');
    Route::get('/tickets/pesonal/modificar','TicketsController@modificarPersonal')->name('modificar.personal');
    Route::get('/tickets/consultar/pago','TicketsController@consultarTicketsPago')->name('consultar.ticket.pago');
    Route::get('/tickets/consultar/pasados','TicketsController@consultarTicketsPasados')->name('consultar.ticket.pasado');

// Tutorias
    Route::get('/tutoria/consultar','TutoriasController@consultar')->name('consultar.tutoria');
    Route::get('/tutoria/actualizar/contacto/{adt}','TutoriasController@actualizarContacto')->name('actualizar.contacto.adt');
    Route::get('/tutoria/llamada/noefectiva/{adt}','TutoriasController@llamadaNoEfectiva')->name('llamada.noefectiva.adt');
    Route::get('/tutoria/panel/llamada/{adt}','TutoriasController@panelLlamada')->name('panel.llamada.adt');
    Route::get('/tutoria/actualizar/internet/{adt}','TutoriasController@actualizarInternet')->name('actualizar.internet.adt');
    Route::get('/tutoria/actualizar/infraestructura/{adt}','TutoriasController@actualizarInfraestructura')->name('actualizar.infraestructura.adt');
    Route::get('/tutoria/actualizar/uso/{adt}','TutoriasController@actualizarUsoBdt')->name('actualizar.uso.adt');
    Route::get('/tutoria/actualizar/equipamiento/{adt}','TutoriasController@actualizarEquipamiento')->name('actualizar.equipamiento.adt');
    Route::get('/tutoria/actualizar/mobiliario/{adt}','TutoriasController@actualizarMobiliario')->name('actualizar.mobiliario.adt');
    Route::get('/tutoria/consultar/estatus','TutoriasController@consultarEstatusBdt')->name('consultar.estatus.bdt.tutorias');

});

// LOGIN
Route::prefix('loginTickets')->group(function(){
    Route::get('/', 'Auth\LoginTicketsController@mostrarLogin')->name('login.tickets');
    Route::post('/', 'Auth\LoginTicketsController@login')->name('login.tickets.submit');
});

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

//Registro de Usuarios
Route::get('/usuarios/inicio', 'ControladorPanelUsuarios@mostrarInicioUsuarios')->name('usuarios.inicio');
Route::post('/usuarios/inicio/registro', 'ControladorPanelUsuarios@registrarUsuario')->name('usuarios.registro');
