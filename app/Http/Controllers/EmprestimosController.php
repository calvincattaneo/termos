<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Emprestimo;

class EmprestimosController extends Controller
{
    public function __construct()
    {
        // check if session expired for ajax request
        $this->middleware('ajax-session-expired');
        // check if user is autenticated for non-ajax request
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $emprestimos = $request->user()
                         ->emprestimo()
                         ->with('itemEmprestimo')
                         ->orderBy('updated_at', 'desc')
                         ->get();
         return view("emprestimos.index", compact('emprestimos'));


         //** Habilitando log na query e mostrar na tela
         /*\DB::enableQueryLog();
         $emprestimos = $request->user()
                        ->emprestimo()
                        ->with('item_emprestimo')
                        ->orderBy('updated_at', 'desc')
                        ->get();
         view("emprestimos.index", compact('emprestimos'))->render();
         dd(\DB::getQueryLog());*/

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $emprestimo = new Emprestimo();
        return view('emprestimos.form', compact('emprestimo'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'solicitante' => 'required|min:5|max:50',
            'destino' => 'required|min:5|max:50',
            'data_retirada' => 'required|date',
            'data_prevista_entrega' => 'required|date'
        ]);

        $emprestimo = $request->user()->emprestimo()->create($request->all());
        return view("emprestimos.item", compact('emprestimo'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        /** Habilitando log **/
        /*\DB::enableQueryLog();
        $emprestimo = Emprestimo::findOrFail($id);
        $itensEmprestimo = $emprestimo->itemEmprestimo()->latest()->get();
        view("itensEmprestimo.index", compact('itensEmprestimo'))->render();
        dd(\DB::getQueryLog());*/

        $emprestimo = Emprestimo::findOrFail($id);
        $itensEmprestimo = $emprestimo->itemEmprestimo()->latest()->get();
        return view("itensEmprestimo.index", compact('itensEmprestimo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $emprestimo = Emprestimo::findOrFail($id);
        return view('emprestimos.form', compact('emprestimo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'solicitante' => 'required|min:5|max:50',
            'destino' => 'required|min:5|max:50',
            'data_retirada' => 'required|date',
            'data_prevista_entrega' => 'required|date'
        ]);

        $emprestimo = Emprestimo::findOrFail($id);
        $emprestimo->update($request->all());

        return view("emprestimos.item", compact('emprestimo'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $emprestimo = Emprestimo::findOrFail($id);
        $emprestimo->delete();

        return $emprestimo;
    }
}
