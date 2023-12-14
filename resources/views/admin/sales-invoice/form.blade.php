<div class="box box-info padding-1">
    <div class="box-body">
        <div class="form-group required">
            {{ Form::label('Ngày nhập') }}
            {{ Form::datetimelocal('saledate', $salesInvoice->saledate, ['class' => 'form-control' . ($errors->has('saledate') ? ' is-invalid' : '')]) }}
            {!! $errors->first('saledate', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group required">
            {{ Form::label('Khách hàng') }}
            <select name="customerid" class="form-control">
                <option value="">-- Chọn khách hàng --</option>
                @foreach($customers as $customer)
                    <option value="{{ $customer->customerid }}"
                        {{ $customer->customerid == $salesInvoice->customerid ? 'selected' : '' }}>
                        {{ $customer->customername }}
                    </option>
                @endforeach
            </select>
        </div>

        <input type="hidden" name="employeeid" value="{{ session('admin_id') }}">

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
            <label for="">Chi tiết hoá đơn</label>
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
                                <div class="form-group">
                                    <label for="">Giá tiền:</label>
                                    <input type="number" class="form-control" name="Price[]">
                                </div>
                            </div>
                        </div>
                    @else
                        @foreach($salesInvoice->salesinvoicedetail as $invoicedetail)
                            <div class="card card-info">
                                <div class="card-header">
                                    <div class="float-left">
                                        <span class="card-title">{{ $invoicedetail->product?->productname }}</span>
                                        <button type="button" class="btn btn-xs btn-danger ml-1"
                                                onclick="deleteProductField()">Xoá
                                        </button>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="">Mã sản phẩm:</label>
                                        <input type="text" class="form-control" name="ProductID[]" onchange="setTitle()"
                                               value="{{ $invoicedetail->productid }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Số lượng:</label>
                                        <input type="number" class="form-control" name="Quantity[]"
                                               value="{{ $invoicedetail->quantity }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Giá tiền:</label>
                                        <input type="number" class="form-control" name="Price[]"
                                               value="{{ $invoicedetail->price }}">
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
            <button type="button" class="btn btn-outline-primary btn-sm mb-5" onclick="addProductField()">Thêm</button>
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
                    <div class="form-group">
                        <label for="">Giá tiền:</label>
                        <input type="number" class="form-control" name="Price[]">
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


        document.getElementById('submitBtn').addEventListener('click', function (event) {
            event.preventDefault();

            if (validateForm()) {
                document.querySelector('form').submit();
            }
        });

        function hasDuplicates(array) {
            return new Set(array).size !== array.length;
        }

        function validateForm() {
            var saledate = document.getElementsByName('saledate')[0];
            var customerid = document.getElementsByName('customerid')[0];
            var productIds = document.getElementsByName('ProductID[]');
            let listId = [];
            productIds.forEach(function (id) {
                listId.push(id.value);
            })

            var quantityReceived = document.getElementsByName('Quantity[]');
            var price = document.getElementsByName('Price[]');

            if (saledate.value === '') {
                alert('Vui lòng chọn Ngày nhập.');
                saledate.focus();
                return false;
            }

            if (customerid.value === '') {
                alert('Vui lòng chọn khách hàng.');
                customerid.focus();
                return false;
            }

            if (hasDuplicates(listId)) {
                alert("Mã sản phẩm không được trùng nhau!");
                return false;
            }


            for (var i = 0; i < quantityReceived.length; i++) {
                if (quantityReceived[i].value === '' || price[i].value === '') {
                    alert('Vui lòng điền đầy đủ thông tin cho tất cả các sản phẩm.');
                    return false;
                }
            }

            if (quantityReceived.length === 0) {
                alert('Vui lòng thêm sản phẩm vào hoá đơn.');
                return false;
            }

            return true;
        }

    </script>

@endsection
