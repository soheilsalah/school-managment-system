<div class="form-group">
@if($bookCategories->count() > 0)
    <label for="book_category_id">اختر فئة</label>
    <select name="book_category_id" class="form-control" id="book_category_id">
    @foreach($bookCategories as $bookCategory)
        <option value="{{ $bookCategory->id }}">{{ $bookCategory->name }}</option>
    @endforeach
    </select>
@else
    <div class="form-group">
        <label for="book_category_name">اسم فئة</label>
        <input type="text" class="form-control" name="book_category_name" id="book_category_name" required>
    </div>
@endif
</div>