<div class="box box-info padding-1">
    <div class="box-body">
        <div class="form-group required">
            {{ Form::label('Tên bộ sản phẩm') }}
            {{ Form::text('setname', $productset->setname, ['class' => 'form-control' . ($errors->has('setname') ? ' is-invalid' : '')]) }}
            {!! $errors->first('setname', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Ảnh đại diện') }}
            <ul class="nav nav-tabs" id="myTabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="tab1-tab" data-toggle="tab" href="#tab1" role="tab"
                       aria-controls="tab1" aria-selected="true">Nhập URL ảnh</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="tab2-tab" data-toggle="tab" href="#tab2" role="tab" aria-controls="tab2"
                       aria-selected="false">Tải lên tệp</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabsContent">
                <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="tab1-tab">
                    <div class="form-group mt-4">
                        <input type="text" class="form-control" name="imageurl" placeholder="https://example.com/image.jpg" value="{{ $productset->image }}">
                    </div>
                </div>
                <div class="tab-pane fade" id="tab2" role="tabpanel" aria-labelledby="tab2-tab">
                    <div class="form-group mt-4">
                        <input type="file" class="form-control-file" name="image" accept="image/*">
                    </div>
                </div>
            </div>
            {!! $errors->first('image', '<div class="invalid-feedback">:message</div>') !!}
        </div>

        <!-- Add Sales Order Detail fields -->
        <div class="form-group">
            <label for="productSearch">Tìm Mã Sản Phẩm</label>
            <input type="text" class="form-control" id="productSearch" placeholder="Nhập tên sản phẩm">
            <select id="productSearchResults" class="form-control" style="margin-top: 10px;">
                <option value="">Kết quả sẽ hiển thị ở đây.</option>
            </select>
        </div>

        <!-- Selected Product Information -->
        <div id="selectedProductInfo"></div>

        <div class="form-group required">
            <label for="">Chi tiết bộ</label>
            <div class="card">
                <div class="card-body" id="additionalProducts">
                    @if($method != 'PATCH')
                        <div class="card card-info">
                            <div class="card-header">
                                <div class="float-left">
                                    <span class="card-title"></span>
                                    <button type="button" class="btn btn-xs btn-danger ml-1"
                                            onclick="deleteProductField()">Xoá
                                    </button>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="form-group">
                                    <label for="">Mã sản phẩm:</label>
                                    <input type="text" class="form-control" name="ProductID[]" onchange="setTitle()">
                                </div>
                                <div class="form-group">
                                    <label for="">Số lượng:</label>
                                    <input type="number" class="form-control" name="Quantity[]">
                                </div>
                            </div>
                        </div>
                    @else
                        @foreach($productset->productsetdetail as $setdetail)
                            <div class="card card-info">
                                <div class="card-header">
                                    <div class="float-left">
                                        <span class="card-title">{{ $setdetail->product?->productname }}</span>
                                        <button type="button" class="btn btn-xs btn-danger ml-1"
                                                onclick="deleteProductField()">Xoá
                                        </button>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="">Mã sản phẩm:</label>
                                        <input type="text" class="form-control" name="ProductID[]" onchange="setTitle()"
                                               value="{{ $setdetail->productid }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Số lượng:</label>
                                        <input type="number" class="form-control" name="Quantity[]" value="{{ $setdetail->quantity }}">
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
            <button type="button" class="btn btn-outline-primary btn-sm mb-5" onclick="addProductField()">Thêm</button>
        </div>

        <div class="form-group">
            {{ Form::label('Mô tả, ghi chú') }}
            {{ Form::textarea('note', $productset->note, ['class' => 'form-control' . ($errors->has('note') ? ' is-invalid' : '')]) }}
            {!! $errors->first('note', '<div class="invalid-feedback">:message</div>') !!}
        </div>
    </div>

    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Xác nhận') }}</button>
    </div>
</div>

@section('formPurchaseOrderScripts')
    <script>
        // Hàm debounce để trì hoãn gọi hàm search
        function debounce(func, delay) {
            let timeoutId;
            return function (...args) {
                clearTimeout(timeoutId);
                timeoutId = setTimeout(() => {
                    func.apply(this, args);
                }, delay);
            };
        }

        // Hàm tìm kiếm với debounce
        const debouncedSearch = debounce(function (searchTerm) {
            if (searchTerm.trim() !== '') {
                // Make an AJAX request to the product search API
                fetch('/api/product/search/' + searchTerm)
                    .then(response => response.json())
                    .then(data => displaySearchResults(data));
            } else {
                // Clear the search results
                document.getElementById('productSearchResults').innerHTML = '<option value="">Kết quả sẽ hiển thị ở đây</option>';
            }
        }, 1000); // 3000ms debounce time

        // Event listener với debounce
        document.getElementById('productSearch').addEventListener('input', function () {
            var searchTerm = this.value;
            debouncedSearch(searchTerm);
        });

        // Function to display search results
        function displaySearchResults(results) {
            var resultsContainer = document.getElementById('productSearchResults');
            resultsContainer.innerHTML = '';

            if (results.length > 0) {
                results.forEach(product => {
                    var resultOption = document.createElement('option');
                    resultOption.value = product.productid;
                    resultOption.textContent = product.productname;
                    resultsContainer.appendChild(resultOption);
                });
                displaySelectedProduct(results[0]);
            } else {
                resultsContainer.innerHTML = '<option value="">Không tìm thấy cuốn sản phẩm nào.</option>';
                document.getElementById('selectedProductInfo').innerHTML = '';
            }
        }

        // Function to select a product and display its information
        document.getElementById('productSearchResults').addEventListener('change', function () {
            var selectedProductId = this.value;
            if (selectedProductId !== '') {
                // Make an AJAX request to get the details of the selected product
                fetch('/api/product/' + selectedProductId)
                    .then(response => response.json())
                    .then(product => displaySelectedProduct(product));
            } else {
                document.getElementById('selectedProductInfo').innerHTML = '';
            }
        });

        // Function to display selected product information
        function displaySelectedProduct(product) {
            var selectedProductInfo = document.getElementById('selectedProductInfo');
            selectedProductInfo.innerHTML = `<p><mark>sản phẩm đang chọn: ${product.productname} - Mã sản phẩm: <strong>${product.productid}</strong></mark>`;
        }

        // Function to add additional product fields dynamically
        function addProductField() {
            var additionalProducts = document.getElementById('additionalProducts');
            var newProductField = document.createElement('div');
            newProductField.innerHTML = `
            <div class="card card-info">
                <div class="card-header">
                    <div class="float-left">
                        <span class="card-title"></span>
                        <button type="button" class="btn btn-xs btn-danger ml-1" onclick="deleteProductField()">Xoá</button>
                    </div>
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <label for="">Mã sản phẩm:</label>
                        <input type="text" class="form-control" name="ProductID[]" onchange="setTitle()">
                    </div>
                    <div class="form-group">
                        <label for="">Số lượng:</label>
                        <input type="number" class="form-control" name="Quantity[]">
                    </div>
                </div>
            </div>`;
            additionalProducts.appendChild(newProductField);
        }

        function deleteProductField() {
            let card = event.currentTarget.parentNode.parentNode.parentNode;
            card.remove();
        }


        function setTitle() {
            let cardTitle = event.currentTarget.parentNode.parentNode.parentNode.querySelector('.card-title');
            let productID = event.currentTarget.value;
            if (productID !== '') {
                fetch('/api/product/' + productID)
                    .then(response => response.json())
                    .then(product => {
                        cardTitle.innerHTML = product.productname;
                    });
            }
        }
    </script>

@endsection
