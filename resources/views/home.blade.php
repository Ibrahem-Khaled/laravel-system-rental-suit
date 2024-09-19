@extends('layouts.dashboard')

@section('content')
    <div class="container-fluid">
        <div class="row mb-4">
            <div class="col-12 text-center">
                <h1 class="mb-3">إدارة البدل</h1>
                <p class="text-muted">متابعة جميع العمليات الخاصة بالبدل والحجوزات</p>
            </div>
        </div>

        <div class="row">
            <!-- غسيل ومكواه -->
            <div class="col-md-3">
                <div class="card text-center shadow">
                    <div class="card-body">
                        <h5 class="card-title">غسيل ومكواه</h5>
                        <p class="text-muted">البدل التي تم تسجيلها كغسيل ومكواه</p>
                        <h2 class="display-4 text-danger">{{ $damagedSuits }}</h2>
                    </div>
                    <div class="card-footer">
                        <a href="#" class="btn btn-danger">عرض التفاصيل</a>
                    </div>
                </div>
            </div>


            <!-- البدل المطلوب استلامها -->
            <div class="col-md-3">
                <div class="card text-center shadow">
                    <div class="card-body">
                        <h5 class="card-title">البدل المطلوب استلامها</h5>
                        <p class="text-muted">البدل التي يجب استلامها من العميل</p>
                        <h2 class="display-4 text-warning">{{ $toBeCollectedSuits }}</h2>
                    </div>
                    <div class="card-footer">
                        <a href="#" class="btn btn-warning">عرض التفاصيل</a>
                    </div>
                </div>
            </div>
            <!-- البدل المكتملة -->
            <div class="col-md-3">
                <div class="card text-center shadow">
                    <div class="card-body">
                        <h5 class="card-title">البدل المكتملة</h5>
                        <p class="text-muted">جاهزة للتسليم للعميل</p>
                        <h2 class="display-4 text-success">{{ $completedSuits }}</h2>
                    </div>
                    <div class="card-footer">
                        <a href="#" class="btn btn-success">عرض التفاصيل</a>
                    </div>
                </div>
            </div>
            <!-- الحجوزات الغير مكتملة -->
            <div class="col-md-3">
                <div class="card text-center shadow">
                    <div class="card-body">
                        <h5 class="card-title">الحجوزات الغير مكتملة</h5>
                        <p class="text-muted">يتم تجهيزها قبل التسليم للعميل</p>
                        <h2 class="display-4 text-primary">{{ $incompleteReservations }}</h2>
                    </div>
                    <div class="card-footer">
                        <a href="#" class="btn btn-primary">عرض التفاصيل</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-5">
            <!-- الهالك للبدل -->
            <div class="col-md-3">
                <div class="card text-center shadow">
                    <div class="card-body">
                        <h5 class="card-title">الهالك للبدل</h5>
                        <p class="text-muted">البدل التي تم تسجيلها كهالك</p>
                        <h2 class="display-4 text-danger">{{ $damagedSuits }}</h2>
                    </div>
                    <div class="card-footer">
                        <a href="#" class="btn btn-danger">عرض التفاصيل</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- الإحصائيات والرسوم البيانية -->
        <div class="row mt-5">
            <!-- الرسم البياني لعدد الحجوزات -->
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-header">
                        <h5 class="card-title">عدد الحجوزات</h5>
                    </div>
                    <div class="card-body">
                        <canvas id="reservationsChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- الرسم البياني لحالة البدل -->
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-header">
                        <h5 class="card-title">حالة البدل</h5>
                    </div>
                    <div class="card-body">
                        <canvas id="suitsChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // بيانات الرسم البياني للحجوزات
        var ctx1 = document.getElementById('reservationsChart').getContext('2d');
        var reservationsChart = new Chart(ctx1, {
            type: 'bar',
            data: {
                labels: ['يناير', 'فبراير', 'مارس', 'أبريل', 'مايو', 'يونيو', 'يوليو'],
                datasets: [{
                    label: 'عدد الحجوزات',
                    data: [12, 19, 3, 5, 2, 3, 7],
                    backgroundColor: 'rgba(98, 94, 238, 0.7)',
                    borderColor: 'rgba(98, 94, 238, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // بيانات الرسم البياني لحالة البدل
        var ctx2 = document.getElementById('suitsChart').getContext('2d');
        var suitsChart = new Chart(ctx2, {
            type: 'pie',
            data: {
                labels: ['غير مكتملة', 'مكتملة', 'مطلوب استلامها', 'هالك'],
                datasets: [{
                    label: 'حالة البدل',
                    data: [{{ $incompleteReservations }}, {{ $completedSuits }}, {{ $toBeCollectedSuits }},
                        {{ $damagedSuits }}
                    ],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.7)',
                        'rgba(54, 162, 235, 0.7)',
                        'rgba(255, 206, 86, 0.7)',
                        'rgba(255, 159, 64, 0.7)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            }
        });
    </script>
@endsection
