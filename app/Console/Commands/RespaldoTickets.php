<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

// Modelos
use App\Exports\exportarBaseTickets;

class RespaldoTickets extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Respaldo:TicketsXlsx';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Respaldo semanal de base en archivo cargado en el servidor';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
    // Eliminar anteriores reportes XLS
        \Storage::disk('tickets_reportes')->delete('Respaldo.xlsx');

    // Generar nueva base
        $archivo = new exportarBaseTickets();

        $archivo->store();

    }

}
