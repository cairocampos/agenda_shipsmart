<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ContatoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'          => $this->_id,
            'nome'        => $this->nome,
            'email'       => $this->email,
            'telefone'    => $this->telefone,
            'cep'         => $this->cep,
            'bairro'      => $this->bairro,
            'cidade'      => $this->cidade,
            'numero'      => $this->numero,
            'logradouro'  => $this->logradouro,
            'estado'      => $this->estado,
            'ref'         => $this->ref
        ];
    }
}
