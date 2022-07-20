<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\TenantFormRequest;
use App\Http\Resources\TablesResource;
use App\Services\TablesService;
use Illuminate\Http\Request;

class TableApiController extends Controller
{
    protected $tableService;

    public function __construct(TablesService $tableService)
    {
        $this->tableService = $tableService;
    }

    public function tablesByTenant(TenantFormRequest $request)
    {
        $tables = $this->tableService->getTablesByUuid($request->token_company);

        return TablesResource::collection($tables);
    }

    public function show(TenantFormRequest $request, $identify)
    {
        if(!$table = $this->tableService->getTableByUuid($identify)){
            return response()->json(['message' => 'Tables Not Found'], 404);
        }

        return new TablesResource($table);
    }
}
