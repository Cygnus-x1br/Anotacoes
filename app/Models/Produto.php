<?php

namespace App\Models;

use MF\Model\Model;


class Produto extends Model
{
    public function getProdutos()
    {
        // return array('Sofá', 'Cadeira');
        $query = "SELECT id, descricao, preco FROM tb_produtos";
        return $this->db->query($query)->fetchAll();
    }
}
