@extends('layouts.app')

@section('content')

    <header class="district-header text-center my-4">
        <h1 class="julee-regular">{{__('result.results_off')}} {{--{{ $query }}--}}</h1>
    </header>

    <div class="container custom-container">

        <!-- Filtros de Pesquisa -->
        <section class="search-filters my-4">
            <form id="filterForm" method="GET" action="{{ route('filter.results') }}">
                <div class="row">

                    <div class="col-md-4 mb-3">
                        <div class="form-check d-flex justify-content-center align-items-center">
                            <input class="form-check-input" type="checkbox" value="WC" id="filterWC" name="filters[]"
                                   @if(in_array('WC', request()->filters ?? [])) checked @endif>
                            <label class="form-check-label" for="filterWC">
                                {{ __('result.filter_wc') }}
                            </label>
                        </div>
                    </div>

                    <div class="col-md-4 mb-3">
                        <div class="form-check d-flex justify-content-center align-items-center">
                            <input class="form-check-input" type="checkbox" value="Acesso Mobilidade Reduzida" id="filterAcessoMobilidadeReduzida" name="filters[]"
                                   @if(in_array('Acesso Mobilidade Reduzida', request()->filters ?? [])) checked @endif>
                            <label class="form-check-label" for="filterAcessoMobilidadeReduzida">
                                {{ __('result.filter_acesso_mobilidade_reduzida') }}
                            </label>
                        </div>
                    </div>

                    <div class="col-md-4 mb-3">
                        <div class="form-check d-flex justify-content-center align-items-center">
                            <input class="form-check-input" type="checkbox" value="Parque" id="filterParque" name="filters[]"
                                   @if(in_array('Parque', request()->filters ?? [])) checked @endif>
                            <label class="form-check-label" for="filterParque">
                                {{ __('result.filter_parque') }}
                            </label>
                        </div>
                    </div>

                    <div class="col-md-4 mb-3">
                        <div class="form-check d-flex justify-content-center align-items-center">
                            <input class="form-check-input" type="checkbox" value="Chuveiro" id="filterChuveiro" name="filters[]"
                                   @if(in_array('Chuveiro', request()->filters ?? [])) checked @endif>
                            <label class="form-check-label" for="filterChuveiro">
                                {{ __('result.filter_chuveiro') }}
                            </label>
                        </div>
                    </div>

                    <div class="col-md-4 mb-3">
                        <div class="form-check d-flex justify-content-center align-items-center">
                            <input class="form-check-input" type="checkbox" value="Nadador Salvador" id="filterNadadorSalvador" name="filters[]"
                                   @if(in_array('Nadador Salvador', request()->filters ?? [])) checked @endif>
                            <label class="form-check-label" for="filterNadadorSalvador">
                                {{ __('result.filter_nadador_salvador') }}
                            </label>
                        </div>
                    </div>

                    <div class="col-md-4 mb-3">
                        <div class="form-check d-flex justify-content-center align-items-center">
                            <input class="form-check-input" type="checkbox" value="Bandeira Azul" id="filterBandeiraAzul" name="filters[]"
                                   @if(in_array('Bandeira Azul', request()->filters ?? [])) checked @endif>
                            <label class="form-check-label" for="filterBandeiraAzul">
                                {{ __('result.filter_bandeira_azul') }}
                            </label>
                        </div>
                    </div>

                    <div class="col-md-4 mb-3">
                        <div class="form-check d-flex justify-content-center align-items-center">
                            <input class="form-check-input" type="checkbox" value="Restauração" id="filterRestauração" name="filters[]"
                                   @if(in_array('Restauração', request()->filters ?? [])) checked @endif>
                            <label class="form-check-label" for="filterRestauração">
                                {{ __('result.filter_restauração') }}
                            </label>
                        </div>
                    </div>

                    <div class="col-md-4 mb-3">
                        <div class="form-check d-flex justify-content-center align-items-center">
                            <input class="form-check-input" type="checkbox" value="Atividades" id="filterAtividades" name="filters[]"
                                   @if(in_array('Atividades', request()->filters ?? [])) checked @endif>
                            <label class="form-check-label" for="filterAtividades">
                                {{ __('result.filter_atividades') }}
                            </label>
                        </div>
                    </div>

                    <div class="col-md-4 mb-3">
                        <div class="form-check d-flex justify-content-center align-items-center">
                            <input class="form-check-input" type="checkbox" value="Zero Poluição" id="filterZeroPoluição" name="filters[]"
                                   @if(in_array('Zero Poluição', request()->filters ?? [])) checked @endif>
                            <label class="form-check-label" for="filterZeroPoluição">
                                {{ __('result.filter_zero_poluição') }}
                            </label>
                        </div>
                    </div>

                    <div class="col-md-4 mb-3">
                        <div class="form-check d-flex justify-content-center align-items-center">
                            <input class="form-check-input" type="checkbox" value="Qualidade de Ouro" id="filterQualidadeDeOuro" name="filters[]"
                                   @if(in_array('Qualidade de Ouro', request()->filters ?? [])) checked @endif>
                            <label class="form-check-label" for="filterQualidadeDeOuro">
                                {{ __('result.filter_qualidade_de_ouro') }}
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Botão de envio do formulário -->
                <div class="text-end">
                    <button type="submit" class="btn btn-primary mt-2 ">{{ __('result.apply_filters') }}</button>
                </div>
            </form>
        </section>

        <section class="districts-section">
            <div class="row">
                @if($locals->isEmpty())
                    <p>{{__('result.no_result')}}</p>
                @else
                    @foreach($locals as $local)
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="view-card h-100 position-relative">
                                @php
                                    $mediaUrl = $local->getFirstMediaUrl('locals');
                                @endphp
                                @if($mediaUrl)
                                    <img src="{{ $mediaUrl }}" alt="{{ $local->name }}" class="view-card-img-top">
                                @else
                                    <div class="view-card-img-top no-image">{{ __('local.no_image') }}</div>
                                @endif
                                <div class="view-card-body">
                                    <h5 class="view-card-title">{{ $local->name }}</h5>
                                    <p class="view-card-text">{{ $local->description }}</p>
                                    <a href="{{ route('locals.show', $local->id) }}" class="custom-icon-link"><i class="ph ph-arrow-circle-right"></i></a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </section>
    </div>
@endsection
