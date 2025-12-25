@extends('adminPanel.layout.main')
@section('main-section')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<script src="https://cdn.tailwindcss.com"></script>
<style>
    :root {
        --primary-color: #4361ee;
        --primary-light: #eef2ff;
        --success-color: #10b981;
        --success-light: #d1fae5;
        --warning-color: #f59e0b;
        --warning-light: #fef3c7;
        --danger-color: #ef4444;
        --danger-light: #fee2e2;
        --info-color: #0ea5e9;
        --dark-color: #1e293b;
        --dark-light: #334155;
        --light-color: #f8fafc;
        --border-color: #e2e8f0;
        --gradient-primary: linear-gradient(135deg, #4361ee 0%, #3a56d4 100%);
        --gradient-success: linear-gradient(135deg, #10b981 0%, #0da271 100%);
        --gradient-warning: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
        --gradient-danger: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        --gradient-dark: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
    }
    
    body {
        font-family: 'Inter', sans-serif;
        background-color: #f8fafc;
        letter-spacing: -0.01em;
    }
    
    .card {
        border: none;
        box-shadow: 0 1px 3px rgba(0,0,0,0.08);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        border-radius: 12px;
        overflow: hidden;
    }
    
    .card:hover {
        box-shadow: 0 8px 25px rgba(0,0,0,0.1);
        transform: translateY(-2px);
    }
    
    .stat-card {
        border-left: 0;
        position: relative;
        overflow: hidden;
    }
    
.stat-card::before {
    width: 4px;
}
    
    .stat-card.primary::before {
        background: var(--gradient-primary);
    }
    
    .stat-card.success::before {
        background: var(--gradient-success);
    }
    
    .stat-card.warning::before {
        background: var(--gradient-warning);
    }
    
    .stat-card.danger::before {
        background: var(--gradient-danger);
    }
    
   .stat-icon {
    width: 40px;
    height: 40px;
    border-radius: 10px;
}
.stat-card h2 {
    font-size: 1.4rem;
    margin-bottom: 0.25rem !important;
}

.stat-card p {
    margin-bottom: 0.25rem !important;
}
    
    .stat-card:hover .stat-icon {
        transform: scale(1.05);
    }
    
    .chart-container {
        position: relative;
        height: 280px;
    }
    
    .chart-container-pie {
        position: relative;
        height: 260px;
    }
    
    .quick-action-card {
        transition: all 0.3s ease;
        border: 1px solid var(--border-color);
        border-radius: 12px;
        padding: 1.25rem;
    }
    
    .quick-action-card:hover {
        transform: translateY(-4px);
        border-color: var(--primary-color);
        background-color: var(--primary-light);
    }
    
    .status-badge {
        padding: 6px 16px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
        letter-spacing: 0.02em;
    }
    
    .header-title {
        background: var(--gradient-dark);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        position: relative;
        display: inline-block;
    }
    
    .header-title::after {
        content: '';
        position: absolute;
        bottom: -8px;
        left: 0;
        width: 60px;
        height: 4px;
        background: var(--gradient-primary);
        border-radius: 2px;
    }
    
    .time-select {
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        padding: 8px 16px;
        font-size: 0.875rem;
        font-weight: 500;
        transition: all 0.3s ease;
        background-color: white;
    }
    
    .time-select:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.1);
        outline: none;
    }
    
    .progress {
        height: 8px;
        border-radius: 4px;
        background-color: #e2e8f0;
    }
    
    .progress-bar {
        border-radius: 4px;
    }
    
    .trend-indicator {
        display: inline-flex;
        align-items: center;
        padding: 4px 10px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
    }
    
    .trend-up {
        background-color: rgba(16, 185, 129, 0.1);
        color: var(--success-color);
    }
    
    .trend-down {
        background-color: rgba(239, 68, 68, 0.1);
        color: var(--danger-color);
    }
    
    .country-badge {
        background: var(--gradient-primary);
        height: 30px;
        color: white;
        padding: 8px 20px;
        border-radius: 30px;
        font-weight: 500;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }
    
    .section-title {
        font-weight: 600;
        color: var(--dark-color);
        margin-bottom: 1rem;
        position: relative;
        padding-bottom: 8px;
    }
    
    .section-title::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 40px;
        height: 3px;
        background: var(--gradient-primary);
        border-radius: 2px;
    }
    .container-fluid {
    padding-top: 1rem !important;
    padding-bottom: 1rem !important;
}

.mb-5 { margin-bottom: 2rem !important; }
.mb-4 { margin-bottom: 1.25rem !important; }

.card {
    border-radius: 10px;
}

.card-body {
    padding: 0.75rem !important;
}
</style>


<div class="container-fluid py-4">
    <!-- Header -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-5">
        <div>
            <h3 class="header-title fw-bold mb-2">United Arab Emirates Dashboard</h3>
            <div class="d-flex align-items-center gap-3">
                <div class="country-badge">
                    <i class="bi bi-geo-alt"></i>
                    UAE Region
                </div>
                <span class="text-muted small">
                    <i class="bi bi-calendar3 me-1"></i>
                    Last updated: Today, 10:30 AM
                </span>
            </div>
        </div>
    </div>

    <!-- Stats Cards Row -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        
        <!-- Today -->
        <div class="bg-yellow-100 rounded-xl shadow-md p-4 flex justify-between items-start hover:shadow-xl transition">
              <div>
                <p class="text-gray-700 mb-1 font-medium">Today</p>
                <h2 class="text-gray-900 font-bold text-2xl mb-2">{{ $todayData }}</h2>
                <div class="mt-2">
                    <div class="flex justify-between mb-1">
                        <span class="text-gray-600 text-sm" style="color: black">Percentage </span>
                        <span class="text-yellow-700 text-sm font-bold" style="color: black; margin-left: 10px;">{{$percentDifferencetoday}} %</span>
                    </div>
                    <div class="h-2 w-full bg-yellow-200 rounded">
                        <div class="h-2 bg-yellow-400 rounded" style="width: 71.7%;"></div>
                    </div>
                </div>
            </div>
            <div class="w-12 h-12 bg-yellow-200 rounded-lg flex items-center justify-center">
                <i class="bi bi-check-circle text-yellow-600 text-xl"></i>
            </div>
        </div>
        <!-- Prices Day -->
           <div class="bg-green-100 rounded-xl shadow-md p-4 flex justify-between items-start hover:shadow-xl transition">
            <div>
                <p class="text-gray-700 mb-1 font-medium">Yersterday</p>
                <h2 class="text-gray-900 font-bold text-2xl mb-2">{{$yesterdayData}}</h2>
                <div class="mt-2">
                  
                  
                </div>
            </div>
            <div class="w-12 h-12 bg-green-200 rounded-lg flex items-center justify-center">
                <i class="bi bi-check-circle text-green-600 text-xl"></i>
            </div>
        </div>
        <div class="bg-blue-100 rounded-xl shadow-md p-4 flex justify-between items-start hover:shadow-xl transition">
            <div>
                <p class="text-gray-700 mb-2 font-medium">Last week</p>
                <h2 class="text-gray-900 font-bold mb-3">{{ $lastWeekData }}</h2>
                <div class="flex items-center gap-2">
                    <span class="bg-green-100 text-green-700 px-2 py-0.5 rounded-full text-sm flex items-center">
                        <i class="bi bi-arrow-up-right me-1"></i>{{$percentDifferenceWeek}}
                    </span>
                    <span class="text-gray-600 text-sm">Compared to last week</span>
                </div>
            </div>
            <div class="w-12 h-12 bg-blue-200 rounded-lg flex items-center justify-center">
                <i class="bi bi-file-text text-blue-600 text-xl"></i>
            </div>
        </div>

        <!-- Approved Queries -->
     

    </div>

    <!-- Graph Section -->
    <div class="row mb-4">
        <div class="col-lg-8 mb-4">
            <div class="card h-100">
                <div class="card-header bg-white d-flex justify-content-between align-items-center py-3 border-bottom">
                    <div>
                        <h5 class="section-title mb-1">Queries Analytics</h5>
                        <p class="text-muted mb-0 small">Monthly query performance trends</p>
                    </div>
                    <div>
                        <select id="timeRange" class="time-select">
                            <option value="7d">Last 7 days</option>
                            <option value="30d">Last 30 days</option>
                            <option value="3m" selected>Last 3 months</option>
                            <option value="6m">Last 6 months</option>
                            <option value="1y">Last year</option>
                        </select>
                    </div>
                </div>
                <div class="card-body p-4">
                    <div class="chart-container">
                        <canvas id="queriesChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>

document.addEventListener("DOMContentLoaded", function () {
    const ctx = document.getElementById('queriesChart').getContext('2d');
    const timeRange = document.getElementById('timeRange');
    let queriesChart; // global chart instance

    // Blade se domain variable le rahe hain
    const domain = "{{ $thisdomain ?? 'partsfinder.ae' }}";

    // Function to render chart
    function renderChart(labels, data) {
        const gradient = ctx.createLinearGradient(0, 0, 0, 400);
        gradient.addColorStop(0, 'rgba(67, 97, 238, 0.3)');
        gradient.addColorStop(1, 'rgba(67, 97, 238, 0.05)');

        if (queriesChart) queriesChart.destroy();

        queriesChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Queries',
                    data: data,
                    borderColor: '#4361ee',
                    backgroundColor: gradient,
                    borderWidth: 3,
                    fill: true,
                    tension: 0.4,
                    pointBackgroundColor: '#4361ee',
                    pointBorderColor: '#ffffff',
                    pointBorderWidth: 3,
                    pointRadius: 6,
                    pointHoverRadius: 8
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            padding: 20,
                            usePointStyle: true,
                            pointStyle: 'circle',
                            font: { size: 12 }
                        }
                    },
                    tooltip: {
                        mode: 'index',
                        intersect: false,
                        backgroundColor: 'rgba(30, 41, 59, 0.9)',
                        titleFont: { size: 13 },
                        bodyFont: { size: 13 },
                        padding: 12,
                        cornerRadius: 8
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            font: { size: 11 },
                            padding: 10,
                            callback: function(value) { return value.toLocaleString(); }
                        },
                        grid: { color: 'rgba(0,0,0,0.04)', drawBorder: false }
                    },
                    x: {
                        ticks: { font: { size: 11 }, padding: 10 },
                        grid: { display: false }
                    }
                },
                interaction: { intersect: false, mode: 'nearest' }
            }
        });
    }

    // Function to fetch data for given range
    function fetchChartData(range) {
        const canvasContainer = document.querySelector('.chart-container');
        const canvas = canvasContainer.querySelector('canvas');

        // Loading effect
        canvas.style.opacity = 0.3;

        fetch(`/analytics/queries-data/${domain}?range=${range}`)
            .then(res => res.json())
            .then(res => {
                canvas.style.opacity = 1;
                renderChart(res.labels, res.data);
            })
            .catch(err => {
                console.error('Error fetching chart data:', err);
                canvas.style.opacity = 1;
            });
    }

    // Initial load: 3 months
    fetchChartData('3m');

    // Change chart on time range selection
    if (timeRange) {
        timeRange.addEventListener('change', function() {
            fetchChartData(this.value);
        });
    }
});
</script>
</script>
@endsection