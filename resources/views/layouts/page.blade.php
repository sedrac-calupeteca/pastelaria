@extends('layouts.dashboard')
@section('css')
    @parent
    <link rel="stylesheet" href="{{ asset('css/paginate.css') }}" />
@endsection
@section('painel')
    <section class="shadow p-2  mt-4 bg-white">
        @isset($panel)
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Painel</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $panel }}</li>
                </ol>
            </nav>
        @endisset
        <div class="position-relative">
            <div class="m-2">
                @yield('buttons')
            </div>
        </div>
        @include('components.message')
        @include('components.errors')
        @yield('page-container')
        @yield('form-open')
        <div class="table-responsive">
            <table class="table table-striped  table-hover text-center">
                <thead>
                    <tr>
                        @yield('thead')
                    </tr>
                </thead>
                <tbody>
                    @yield('tbody')
                </tbody>
            </table>
        </div>
        @yield('form-end')
        @if ($list->total() == 0)
            <div class="msg-empty">
                @isset($msgEmpty)
                    {{ $msgEmpty }}
                @else
                    Nenhum resultado foi encontrado
                @endisset
            </div>
        @endif
        <div id="pag" class="mt-3">
            {{ $list->links() }}
        </div>
    </section>
    @yield('modal')
@endsection
@section('script')
    @parent
    <script src="{{ asset('js/template.js') }}"></script>
@endsection
