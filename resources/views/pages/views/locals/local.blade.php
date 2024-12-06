@extends('layouts.app')

@section('title', $local->name)

@section('content')
    <header class="custom-header text-center my-4">
        <div class="name-with-flag">
            <h1 class="julee-regular">{{ $local->name }}</h1>
            <div id="flag-indicator" class="flag-indicator"></div>
        </div>
    </header>
    <div class="custom-container">



        <!-- Distrito e País -->
        <div class="icon-text-container" style="justify-content: space-between">
            <div><i class="ph ph-map-pin-area place_icon"></i>{{ $local->district->name }}, {{ __('local.portugal') }}</div>

            <div class="flag-selection-container my-4">
                <h3 class="julee-regular">{{ __('Selecione a Bandeira') }}</h3>
                <div class="flag-buttons">
                    <button class="flag-button btn btn-danger" data-color="red">Vermelha</button>
                    <button class="flag-button btn btn-warning" data-color="yellow">Amarela</button>
                    <button class="flag-button btn btn-success" data-color="green">Verde</button>
                </div>
            </div>
        </div>

        <!-- Secção com imagem e ícones-->
        <div class="image-description-container">

            <!-- Imagem -->
            <div class="local-image-container">
                @php
                    $mediaUrl = $local->getFirstMediaUrl('locals');
                @endphp
                @if($mediaUrl)
                    <img src="{{ $mediaUrl }}" alt="{{ $local->name }}" class="local-image">
                @else
                    <div class="no-image-local">{{ __('local.no_image') }}</div>
                @endif
            </div>

            <!-- Atributos destacados -->
            <div class="description-container">
                @if($local->attributes->contains('name', 'Blue Flag') || $local->attributes->contains('name', 'Parque'))
                    <div class="icon-attr-container local_description_info">
                        <div class="icon-row">
                            @if($local->attributes->contains('name', 'Nadador Salvador'))
                                <div class="special_attr_info_row">
                                    <img src="{{ asset('assets/img/rubber-ring.png') }}" alt="Praia Vigiada" class="attr-image">
                                    <p>{{ __('local.guarded_beach') }}</p>
                                </div>
                            @endif
                            @if($local->attributes->contains('name', 'Bandeira Azul'))
                                <div class="special_attr_info_row">
                                    <img src="{{ asset('assets/img/bandeira_azul.png') }}" alt="Bandeira Azul" class="attr-image">
                                    <p>{{ __('local.blue_flag') }}</p>
                                </div>
                            @endif
                            @if($local->attributes->contains('name', 'Qualidade de Ouro'))
                                <div class="special_attr_info_row">
                                    <img src="{{ asset('assets/img/qualidade-ouro.png') }}" alt="Qualidade de Ouro" class="attr-image">
                                    <p>{{ __('local.or_quality') }}</p>
                                </div>
                            @endif
                            @if($local->attributes->contains('name', 'Zero Poluição'))
                                <div class="special_attr_info_row">
                                    <img src="{{ asset('assets/img/zero-poluição.png') }}" alt="Zero Poluição" class="attr-image">
                                    <p>{{ __('local.zero_polution') }}</p>
                                </div>
                            @endif
                            @if($local->attributes->contains('name', 'Parque'))
                                <div class="special_attr_info_row">
                                     <img src="{{ asset('assets/img/parking.png') }}" alt="Parque" class="attr-image">
                                     <p>{{ __('local.parking') }}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                @else
                    <p>{{ __('local.no_special_attributes') }}</p>
                @endif
            </div>
        </div>

        <!-- Descrição -->
        <div class="description-container mb-5">
            <h2 class="julee-regular local-subtitle mb-5">{{ __('local.description') }}</h2>
            <p>{{$local->description}}</p>
        </div>


        <!-- Listagem dos atributos -->
        <div class="services-container">
            <h2 class="julee-regular local-subtitle mb-5">{{ __('local.existing_services') }}</h2>
            <div class="attributes-container">
                @foreach($local->attributes->chunk(2) as $chunk) <!-- chunk serve para agrupar, neste caso em pares -->
                    <div class="attribute-pair">
                        @foreach($chunk as $attribute)
                            <div class="local_description_info_row">
                                @if($attribute->name == 'Acesso Mobilidade Reduzida')
                                    <i class="ph ph-wheelchair description_icon"></i>
                                @elseif($attribute->name == 'Parque')
                                    <i class="ph ph-letter-circle-p description_icon"></i>
                                @elseif($attribute->name == 'Chuveiro')
                                    <i class="ph ph-shower description_icon"></i>
                                @elseif($attribute->name == 'WC')
                                    <i class="ph ph-toilet description_icon"></i>
                                @elseif($attribute->name == 'Nadador Salvador')
                                    <i class="ph ph-binoculars description_icon"></i>
                                @elseif($attribute->name == 'Bandeira Azul')
                                    <i class="ph ph-flag description_icon"></i>
                                @elseif($attribute->name == 'Restauração')
                                    <i class="ph ph-fork-knife description_icon"></i>
                                @elseif($attribute->name == 'Atividades')
                                    <i class="ph ph-person-simple-swim description_icon"></i>
                                @elseif($attribute->name == 'Qualidade de Ouro')
                                    <i class="ph ph-medal description_icon"></i>
                                @else
                                    <i class="ph ph-smiley-sad description_icon"></i>
                                @endif
                                <p>{{ $attribute->name == 'local.no_info' ? __('local.no_info') : $attribute->name }}</p>
                            </div>
                            @if($loop->last && $chunk->count() == 1)
                                <div class="local_description_info_row ghost"></div>
                            @endif
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>

        <div class="gps_location mt-5">
            <h2 class="julee-regular local-subtitle mb-5">{{ __('local.how_to_arrive') }}</h2>
            <!-- Integração com Google Maps -->
            <div class="map-container mt-4 mb-4">
                @if($latitude && $longitude)
                    @php
                        $mapUrl = "https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d12248.057348026508!2d{$longitude}!3d{$latitude}!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2z{$latitude},{$longitude}!5e0!3m2!1sen!2s!4v1600000000000!5m2!1sen!2s";
                    @endphp
                    <iframe src="{{ $mapUrl }}" width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                @else
                    <p>{{ __('local.invalid_coordinates') }}</p>
                @endif
            </div>

            <!-- Coordenadas -->
            <div class="coordinates_container local_coordinates_info">
                <div class="local_coordinates_info_row mt-4"><i class="ph ph-gps description_icon"></i><p>{{ __('local.coordinates') }}: {{ $local->coordinates }}</p></div>
        </div>

            <div class="feedback-container">
                <div class="feedback-header">
                    <h2 class="julee-regular local-subtitle">{{ __('local.feedback') }}</h2>
                    <!-- Navbar de Comentários -->
                    <div class="comments-navbar">
                        <button id="show-form-button" class="comments-nav-button">Deixar Comentário</button>
                        <button id="show-comments-button" class="comments-nav-button">Ver Comentários</button>
                    </div>
                </div>

                <!-- Contêiner para o formulário de feedback -->
                <div id="feedback-form-container">
                    <form action="{{ route('feedback.store', $local->id) }}" method="POST">
                        @csrf
                        <!-- Avaliação com estrelas -->
                        <div class="rating-container">
                            <label for="rating" class="rating-label">{{ __('local.rating') }}:</label>
                            <div class="rating-stars">
                                <span data-value="1" class="star">&#9733;</span>
                                <span data-value="2" class="star">&#9733;</span>
                                <span data-value="3" class="star">&#9733;</span>
                                <span data-value="4" class="star">&#9733;</span>
                                <span data-value="5" class="star">&#9733;</span>
                            </div>
                            <input type="hidden" name="rating" id="rating" value="0">
                        </div>

                        <!-- Campo para comentários -->
                        <div class="comment-container mt-4">
                            <label for="comment" class="comment-label">{{ __('local.comment') }}:</label>
                            <textarea id="comment" name="comment" rows="4" class="comment-textarea" placeholder="{{ __('local.enter_comment') }}"></textarea>
                        </div>
                        <div class="feedback-button-container">
                            <!-- Botão de envio -->
                            <button type="submit" class="submit-button mt-3">{{ __('local.submit') }}</button>
                        </div>
                    </form>
                </div>

                <!-- Container para a listagem de comentários -->
                <div id="comments-list-container" class="comments-container" style="display: none;">
                    <h2>Comentários</h2>
                    <hr>
                    @foreach ($local->feedbacks as $feedback)
                        <div class="comment">
                            <div class="comment-header">
                                <!-- Exibição da foto do usuário -->
                                <div class="comment-user-photo">
                                    @php
                                        $mediaUrl = $feedback->user->getFirstMediaUrl('users');
                                    @endphp
                                    @if($mediaUrl)
                                        <img src="{{ $mediaUrl }}" alt="{{ $feedback->user->name }}" class="comment-user-photo-img">
                                    @else
                                        <img src="{{ $feedback->user->avatar_url }}" alt="Avatar de {{ $feedback->user->name }}" class="comment-user-photo-img">
                                    @endif
                                </div>
                                <!-- Informações do usuário e data -->
                                <div class="comment-user-info">
                                    <strong>{{ $feedback->user->name }}</strong>
                                    <small>em {{ $feedback->created_at->format('d/m/Y') }}</small>
                                </div>
                            </div>
                            <div class="rating">
                                @for ($i = 0; $i < $feedback->rating; $i++)
                                    <span class="star">&#9733;</span>
                                @endfor
                            </div>
                            <p>{{ $feedback->comment }}</p>
                            <div class="comment-actions">
                                @if(auth()->check() && auth()->id() === $feedback->users_id || auth()->check() && auth()->user()->hasRole('admin'))
                                <a href="#" data-bs-toggle="modal" data-bs-target="#deleteCommentModal{{ $feedback->id }}" onclick="confirmDelete('deleteCommentForm{{ $feedback->id }}', '{{ route('feedback.destroy', $feedback->id) }}')">
                                    <button type="button" class="delete-comment-button">
                                        <i class="ph ph-trash delete-trash me-1"></i>
                                    </button>
                                </a>
                                @endif
                            </div>
                        </div>
                        @include('pages.views.locals.modals.comments-delete-modal', ['feedback' => $feedback])
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection

<script>
    import Echo from "laravel-echo";

    const echo = new Echo({
        broadcaster: "pusher",
        key: "ee7b90fa38376461a913",
        cluster: "ap1",
        forceTLS: true,
    });

    echo.channel('flags')
        .listen('.flag-clicked', (event) => {
            alert(`A bandeira ${event.color} foi selecionada 5 vezes!`);
        });
</script>
