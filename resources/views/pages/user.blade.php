@extends('layouts.page', ['list' => $users])
@section('page-container')
@endsection
@section('css')
    @parent
    <link rel="stylesheet" href="{{ asset('css/page/home.css') }}" />
    <style>
        tbody td:not(:first-child) {
            padding-top: 1rem;
        }
    </style>
@endsection
@section('buttons')
    <button class="btn btn-outline-primary rounded" id="btn-add-user" data-bs-toggle="modal" data-bs-target="#modalUser"
        url="{{ route($panel . '.store') }}" method="POST">
        <i class="fas fa-user-plus"></i>
        <span>adicionar</span>
    </button>
    <button class="btn btn-outline-success rounded" id="btn-search-user" data-bs-toggle="modal" data-bs-target="#modalUserSearch"
        url="#" method="POST">
        <i class="fas fa-search"></i>
        <span>procurar</span>
    </button>
@endsection
@php $perfil = isset($panel) ? $panel : ""; @endphp
@section('thead')
    <th>
        <div><i class="fas fa-image"></i><span>Foto</span></div>
    </th>
    <th>
        <div><i class="fas fa-signature"></i><span>Nome</span></div>
    </th>
    <th>
        <div><i class="fas fa-envelope"></i><span>Email</span></div>
    </th>
    <th>
        <div><i class="fas fa-venus-mars"></i><span>Gênero</span></div>
    </th>
    <th>
        <div><i class="fas fa-phone"></i><span>Telefone</span></div>
    </th>
    @if ($perfil == 'funcionarios')
        <th>
            <div><i class="fas fa-list-ol"></i><span>Categoria</span></div>
        </th>
    @elseif ($perfil == 'clientes')
        <th>
            <div><i class="fas fa-list-ol"></i><span>Frequência compra</span></div>
        </th>
        <th>
            <div><i class="fas fa-money-bill"></i><span>Loja</span></div>
        </th>
    @endif
    <th colspan="2">
        <div><i class="fas fa-tools"></i><span>Acções</span></div>
    </th>
@endsection
@section('tbody')
    @foreach ($users as $person)
        <tr style="align-items: center;">
            <td class="text-center">
                @if ($person->image)
                    <a href="{{ url("storage/{$person->image}") }}">
                        <img src="{{ url("storage/{$person->image}") }}" alt="foto perfil" class="rounded-circle"
                            style="width: 40px; height: 40px;">
                    </a>
                @else
                    <a href="{{ asset('img/avatar.jpg') }}" class="m-2">
                        <img src="{{ asset('img/avatar.jpg') }}" alt="foto perfil" class="rounded-circle"
                            style="width: 35px; height: 35px;">
                    </a>
                    <br />
                    <button class="text-primary bg-none btn-file d-flex gap-1 align-items-center" data-bs-toggle="modal"
                        data-bs-target="#modalFile" url="{{ route('account.photo', $person->id) }}" method="PUT">
                        <i class="fas fa-plus"></i>
                        <span>adicionar</span>
                    </button>
                @endif
            </td>
            <td>{{ $person->name }}</td>
            <td>{{ $person->email }}</td>
            <td data-vd="{{ $person->gender }}">
                {{ $person->gender }}
            </td>
            <td>{{ $person->phone }}</td>
            @if ($perfil == 'funcionarios')
                <td data-vd={{ $person->funcionario->categoria }}>
                    {{ $person->funcionario->categoria }}
                </td>
            @elseif ($perfil == 'clientes')
                <td>{{ $person->cliente->frequencia_compra }}</td>
                <td>
                    <a href="{{ route('loja.auth.user',$person->id) }}" class="text-primary rounded btn-sm btn-user-tr d-flex gap-1 align-items-center">
                        <i class="fas fa-plus"></i>
                        <span>Loja</span>
                    </a>
                </td>
            @endif
            <td>
                <a href="#" class="text-warning rounded btn-sm btn-user-tr d-flex gap-1 align-items-center"
                    data-bs-toggle="modal" data-bs-target="#modalUser" url="{{ route($panel . '.update', $person->id) }}"
                    method="PUT">
                    <i class="fas fa-user-edit"></i>
                    <span>editar</span>
                </a>
            </td>
            <td>
                <a href="#" class="text-danger rounded btn-sm btn-user-del d-flex gap-1 align-items-center"
                    data-bs-toggle="modal" data-bs-target="#modalUser" url="{{ route($panel . '.destroy', $person->id) }}"
                    method="DELETE">
                    <i class="fas fa-user-times"></i>
                    <span>eliminar</span>
                </a>
            </td>
        </tr>
    @endforeach
@endsection
@section('modal')
    @include('components.modal.user', ['type' => $panel])
    @include('components.modal.fileupload')
    @include('components.modal.search',[
        'route' => route($panel . '.index'),
        'parmas' => ['name' => 'Nome','email' => 'Email','phone' => 'Telefone','gender' => 'Gênero',]
    ])
@endsection
@section('script')
    @parent
    <script src="{{ asset('js/help/clearForm.help.js') }}"></script>
    <script src="{{ asset('js/help/select.help.js') }}"></script>
    <script src="{{ asset('js/fileupload.js') }}"></script>
    @if ($perfil == 'funcionarios')
        <script src="{{ asset('js/page/user/funcionario.js') }}"></script>
    @elseif ($perfil == 'clientes')
        <script src="{{ asset('js/page/user/cliente.js') }}"></script>
    @else
        <script src="{{ asset('js/page/user.js') }}"></script>
    @endif
@endsection
