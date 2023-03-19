<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Products;
use App\Http\Requests\StoreProductsRequest;

class LivewireHome extends Component
{
    public $products, $action = false, $actionTaken;

    public $productName, $productCategory, $productColor, $productPrice;


    protected function rules(): array
    {
        //*****referencing the form validate */
        return (new StoreProductsRequest())->rules();
    }

    public function render()
    {
        if ($this->action === false) {
            $this->products = Products::select('id','productName','productColor','productCategory','productPrice')->orderBy('id','desc')->get();
        }

        return view('livewire.livewire-home');
    }

    public function back(){
        $this->action = false;
        $this->actionTaken = '';
    }

    public function action(){
        $this->action = true;
        $this->actionTaken = 'Store';
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
