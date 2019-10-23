<?php

namespace App\Models\Repositories;

use App\Models\VO\Produto;
use Illuminate\Support\Facades\DB;

class EstoqueRepository
{
    public function getEstoqueByIdProduto($id)
    {
        try {
            $result = DB::select('  SELECT 
                                    estoque.id,
                                    estoque.produto,
                                    estoque.evento,
                                    estoque.tipo,
                                    estoque.inclusao
                                FROM 
                                    estoque
                                WHERE 
                                    estoque.produto = ?', [$id]);
        } catch (\Throwable $th) {
            throw $th;
        }

        if(empty($result)){
            return "Não existe nenhum estoque deste produto";
        }

        $arrayProdutos = array();

        foreach($result as $value)
        {
            $produto = new Produto();

            $produto->id = $value->id;
            $produto->idProduto = $value->produto;
            $produto->evento = $value->evento;
            $produto->tipo = ($value->tipo=='c'?'compra':'venda');
            $produto->inclusao = $value->inclusao;

            $arrayProdutos[] = $produto;
        }
        
        return $arrayProdutos;
    }

    public function insertProduto(Produto $produto)
    {
        try {
            $result = DB::insert('  INSERT INTO 
                                        estoque (produto, evento, tipo) 
                                    VALUES 
                                        (?, ?, ?)', [$produto->fkProduto, $produto->evento, $produto->tipo]);
        } catch (\Throwable $th) {
            throw $th;
        }
        
        if (!$result) {
            throw new Exception('Erro ao cadastrar produto no estoque');
        }

        $result = DB::select('  SELECT 
                                    MAX(e.id) id 
                                FROM 
                                    estoque e');

        return $result[0]->id;
    }
}
