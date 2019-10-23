<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\EstoqueService;
use Illuminate\Http\Request;

class EstoqueController extends Controller
{
     /**
     * @var EstoqueService
     */
    private $estoqueService;

    /**
     * EstoqueController constructor.
     */
    public function __construct(EstoqueService $estoqueService)
    {
        $this->estoqueService = $estoqueService;
    }

    public function getById($id)
    {
        return response()->json($this->estoqueService->getById($id));
    }

    public function create(Request $request)
    {
        return response()->json(
            [[
                'result' => $this->estoqueService->insertEstoque($request)
            ]]
        );
    }
}