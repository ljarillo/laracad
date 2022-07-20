<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            'identify' => $this->identify,
            'total' => $this->total,
            'status' => $this->status,
            'date' => Carbon::make($this->created_at)->format('Y-m-d'),
            'company' => new TenantResource($this->tenant),
            'client' => $this->client_id ? new ClientResource($this->client) : '',
            'table' => $this->table_id ? new TablesResource($this->table) : '',
            'products' => ProductResource::collection($this->products),
            'evaluation' => EvaluationResource::collection($this->evaluations),
        ];
    }
}
