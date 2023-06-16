<div class="row">
    <div style="text-align: right;">
        <label for="checkboxUrbano">Urbano</label>
        <input type="checkbox" id="checkboxUrbano" name="arregloOpciones[]" value="U" checked>
        <label for="checkboxRural">Rural</label>
        <input type="checkbox" id="checkboxRural" name="arregloOpciones[]" value="R" checked>
    </div>
    <div class="col-12 col-sm-6 col-md-2">
        <div class="info-box">
            <span class="info-box-icon bg-light elevation-1"><i class="fas fa-user-tie"></i></span>
            <div class="info-box-content">
                <span class="info-box-text text-md">Presidente</span>
                <span class="info-box-number text-xl" id="totalPresidente">
                    0
                </span>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-md-2">
        <div class="info-box">
            <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-user-tie"></i></span>
            <div class="info-box-content">
                <span class="info-box-text text-md">Diputado</span>
                <span class="info-box-number text-xl" id="totalAlcalde">
                    0
                </span>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-md-2">
        <div class="info-box">
            <span class="info-box-icon bg-pink elevation-1"><i class="fas fa-user-tie"></i></span>
            <div class="info-box-content">
                <span class="info-box-text text-md">Alcalde</span>
                <span class="info-box-number text-xl" id="totalDiputado">
                    0
                </span>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-md-2">
        <div class="info-box">
            <span class="info-box-icon bg-dark elevation-1"><i class="fas fa-hotel"></i></span>
            <div class="info-box-content">
                <span class="info-box-text text-md">Centros Completos</span>
                <span class="info-box-number text-xl" id="centrosCompletos">
                    0
                </span>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-md-2">
        <div class="info-box">
            <span class="info-box-icon bg-dark elevation-1"><i class="fas fa-map"></i></span>
            <div class="info-box-content">
                <span class="info-box-text text-md">Mesas Computadas</span>
                <span class="info-box-number text-xl" id="mesasComputadasNumero">
                    0<small class="text-md"> (0%)</small>
                </span>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-md-2">
        <div class="info-box">
            <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-map-marked"></i></span>
            <div class="info-box-content">
                <span class="info-box-text text-md">Mesas Impugnadas</span>
                <span class="info-box-number text-xl" id="mesasImpugnadas">
                    0
                </span>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="card card-outline card-info">
            <div class="card-header">
                Votos
            </div>
            <div class="card-body">
                <table class="table table-striped table-hover text-md">
                    <thead class='thead-dark'>
                        <tr>
                            <th></th>
                            <th>Presidente</th>
                            <th>Diputado</th>
                            <th>Alcalde</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>NULOS</td>
                            <td id="np" class="text-right pr-5">0</td>
                            <td id="nd" class="text-right pr-5">0</td>
                            <td id="na" class="text-right pr-5">0</td>
                        </tr>
                        <tr>
                            <td>EN BLANCO</td>
                            <td id="bp" class="text-right pr-5">0</td>
                            <td id="bd" class="text-right pr-5">0</td>
                            <td id="ba" class="text-right pr-5">0</td>
                        </tr>
                        <tr>
                            <td>NO VÁLIDOS</td>
                            <td id="vp" class="text-right pr-5">0</td>
                            <td id="vd" class="text-right pr-5">0</td>
                            <td id="va" class="text-right pr-5">0</td>
                        </tr>
                        <tr>
                            <td>IMPUGNADOS</td>
                            <td id="ip" class="text-right pr-5">0</td>
                            <td id="id" class="text-right pr-5">0</td>
                            <td id="ia" class="text-right pr-5">0</td>
                        </tr>
                    </tbody>
                </table>
            </div>
    </div>
</div>
<div class="col-md-6">
    <div class="card card-outline card-info">
        <div class="card-header">
            Concejales
        </div>
        <div class="card-body">
            <table>
                <canvas id="grafico-concejales"></canvas>
            </table>
        </div>
    </div>
</div>

</div>
<div class="row">
    <!-- <div class="col-md-12"> -->
    <div class="col-md-12">
        <div class="card card-outline card-dark">
            <div class="card-header">
                Presidente
            </div>
            <div class="card-body">
                <canvas id="grafico-presidente"></canvas>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="card card-outline card-primary">
            <div class="card-header">
                Diputado
            </div>
            <div class="card-body">
                <canvas id="grafico-diputado"></canvas>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="card card-outline card-pink">
            <div class="card-header">
                Alcalde
            </div>
            <div class="card-body">
                <canvas id="grafico-alcalde"></canvas>
            </div>
        </div>
    </div>
</div>
