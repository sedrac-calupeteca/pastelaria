@extends('layouts.dashboard')
@section('painel')
    <section class="shadow p-4 mt-4 bg-white rounded">
        <div class="h4">
            Bem Vindo!
        </div>
        <div class="accordion" id="accordionExample">
            <div class="accordion-item">
                <h4 class="accordion-header" id="headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne"
                        aria-expanded="true" aria-controls="collapseOne">
                        Dados Pessoas
                    </button>
                </h4>
                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                    data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        @if (Auth::user()->image)
                            <a href="{{ url('storage/' . Auth::user()->image) }}" class="m-2">
                                <img src="{{ url('storage/' . Auth::user()->image) }}" alt="foto perfil"
                                    class="rounded-circle" style="width: 100px; height: 100px;">
                            </a>
                        @else
                            <a href="{{ asset('img/avatar.jpg') }}" class="m-2">
                                <img src="{{ asset('img/avatar.jpg') }}" alt="foto perfil" class="rounded-circle"
                                    style="width: 100px; height: 100px;">
                            </a>
                        @endif
                        @include('components.import.user', [
                            'user' => Auth::user(),
                            'inline' => false,
                            'disabled' => true,
                            'password_hidden' => true,
                        ])
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h4 class="accordion-header" id="headingTwo">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        Actualização dados
                    </button>
                </h4>
                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                    data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <form action="{{ route('account.update') }}" method="POST">
                            @csrf
                            @include('components.import.user', [
                                'user' => Auth::user(),
                                'inline' => true,
                            ])
                            <div class="d-flex gap-1">
                                <button class="btn btn-warning  btn-file m-2 rounded" data-bs-toggle="modal"
                                    data-bs-target="#modalFile" url="{{ route('account.photo', Auth::user()->id) }}"
                                    method="PUT">
                                    <i class="fas fa-plus"></i>
                                    <span>Foto de perfil</span>
                                </button>
                                <button class="btn btn-primary rounded m-2" type="submit">
                                    <i class="fas fa-check-circle"></i>
                                    <span>Salvar</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h4 class="accordion-header" id="headingThree">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        Segurança
                    </button>
                </h4>
                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                    data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <form action="{{ route('account.pass') }}" method="POST">
                            @csrf
                            @include('components.import.password', ['inline' => true])
                            <button class="btn btn-warning rounded m-2" type="submit">
                                <i class="fas fa-check-circle"></i>
                                <span>Salvar</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('components.modal.fileupload')
@endsection
@section('script')
    <script src="{{ asset('js/fileupload.js') }}"></script>
@endsection
