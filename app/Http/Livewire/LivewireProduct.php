<?php

namespace App\Http\Livewire;

use App\Http\Requests\StoreProductsRequest;
use Livewire\Component;
use App\Models\Products;

class LivewireProduct extends Component
{
    public $action, $products, $actionTaken;
    public $pid ,$productName, $productCategory, $productColor, $productPrice;

    public function mount($action, $actionTaken)
    {
        $this->action = $action;
        $this->actionTaken = $actionTaken;
    }

 //*****referencing the form validate */
    protected function rules(): array
    {
        //*****referencing the form validate */
        return (new StoreProductsRequest())->rules();
    }
    public function render()
    {
        if ($this->action === true) {
            return view('livewire.livewire-product');
        }

        //*****return to the home page */
        $this->products = Products::select('id','productName','productColor','productCategory','productPrice')->orderBy('id','desc')->get();
        return view('livewire.livewire-home',['products' => $this->products,'action' => $this->action]);
    }

    public function back(){
        $this->action = false;
        $this->actionTaken = '';
    }

    public function action(){
        $this->action = true;
        $this->actionTaken = 'Store';
    }

    public function clearInput(){
        $this->id = '';
        $this->productName = '';
        $this->productColor = '';
        $this->productCategory = '';
        $this->productPrice = '';
    }

    public function store(){
        //*****using the form validate */
        $this->validate();
        try {
            //*****store all requests in the data variable */
            $data = [
                "productName" => $this->productName,
                "productColor" => $this->productColor,
                "productCategory" => $this->productCategory,
                "productPrice" => $this->productPrice
            ];

            //******store in the data in the mySQLdb */
            Products::create($data);

            $this->clearInput(); //*****clearing the input box */
            $this->back();

            session()->flash('success','Product stored');
        } catch (\Throwable $th) {

            session()->flash('error',$th->getMessage());
        }
    }

    public function actionView($productID){
        $this->actionTaken = 'View';

        $product = Products::find($productID);

        $this->productName = $product->productName;
        $this->productColor = $product->productColor;
        $this->productCategory = $product->productCategory;
        $this->productPrice = $product->productPrice;
    }

    public function actionEdit($productID){
        $this->actionTaken = 'Edit';

        $product = Products::find($productID);

        $this->pid = $productID;
        $this->productName = $product->productName;
        $this->productColor = $product->productColor;
        $this->productCategory = $product->productCategory;
        $this->productPrice = $product->productPrice;
    }

    public function update(){
        $this->validate();
        try {
            //******find the product data with the new request data id*/
            $findProduct = Products::find($this->pid);

            //******update the find product */
            $findProduct->productName = $this->productName;
            $findProduct->productCategory = $this->productCategory;
            $findProduct->productColor = $this->productColor;
            $findProduct->productPrice = $this->productPrice;

            if($findProduct->update()){
                $this->clearInput(); //*****clearing the input box */
                $this->back();

                session()->flash('success','Product updated');
            }
            else{
                session()->flash('error',"ooooops");
            }


        } catch (\Throwable $th) {
            session()->flash('error',$th->getMessage());
        }
    }

    public function delete($productID){
        try {
            //******find the product data with the new request data id*/
            $findProduct = Products::find($productID);

            $findProduct->delete();
            session()->flash('success','Product deleted');
        } catch (\Throwable $th) {
            session()->flash('error',$th->getMessage());
        }
    }
}
