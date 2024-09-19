@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="my-4">إدارة الحجوزات</h1>
            </div>
        </div>

        <div class="row">
            @forelse ($reservations as $reservation)
                <div class="col-md-4 mb-4">
                    <div class="card shadow-lg">
                        <div class="card-header bg-primary text-white">
                            <h5 class="card-title mb-0">حجز #{{ $reservation->id }}</h5>
                        </div>
                        <div class="card-body">
                            <h6 class="card-subtitle mb-2 text-muted">تفاصيل البدلة:</h6>
                            <p><strong>البدلة:</strong> {{ $reservation->suit->name }}</p>
                            <p><strong>المقاس:</strong> {{ $reservation->size->size }}</p>
                            <p><strong>السعر:</strong> {{ $reservation->price }} جنيه</p>

                            <h6 class="card-subtitle mb-2 text-muted">معلومات العميل:</h6>
                            <p><strong>الاسم:</strong> {{ $reservation->name }}</p>
                            <p><strong>الهاتف:</strong> {{ $reservation->phone }}</p>

                            <h6 class="card-subtitle mb-2 text-muted">التواريخ:</h6>
                            <p><strong>تاريخ الحجز:</strong>
                                {{ \Carbon\Carbon::parse($reservation->reservation_date)->format('d/m/Y') }}</p>
                            <p><strong>تاريخ الاستعادة:</strong>
                                {{ \Carbon\Carbon::parse($reservation->return_date)->format('d/m/Y') }}</p>

                            <h6 class="card-subtitle mb-2 text-muted">الحالة:</h6>
                            <p>
                                @if ($reservation->status == 'incomplete')
                                    <span class="badge badge-warning">قيد التجهيز</span>
                                @elseif ($reservation->status == 'completed')
                                    <span class="badge badge-success">تم التجهيز</span>
                                @elseif ($reservation->status == 'to_collect')
                                    <span class="badge badge-info">تم الاستلام</span>
                                @endif
                            </p>

                            <a href="#" class="btn btn-primary btn-block" data-toggle="modal"
                                data-target="#reservationModal{{ $reservation->id }}">عرض التفاصيل</a>
                        </div>
                    </div>
                </div>

                <!-- مودال عرض تفاصيل الحجز -->
                <div class="modal fade" id="reservationModal{{ $reservation->id }}" tabindex="-1"
                    aria-labelledby="reservationModalLabel{{ $reservation->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="reservationModalLabel{{ $reservation->id }}">
                                    تفاصيل الحجز رقم {{ $reservation->id }}
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="container-fluid">
                                    <!-- معلومات العميل -->
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <strong>اسم العميل:</strong>
                                            <p>{{ $reservation->name }}</p>
                                        </div>
                                        <div class="col-md-6">
                                            <strong>رقم الهاتف:</strong>
                                            <p>{{ $reservation->phone }}</p>
                                        </div>
                                    </div>

                                    <!-- معلومات البدلة -->
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <strong>البدلة:</strong>
                                            <p>{{ $reservation->suit->name }}</p>
                                        </div>
                                        <div class="col-md-6">
                                            <strong>المقاس:</strong>
                                            <p>{{ $reservation->size->size }}</p>
                                        </div>
                                    </div>

                                    <!-- التواريخ -->
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <strong>تاريخ الحجز:</strong>
                                            <p>{{ \Carbon\Carbon::parse($reservation->reservation_date)->format('d/m/Y') }}
                                            </p>
                                        </div>
                                        <div class="col-md-6">
                                            <strong>تاريخ الاستعادة:</strong>
                                            <p>{{ \Carbon\Carbon::parse($reservation->return_date)->format('d/m/Y') }}</p>
                                        </div>
                                    </div>

                                    <!-- الملحقات -->
                                    <div class="row mb-3">
                                        <div class="col-md-12">
                                            <strong>الملحقات:</strong>
                                            <ul>
                                                @if ($reservation->include_pants)
                                                    <li>بنطال</li>
                                                @endif
                                                @if ($reservation->include_vest)
                                                    <li>سديري</li>
                                                @endif
                                                @if ($reservation->include_tie)
                                                    <li>كرفتة</li>
                                                @endif
                                                @if ($reservation->include_bow_tie)
                                                    <li>ببيون</li>
                                                @endif
                                                @if ($reservation->include_pocket_square)
                                                    <li>منديل جيب</li>
                                                @endif
                                                @if ($reservation->include_shirt)
                                                    <li>قميص</li>
                                                @endif
                                                @if ($reservation->include_brooch)
                                                    <li>بروش</li>
                                                @endif
                                            </ul>
                                        </div>
                                    </div>

                                    <!-- المقاسات الشخصية -->
                                    <div class="row mb-3">
                                        <div class="col-md-3">
                                            <strong>الطول:</strong>
                                            <p>{{ $reservation->height ?? 'غير محدد' }} سم</p>
                                        </div>
                                        <div class="col-md-3">
                                            <strong>الوسط:</strong>
                                            <p>{{ $reservation->waist ?? 'غير محدد' }} سم</p>
                                        </div>
                                        <div class="col-md-3">
                                            <strong>الفخذ:</strong>
                                            <p>{{ $reservation->thighs ?? 'غير محدد' }} سم</p>
                                        </div>
                                        <div class="col-md-3">
                                            <strong>السمانة:</strong>
                                            <p>{{ $reservation->calves ?? 'غير محدد' }} سم</p>
                                        </div>
                                    </div>

                                    <!-- الملاحظات -->
                                    <div class="row mb-3">
                                        <div class="col-md-12">
                                            <strong>ملاحظات:</strong>
                                            <p>{{ $reservation->notes ?? 'لا توجد ملاحظات' }}</p>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                            </div>
                        </div>
                    </div>
                </div>

            @empty
                <div class="col-12">
                    <p class="text-center">لا توجد حجوزات.</p>
                </div>
            @endforelse
        </div>
    </div>
@endsection
