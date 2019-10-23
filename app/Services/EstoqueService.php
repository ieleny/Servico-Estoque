<?php

namespace App\Services;

use App\Models\Repositories\EstoqueRepository;
use App\Models\VO\Produto;
use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Request;


class EstoqueService extends ServiceProvider
{ 
    /**
    * @var EstoqueRepository
    */
   private $repository;

   /**
    * EstoqueService constructor.
    */
    public function __construct(EstoqueRepository $repository) {
        $this->repository = $repository;
    }

    public function getById($id)
    {
        if(empty($id)){
            return "Necessário passar ID do Produto";
        }

        // Buscar lista de estoque pelo ID do produto
        $arrayProduto = $this->repository->getEstoqueByIdProduto($id);

        return $arrayProduto;
    }

    public function insertEstoque(Request $request)
    {
        if(empty($request->fkProduto)){
            return "Necessário informar ID do Produto";
        }

        if(empty($request->evento)){
            return "Necessário informar o evento";
        }

        if(empty($request->tipo)){
            return "Necessário informar o tipo (Compra ou Venda)";
        }

        $produto = new Produto();

        $produto->fkProduto = $request->fkProduto;
        $produto->evento = $request->evento;
        $produto->tipo = $request->tipo;

        // Insere o contato e caso consiga retorna o ID
        $produto->id = $this->repository->insertProduto($produto);

        return true;
    }
}
