@foreach ($itensEmprestimo as $item)
    @include('itensEmprestimo.item', compact('item'))
@endforeach
