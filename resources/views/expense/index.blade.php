@php
    $formatter = new \NumberFormatter('pt_BR', \NumberFormatter::CURRENCY);
@endphp

@extends('layouts.app')

@section('title', ' - Despesas')

@section('content')
    <main id="expenses-index">
        @include('partials.messages')

        <div class="d-flex justify-content-between align-items-center gap-4 mb-4">
            <a href="{{ route('expenses.create') }}" class="btn btn-small btn-primary text-white">
                Nova Despesa
            </a>
        </div>

        @if (count($expenses))
            <table class="table table-striped table-hover align-middle">
                <caption>Suas despesas</caption>

                <thead class="table-light">
                    <tr>
                        <th scope="col">#</th>

                        <th scope="col">Nome</th>

                        <th scope="col">Valor</th>

                        <th scope="col">Data de Pagamento</th>

                        <th scope="col">Está Pago</th>

                        <th scope="col" class="text-end">Ações</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($expenses as $expense)
                        <tr>
                            <th scope="row">{{ $expense->id }}</th>

                            <td>{{ $expense->name }}</td>

                            <td>{{ $formatter->formatCurrency($expense->value, 'BRL') }}</td>

                            <td>{{ $expense->payment_date->format('d/m/Y') }}</td>

                            <td>
                                <input class="form-check-input" type="checkbox" disabled
                                    @if ($expense->paid) checked @endif />
                            </td>

                            <td class="text-end">
                                <a href="{{ route('expenses.edit', $expense->id) }}"
                                    class="btn btn-small btn-warning text-white">
                                    Editar
                                </a>

                                @include('partials.expense.delete_form', compact('expense'))
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <nav>
                <ul class="pagination">
                    @if ($expenses->onFirstPage())
                        <li class="page-item disabled">
                            <span class="page-link">&laquo;</span>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $expenses->previousPageUrl() }}" rel="prev">
                                &laquo;
                            </a>
                        </li>
                    @endif

                    @foreach ($expenses->getUrlRange(1, $expenses->lastPage()) as $page => $url)
                        @if ($page === $expenses->currentPage())
                            <li class="page-item active">
                                <span class="page-link">{{ $page }}</span>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach

                    @if ($expenses->hasMorePages())
                        <li class="page-item">
                            <a class="page-link" href="{{ $expenses->nextPageUrl() }}" rel="next">
                                &raquo;
                            </a>
                        </li>
                    @else
                        <li class="page-item disabled">
                            <span class="page-link">&raquo;</span>
                        </li>
                    @endif
                </ul>
            </nav>
        @else
            <div class="alert alert-light fs-4 text-center">
                Não há despesas registradas até o momento
            </div>
        @endif
    </main>
@endsection
