<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
//Importaciones para que funcione el observer
use App\Models\Beca;
use App\Observers\BecaObserver;
use App\Models\Turno;
use App\Observers\TurnoObserver;
use App\Models\CanalPublicitario;
use App\Observers\CanalPublicitarioObserver;
use App\Models\Carrera;
use App\Observers\CarreraObserver;
use App\Models\Docente;
use App\Observers\DocenteObserver;
use App\Models\EstadoVerificacion;
use App\Observers\EstadoVerificacionObserver;
use App\Models\Estudiante;
use App\Observers\EstudianteObserver;
use App\Models\Gestion;
use App\Observers\GestionObserver;
use App\Models\Inscripcion;
use App\Observers\InscripcionObserver;
use App\Models\Inscriptor;
use App\Observers\InscriptorObserver;
use App\Models\ModalidadPago;
use App\Observers\ModalidadPagoObserver;
use App\Models\Plazoinscripcion;
use App\Observers\PlazoInscripcionObserver;
use App\Models\User;
use App\Observers\UserObserver;
use App\Models\Pais;
use App\Observers\PaisObserver;
use App\Models\Departamento;
use App\Observers\DepartamentoObserver;
use App\Models\Provincia;
use App\Observers\ProvinciaObserver;
use App\Models\Localidad;
use App\Observers\LocalidadObserver;
use App\Models\Genero;
use App\Observers\GeneroObserver;
use App\Models\ExpedicionCi;
use App\Observers\ExpedicionCiObserver;
class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot() //Vinculos con el observer
    {
        Beca::observe(BecaObserver::class);
        CanalPublicitario::observe(CanalPublicitarioObserver::class);
        Carrera::observe(CarreraObserver::class);
        Docente::observe(DocenteObserver::class);
        EstadoVerificacion::observe(EstadoVerificacionObserver::class);
        Estudiante::observe(EstudianteObserver::class);
        Gestion::observe(GestionObserver::class);
        Inscriptor::observe(InscriptorObserver::class);
        Inscripcion::observe(InscripcionObserver::class);
        ModalidadPago::observe(ModalidadPagoObserver::class);
        Plazoinscripcion::observe(PlazoInscripcionObserver::class);
        User::observe(UserObserver::class);
        Turno::observe(TurnoObserver::class);
        Pais::observe(PaisObserver::class);
        Departamento::observe(DepartamentoObserver::class);
        Provincia::observe(ProvinciaObserver::class);
        Localidad::observe(LocalidadObserver::class);
        Genero::observe(GeneroObserver::class);
        ExpedicionCi::observe(ExpedicionCiObserver::class);
    }
}
