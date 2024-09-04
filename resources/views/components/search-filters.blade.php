<section class="search-filters my-4">
    <form id="filterForm" method="GET"
          action="
      @if(isset($regionId))
          {{ route('filter.region_results', ['regionId' => $regionId]) }}
       @elseif(isset($districtId))
          {{ route('filter.district_results', ['districtId' => $districtId]) }}
      @else
          {{ route('filter.results') }}
      @endif
      ">
        <div class="row">
            @php
                $filters = [
                    'WC' => 'result.filter_wc',
                    'Acesso Mobilidade Reduzida' => 'result.filter_acesso_mobilidade_reduzida',
                    'Parque' => 'result.filter_parque',
                    'Chuveiro' => 'result.filter_chuveiro',
                    'Nadador Salvador' => 'result.filter_nadador_salvador',
                    'Bandeira Azul' => 'result.filter_bandeira_azul',
                    'Restauração' => 'result.filter_restauração',
                    'Atividades' => 'result.filter_atividades',
                    'Zero Poluição' => 'result.filter_zero_poluição',
                    'Qualidade de Ouro' => 'result.filter_qualidade_de_ouro',
                ];
            @endphp

            @foreach($filters as $value => $label)
                <div class="col-md-4 mb-3">
                    <div class="form-check d-flex justify-content-center align-items-center">
                        <input class="form-check-input" type="checkbox" value="{{ $value }}" id="filter{{ str_replace(' ', '', $value) }}" name="filters[]"
                               @if(in_array($value, request()->filters ?? [])) checked @endif>
                        <label class="form-check-label" for="filter{{ str_replace(' ', '', $value) }}">
                            {{ __($label) }}
                        </label>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Botão de envio do formulário -->
        <div class="text-end">
            <button type="submit" class="btn btn-primary mt-2">{{ __('result.apply_filters') }}</button>
        </div>
    </form>
</section>
