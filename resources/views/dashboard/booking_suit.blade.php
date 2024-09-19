@extends('layouts.dashboard')

@section('content')
    <div class="container my-5">
        <div class="row">
            <!-- معلومات البدلة -->
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h4>تفاصيل البدلة: {{ $suit->name }}</h4>
                    </div>
                    <div class="card-body">
                        @if ($suit->image)
                            <img src="{{ asset('storage/' . $suit->image) }}" alt="صورة البدلة" class="img-fluid mb-3 rounded">
                        @endif
                        <p><strong>الوصف:</strong> {{ $suit->description }}</p>
                        <p><strong>السعر:</strong> {{ number_format($suit->price, 2) }} جنيه</p>
                        <p><strong>اللون:</strong> {{ $suit->color }}</p>
                        <p><strong>النوع:</strong> {{ ucfirst($suit->product_type) }}</p>
                        <p><strong>الجنس:</strong> {{ ucfirst($suit->gender) }}</p>
                    </div>
                </div>
            </div>

            <!-- المقاسات المتاحة -->
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-header bg-success text-white">
                        <h4>المقاسات المتاحة</h4>
                    </div>
                    <div class="card-body">
                        @if ($suit->sizes->where('is_available', true)->count() > 0)
                            <ul class="list-group">
                                @foreach ($suit->sizes as $size)
                                    @if ($size->is_available)
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <span>{{ $size->size }}</span>
                                            <button class="btn btn-primary btn-sm" data-toggle="modal"
                                                data-target="#reserveModal{{ $size->id }}">
                                                <i class="fas fa-calendar-plus"></i> حجز
                                            </button>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        @else
                            <p class="text-danger">لا توجد مقاسات متاحة حاليًا.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- قسم عرض الحجوزات الحالية -->
        <div class="row mt-5">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-header bg-info text-white">
                        <h4>الحجوزات الحالية للبدلة: {{ $suit->name }}</h4>
                    </div>
                    <div class="card-body">
                        @if ($suit->reservations->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>#</th>
                                            <th>اسم العميل</th>
                                            <th>المقاس</th>
                                            <th>رقم الهاتف</th>
                                            <th>تاريخ الحجز</th>
                                            <th>تاريخ الاستعادة</th>
                                            <th>الحالة</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($suit->reservations as $index => $reservation)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $reservation->name }}</td>
                                                <td>{{ $reservation->size->size }}</td>
                                                <td>{{ $reservation->phone }}</td>
                                                <td>{{ \Carbon\Carbon::parse($reservation->reservation_date)->format('d/m/Y') }}
                                                </td>
                                                <td>{{ \Carbon\Carbon::parse($reservation->return_date)->format('d/m/Y') }}
                                                </td>
                                                <td>
                                                    @if ($reservation->status == 'incomplete')
                                                        <span class="badge badge-success">قيد التجهيز</span>
                                                    @elseif($reservation->status == 'completed')
                                                        <span class="badge badge-success">تم التجهيز</span>
                                                    @else
                                                        <span class="badge badge-warning">تم الاستلام</span>
                                                    @endif
                                                </td>
                                                <!-- زر عرض التفاصيل -->
                                                <td>
                                                    <button type="button" class="btn btn-primary btn-sm"
                                                        data-toggle="modal"
                                                        data-target="#reservationModal{{ $reservation->id }}">
                                                        عرض التفاصيل
                                                    </button>
                                                </td>
                                            </tr>

                                            <!-- مودال عرض تفاصيل الحجز -->
                                            <div class="modal fade" id="reservationModal{{ $reservation->id }}"
                                                tabindex="-1"
                                                aria-labelledby="reservationModalLabel{{ $reservation->id }}"
                                                aria-hidden="true">
                                                <div class="modal-dialog modal-lg modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title"
                                                                id="reservationModalLabel{{ $reservation->id }}">
                                                                تفاصيل الحجز رقم {{ $reservation->id }}
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
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
                                                                <!-- معلومات المقاس والتاريخ -->
                                                                <div class="row mb-3">
                                                                    <div class="col-md-6">
                                                                        <strong>المقاس:</strong>
                                                                        <p>{{ $reservation->size->size }}</p>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <strong>تاريخ الحجز:</strong>
                                                                        <p>{{ \Carbon\Carbon::parse($reservation->reservation_date)->format('d/m/Y') }}
                                                                        </p>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <strong>تاريخ الاستعادة:</strong>
                                                                        <p>{{ \Carbon\Carbon::parse($reservation->return_date)->format('d/m/Y') }}
                                                                        </p>
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

                                                                <!-- السعر والملاحظات -->
                                                                <div class="row mb-3">
                                                                    <div class="col-md-6">
                                                                        <strong>السعر:</strong>
                                                                        <p>{{ $reservation->price }} جنيه</p>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <strong>ملاحظات:</strong>
                                                                        <p>{{ $reservation->notes ?? 'لا توجد ملاحظات' }}
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">إغلاق</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <p class="text-muted">لا توجد حجوزات حالية لهذه البدلة.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- مودال الحجز لكل مقاس -->
        @foreach ($suit->sizes as $size)
            @if ($size->is_available)
                <div class="modal fade" id="reserveModal{{ $size->id }}" tabindex="-1"
                    aria-labelledby="reserveModalLabel{{ $size->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered">
                        <div class="modal-content">
                            <form action="{{ route('reservations.store') }}" method="POST">
                                @csrf
                                <div class="modal-header bg-primary text-white">
                                    <h5 class="modal-title" id="reserveModalLabel{{ $size->id }}">
                                        <i class="fas fa-calendar-plus"></i> حجز المقاس {{ $size->size }} للبدلة
                                        {{ $suit->name }}
                                    </h5>
                                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" name="suit_id" value="{{ $suit->id }}">
                                    <input type="hidden" name="size_id" value="{{ $size->id }}">

                                    <!-- معلومات العميل -->
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="name">اسم العميل <span class="text-danger">*</span></label>
                                            <input type="text" name="name" class="form-control" required>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="phone">رقم الهاتف <span class="text-danger">*</span></label>
                                            <input type="text" name="phone" class="form-control" required>
                                        </div>
                                    </div>

                                    <!-- ملحقات الحجز -->
                                    <div class="form-group">
                                        <label>ملحقات الحجز</label>
                                        <!-- بنطال -->
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="include_pants"
                                                id="include_pants{{ $size->id }}"
                                                onchange="togglePantsFields({{ $size->id }})">
                                            <label class="form-check-label" for="include_pants{{ $size->id }}">
                                                بنطال
                                            </label>
                                        </div>

                                        <!-- القميص -->
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="include_shirt"
                                                id="include_shirt{{ $size->id }}">
                                            <label class="form-check-label" for="include_shirt{{ $size->id }}">
                                                قميص
                                            </label>
                                        </div>

                                        <!-- بروش -->
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="include_brooch"
                                                id="include_brooch{{ $size->id }}">
                                            <label class="form-check-label" for="include_brooch{{ $size->id }}">
                                                بروش
                                            </label>
                                        </div>
                                    </div>
                                    <!-- الحقول الإضافية للقميص -->
                                    <div id="shirtFields{{ $size->id }}">
                                        <div class="form-group">
                                            <label for="shirt_size">مقاس القميص</label>
                                            <input type="text" name="shirt_size" class="form-control"
                                                placeholder="مقاس القميص">
                                        </div>
                                        <div class="form-group">
                                            <label for="shirt_color">لون القميص</label>
                                            <input type="text" name="shirt_color" class="form-control"
                                                placeholder="لون القميص">
                                        </div>
                                    </div>

                                    <!-- الحقول الإضافية للبنطال -->
                                    <div id="pantsFields{{ $size->id }}" style="display: none;">
                                        <div class="form-group">
                                            <label for="pants_size">مقاس البنطال</label>
                                            <input type="text" name="pants_size" class="form-control"
                                                placeholder="مقاس البنطال">
                                        </div>
                                        <div class="form-group">
                                            <label for="pants_color">لون البنطال</label>
                                            <input type="text" name="pants_color" class="form-control"
                                                placeholder="لون البنطال">
                                        </div>
                                        <div class="form-group">
                                            <label for="pants_type">نوع البنطال</label>
                                            <input type="text" name="pants_type" class="form-control"
                                                placeholder="نوع البنطال">
                                        </div>
                                    </div>

                                    <!-- الحقول الأخرى -->
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="reservation_date">تاريخ الحجز <span
                                                    class="text-danger">*</span></label>
                                            <input type="date" name="reservation_date" class="form-control" required>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="return_date">تاريخ الاستعادة <span
                                                    class="text-danger">*</span></label>
                                            <input type="date" name="return_date" class="form-control" required>
                                        </div>
                                    </div>

                                    <!-- بيانات السليم والبنطال -->
                                    <div class="form-row">
                                        <div class="form-group col-md-2">
                                            <label for="height">الطول (سم)</label>
                                            <input type="number" name="height" class="form-control" min="0">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="slim">سليم (سم)</label>
                                            <input type="number" name="slim" class="form-control" min="0">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="calves">السمانة (سم)</label>
                                            <input type="number" name="calves" class="form-control" min="0">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="thighs">الفخذ (سم)</label>
                                            <input type="number" name="thighs" class="form-control" min="0">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="waist">الوسط (سم)</label>
                                            <input type="number" name="waist" class="form-control" min="0">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="notes">ملاحظات</label>
                                        <textarea name="notes" class="form-control" rows="3"></textarea>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="price">سعر الحجز <span class="text-danger">*</span></label>
                                            <input type="number" name="price" class="form-control" required
                                                min="0">
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                        <i class="fas fa-times"></i> إغلاق
                                    </button>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save"></i> حجز المقاس
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach

        <script>
            function togglePantsFields(sizeId) {
                var pantsFields = document.getElementById('pantsFields' + sizeId);
                var includePantsCheckbox = document.getElementById('include_pants' + sizeId);

                if (includePantsCheckbox.checked) {
                    pantsFields.style.display = 'block';
                } else {
                    pantsFields.style.display = 'none';
                }
            }
        </script>
    </div>

    <!-- إضافة بعض الأيقونات باستخدام Font Awesome -->
    @push('styles')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @endpush
@endsection
