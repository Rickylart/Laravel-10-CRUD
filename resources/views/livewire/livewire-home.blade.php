<div>
{{-- calling the alert component --}}
<x-alert-component />
    @if ($action)
        {{-- <livewire:livewire-product/> --}}
        @livewire('livewire-product', ['action' => $action, 'products' => $products, 'actionTaken' => $actionTaken])
    @else
        @if ($actionTaken === 'View')
            <div class="d-grid gap-2 mb-2">
                <button wire:click.prevent="back()" class="btn btn-danger" type="button">Back</button>
            </div>
            <div class="mb-2 mt-3 text-center border border-5">
                <strong>{{ $actionTaken }} a product</strong>
            </div>
            <form method="POST">
                @csrf
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="floatingInput" wire:model="productName"
                        name="productName" disabled placeholder="name@example.com">
                    <label for="floatingInput">Product Name</label>
                    <span>
                        @error('productName')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </span>
                </div>


                <div class="form-floating mb-3">
                    <select class="form-select" wire:model="productCategory" name="productCategory" disabled
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
                    <input type="text" class="form-control" id="floatingPassword" wire:model="productColor" disabled
                        name="productColor" placeholder="Password">
                    <label for="floatingPassword">Product Color</label>
                    <span>
                        @error('productColor')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </span>
                </div>

                <div class="form-floating mb-3">
                    <input type="number" class="form-control" id="floatingPassword" wire:model="productPrice" disabled
                        name="productPrice" placeholder="Password">
                    <label for="floatingPassword">Product Price</label>
                    <span>
                        @error('productPrice')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </span>
                </div>
            </form>
        @elseif ($actionTaken === 'Edit')
            <div class="d-grid gap-2 mb-2">
                <button wire:click.prevent="back()" class="btn btn-danger" type="button">Back</button>
            </div>
            <div class="mb-2 mt-3 text-center border border-5">
                <strong>{{ $actionTaken }} a product</strong>
            </div>
            <form method="POST">
            @csrf
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingInput" wire:model="productName"
                    name="productName"  placeholder="name@example.com">
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
                    <button wire:click.prevent="update()" class="btn btn-outline-warning" type="submit">Update
                        Product</button>
                </div>
            </div>
        </form>
        @else
            <div class="table-responsive table-responsive-md table-responsive-sm">
                <div class="d-grid gap-2 mb-2 d-md-block">
                    <button href="javascript:void()" wire:click.prevent="action()"
                        class="btn btn-primary btn-block-full" type="button">Add
                        product</button>
                </div>
                <table class="table table-striped table-hover table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Product Name</th>
                            <th scope="col">Product Category</th>
                            <th scope="col">Product Color</th>
                            <th scope="col">Product Price</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($products as $product)
                            <tr>
                                <th scope="row">{{ $product->productName }}</th>
                                <td>{{ $product->productCategory }}</td>
                                <td>{{ $product->productColor }}</td>
                                <td>{{ $product->productPrice }}</td>
                                <td>
                                    <div class="btn btn-sm" role="group" aria-label="Basic example">
                                        <div class="row">
                                            <div class="col-lg-4 col-md-4">
                                                <a href="javascript:void()" type="button"
                                                    wire:click.prevent="actionView({{ $product->id }})"
                                                    class="btn btn-sm btn-outline-primary">View</a>
                                            </div>

                                            <div class="col-lg-4 col-md-4">
                                                <a href="javascript:void()"
                                                    wire:click.prevent="actionEdit({{ $product->id }})" type="button"
                                                    class="btn btn-sm btn-outline-warning">Edit</a>
                                            </div>

                                            <div class="col-lg-4 col-md-4">
                                                 <button type="submit" wire:click.prevent="delete({{ $product->id }})" class="btn btn-sm btn-outline-danger">Delete</button>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan='5'><strong class="text-danger">{{ 'No data found' }}</strong></td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>
        @endif

    @endif
</div>
