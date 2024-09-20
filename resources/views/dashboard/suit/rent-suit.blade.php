@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <h2 class="my-4 text-center">إدارة البدلات</h2>
        <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#addSuitModal">إضافة بدلة جديدة</button>

        <!-- إضافة التبويبات -->
        <ul class="nav nav-tabs mb-4" id="suitsTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="men-tab" data-toggle="tab" href="#men" role="tab" aria-controls="men"
                    aria-selected="true">البدل الرجالية</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="children-tab" data-toggle="tab" href="#children" role="tab"
                    aria-controls="children" aria-selected="false">البدل الأطفال</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="sarieh-tab" data-toggle="tab" href="#sarieh" role="tab" aria-controls="sarieh"
                    aria-selected="false">سواريه</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="mixed-tab" data-toggle="tab" href="#mixed" role="tab" aria-controls="mixed"
                    aria-selected="false">ميكس</a>
            </li>
        </ul>

        <!-- محتويات التبويبات -->
        <div class="tab-content" id="suitsTabContent">
            <!-- تبويب البدلات الرجالية -->
            <div class="tab-pane fade show active" id="men" role="tabpanel" aria-labelledby="men-tab">
                <div class="row">
                    @foreach ($suits->where('gender', 'men') as $suit)
                        <div class="col-md-4">
                            <div class="card mb-4 shadow-sm">
                                <img src="{{ asset('storage/' . $suit->image) }}" class="card-img-top" alt="صورة البدلة"
                                    style="height: 250px; object-fit: cover;">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $suit->name }}</h5>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <button class="btn btn-info btn-sm" data-toggle="modal"
                                                data-target="#editSuitModal{{ $suit->id }}">تعديل</button>
                                            <button class="btn btn-danger btn-sm" data-toggle="modal"
                                                data-target="#deleteSuitModal{{ $suit->id }}">حذف</button>
                                            <button class="btn btn-secondary btn-sm" data-toggle="modal"
                                                data-target="#addSizeModal{{ $suit->id }}">إضافة مقاسات</button>
                                        </div>
                                        <a href="{{ route('suits.show', $suit->id) }}" class="btn btn-primary btn-sm">عرض
                                            التفاصيل</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- مودالات التعديل والحذف وإضافة المقاسات --}}
                        @include('dashboard.suit.modals', ['suit' => $suit])
                    @endforeach
                </div>
            </div>

            <!-- تبويب البدلات الأطفال -->
            <div class="tab-pane fade" id="children" role="tabpanel" aria-labelledby="children-tab">
                <div class="row">
                    @foreach ($suits->where('gender', 'children') as $suit)
                        <div class="col-md-4">
                            <div class="card mb-4 shadow-sm">
                                <img src="{{ asset('storage/' . $suit->image) }}" class="card-img-top" alt="صورة البدلة"
                                    style="height: 250px; object-fit: cover;">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $suit->name }}</h5>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <button class="btn btn-info btn-sm" data-toggle="modal"
                                                data-target="#editSuitModal{{ $suit->id }}">تعديل</button>
                                            <button class="btn btn-danger btn-sm" data-toggle="modal"
                                                data-target="#deleteSuitModal{{ $suit->id }}">حذف</button>
                                            <button class="btn btn-secondary btn-sm" data-toggle="modal"
                                                data-target="#addSizeModal{{ $suit->id }}">إضافة مقاسات</button>
                                        </div>
                                        <a href="{{ route('suits.show', $suit->id) }}" class="btn btn-primary btn-sm">عرض
                                            التفاصيل</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- مودالات التعديل والحذف وإضافة المقاسات --}}
                        @include('dashboard.suit.modals', ['suit' => $suit])
                    @endforeach
                </div>
            </div>

            <!-- تبويب السواريه -->
            <div class="tab-pane fade" id="sarieh" role="tabpanel" aria-labelledby="sarieh-tab">
                <div class="row">
                    @foreach ($suits->where('product_type', 'sarieh') as $suit)
                        <div class="col-md-4">
                            <div class="card mb-4 shadow-sm">
                                <img src="{{ asset('storage/' . $suit->image) }}" class="card-img-top"
                                    alt="صورة السواريه" style="height: 250px; object-fit: cover;">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $suit->name }}</h5>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <button class="btn btn-info btn-sm" data-toggle="modal"
                                                data-target="#editSuitModal{{ $suit->id }}">تعديل</button>
                                            <button class="btn btn-danger btn-sm" data-toggle="modal"
                                                data-target="#deleteSuitModal{{ $suit->id }}">حذف</button>
                                            <button class="btn btn-secondary btn-sm" data-toggle="modal"
                                                data-target="#addSizeModal{{ $suit->id }}">إضافة مقاسات</button>
                                        </div>
                                        <a href="{{ route('suits.show', $suit->id) }}" class="btn btn-primary btn-sm">عرض
                                            التفاصيل</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- مودالات التعديل والحذف وإضافة المقاسات --}}
                        @include('dashboard.suit.modals', ['suit' => $suit])
                    @endforeach
                </div>
            </div>

            <!-- تبويب الميكس -->
            <div class="tab-pane fade" id="mixed" role="tabpanel" aria-labelledby="mixed-tab">
                <div class="row">
                    @foreach ($suits->where('gender', 'mixed') as $suit)
                        <div class="col-md-4">
                            <div class="card mb-4 shadow-sm">
                                <img src="{{ asset('storage/' . $suit->image) }}" class="card-img-top" alt="صورة البدلة"
                                    style="height: 250px; object-fit: cover;">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $suit->name }}</h5>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <button class="btn btn-info btn-sm" data-toggle="modal"
                                                data-target="#editSuitModal{{ $suit->id }}">تعديل</button>
                                            <button class="btn btn-danger btn-sm" data-toggle="modal"
                                                data-target="#deleteSuitModal{{ $suit->id }}">حذف</button>
                                            <button class="btn btn-secondary btn-sm" data-toggle="modal"
                                                data-target="#addSizeModal{{ $suit->id }}">إضافة مقاسات</button>
                                        </div>
                                        <a href="{{ route('suits.show', $suit->id) }}" class="btn btn-primary btn-sm">عرض
                                            التفاصيل</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- مودالات التعديل والحذف وإضافة المقاسات --}}
                        @include('dashboard.suit.modals', ['suit' => $suit])
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    {{-- مودال إضافة بدلة جديدة --}}
    <div class="modal fade" id="addSuitModal" tabindex="-1" aria-labelledby="addSuitModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('suits.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="addSuitModalLabel">إضافة بدلة جديدة</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        {{-- حقول البدلة --}}
                        <div class="form-group">
                            <label for="name">الاسم</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="description">الوصف</label>
                            <textarea name="description" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="price">السعر</label>
                            <input type="number" name="price" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="color">اللون</label>
                            <input type="text" name="color" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="gender">النوع</label>
                            <select name="gender" class="form-control">
                                <option value="men">رجال</option>
                                <option value="children">أطفال</option>
                                <option value="mixed">مختلط</option>
                                <option value="grooms_suit">سواريه (بدلة عريس)</option> <!-- إضافة سواريه -->
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="product_type">نوع المنتج</label>
                            <select name="product_type" class="form-control">
                                <option value="shirts">قمصان</option>
                                <option value="pants">سراويل</option>
                                <option value="suits">بدلات</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="is_active">نشط</label>
                            <select name="is_active" class="form-control">
                                <option value="1">نعم</option>
                                <option value="0">لا</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="image">صورة البدلة</label>
                            <input type="file" name="image" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                        <button type="submit" class="btn btn-primary">حفظ البدلة</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
