<div class="row">
<div style="text-align: right;">
    <label for="checkboxUrbano">Urbano</label>
    <input type="checkbox" id="checkboxUrbano" name="arregloOpciones[]" value="U" checked>
    <label for="checkboxRural">Rural</label>
    <input type="checkbox" id="checkboxRural" name="arregloOpciones[]" value="R" checked>
</div>
</div>
<div class="row">
   <!-- <div class="col-md-12"> -->
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Presidente
                </div>
                <div class="card-body">
                    <canvas id="grafico-presidente"></canvas>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Alcalde
                </div>
                <div class="card-body">
                    <canvas id="grafico-alcalde"></canvas>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Diputado
                </div>
                <div class="card-body">
                    <canvas id="grafico-diputado"></canvas>
                </div>
            </div>
        </div>
    </div>
   <!-- <div class="col-md-2">
        <div class="card sticky-top">
            <div class="card-header">
                Leyenda
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <tbody>
                        @php
                            $count = 0;
                        @endphp
                        @foreach ($partidosT as $dato)
                            @if ($count % 2 == 0)
                                <tr>
                            @endif
                            <td class="mr-5">
                                <div style="width: 10px; height: 10px; background-color: {{ $dato['color'] }};"></div>
                            </td>
                            <td class="mr-5"><img src="{{ asset('assets/img/' . $dato['id'] . '.png') }}"
                                    loading="lazy" alt="{{ $dato['nombre'] }}" class="img-sm"
                                    title="{{ $dato['nombre'] }}" data-toggle="tooltip" data-placement="top"></td>
                            @if ($count % 2 != 0)
                                </tr>
                            @endif
                            @php
                                $count++;
                            @endphp
                        @endforeach
                        @if ($count % 2 != 0)
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div> -->
