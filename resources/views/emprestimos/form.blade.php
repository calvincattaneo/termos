<div class="alert alert-success" id="add-new-alert" style="display:none"></div>

{!! Form::model($emprestimo, [
    'route' => $emprestimo->exists ? ['emprestimos.update', $emprestimo->id] : 'emprestimos.store',
    'method' => $emprestimo->exists ? 'PUT' : 'POST'
]) !!}
    <div class="form-group">
        <label for="" class="control-label">Solicitante</label>
        {!! Form::text('solicitante', null, ['class' => 'form-control', 'id' => 'solicitante']) !!}
        {!! Form::hidden('id') !!}
    </div>
    <div class="form-group">
        <label for="" class="control-label">Destino</label>
        {!! Form::text('destino', null, ['class' => 'form-control', 'id' => 'destino']) !!}
    </div>
    <div class="form-group">
        <label for="" class="control-label">Data Retirada</label>
        {!! Form::date('data_retirada', $emprestimo->exists ? null : \Carbon\Carbon::now(), ['class' => 'form-control', 'id' => 'data_retirada']) !!}
    </div>
    <div class="form-group">
        <label for="" class="control-label">Data Prevista Entrega</label>
        {!! Form::date('data_prevista_entrega', $emprestimo->exists ? null : \Carbon\Carbon::now(), ['class' => 'form-control', 'id' => 'data_prevista_entrega']) !!}
    </div>
    @if($emprestimo->exists)
        <div class="form-group">
            <label for="" class="control-label">Data Entrega</label>
            {!! Form::date('data_entrega', null, ['class' => 'form-control', 'id' => 'data_entrega']) !!}
        </div>
    @endif

{!! Form::close() !!}
