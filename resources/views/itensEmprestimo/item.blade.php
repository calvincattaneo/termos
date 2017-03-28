<tr class="item-item" id="item-{{ $item->id }}">
    <td>
        <input type="checkbox" data-url="{{ route('emprestimos.itens.update', [$item->emprestimo_id, $item->id]) }}" {{ !$item->entregue ?: 'checked=true' }} class="check-item">
    </td>
    <td class="item-item-descricao {{ !$item->entregue ?: 'done' }}">
        {{ $item->descricao }}
    </td>
    <td>
        <div class="row-buttons">
            <a href="{{ route('emprestimos.itens.destroy', [$item->emprestimo_id, $item->id]) }}" class="btn btn-xs btn-danger remove-item-btn">
                <i class="glyphicon glyphicon-remove"></i>
            </a>
        </div>
    </td>
</tr>
