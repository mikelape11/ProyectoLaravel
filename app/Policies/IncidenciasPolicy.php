<?php

namespace App\Policies;

use App\Incidencias;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;


class IncidenciasPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any incidencias.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the incidencias.
     *
     * @param  \App\User  $user
     * @param  \App\Incidencias  $incidencias
     * @return mixed
     */
    public function view(User $user, Incidencias $incidencias)
    {
        return $user->id===$incidencias->id_profesor;
    }

    /**
     * Determine whether the user can create incidencias.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the incidencias.
     *
     * @param  \App\User  $user
     * @param  \App\Incidencias  $incidencias
     * @return mixed
     */
    public function update(User $user, Incidencias $incidencias)
    {
        //
    }

    /**
     * Determine whether the user can delete the incidencias.
     *
     * @param  \App\User  $user
     * @param  \App\Incidencias  $incidencias
     * @return mixed
     */
    public function delete(User $user, Incidencias $incidencias)
    {
        //
    }

    /**
     * Determine whether the user can restore the incidencias.
     *
     * @param  \App\User  $user
     * @param  \App\Incidencias  $incidencias
     * @return mixed
     */
    public function restore(User $user, Incidencias $incidencias)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the incidencias.
     *
     * @param  \App\User  $user
     * @param  \App\Incidencias  $incidencias
     * @return mixed
     */
    public function forceDelete(User $user, Incidencias $incidencias)
    {
        //
    }
}
