<?php $count = $emprestimo->itemEmprestimo->count() ?>
<li class="list-group-item" id="emprestimo-{{ $emprestimo->id }}">
    <h4 class="list-group-item-heading">{{ $emprestimo->destino }} <span class="badge">{{ $count }} {{ $count > 1 ? 'itens' : 'item' }}</span></h4>
    <p class="list-group-item-text"> {{ $emprestimo->solicitante }} </p>
    <div class="buttons">
        <a href="{{ route("emprestimos.show", $emprestimo->id) }}" data-action="{{ route('emprestimos.itens.store', $emprestimo->id) }}" class="btn btn-info show-item-modal btn-xs" data-title="{{ $emprestimo->destino }}" title="Gerenciar Itens">
            <i class="glyphicon glyphicon-ok"></i>
        </a>
        <a href="{{ route('emprestimos.edit', $emprestimo->id) }}" class="btn btn-default show-emprestimo-modal btn-xs edit" title="Editar {{ $emprestimo->destino }}">
            <i class="glyphicon glyphicon-edit"></i>
        </a>
        <a href="{{ route('emprestimos.destroy', $emprestimo->id) }}" class="btn btn-danger btn-xs show-confirm-modal" data-title="{{ $emprestimo->destino }}" title="Excluir">
            <i class="glyphicon glyphicon-remove"></i>
        </a>
    </div>
</li>
