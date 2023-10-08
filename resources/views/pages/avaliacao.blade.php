@extends('layouts.page', ['list' => $avaliacoes])
@section('buttons')
    <a class="btn btn-outline-primary rounded" href="{{ route('encomendas.index') }}">
        <i class="fas fa-arrow-left"></i>
        <span>voltar</span>
    </a>
@endsection
@section('css')
    @parent
    <link rel="stylesheet" href="{{ asset('css/page/home.css') }}" />
@endsection
@section('thead')
    <th>
        <div><i class="fas fa-signature"></i><span>Assunto</span></div>
    </th>
    <th>
        <div><i class="fas fa-check-square" aria-hidden="true"></i><span>Tipo</span></div>
    </th>
    <th>
        <div><i class="fas fa-comment"></i><span>Descricao</span></div>
    </th>
    <th colspan="2">
        <div><i class="fas fa-tools"></i><span>Acções</span></div>
    </th>
@endsection
@section('tbody')
    @foreach ($avaliacoes as $item)
        <tr>
            <td>{{ $item->assunto }}</td>
            <td data-vd="{{ $item->tipo }}">{{ $item->tipo }}</td>
            <td>{{ $item->descricao }}</td>
            <td>
                <a href="#" class="text-warning rounded btn-sm btn-avaliacao-tr d-flex gap-1 align-items-center"
                    data-bs-toggle="modal" data-bs-target="#modalAvaliacao" method="PUT"
                    url="{{ route('avaliacao.encomenda.put', $item->id) }}">
                    <i class="fas fa-edit"></i>
                    <span>editar</span>
                </a>
            </td>
            <td>
                <a href="#" class="text-danger rounded btn-sm btn-avaliacao-del d-flex gap-1 align-items-center"
                    data-bs-toggle="modal" data-bs-target="#modalAvaliacao" method="DELETE"
                    url="{{ route('avaliacao.encomenda.delete', $item->id) }}">
                    <i class="fas fa-trash"></i>
                    <span>eliminar</span>
                </a>
            </td>
        </tr>
    @endforeach
@endsection
@section('modal')
    @include('components.modal.avaliacao')
@endsection
@section('script')
    @parent
    <script src="{{ asset('js/help/clearForm.help.js') }}"></script>
    <script src="{{ asset('js/help/select.help.js') }}"></script>
    <script src="{{ asset('js/page/avaliacao.js') }}"></script>
@endsection
