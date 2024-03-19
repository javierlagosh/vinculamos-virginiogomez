$(document).ready(function() {
    cargarSedes();
});

function cargarSedes() {
  var sede = $("#select_sede").val();
  $.ajax({
    url: `${window.location.origin}/dashboard/sedes-datos`,
    data: {
      sede_codigo: sede,
    },
    headers: {
      "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
    type: "POST",
    dataType: "json",
    success: function (data) {
      $("#sede_estudiantes").empty();
      $("#sede_estudiantes_porcentaje").empty();
      $("#sede_docentes").empty();
      $("#sede_docentes_porcentaje").empty();
      $("#iniciativas_sedes").empty();
      $("#iniciativas_sedes_porcentaje").empty();
      var total;
      var estimado;
      var estados = [
        "En ejecución",
        "Aceptada",
        "Falta info",
        "Cerrada",
        "Falta Evidencia",
        "Finalizada",
      ];

      var aux_a = [];
      var aux_contador_a = {};
      var aux_result_a = [];

      var aux_b = [];
      var aux_contador_b = {};
      var aux_result_b = [];

      var aux_c = [];
      var aux_contador_c = {};
      var aux_result_c = [];

      var aux_d = [];
      var aux_contador_d = {};
      var aux_result_d = [];

      var aux_e = [];
      var aux_contador_e = {};
      var aux_result_e = [];

      data[0].forEach((element) => {
        total = element != null ? element : 0;
      });
      var claves_total = Object.keys(total);
      for (let i = 0; i < claves_total.length; i++) {
        let value = claves_total[i];
        total[value] = total[value] != null ? total[value] : 0;
      }
      data[1].forEach((element) => {
        estimado = element != null ? element : 0;
      });
      var claves_estimado = Object.keys(estimado);
      for (let i = 0; i < claves_estimado.length; i++) {
        let value = claves_estimado[i];
        estimado[value] = estimado[value] != null ? estimado[value] : 0;
      }
      var porcentaje_sede_estudiantes =
        (total.total_estudiantes * 100) / estimado.meta_estudiantes < 100
          ? (total.total_estudiantes * 100) / estimado.meta_estudiantes
          : 100;
      var porcentaje_sede_docentes =
        (total.total_docentes * 100) / estimado.meta_docentes < 100
          ? (total.total_docentes * 100) / estimado.meta_docentes
          : 100;
      var porcentaje_iniciativas_sedes =
        (total.total_iniciativas * 100) / estimado.meta_iniciativas < 100
          ? (total.total_iniciativas * 100) / estimado.meta_iniciativas
          : 100;
      //TODO: Manejar erro de division por cero, debido al no registro de meta de iniciativas por sedes.

      //TODO:manejar datos en caso de que vengan nulos

      $("#sede_estudiantes").html(
        `${total.total_estudiantes} de ${estimado.meta_estudiantes}`
      );
      $("#sede_estudiantes_porcentaje").html(
        `${porcentaje_sede_estudiantes.toFixed(2)}% Completado`
      );
      $("#sede_estudiantes_porcentaje_bar").css(
        "width",
        `${porcentaje_sede_estudiantes.toFixed(2)}%`
      );

      $("#sede_docentes").html(
        `${total.total_docentes} de ${estimado.meta_docentes}`
      );
      $("#sede_docentes_porcentaje").html(
        `${porcentaje_sede_docentes.toFixed(2)}% Completado`
      );
      $("#sede_docentes_porcentaje_bar").css(
        "width",
        `${porcentaje_sede_docentes.toFixed(2)}%`
      );

      $("#iniciativas_sedes").html(
        `${total.total_iniciativas} de ${estimado.meta_iniciativas}`
      );
      $("#iniciativas_sedes_porcentaje").html(
        `${porcentaje_iniciativas_sedes.toFixed(2)}% Completado`
      );
      $("#iniciativas_sedes_porcentaje_bar").css(
        "width",
        `${porcentaje_iniciativas_sedes.toFixed(2)}%`
      );

      // data[2].forEach(element => {
      //     if (aux_a.includes(element.sugr_nombre)) {
      //         aux_contador_a[element.sugr_nombre]++;
      //     } else {
      //         aux_a.push(element.sugr_nombre);
      //         aux_contador_a[element.sugr_nombre] = 1;
      //     }
      // });

      // aux_a.forEach(element => {
      //     aux_result_a.push({
      //         nombre: element,
      //         cantidad: aux_contador_a[element]
      //     })
      // })

      // pieChart("iniciativaXsubgrupo", aux_result_a);

      if (data[3].length != 0) {
        data[3].forEach((element) => {
          if (aux_b.includes(element.grin_nombre)) {
            aux_contador_b[element.grin_nombre]++;
          } else {
            aux_b.push(element.grin_nombre);
            aux_contador_b[element.grin_nombre] = 1;
          }
        });

        aux_b.forEach((element) => {
          aux_result_b.push({
            nombre: element,
            cantidad: aux_contador_b[element],
          });
        });

        pieChart("iniciativaXgrupo", aux_result_b);
      } else {
        $("#iniciativaXgrupo").css("height", "0cm");
        $("#iniciativaXgrupoError").html("No hay datos registrados");
      }

      if (data[4].length != 0) {
        data[4].forEach((element) => {
          var estado = estados[element.inic_estado - 1];

          if (aux_c.includes(estado)) {
            aux_contador_c[estado]++;
          } else {
            aux_c.push(estado);
            aux_contador_c[estado] = 1;
          }
        });

        aux_c.forEach((element) => {
          aux_result_c.push({
            nombre: element,
            cantidad: aux_contador_c[element],
          });
        });

        barChart("iniciativaXestado", aux_result_c);
      } else {
        $("#iniciativaXestado").css("height", "0cm");
        $("#iniciativaXestadoError").html("No hay datos registrados");
      }

      if (data[4].length != 0) {
        data[5].forEach((element) => {
          if (aux_d.includes(element.inic_anho)) {
            aux_contador_d[element.inic_anho]++;
          } else {
            aux_d.push(element.inic_anho);
            aux_contador_d[element.inic_anho] = 1;
          }
        });

        aux_d.forEach((element) => {
          aux_result_d.push({
            nombre: element,
            cantidad: aux_contador_d[element],
          });
        });

        barChart("iniciativaXanho", aux_result_d);
      } else {
        $("#iniciativaXanho").css("height", "0cm");
        $("#iniciativaXanhoError").html("No hay datos registrados");
      }

      if (data[6].length != 0) {
        data[6].forEach((element) => {
          if (aux_e.includes(element.comu_nombre)) {
            aux_contador_e[element.comu_nombre]++;
          } else {
            aux_e.push(element.comu_nombre);
            aux_contador_e[element.comu_nombre] = 1;
          }
        });

        aux_e.forEach((element) => {
          aux_result_e.push({
            nombre: element,
            cantidad: aux_contador_e[element],
          });
        });

        barChart("iniciativaXcomuna", aux_result_e);
      } else {
        $("#iniciativaXcomuna").css("height", "0cm");
        $("#iniciativaXcomunaError").html("No hay datos registrados");
      }
    },
  });
}

function barChart(div_name, data) {
  // Themes begin
  am4core.useTheme(am4themes_animated);
  // Themes end

  // Create chart instance
  var chart = am4core.create(div_name, am4charts.XYChart);
  $(`#${div_name}`).css("height", "10cm");
  chart.scrollbarX = new am4core.Scrollbar();
  var ejes = Object.keys(data[0]);
  var labels = ejes[0];
  var valores = ejes[1];
  // Add data
  chart.data = data;

  // Create axes
  var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
  categoryAxis.dataFields.category = labels;
  categoryAxis.renderer.grid.template.location = 0;
  categoryAxis.renderer.minGridDistance = 30;
  categoryAxis.renderer.labels.template.horizontalCenter = "right";
  categoryAxis.renderer.labels.template.verticalCenter = "middle";
  categoryAxis.renderer.labels.template.rotation = 270;
  categoryAxis.tooltip.disabled = true;
  categoryAxis.renderer.minHeight = 110;
  categoryAxis.renderer.labels.template.fill = am4core.color("#9aa0ac");

  var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
  valueAxis.renderer.minWidth = 50;
  valueAxis.renderer.labels.template.fill = am4core.color("#9aa0ac");

  // Create series
  var series = chart.series.push(new am4charts.ColumnSeries());
  series.sequencedInterpolation = true;
  series.dataFields.valueY = valores;
  series.dataFields.categoryX = labels;
  series.tooltipText = "[{categoryX}: bold]{valueY}[/]";
  series.columns.template.strokeWidth = 0;

  series.tooltip.pointerOrientation = "vertical";

  series.columns.template.column.cornerRadiusTopLeft = 10;
  series.columns.template.column.cornerRadiusTopRight = 10;
  series.columns.template.column.fillOpacity = 0.8;

  // on hover, make corner radiuses bigger
  let hoverState = series.columns.template.column.states.create("hover");
  hoverState.properties.cornerRadiusTopLeft = 0;
  hoverState.properties.cornerRadiusTopRight = 0;
  hoverState.properties.fillOpacity = 1;

  series.columns.template.adapter.add("fill", (fill, target) => {
    return chart.colors.getIndex(target.dataItem.index);
  });

  // Cursor
  chart.cursor = new am4charts.XYCursor();
}

function pieChart(div_name, data) {
  // Themes begin
  am4core.useTheme(am4themes_animated);
  // Themes end

  // Create chart instance
  var chart = am4core.create(div_name, am4charts.PieChart);
  $(`#${div_name}`).css("height", "10cm");
  var ejes = Object.keys(data[0]);
  var labels = ejes[0];
  var valores = ejes[1];
  // Add data
  chart.data = data;

  // Add and configure Series
  var pieSeries = chart.series.push(new am4charts.PieSeries());
  pieSeries.dataFields.value = valores;
  pieSeries.dataFields.category = labels;
  pieSeries.slices.template.stroke = am4core.color("#fff");
  pieSeries.slices.template.strokeWidth = 2;
  pieSeries.slices.template.strokeOpacity = 1;
  pieSeries.labels.template.fill = am4core.color("#9aa0ac");

  // Configura la leyenda (barra lateral)
  chart.legend = new am4charts.Legend();
  chart.legend.position = "top";
  // Configura las etiquetas
  pieSeries.ticks.template.disabled = true; // Desactiva las marcas de división
  pieSeries.labels.template.disabled = false; // Habilita las etiquetas
  pieSeries.labels.template.text =
    "{category}: {value.percent.formatNumber('#.0')}%"; // Personaliza el texto de las etiquetas

  // This creates initial animation
  pieSeries.hiddenState.properties.opacity = 1;
  pieSeries.hiddenState.properties.endAngle = -90;
  pieSeries.hiddenState.properties.startAngle = -90;
}
