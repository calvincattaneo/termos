@extends('layouts.main')

@section('title', 'Termo Emprestimos')

@section('content')
    <!-- Header -->
    <header>
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="clearfix">
                        <div class="pull-left">
                            <h1 class="header-title">Emprestimos</h1>
                        </div>
                        <div class="pull-right">
                            <a href="{{ route('emprestimos.create') }}" class="btn btn-success show-emprestimo-modal" title="Novo Emprestimo">Novo Emprestimo</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Container -->
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <?php $count = $emprestimos->count() ?>

                <div class="alert alert-warning {{ $count ? 'hidden' : '' }}" id="no-record-alert">
                    Nenhum registro encontrado.
                </div>

                <div class="alert alert-success" id="update-alert" style="display:none;"></div>

                <div class="panel panel-default {{ ! $count ? 'hidden' : '' }}">
                    <ul class="list-group" id="emprestimo">

                        @foreach($emprestimos as $emprestimo)

                            @include('emprestimos.item', compact('emprestimo'))

                        @endforeach

                    </ul>

                    <div class="panel-footer">
                        <small><span id="emprestimo-counter">{{ $count }}</span> <span>{{ $count > 1 ? 'registros' : 'registro' }}</span></small>
                    </div>
                </div>
            </div>

            @include('emprestimos.modal')

            @include('emprestimos.itemmodal')

            @include('emprestimos.confirmmodal')

        </div>
    </div>

@endsection
