<div class="mb-8">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Actions per Month</h3>
            <canvas id="actionsChart" height="80"></canvas>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Cost per Employee</h3>
            <canvas id="costChart" height="80"></canvas>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Actions by Type</h3>
            <canvas id="actionsTypeChart" height="80"></canvas>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Costs per Month</h3>
            <canvas id="kostenMaandChart" height="80"></canvas>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.js"></script>
<script>
    const chartData = @json($chartData);
    const kostenPerMaand = @json($kostenPerMaand);

    // Actions per Month Chart
    const actionsCtx = document.getElementById('actionsChart').getContext('2d');
    new Chart(actionsCtx, {
        type: 'bar',
        data: {
            labels: Object.keys(chartData.actionsPerMonth),
            datasets: [{
                label: 'Actions',
                data: Object.values(chartData.actionsPerMonth),
                backgroundColor: '#185FA5',
                borderColor: '#0f3a6e',
                borderWidth: 1,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    }
                }
            }
        }
    });

    // Cost per Employee Chart
    const costCtx = document.getElementById('costChart').getContext('2d');
    new Chart(costCtx, {
        type: 'bar',
        data: {
            labels: Object.keys(chartData.costPerEmployee),
            datasets: [{
                label: 'Cost (€)',
                data: Object.values(chartData.costPerEmployee),
                backgroundColor: '#9FE1CB',
                borderColor: '#5cb89e',
                borderWidth: 1,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Actions by Type Donut Chart
    const actionsTypeCtx = document.getElementById('actionsTypeChart').getContext('2d');
    new Chart(actionsTypeCtx, {
        type: 'doughnut',
        data: {
            labels: Object.keys(chartData.actionsByType),
            datasets: [{
                data: Object.values(chartData.actionsByType),
                backgroundColor: ['#185FA5', '#9FE1CB', '#B5D4F4', '#E6F1FB', '#3b82f6'],
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
        }
    });

    // Costs per Month Chart
    const kostenCtx = document.getElementById('kostenMaandChart').getContext('2d');
    new Chart(kostenCtx, {
        type: 'bar',
        data: {
            labels: Object.keys(kostenPerMaand),
            datasets: [{
                label: 'Cost (€)',
                data: Object.values(kostenPerMaand),
                backgroundColor: '#3b82f6',
                borderColor: '#1d4ed8',
                borderWidth: 1,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
