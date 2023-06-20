<script>
    var chart1, chart2, chart3, chart4;
    var intervaloActualizacion;
    var opcionesSeleccionadas = new Set(['U', 'R']);

    // Evento click del checkbox "Urbano"
    document.getElementById("checkboxUrbano").addEventListener("click", function() {
        if (this.checked) {
            opcionesSeleccionadas.add("U");
        } else {
            opcionesSeleccionadas.delete("U");
        }
        enviarOpcionesSeleccionadas();
    });

    // Evento click del checkbox "Rural"
    document.getElementById("checkboxRural").addEventListener("click", function() {
        if (this.checked) {
            opcionesSeleccionadas.add("R");
        } else {
            opcionesSeleccionadas.delete("R");
        }
        enviarOpcionesSeleccionadas();
    });

    function enviarOpcionesSeleccionadas() {
        var arregloOpciones = Array.from(opcionesSeleccionadas);
        if (arregloOpciones.length != 0) {
            refrescarGraficos(arregloOpciones);
        } else {
            refrescarGraficos(['N']);
        }
    }

    function buscarVotos(arreglo, tipo, boleta) {
        for (let i = 0; i < arreglo.length; i++) {
            const obj = arreglo[i];
            if (obj.Tipo === tipo && obj.boleta === boleta) {
                return parseInt(obj.votes);
            }
        }
        return 0; // Devuelve 0 si no se encuentra coincidencia
    }

    function actualizarDatosGraficos(partidosPres, partidosAl, partidosDip, datosExtra) {
        //datos de indicadores
        document.getElementById("totalPresidente").innerText = datosExtra.totalPresidente;
        document.getElementById("totalDiputado").innerText = datosExtra.totalDiputado;
        document.getElementById("totalAlcalde").innerText = datosExtra.totalAlcalde;
        document.getElementById("centrosCompletos").innerText = datosExtra.centroVotacionCompletado;
        document.getElementById("mesasComputadasNumero").innerHTML = datosExtra.mesasComputadasNumero +
            "<small class='text-md ml-3'>(" + datosExtra.mesasComputadasPorcentaje + ")</small>";
        document.getElementById("mesasImpugnadas").innerText = datosExtra.mesasImpugnadas;

        //otros Votos
        document.getElementById("np").innerText = buscarVotos(datosExtra.votosOtros, 'NULOS', 'P');
        document.getElementById("nd").innerText = buscarVotos(datosExtra.votosOtros, 'NULOS', 'D');
        document.getElementById("na").innerText = buscarVotos(datosExtra.votosOtros, 'NULOS', 'A');
        document.getElementById("bp").innerText = buscarVotos(datosExtra.votosOtros, 'EN BLANCO', 'P');
        document.getElementById("bd").innerText = buscarVotos(datosExtra.votosOtros, 'EN BLANCO', 'D');
        document.getElementById("ba").innerText = buscarVotos(datosExtra.votosOtros, 'EN BLANCO', 'A');
        document.getElementById("vp").innerText = buscarVotos(datosExtra.votosOtros, 'EXTRAVIADOS', 'P');
        document.getElementById("vd").innerText = buscarVotos(datosExtra.votosOtros, 'EXTRAVIADOS', 'D');
        document.getElementById("va").innerText = buscarVotos(datosExtra.votosOtros, 'EXTRAVIADOS', 'A');
        document.getElementById("ip").innerText = buscarVotos(datosExtra.votosOtros, 'IMPUGNADOS', 'P');
        document.getElementById("id").innerText = buscarVotos(datosExtra.votosOtros, 'IMPUGNADOS', 'D');
        document.getElementById("ia").innerText = buscarVotos(datosExtra.votosOtros, 'IMPUGNADOS', 'A');

        // Preparar los datos para cada tipo de boleta
        var datosPresidente = partidosPres.map(function(item) {
            return item.total;
        });

        var datosAlcalde = partidosAl.map(function(item) {
            return item.total;
        });

        var datosDiputado = partidosDip.map(function(item) {
            return item.total;
        });

        // Actualizar los datos de cada gráfico
        chart1.data.datasets[0].data = datosPresidente;
        chart2.data.datasets[0].data = datosAlcalde;
        chart3.data.datasets[0].data = datosDiputado;

        //Actualizar el de concejales este es distinto porque se actualiza todo
        var datosConcejalEnt = datosExtra.concejales.map(function(item) {
            return item.ent
        });
        var datosConcejalSeats = datosExtra.concejales.map(function(item) {
            return item.seats
        });

        chart4.data.labels = datosConcejalEnt;
        chart4.data.datasets[0].data = datosConcejalSeats;

        // Actualizar el gráfico
        chart1.update();
        chart2.update();
        chart3.update();
        chart4.update();
    }

    function crearGraficos() {
        var datosPres = {!! json_encode($partidosPres) !!};
        var datosDip = {!! json_encode($partidosDip) !!};
        var datosAl = {!! json_encode($partidosAl) !!};
        // Obtener los nombres de los partidos
        var partidosPres = datosPres.map(function(item) {
            return item.nombre;
        });
        var partidosDip = datosDip.map(function(item) {
            return item.nombre;
        });
        var partidosAl = datosAl.map(function(item) {
            return item.nombre;
        });

        var ctx1 = document.getElementById('grafico-presidente').getContext('2d');
        chart1 = new Chart(ctx1, {
            type: 'bar',
            data: {
                labels: partidosPres,
                datasets: [{
                    label: 'Total',
                    data: [],
                    backgroundColor: datosPres.map(function(item) {
                        return item.color;
                    }),
                    borderColor: datosPres.map(function(item) {
                        return item.colorB;
                    }),
                    borderWidth: 1,
                    skipNull: true,
                    datalabels: {
                        anchor: 'end',
                        align: 'top'
                    }
                }]
            },
            plugins: [ChartDataLabels],
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        afterLayout: function(scale) {
                            var gridLines = scale.options.gridLines;
                            var stepSize = scale.options.ticks.stepSize;
                            var max = scale.max;

                            var adjustedMax = Math.ceil(max / stepSize) * stepSize;

                            if (gridLines.display && adjustedMax > max) {
                                scale.max = adjustedMax;
                                scale.options.ticks.max = adjustedMax;
                                scale.options.ticks.minorMax = adjustedMax;
                                scale.chart.update();
                            }
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false // Ocultar la leyenda
                    }
                }
            }
        });

        var ctx2 = document.getElementById('grafico-alcalde').getContext('2d');
        chart2 = new Chart(ctx2, {
            type: 'bar',
            data: {
                labels: partidosAl,
                datasets: [{
                    label: 'Total',
                    data: [],
                    backgroundColor: datosAl.map(function(item) {
                        return item.color;
                    }),
                    borderColor: datosAl.map(function(item) {
                        return item.colorB;
                    }),
                    borderWidth: 1,
                    datalabels: {
                        anchor: 'end',
                        align: 'top'
                    }
                }]
            },
            plugins: [ChartDataLabels],
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        afterLayout: function(scale) {
                            var gridLines = scale.options.gridLines;
                            var stepSize = scale.options.ticks.stepSize;
                            var max = scale.max;

                            var adjustedMax = Math.ceil(max / stepSize) * stepSize;

                            if (gridLines.display && adjustedMax > max) {
                                scale.max = adjustedMax;
                                scale.options.ticks.max = adjustedMax;
                                scale.options.ticks.minorMax = adjustedMax;
                                scale.chart.update();
                            }
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false // Ocultar la leyenda
                    }
                }
            }
        });

        var ctx3 = document.getElementById('grafico-diputado').getContext('2d');
        chart3 = new Chart(ctx3, {
            type: 'bar',
            data: {
                labels: partidosDip,
                datasets: [{
                    label: 'Total',
                    data: [],
                    backgroundColor: datosDip.map(function(item) {
                        return item.color;
                    }),
                    borderColor: datosDip.map(function(item) {
                        return item.colorB;
                    }),
                    borderWidth: 1,
                    datalabels: {
                        anchor: 'end',
                        align: 'top'
                    }
                }]
            },
            plugins: [ChartDataLabels],
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        afterLayout: function(scale) {
                            var gridLines = scale.options.gridLines;
                            var stepSize = scale.options.ticks.stepSize;
                            var max = scale.max;

                            var adjustedMax = Math.ceil(max / stepSize) * stepSize;

                            if (gridLines.display && adjustedMax > max) {
                                scale.max = adjustedMax;
                                scale.options.ticks.max = adjustedMax;
                                scale.options.ticks.minorMax = adjustedMax;
                                scale.chart.update();
                            }
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false // Ocultar la leyenda
                    }
                }
            }
        });

        var adjustedMax;
        var ctx4 = document.getElementById('grafico-concejales').getContext('2d');
        chart4 = new Chart(ctx4, {
            type: 'bar',
            data: {
                labels: [],
                datasets: [{
                    label: 'Total',
                    data: [],
                    borderWidth: 1,
                    datalabels: {
                        anchor: 'end',
                        align: 'top'
                    }
                }]
            },
            plugins: [ChartDataLabels],
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 14
                    }
                },
                plugins: {
                    legend: {
                        display: false // Ocultar la leyenda
                    }
                }
            }
        });

    }

    function refrescarGraficos(arregloOpciones) {
        if (!arregloOpciones) {
            arregloOpciones = ['U', 'R'];
        }
        var arregloOpcionesParametro = arregloOpciones.join(',');
        // Construir la URL de la ruta con arregloOpciones como parámetro
        var ruta = '{{ route('datosGrafico', ['arregloOpciones' => 'ARREGLO']) }}';
        ruta = ruta.replace('ARREGLO', arregloOpcionesParametro);
        // Detener el intervalo de actualización existente
        clearInterval(intervaloActualizacion);

        // Obtener los datos desde el controlador
        fetch(ruta)
            .then(function(response) {
                return response.json();
            })
            .then(function(data) {
                actualizarDatosGraficos(data.partidosPres, data.partidosAl, data.partidosDip, data
                    .noGraficables);
            })
            .catch(function(error) {
                console.log(error);
            });

        // Iniciar el nuevo intervalo de actualización
        intervaloActualizacion = setInterval(function() {
            // Obtener los datos desde el controlador
            fetch(ruta)
                .then(function(response) {
                    return response.json();
                })
                .then(function(data) {
                    actualizarDatosGraficos(data.partidosPres, data.partidosAl, data.partidosDip, data
                        .noGraficables);
                })
                .catch(function(error) {
                    console.log(error);
                });
        }, 10000); // 10 segundos = 10000 milisegundos
    }
    // Obtener los datos iniciales y crear los gráficos
    crearGraficos();
    refrescarGraficos();
</script>
