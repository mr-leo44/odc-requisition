
<div class="hidden p-4 rounded-lg" id="styled-statistics" role="tabpanel" aria-labelledby="statistics-tab">
<div class="mt-4">
    <canvas id="verticalBarChart" style="display: block; box-sizing: border-box; height: 414px; width: 828px;" class="w-full dark:text-white"></canvas>
</div>
</div>

<script>
    // Préparer les données
    var labels = ['Total des demandes', 'Demandes livrées', 'Demandes validées', 'Demandes rejetées', 'Demande du mois passé', 'Demande du mois actuel'];
    var data = [
        {{ $statistics['total_requests'] }},
        {{ $statistics['delivered_requests'] }},
        {{ $statistics['validated_requests'] }},
        {{ $statistics['rejected_requests'] }},
        {{ $statistics['last_monthly_requests'] }},
        {{ $statistics['this_month_requests'] }}

    ];

    // Couleurs pour chaque barre
    var colors = [
        'rgba(255, 99, 132, 0.5)',
        'rgba(54, 162, 235, 0.5)',
        'rgba(255, 206, 86, 0.5)',
        'rgba(75, 192, 192, 0.5)',
        'rgba(153, 102, 255, 0.5)',
        'rgba(255, 159, 64, 0.5)'
    ];

    // Configurer le graphique
    const dataVerticalBarChart = {
        labels: labels,
        datasets: [{
            label: 'Nombre de demandes',
            data: data,
            backgroundColor: colors,
            borderColor: colors.map(color => color.replace('0.5', '1')),
            borderWidth: 1
        }]
    };

    const configVerticalBarChart = {
        type: 'bar',
        data: dataVerticalBarChart,
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: true,
                    position: 'bottom',
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return context.dataset.label + ': ' + context.raw;
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        },
    };

    // Initialiser le graphique
    var verticalBarChart = new Chart(
        document.getElementById('verticalBarChart'),
        configVerticalBarChart
    );
</script>
