<?php

use Illuminate\Database\Seeder;

class ItemEmprestimosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $itens = [];

        for ($j=1; $j <= 30; $j++)
        {
            $data = date("Y-m-d H:i:s", strtotime("2016-05-01 + {$j} days"));
            $entregue = date("Y-m-d", strtotime("{$data} + {$j} days"));
            $termo = rand(1,10);
            $itens[] = [
                //'id' => $j,
                'emprestimo_id' => $termo,
                'descricao' => "Item {$j} do termo de emprestimo {$termo}",
                'entregue' => $entregue,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ];
        }

        DB::table('item_emprestimos')->insert($itens);
    }
}
