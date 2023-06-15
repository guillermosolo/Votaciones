<script>
    var chart1, chart2, chart3;
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

    function actualizarDatosGraficos(partidosPres, partidosAl, partidosDip) {
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

        var maxDataValue = Math.max(...datosPresidente, ...datosAlcalde, ...datosDiputado);

        // Agregar un margen a los datos
        var margin = 50; // Ajusta este valor según tus necesidades
        var maxDataValueWithMargin = maxDataValue + margin;

        // Actualizar los datos de cada gráfico
        chart1.data.datasets[0].data = datosPresidente;
        chart2.data.datasets[0].data = datosAlcalde;
        chart3.data.datasets[0].data = datosDiputado;

        // Actualizar los límites del eje y en cada gráfico
        chart1.options.scales.y.max = maxDataValueWithMargin;
        chart2.options.scales.y.max = maxDataValueWithMargin;
        chart3.options.scales.y.max = maxDataValueWithMargin;


        // Actualizar el gráfico
        chart1.update();
        chart2.update();
        chart3.update();
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
                        beginAtZero: true
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
                    borderColor: datosPres.map(function(item) {
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
                        beginAtZero: true
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
                    borderColor: datosPres.map(function(item) {
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
                        beginAtZero: true
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
                actualizarDatosGraficos(data.partidosPres, data.partidosAl, data.partidosDip);
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
                    actualizarDatosGraficos(data.partidosPres, data.partidosAl, data.partidosDip);
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
