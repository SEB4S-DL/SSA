function getParametro(nombre) {
  const params = new URLSearchParams(window.location.search);
  return params.get(nombre);
}

let chart;

function cargarGrafica() {
  const ficha = getParametro("ficha"); // lee ?ficha=XXXX de la URL
  if (!ficha) {
    console.error("No se especificó ficha en la URL");
    return;
  }

  const response = fetch("functions/datosGrafica.php?ficha=" + ficha);
  const data = response.json();

  const ctx = document.getElementById("miGrafico").getContext("2d");

  if (chart) {
    chart.destroy();
  }

  chart = new Chart(ctx, {
    type: "bar",
    data: {
      labels: data.labels,
      datasets: [{
        label: "RAEs aprobados",
        data: data.values,
        backgroundColor: "#39a900"
      }]
    },
    options: {
      scales: {
        x: {
          ticks: {
            // Fuerza que el texto esté vertical
            minRotation: 90,
            maxRotation: 90
          }
        }
      },
      responsive: false,
      maintainAspectRatio: false
    }
  });
}

cargarGrafica();
