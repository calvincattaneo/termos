<?php

use Illuminate\Database\Seeder;

class EmprestimosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $emprestimos = [];

        for ($i=1; $i <= 10; $i++)
        {
            $date = date("Y-m-d", strtotime("2016-05-01 + {$i} days"));
            $datePlus = date("Y-m-d", strtotime("{$date} + {$i} days"));
            $emprestimos[] = [
                //'id' => $i,
                'user_id' => rand(1,2),
                'solicitante' => "Fulano de Tal {$i}",
                'destino' => "Coren na Área {$i}",
                'data_retirada' => $date,
                'data_prevista_entrega' => $datePlus,
                'data_entrega' => $datePlus,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ];
        }

        DB::table('emprestimos')->insert($emprestimos);
    }
}
