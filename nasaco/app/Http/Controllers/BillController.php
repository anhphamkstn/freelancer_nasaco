<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\BillService as BillService;
use App\Helpers\Response;
use Illuminate\Support\Facades\Input;

class BillController extends Controller
{
    protected  $billService;
    //
    public function __construct(BillService $billService)
    {
        $this->billService = $billService;
    }

    public function store(Request $request)
    {
        $newBills = $request->get('bills');
        $data = [];
        $errorMsg = [];
        $resultInsertBill = null;
        if (empty($newBills)) {
            return Response::response($data, 400, 'Data is empty.');
        }
        foreach ($newBills as $newBill) {
            $validator = $this->billService->validateInfo($newBill);
            if ($validator->fails()) {
                $errors = $validator->errors()->all();
                $errorMsg[] = array_merge($errorMsg, $errors);
            }
            $resultInsertBill = $this->billService->insert($newBill);
            if(!empty($resultInsertBill)){
                $data[] = $resultInsertBill;
            }
        }
        if (!empty($errorMsg)) {
            return Response::responseValidateFailed(implode(' | ', $errorMsg), $data);
        }
        return Response::response($data);
    }

    public function provinceIndex(){
        $provinces = array();
        $provinces = $this->billService->getListProvince();
        if(!empty($provinces)){
            return Response::response($provinces);
        }
        else{
            return Response::responseNotFound();
        }
    }

    public function categoryProductIndex(){
        $categories = array();
        $categories = $this->billService->getListCategoryProduct();
        if(!empty($categories)){
            return Response::response($categories);
        }
        else{
            return Response::responseNotFound();
        }
    }

    public function productIndex(){
        $products = array();
        $products = $this->billService->getListProduct();
        if(!empty($products)){
            return Response::response($products);
        }
        else{
            return Response::responseNotFound();
        }
    }

    public function reportCategoryByProduct(){
        $billFilter = Input::get();
        $data = $this->billService->getDataReportByCategoryProduct($billFilter);
        if(empty($data)){
                return Response::responseNotFound();
        }
        else{
            return Response::response($data);
        }
    }
}
