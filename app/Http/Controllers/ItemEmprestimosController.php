<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Emprestimo;
use App\ItemEmprestimo;
use Carbon\Carbon;

class ItemEmprestimosController extends Controller
{
    public function __construct()
    {
        // check if session expired for ajax request
        $this->middleware('ajax-session-expired');
        // check if user is autenticated for non-ajax request
        $this->middleware('auth');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $emprestimoId)
    {
        $this->validate($request, [
            'descricao' => 'required|min:5|max:50'
        ]);

        $emprestimo = Emprestimo::findOrFail($emprestimoId);
        $item = $emprestimo->ItemEmprestimo()->create($request->all());
        return view('itensEmprestimo.item', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $emprestimoId, $id)
    {
        $item = ItemEmprestimo::findOrFail($id);
        $item->entregue = $request->entregue == "true" ? Carbon::now() : NULL;
        $affectedRow = $item->update();
        echo $affectedRow;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function destroy($emprestimoId, $id)
     {
         $item = ItemEmprestimo::findOrFail($id);
         $item->delete();
         return $item;
     }
}
