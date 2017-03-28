<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\BillService as BillService;
use App\Helpers\Response;
use Illuminate\Support\Facades\Input;

class BillController extends Controller
{
    protected  $billService;

    /**
     * BillController constructor.
     * @param BillService $billService
     * Ham constructor
     */
    public function __construct(BillService $billService)
    {
        $this->billService = $billService;
    }

    // region DANH MUC & DU LIEU
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * Ham them moi bill voi tham so la mang bill, ke qua tra ve la mang bill
     */
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

    public function layDanhMucNhomHang(){
        $nhomHang = array();
        $nhomHang = $this->billService->layDanhMucNhomHang();
        if(!empty($nhomHang)){
            return Response::response($nhomHang);
        }
        else{
            return Response::responseNotFound();
        }
    }

    public function index(){
        $filter = Input::get();
        $queryBuilder = $this->billService->getBillListingQueryBuilder($filter);

        $filter['perPage'] = isset($filter['perPage']) ? $filter['perPage'] : 10;
        $filter['page'] = isset($filter['page']) ? $filter['page'] : 1;

        $pagination = $queryBuilder->paginate($filter['perPage'], ['*'], 'page', $filter['page']);

        $pageCount = $pagination->lastPage();

        $bills = $this->billService->getTransformedItems($pagination->items());

        return Response::responseWithPageCount($bills, 200, 'OK', [], $pageCount);
    }

    public function update(){
        return 'update';
    }

    public function delete(){
        return 'delete';
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     * Ham lay danh sach  province trong bang province
     */
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

    /**
     * @return \Illuminate\Http\JsonResponse
     * Lay danh muc mat hang da luu
     */
    public function layDanhMucMatHang(){
        $danhMucMatHang = array();
        $danhMucMatHang = $this->billService->layDanhMucMatHang();
        if(!empty($danhMucMatHang)){
            return Response::response($danhMucMatHang);
        }
        else{
            return Response::responseNotFound();
        }
    }
    // endregion

    // region /** Bao cao */

    /**
     * @return \Illuminate\Http\JsonResponse
     * bao cao so luong dat hang the tung tinh thanh tren tung nhom hang
     */
    public function baoCaoSoLuongDatHangTheoTinhThanhTrenTungNhomHang(){
        $billFilter = Input::get();
        $data = $this->billService->baoCaoSoLuongDatHangTheoTinhThanhTrenTungNhomHang($billFilter);
        if(empty($data)){
            return Response::response(array());
        }
        else{
            return Response::response($data);
        }
    }
    // bao cao tong suat thanh toan thoe tung nhom hang
    public function baocaoTongSuatThanhToanTheoNhomHang(){
        $filter = Input::get();
        $data = $this->billService->baocaoTongSuatThanhToanTheoNhomHang($filter);
        if(empty($data)){
            return Response::response(array());
        }
        else{
            return Response::response($data);
        }
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     * bao cao tong xuat theo hai nhom hang la F1, FA
     */
    public function baoCaoTongSuatTheoF1FA(){
        $filter = Input::get();
        $data = $this->billService->baoCaoTongSuatTheoNhom($filter);
        if(empty($data)){
            return Response::response(array());
        }
        else{
            return Response::response($data);
        }
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     * bao cao xuat, nhap ton theo tung nhom hang
     */
    public function baoCaoXuatNhapTon(){
        $filter = Input::get();
        $data = $this->billService->baoCaoXuatNhapTon($filter);
        if(empty($data)){
            return Response::response(array());
        }
        else{
            return Response::response($data);
        }
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     * bao cao thong ke theo tinh
     */
    public function baoCaoThongKeTheoTinh(){
        $filter = Input::get();
        $data = $this->billService->baoCaoThongKeTheoTinh($filter);
        if(empty($data)){
            return Response::response(array());
        }
        else{
            return Response::response($data);
        }
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     * bao cao thong ke so luong nhap xuat theo nhom hang
     */
    public function baoCaoThongKeTheoNhomHang(){
        $filter = Input::get();
        $data = $this->billService->baoCaoThongKeTheoNhomHang($filter);
        if(empty($data)){
            return Response::response(array());
        }
        else{
            return Response::response($data);
        }
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     * danh sach tinh thanh co dat hang
     */
    public function baoCaoDanhSachTinhThanhCoDatHang(){
        $filter = Input::get();
        $data = $this->billService->baoCaoDanhSachTinhThanhCoDatHang($filter);
        if(empty($data)){
            return Response::response(array());
        }
        else{
            return Response::response($data);
        }
    }
    // endregion

}
