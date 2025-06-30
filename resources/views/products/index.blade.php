i<div class="d-flex justify-content-end mb-2">
    <button id="save-products" class="btn btn-success font-bold" disabled>
        <span class="spinner-border spinner-border-lg d-none" id="save-spinner" role="status"></span>
        <span id="save-btn-text">Simpan Semua</span>
    </button>
</div>
<div class="table-responsive rounded">
    <table class="table table-bordered">
        <thead style="background-color: #40217a">
            <th class="text-white">No</th>
            <th class="text-white">Produk</th>
            <th class="text-white">Deskripsi Produk</th>
            <th class="text-white">Gambar Produk</th>
            <th class="text-white">Aksi</th>
            <th class="text-white"></th>
        </thead>
        <tbody id="product-table">
            @foreach ($categories as $category)
                @php
                    $productCount = $category->product->count();
                @endphp

                @if ($productCount > 0)
                    @foreach ($category->product as $index => $product)
                        <tr class="category-row" data-category-id="{{ $category->id }}"
                            data-product-id="{{ $product->id }}">
                            @if ($index === 0)
                                <td class="category-rowspan" rowspan="{{ $productCount + 1 }}"
                                    data-category-id="{{ $category->id }}"><input type="text" class="form-control"
                                        value="{{ $loop->iteration }}"></td>
                                <td class="category-rowspan" rowspan="{{ $productCount + 1 }}"
                                    data-category-id="{{ $category->id }}">
                                    <input type="text" class="form-control" value="{{ $category->name }}">
                                </td>
                            @endif
                            <td>
                                <input type="text" class="form-control product-description"
                                    name="description_{{ $product->id }}" id="description_{{ $product->id }}"
                                    value="{{ $product->description }}">
                            </td>
                            <td>
                                @if ($product->image)
                                    <img src="{{ route('product.get-product-image', ['path' => rawurlencode($product->image)]) }}"
                                        width="150" height="150">
                                @else
                                    <input type="file" class="form-control product-image" name="image_new[]"
                                        id="image_new_{{ $category->id }}">
                                @endif
                            </td>
                            <td>
                                <i class="fa-solid fa-x delete-sub-row" data-category-id="{{ $category->id }}"
                                    style="cursor: pointer;"></i>
                            </td>

                            {{-- + (Add New Row) Button --}}
                            @if ($index === 0)
                                <td class="category-rowspan" rowspan="{{ $productCount + 1 }}"
                                    data-category-id="{{ $category->id }}">
                                    <i class="fa-solid fa-x delete-category text-danger"
                                        data-category-id="{{ $category->id }}" style="cursor: pointer;"
                                        title="Hapus kategori"></i>

                                </td>
                            @endif
                        </tr>
                    @endforeach
                    <tr class="empty-product-row" data-category-id="{{ $category->id }}">
                        <td>
                            <input type="text" class="form-control product-description" name="description_new[]"
                                id="description_new_{{ $category->id }}">
                        </td>
                        <td>
                            <input type="file" class="form-control product-image" name="image_new[]"
                                id="image_new_{{ $category->id }}">
                        </td>
                        <td><i class="fa-solid fa-plus" style="cursor: pointer;"></i></td>
                    </tr>
                @else
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->name }}</td>
                        <td colspan="3"><em>No products found</em></td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>
</div>

<script>
    let deletedProductIds = [];
    let deletedCategoryIds = [];

    $(document).ready(function() {
        let productAdded = 1;

        // Use event delegation for dynamically added rows
        $(document).on('click', '.fa-plus', function() {
            let $this = $(this);
            let categoryId = $this.closest('tr').data('category-id');

            // Find specific rowspan cells for this category
            let rowspanCell = $(`.category-rowspan[data-category-id="${categoryId}"]`);
            let nameCell = $(`td[rowspan][data-category-id="${categoryId}"]`).not('.category-rowspan');

            // Update rowspan
            let currentRowSpan = parseInt(rowspanCell.attr('rowspan'), 10) || 1;
            rowspanCell.attr('rowspan', currentRowSpan + 1);
            nameCell.attr('rowspan', currentRowSpan + 1);

            if (productAdded < 5) {
                productAdded++;

                const newRow = `
            <tr class="product-row" data-category-id="${categoryId}">
                <td>
                    <input type="text" class="form-control product-description"
                        name="description_new[]" id="description_new_${categoryId}_${productAdded}">
                </td>
                <td>
                    <input type="file" class="form-control product-image"
                        name="image_new[]" id="image_new_${categoryId}_${productAdded}">
                </td>
                <td>
                    <i class="fa-solid fa-x remove-new-product-row" style="cursor: pointer;"></i>
                </td>
            </tr>`;

                $this.closest('tr').before(newRow);
            } else {
                alert("Penambahan Produk Tidak boleh lebih dari 5");
            }
        });

        $(document).on('click', '.remove-new-product-row', function() {
            let $row = $(this).closest('tr');
            let categoryId = $row.data('category-id');

            // Adjust rowspan
            let rowspanCell = $(`.category-rowspan[data-category-id="${categoryId}"]`);
            let nameCell = $(`td[rowspan][data-category-id="${categoryId}"]`).not('.category-rowspan');

            let currentRowSpan = parseInt(rowspanCell.attr('rowspan'), 10) || 1;
            rowspanCell.attr('rowspan', currentRowSpan - 1);
            nameCell.attr('rowspan', currentRowSpan - 1);

            $row.remove();
            productAdded--;
        });
    });

    // Function to check if any input has value
    function checkInputValues() {
        var hasValue = false;

        $('input[type="text"], input[type="file"]').each(function() {
            if ($(this).val().trim() !== '') {
                hasValue = true;
                return false;
            }
        });

        // Enable/disable button
        if (hasValue) {
            $('#save-products').prop('disabled', false);
        } else {
            $('#save-products').prop('disabled', true);
        }
    }

    // Initialize button as disabled
    $('#save-products').prop('disabled', true);

    // Listen for input changes
    $(document).on('input change', 'input[type="text"], input[type="file"]', function() {
        checkInputValues();
    });

    // Check when inputs are cleared
    $(document).on('keyup', 'input[type="text"]', function() {
        checkInputValues();
    });

    // Save All Data
    $('#save-products').on('click', function() {
        let formData = new FormData();
        let index = 0;

        $('#product-table tr').each(function() {
            let $row = $(this);

            // Only look for rows with inputs (new rows)
            let descriptionInput = $row.find('.product-description');
            let imageInput = $row.find('.product-image');

            if (descriptionInput.length && imageInput.length) {
                let description = descriptionInput.val();
                let imageFile = imageInput[0]?.files[0];
                let categoryId = $row.data('category-id');

                // Skip empty rows
                if (!description || !imageFile) return;

                formData.append(`products[${index}][category_id]`, categoryId);
                formData.append(`products[${index}][description]`, description);
                formData.append(`products[${index}][image]`, imageFile);
                index++;
            }
        });

        if (index === 0) {
            Swal.fire({
                icon: 'warning',
                title: 'Oops!',
                text: 'Tidak ada produk baru untuk disimpan.',
            });
            return;
        }

        axios.post('/products/batch-store', formData, {
            headers: {
                'Content-Type': 'multipart/form-data'
            }
        }).then(res => {
            console.table(res.data.results);

            Swal.fire({
                icon: 'success',
                title: 'Simpan Berhasil!',
                text: 'Data produk telah disimpan.',
                timer: 2000,
                showConfirmButton: false
            });

            setTimeout(() => {
                location.reload();
            }, 2100);
        }).catch(err => {
            console.error('Error saving:', err);
            Swal.fire({
                icon: 'error',
                title: 'Terjadi Kesalahan!',
                text: 'Gagal menyimpan produk. Silakan coba lagi.',
            });
        });
    });

    // Delete Products
    $(document).on('click', '.delete-sub-row', function() {
        const productId = $(this).data('product-id');
        const $row = $(this).closest('tr');

        Swal.fire({
            title: 'Hapus produk ini?',
            text: 'Tindakan ini tidak bisa dibatalkan!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $('#save-products').prop('disabled', false);
                if (productId) {
                    deletedProductIds.push(productId);
                }
                $row.fadeOut(300, function() {
                    $(this).remove();
                    checkInputValues();
                });
            }
        });
    });

    // Delete Categories
    $(document).on('click', '.delete-category', function() {
        const categoryId = $(this).data('category-id');

        Swal.fire({
            title: 'Hapus kategori ini?',
            text: 'Seluruh produk di kategori ini juga akan dihapus!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, hapus kategori!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $('#save-products').prop('disabled', false);

                deletedCategoryIds.push(categoryId);

                // Remove all category and related rows
                $(`tr[data-category-id="${categoryId}"]`).fadeOut(300, function() {
                    $(this).remove();
                    checkInputValues();
                });
            }
        });
    });

    // Deleted products
    deletedProductIds.forEach((id, i) => {
        formData.append(`deleted_products[${i}]`, id);
    });

    // Deleted categories
    deletedCategoryIds.forEach((id, i) => {
        formData.append(`deleted_categories[${i}]`, id);
    });
</script>
