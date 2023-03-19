<div>
    <div class="d-grid gap-2 mb-2">
        <button wire:click.prevent="back()" class="btn btn-danger" type="button">Back</button>
    </div>
    <div class="mb-2 mt-3 text-center border border-5">
        <strong>{{ $actionTaken }} a product</strong>
    </div>
    @if ($actionTaken === 'Store')
        <form method="POST">
            @csrf
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingInput" wire:model="productName" name="productName"
                    placeholder="name@example.com">
                <label for="floatingInput">Product Name</label>
                <span>
                    @error('productName')
                        <strong class="text-danger">{{ $message }}</strong>
                    @enderror
                </span>
            </div>


            <div class="form-floating mb-3">
                <select class="form-select" wire:model="productCategory" name="productCategory"
                    aria-label="Default select example">
                    <option selected>Select a category</option>
                    <option value="Rice">Rice</option>
                    <option value="Gari">Gari</option>
                    <option value="Maize">Maize</option>
                </select>
                <label for="floatingPassword">Product Category</label>
                <span>
                    @error('productCategory')
                        <strong class="text-danger">{{ $message }}</strong>
                    @enderror
                </span>
            </div>

            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingPassword" wire:model="productColor"
                    name="productColor" placeholder="Password">
                <label for="floatingPassword">Product Color</label>
                <span>
                    @error('productColor')
                        <strong class="text-danger">{{ $message }}</strong>
                    @enderror
                </span>
            </div>

            <div class="form-floating mb-3">
                <input type="number" class="form-control" id="floatingPassword" wire:model="productPrice"
                    name="productPrice" placeholder="Password">
                <label for="floatingPassword">Product Price</label>
                <span>
                    @error('productPrice')
                        <strong class="text-danger">{{ $message }}</strong>
                    @enderror
                </span>
            </div>

            <div class="form-floating">
                <div class="d-grid gap-2">
                    <button wire:click.prevent="store()" class="btn btn-outline-success" type="submit">Store
                        Product</button>
                </div>
            </div>
        </form>

    @endif

</div>
