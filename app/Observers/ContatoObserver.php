<?php

namespace App\Observers;

use App\Models\Contato;
use Illuminate\Support\Facades\DB;

class ContatoObserver
{
    /**
     * Handle the Contato "created" event.
     *
     * @param  \App\Models\Contato  $contato
     * @return void
     */
    public function created(Contato $contato)
    {    
        $_id = $contato->_id;
        unset($contato->_id);
        unset($contato->created_at);
        unset($contato->updated_at);

        DB::connection("mysql")
            ->table("contatos")
            ->insert(
                array_merge($contato->toArray(), ["ref" => $_id])
            );
    }

    /**
     * Handle the Contato "updated" event.
     *
     * @param  \App\Models\Contato  $contato
     * @return void
     */
    public function updated(Contato $contato)
    {
        $_id = $contato->_id;
        unset($contato->_id);
        unset($contato->created_at);
        unset($contato->updated_at);

        DB::connection("mysql")
            ->table("contatos")
            ->where("ref", $_id)
            ->update($contato->toArray());
    }

    /**
     * Handle the Contato "deleted" event.
     *
     * @param  \App\Models\Contato  $contato
     * @return void
     */
    public function deleted(Contato $contato)
    {
        //
    }

    /**
     * Handle the Contato "restored" event.
     *
     * @param  \App\Models\Contato  $contato
     * @return void
     */
    public function restored(Contato $contato)
    {
        //
    }

    /**
     * Handle the Contato "force deleted" event.
     *
     * @param  \App\Models\Contato  $contato
     * @return void
     */
    public function forceDeleted(Contato $contato)
    {
        //
    }
}
