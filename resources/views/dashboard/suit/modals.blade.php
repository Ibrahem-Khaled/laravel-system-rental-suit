{{-- suits/partials/modals.blade.php --}}

{{-- مودال تعديل البدلة --}}
<div class="modal fade" id="editSuitModal{{ $suit->id }}" tabindex="-1"
    aria-labelledby="editSuitModalLabel{{ $suit->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('suits.update', $suit->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="editSuitModalLabel{{ $suit->id }}">تعديل البدلة</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{-- حقول البدلة --}}
                    <div class="form-group">
                        <label for="name">الاسم</label>
                        <input type="text" name="name" class="form-control" value="{{ $suit->name }}" required>
                    </div>
                    <div class="form-group">
                        <label for="description">الوصف</label>
                        <textarea name="description" class="form-control">{{ $suit->description }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="price">السعر</label>
                        <input type="number" name="price" class="form-control" value="{{ $suit->price }}" required>
                    </div>
                    <div class="form-group">
                        <label for="color">اللون</label>
                        <input type="text" name="color" class="form-control" value="{{ $suit->color }}">
                    </div>
                    <div class="form-group">
                        <label for="gender">النوع</label>
                        <select name="gender" class="form-control">
                            <option value="men" {{ $suit->gender == 'men' ? 'selected' : '' }}>رجال</option>
                            <option value="children" {{ $suit->gender == 'children' ? 'selected' : '' }}>أطفال</option>
                            <option value="mixed" {{ $suit->gender == 'mixed' ? 'selected' : '' }}>مختلط</option>
                            <option value="grooms_suit" {{ $suit->gender == 'grooms_suit' ? 'selected' : '' }}>سواريه
                                (بدلة عريس)</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="product_type">نوع المنتج</label>
                        <select name="product_type" class="form-control">
                            <option value="shirts" {{ $suit->product_type == 'shirts' ? 'selected' : '' }}>قمصان
                            </option>
                            <option value="pants" {{ $suit->product_type == 'pants' ? 'selected' : '' }}>سراويل
                            </option>
                            <option value="suits" {{ $suit->product_type == 'suits' ? 'selected' : '' }}>بدلات
                            </option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="is_active">نشط</label>
                        <select name="is_active" class="form-control">
                            <option value="1" {{ $suit->is_active ? 'selected' : '' }}>نعم</option>
                            <option value="0" {{ !$suit->is_active ? 'selected' : '' }}>لا</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="image">تغيير صورة البدلة</label>
                        <input type="file" name="image" class="form-control">
                        @if ($suit->image)
                            <img src="{{ asset('storage/' . $suit->image) }}" alt="صورة البدلة" class="img-fluid mt-2"
                                style="max-width: 100px;">
                        @endif
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                    <button type="submit" class="btn btn-primary">تحديث البدلة</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- مودال تأكيد الحذف --}}
<div class="modal fade" id="deleteSuitModal{{ $suit->id }}" tabindex="-1"
    aria-labelledby="deleteSuitModalLabel{{ $suit->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteSuitModalLabel{{ $suit->id }}">تأكيد الحذف</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                هل أنت متأكد أنك تريد حذف البدلة <strong>{{ $suit->name }}</strong>؟
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                <form action="{{ route('suits.destroy', $suit->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">حذف</button>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- مودال إضافة مقاسات --}}
<div class="modal fade" id="addSizeModal{{ $suit->id }}" tabindex="-1"
    aria-labelledby="addSizeModalLabel{{ $suit->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('suits.addSize', $suit->id) }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addSizeModalLabel{{ $suit->id }}">إضافة مقاسات لـ
                        {{ $suit->name }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="sizes">المقاسات (مفصولة بفاصلة)</label>
                        <div id="sizeInputs{{ $suit->id }}">
                            <div class="input-group mb-2">
                                <input type="text" name="sizes[]" class="form-control"
                                    placeholder="مثال: S, M, L, XL">
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-success"
                                        onclick="addSizeInput({{ $suit->id }})">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                    <button type="submit" class="btn btn-primary">إضافة المقاسات</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function addSizeInput(suitId) {
        var inputGroup = `
            <div class="input-group mb-2">
                <input type="text" name="sizes[]" class="form-control" placeholder="مثال: S, M, L, XL">
                <div class="input-group-append">
                    <button type="button" class="btn btn-danger" onclick="removeSizeInput(this)">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
        `;
        document.getElementById('sizeInputs' + suitId).insertAdjacentHTML('beforeend', inputGroup);
    }

    function removeSizeInput(button) {
        button.closest('.input-group').remove();
    }
</script>
