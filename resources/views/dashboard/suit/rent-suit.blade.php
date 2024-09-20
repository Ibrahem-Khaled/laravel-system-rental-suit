@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <h2 class="my-4 text-center">إدارة البدلات</h2>
        <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#addSuitModal">إضافة بدلة جديدة</button>

        <!-- عرض الأخطاء العامة -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

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
                            <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="description">الوصف</label>
                            <textarea name="description" class="form-control">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="price">السعر</label>
                            <input type="number" name="price" class="form-control" value="{{ old('price') }}" required>
                            @error('price')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="color">اللون</label>
                            <input type="text" name="color" class="form-control" value="{{ old('color') }}">
                            @error('color')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="gender">النوع</label>
                            <select name="gender" class="form-control">
                                <option value="men" {{ old('gender') == 'men' ? 'selected' : '' }}>رجال</option>
                                <option value="children" {{ old('gender') == 'children' ? 'selected' : '' }}>أطفال</option>
                                <option value="mixed" {{ old('gender') == 'mixed' ? 'selected' : '' }}>مختلط</option>
                                <option value="grooms_suit" {{ old('gender') == 'grooms_suit' ? 'selected' : '' }}>سواريه (بدلة عريس)</option>
                            </select>
                            @error('gender')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="product_type">نوع المنتج</label>
                            <select name="product_type" class="form-control">
                                <option value="shirts" {{ old('product_type') == 'shirts' ? 'selected' : '' }}>قمصان</option>
                                <option value="pants" {{ old('product_type') == 'pants' ? 'selected' : '' }}>سراويل</option>
                                <option value="suits" {{ old('product_type') == 'suits' ? 'selected' : '' }}>بدلات</option>
                            </select>
                            @error('product_type')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="is_active">نشط</label>
                            <select name="is_active" class="form-control">
                                <option value="1" {{ old('is_active') == '1' ? 'selected' : '' }}>نعم</option>
                                <option value="0" {{ old('is_active') == '0' ? 'selected' : '' }}>لا</option>
                            </select>
                            @error('is_active')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="image">صورة البدلة</label>
                            <input type="file" name="image" class="form-control">
                            @error('image')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
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
