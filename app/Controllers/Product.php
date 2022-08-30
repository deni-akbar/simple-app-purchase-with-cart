<?php namespace App\Controllers;
use App\Models\ProductModel;

class Product extends BaseController
{
	public function index()
	{
        $res=[];
        
        $productModel = new ProductModel();
        $product = $productModel->paginate(10);
        $pagination = $productModel->pager;
        return view('product/index', [
            'product' => $product,
            'pagination' => $pagination,
            'errors' => []
        ]);
    }
    
    
    public function create()
    {
        helper('form');
        $productModel = new ProductModel();
        
        if($this->request->getMethod() == 'post'){
            $validationRule = [
                'photo' => [
                    'label' => 'Image File',
                    'rules' => 'uploaded[photo]'
                        . '|is_image[photo]'
                        . '|mime_in[photo,image/jpg,image/png,]',
                ],
            ];
            if (! $this->validate($validationRule)) {
                $data = ['errors' => $this->validator->getErrors()];
    
                return view('product/create', $data);
            }
     
            $photo = $this->request->getFile('photo');
            $eks=$photo->guessExtension();
            $count=count($productModel->findAll())+1;;

            if($count<10){
                $zero='00';
            }else if($count<100){
                $zero='0';
            }else{
                $zero='';
            }

            if(str_word_count($this->request->getPost('name'))<=1){
                $getFirst=substr($this->request->getPost('name'),0,2);
                $fileName = strtoupper($getFirst.$zero.$count.'.'.$eks);
            }else{
                $ex=explode(" ",$this->request->getPost('name'));
                $getFirst=substr($ex[0],0,1);
                $getSecond=substr($ex[1],0,1);
                $fileName = strtoupper($getFirst.$getSecond.$zero.$count.'.'.$eks);
            }
            

            $photo->move('uploads/photo/', $fileName);

            $product = [
                'name' => $this->request->getPost('name'),
                'stock' => $this->request->getPost('stock'),
                'price' => $this->request->getPost('price'),
                'code' => strtoupper($getFirst.$zero.$count),
                'photo' => $fileName,

            ];
            
            if($productModel->insert($product)){
                session()->setFlashdata('success', 'Data berhasil disimpan');
                return redirect()->to('/product/index');
            }

        }

        return view('product/create');
    }


}
