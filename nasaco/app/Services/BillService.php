<?php
/**
 * Created by PhpStorm.
 * User: pham
 * Date: 17/03/2017
 * Time: 10:42
 */

namespace App\Services;
use App\Bill;
use App\Province;
use App\ProductCategory;
use Illuminate\Support\Facades\Validator;
use DB;
use App\Helpers\StringHelper;

class BillService
{
    protected $fillable = [
        'ngay',
        'thang',
        'nam',
        'ngay_thang_nam',
        'mat_hang',
        'nhom_hang',
        'dien_giai',
        'dvt',
        'sl_dat_hang',
        'sl_thuc_xuat',
        'sl_thanh_toan',
        'con_lai',
        'don_gia',
        'thanh_tien_thanh_toan',
        'ma_buu_chinh'
    ];

    protected $searchFields = ['mat_hang', 'dien_giai'];
    protected $filterFields = ['nhom_hang', 'ma_buu_chinh','dvt'];

    /**
     * @param $info
     * @param string $action
     * @param int $id
     * @return mixed
     * Ham validate du lieu bill
     * editing
     */
    public function validateInfo($info, $action = 'insert', $id = 0)
    {
        $rules = [];
        $messages = [
            // add message
        ];

        if ($action === 'insert') {
            $rules = [
                // to do
            ];
        } elseif ($action === 'update' && $id > 0) {
            $rules = [
            ];
        }
        $validator = Validator::make($info, $rules, $messages);
        return $validator;
    }

    /**
     * @param $info
     * @return array|null
     * Them bill vao bang bills trong csdl
     */
    public function insert($info)
    {
        try{
            $instance = null;
            foreach ($this->fillable as $filterField) {
                if (isset($info[$filterField])) {
                    $value = $info[$filterField];
                    $instance[$filterField] = $value;
                }
            }
            $bill = Bill::create($instance);
            return $this->transform($bill);
        }
        catch(\Exception $e){
            return null;
        }
    }

    /**
     * @param $filter
     * @return \Illuminate\Database\Eloquent\Builder
     * get query bill
     */
    public function getBillListingQueryBuilder($filter){
        $query = Bill::query();
        if (isset($filter['startTime'])) {
            $startTime = $filter['startTime'];
            $query->where('ngay_thang_nam', '>=', $startTime);
        }

        if (isset($filter['endTime'])) {
            $endTime = $filter['endTime'];
            $query->where('ngay_thang_nam', '<=', $endTime);
        }

        if (isset($filter['search']) && trim($filter['search'])) {
            $keyword = $filter['search'];

            $query->where(function ($query) use ($keyword) {
                foreach ($this->searchFields as $key => $searchField) {
                    $query->orWhere($searchField, 'like', "%{$keyword}%");
                }
            });
        }
        foreach ($this->filterFields as $filterField) {
            $filterParamName = StringHelper::pascalCaseToCamelCase($filterField);

            if (isset($filter[$filterParamName])) {
                $filterValue = $filter[$filterParamName];
                $query->where($filterField, '=', $filterValue);
            }
        }
        $filter['sortBy'] = isset($filter['sortBy']) ? $filter['sortBy'] : 'id';
        $filter['orderDirection'] = isset($filter['orderDirection']) ? $filter['orderDirection'] : 'asc';

        $query->orderBy($filter['sortBy'], $filter['orderDirection']);
        return $query;
    }

    /**
     * @param $items
     * @return array
     * transform item bill
     */
    public function getTransformedItems($items){
        $transformedItems = [];
        foreach($items as $item)
        {
            $transformedItem = $this->transform($item);
            if (isset($transformedItem))
                $transformedItems[] = $transformedItem;
        }
        return $transformedItems;
    }

    /**
     * @param $billId
     * @return bill model
     * find bill by id
     */
    public function findResource($billId){
        return Bill::findOrFail($billId);
    }

    /**
     * @param Account $instance
     * @param $info
     * @return array|null
     * to do: update bill model
     */
    public function update(Bill $instance, $info)
    {
        foreach ($this->fillable as $attr) {
            $filterParamName = StringHelper::pascalCaseToCamelCase($attr);
            if (isset($info[$filterParamName])) {
                $instance->$attr = $info[$filterParamName];
            }
        }
        $instance->save();
        return $this->transform($instance);
    }

    public function delete($billId)
    {
        return Bill::destroy($billId);
    }


    /**
     * @param $bill
     * @return array|null
     * transform data bill
     */
    private function transform($bill){
        if ($bill instanceof Bill) {
            return [
                'id' => $bill->id,
                'ngay'=>$bill->ngay,
                'thang'=>$bill->thang,
                'nam'=>$bill->nam,
                "ngayThangNam"=>$bill->ngay_thang_nam,
                'matHang' => $bill->mat_hang,
                'nhomHang' => $bill->nhom_hang,
                'dienGiai'=>$bill->dien_giai,
                'maBuuChinh'=>$bill->ma_buu_chinh,
                'donViTinh'=>$bill->dvt,
                'soLuongDatHang'=>$bill->sl_dat_hang,
                'soLuongThucXuat'=>$bill->sl_thuc_xuat,
                'soLuongThanhToan'=>$bill->sl_thanh_toan,
                'conLai'=>$bill->con_lai,
                'donGia'=>$bill->don_gia,
                'thanhTienThanhToan'=>$bill->thanh_tien_thanh_toan,
                'createdAt' => $bill->created_at->format('Y-m-d H:i:s'),
                'updatedAt' => $bill->updated_at->format('Y-m-d H:i:s')
            ];
        }
        else{
            return null;
        }
    }

    /**
     * @param $province
     * @return array|null
     * transform data province
     */
    private function transformProvince($province){
        if ($province instanceof Province) {
            return [
                'id' => $province->id,
                "code"=>$province->code,
                'name' => $province->name,
                'postalCode' => $province->postal_code
            ];
        }
        else{
            return null;
        }
    }

    /**
     * @return array
     * Get list province in provinces table
     */
    public function getListProvince(){
        $provinces = Province::get();
        $provinceTransforms = array();
        $dataTransform = null;
        if(!empty($provinces)){
            foreach($provinces as $province){
                $dataTransform = $this->transformProvince($province);
                if(!empty($dataTransform)){
                    $provinceTransforms[] = $dataTransform;
                }
            }
        }
        return $provinceTransforms;
    }

    /**
     * @return mixed
     * Lay danh muc nhom hang co trong bang bill
     */
    public function layDanhMucNhomHang(){
        $danhMucNhomHang= Bill::distinct('nhom_hang')
            ->pluck('nhom_hang');
        return $danhMucNhomHang;
    }

    /**
     * @return mixed
     * lay danh muc mat hang co trong bang bill
     */
    public function layDanhMucMatHang(){
        $danhMucMatHang= Bill::distinct('mat_hang')
            ->pluck('mat_hang');
        return $danhMucMatHang;
    }

    /**
     * @param $filter
     * @return array|\Illuminate\Database\Eloquent\Collection|static[]
     * bao cao so luong dat hang the tinh thanh cua tug nhom hang
     */
    public function baoCaoSoLuongDatHangTheoTinhThanhTrenTungNhomHang($filter)
    {
        $query = Bill::query();
        $data = array();

        $startTime = strtotime("-30 day");
        $endTime = strtotime("now");

        if (!empty($filter['startTime']))
            $startTime = strtotime($filter['startTime']);

        if (!empty($filter['endTime']))
            $endTime = strtotime($filter['endTime']);
        $query->whereBetween('ngay_thang_nam', array(date('Y-m-d', $startTime), date('Y-m-d', $endTime)));
        $query->leftJoin('provinces', 'provinces.postal_code', '=', 'bills.ma_buu_chinh');

        if (!empty($filter['postal_codes'])) {
            $postalCodes = StringHelper::stringToArray($filter['postal_codes'], ',');
            $query->whereIn('provinces.postal_code', $postalCodes);
        }
        if (!empty($filter['types'])) {
            $types =  StringHelper::stringToArray($filter['types'], ',');
            $query->whereIn('bills.nhom_hang', $types);
        }

        $data =  $query
            ->groupby('bills.ma_buu_chinh', 'provinces.name','bills.nhom_hang')
            ->select(DB::raw('sum(bills.sl_dat_hang) as soLuongDatHang, bills.ma_buu_chinh as maBuuChinh, provinces.name, bills.nhom_hang as nhomHang'))
            ->get();
        return $data;
    }

    /**
     * @param $filter
     * @return array|\Illuminate\Database\Eloquent\Collection|static[]
     * bao cao tong xuat, thanh toan theo tung nhom hang
     */
    public function baocaoTongSuatThanhToanTheoNhomHang($filter){
        $query = ProductCategory::query();
        $data = array();
        $dataTransforms = array();
        $startTime = strtotime("-30 day");
        $endTime = strtotime("now");

        if (!empty($filter['startTime']))
            $startTime = strtotime($filter['startTime']);

        if (!empty($filter['endTime']))
            $endTime = strtotime($filter['endTime']);

        if (!empty($filter['types'])) {
            $types =  StringHelper::stringToArray($filter['types'], ',');
            $query->whereIn('name', $types);
        }
        if (!empty($filter['postal_codes'])) {
            $postalCodes = StringHelper::stringToArray($filter['postal_codes'], ',');
        }

        $data = $query->get();
        if(!empty($data)){
            $dataTransform = null;
            foreach ($data as $item){
                $dataTransform['nhomHang'] = $item->name;
                $soLuongThucXuat = 0;
                $soLuongThanhToan = 0;

                $queryBill = Bill::query();
                $queryBill->leftJoin('provinces', 'provinces.postal_code', '=', 'bills.ma_buu_chinh');

                if (!empty($postalCodes)) {
                    $queryBill->whereIn('provinces.postal_code', $postalCodes);
                }

                $queryBill->where('nhom_hang', $item->name)
                    ->whereBetween('ngay_thang_nam', array(date('Y-m-d', $startTime), date('Y-m-d', $endTime)));

                $bills = $queryBill->get();

                foreach ($bills as $bill){
                    $soLuongThucXuat = $soLuongThucXuat + $bill->sl_thuc_xuat;
                    $soLuongThanhToan = $soLuongThanhToan + $bill->sl_thanh_toan;
                }
                $dataTransform['soLuongThucXuat'] = $soLuongThucXuat;
                $dataTransform['soLuongThanhToan'] = $soLuongThanhToan;
                $dataTransforms[] = $dataTransform;
            }
        }
        return $dataTransforms;
    }

    /**
     * Bao cao so luong xuat theo nhom hang, hien tai mac dinh tinh cho F1, FA
     * @param $filter
     * @return array|\Illuminate\Database\Eloquent\Collection|static[]
     * update: add fiter by nhom hang va tinh thanh
     */
    public function baoCaoTongSuatTheoNhom($filter)
    {
        $query = Bill::query();
        $types = ['F1','FA'];

        $startTime = strtotime("-30 day");
        $endTime = strtotime("now");
        if (!empty($filter['startTime']))
            $startTime = strtotime($filter['startTime']);

        if (!empty($filter['endTime']))
            $endTime = strtotime($filter['endTime']);

        if (!empty($filter['types'])) {
            $types =  StringHelper::stringToArray($filter['types'], ',');
        }
        $query->whereIn('bills.nhom_hang', $types);
        $query->leftJoin('provinces', 'provinces.postal_code', '=', 'bills.ma_buu_chinh');

        if (!empty($filter['postal_codes'])) {
            $postalCodes = StringHelper::stringToArray($filter['postal_codes'], ',');
            $query->whereIn('provinces.postal_code', $postalCodes);
        }

        $query->whereBetween('bills.ngay_thang_nam', array(date('Y-m-d', $startTime), date('Y-m-d', $endTime)));
        $data =  $query
            ->select(DB::raw('sum(bills.sl_thuc_xuat) as soLuongThucXuat'))
            ->get();
        return $data;
    }

    /**
     * @param $filter
     * @return array|\Illuminate\Database\Eloquent\Collection|static[]
     * bao cao xuat nhap ton theo tinh thanh va nhom hang
     */
    public function baoCaoXuatNhapTon($filter){
        $query = ProductCategory::query();
        $dataTransforms = array();
        $startTime = strtotime("-30 day");
        $endTime = strtotime("now");

        if (!empty($filter['startTime']))
            $startTime = strtotime($filter['startTime']);

        if (!empty($filter['endTime']))
            $endTime = strtotime($filter['endTime']);

        if (!empty($filter['types'])) {
            $types =  StringHelper::stringToArray($filter['types'], ',');
            $query->whereIn('name', $types);
        }
        if (!empty($filter['postal_codes'])) {
            $postalCodes = StringHelper::stringToArray($filter['postal_codes'], ',');
        }
        $data = $query->get();
        if(!empty($data)){
            $dataTransform = null;
            foreach ($data as $item){
                $dataTransform['nhomHang'] = $item->name;
                $soLuongThucXuat = 0;
                $soLuongDathang = 0;

                $queryBill = Bill::query();
                $queryBill->leftJoin('provinces', 'provinces.postal_code', '=', 'bills.ma_buu_chinh');

                if (!empty($postalCodes)) {
                    $queryBill->whereIn('provinces.postal_code', $postalCodes);
                }

                $queryBill->where('nhom_hang', $item->name)
                    ->whereBetween('ngay_thang_nam', array(date('Y-m-d', $startTime), date('Y-m-d', $endTime)));

                $bills = $queryBill->get();

                foreach ($bills as $bill){
                    $soLuongThucXuat = $soLuongThucXuat + $bill->sl_thuc_xuat;
                    $soLuongDathang = $soLuongDathang + $bill->sl_dat_hang;
                }
                $dataTransform['soLuongThucXuat'] = $soLuongThucXuat;
                $dataTransform['soLuongDatHang'] = $soLuongDathang;
                $dataTransform['soLuongTon'] = $soLuongDathang - $soLuongThucXuat;
                $dataTransforms[] = $dataTransform;
            }
        }
        return $dataTransforms;
    }

    /**
     * @param $filter
     * @return array|\Illuminate\Database\Eloquent\Collection|static[]
     * bao cao thong ke theo tinh thanh so luong xuat, nhap
     */
    public function baoCaoThongKeTheoTinh($filter){
        $query = Bill::query();
        $dataTransforms = array();
        $types = ['F1','F2','FA','E','G'];
        $startTime = strtotime("-30 day");
        $endTime = strtotime("now");
        if (!empty($filter['startTime']))
            $startTime = strtotime($filter['startTime']);

        if (!empty($filter['endTime']))
            $endTime = strtotime($filter['endTime']);

        if (!empty($filter['types'])) {
            $types =  StringHelper::stringToArray($filter['types'], ',');
        }
        $query->whereIn('bills.nhom_hang', $types);

        $query->leftJoin('provinces', 'provinces.postal_code', '=', 'bills.ma_buu_chinh');

        if (!empty($filter['postal_codes'])) {
            $postalCodes = StringHelper::stringToArray($filter['postal_codes'], ',');
            $query->whereIn('provinces.postal_code', $postalCodes);
        }
        $query->whereBetween('bills.ngay_thang_nam', array(date('Y-m-d', $startTime), date('Y-m-d', $endTime)));

        $queryBill = $query;

        $tinhThanhCoDatHang =  $query->distinct('bills.ma_buu_chinh')
            ->pluck('bills.ma_buu_chinh');

        $data = null;
        $bills = $queryBill->get();
        foreach($tinhThanhCoDatHang as $tinh){
            $province = $this->getProvinceByPostalCode($tinh);
            if(!empty($province)){
                $data['postal_code'] = $province->postal_code;
                $data['code'] = $province->code;
                $data['name'] = $province->name;
                $nhomHang = ProductCategory::get();
                $dataTheoNhom = array();
                if(!empty($nhomHang)){
                    $dataTransform = null;
                    foreach ($nhomHang as $item){
                        $dataTransform['nhomHang'] = $item->name;
                        $soLuongThucXuat = 0;
                        $soLuongThanhToan = 0;
                        $soLuongDathang = 0;
                        foreach ($bills as $bill){
                            if($bill->ma_buu_chinh == $tinh && $bill->nhom_hang == $item->name){
                                $soLuongThucXuat = $soLuongThucXuat + $bill->sl_thuc_xuat;
                                $soLuongThanhToan = $soLuongThanhToan + $bill->sl_thanh_toan;
                                $soLuongDathang = $soLuongDathang + $bill->sl_dat_hang;
                            }
                        }
                        $dataTransform['soLuongThucXuat'] = $soLuongThucXuat;
                        $dataTransform['soLuongThanhToan'] = $soLuongThanhToan;
                        $dataTransform['soLuongDatHang'] = $soLuongDathang;
                        $dataTheoNhom[] = $dataTransform;
                    }
                }
                $data['dataTheoNhom'] = $dataTheoNhom;
                $dataTransforms[] = $data;
            }
        }
        return $dataTransforms;
    }

    /**
     * @param $filter
     * @return array|\Illuminate\Database\Eloquent\Collection|static[]
     * bao cao thong ke so luong xuat, dat hang theo tung nhom hang
     */
    public function baoCaoThongKeTheoNhomHang($filter){
        $query = ProductCategory::query();
        $data = array();
        $dataTransforms = array();
        $startTime = strtotime("-30 day");
        $endTime = strtotime("now");

        if (!empty($filter['startTime']))
            $startTime = strtotime($filter['startTime']);

        if (!empty($filter['endTime']))
            $endTime = strtotime($filter['endTime']);

        if (!empty($filter['types'])) {
            $types =  StringHelper::stringToArray($filter['types'], ',');
            $query->whereIn('name', $types);
        }
        if (!empty($filter['postal_codes'])) {
            $postalCodes = StringHelper::stringToArray($filter['postal_codes'], ',');
        }
        $data = $query->get();
        if(!empty($data)){
            $dataTransform = null;
            foreach ($data as $item){
                $dataTransform['nhomHang'] = $item->name;
                $soLuongThucXuat = 0;
                $soLuongThanhToan = 0;
                $soLuongDathang = 0;

                $queryBill = Bill::query();
                $queryBill->leftJoin('provinces', 'provinces.postal_code', '=', 'bills.ma_buu_chinh');

                if (!empty($postalCodes)) {
                    $queryBill->whereIn('provinces.postal_code', $postalCodes);
                }

                $queryBill->where('nhom_hang', $item->name)
                    ->whereBetween('ngay_thang_nam', array(date('Y-m-d', $startTime), date('Y-m-d', $endTime)));

                $bills = $queryBill->get();

                foreach ($bills as $bill){
                    $soLuongThucXuat = $soLuongThucXuat + $bill->sl_thuc_xuat;
                    $soLuongThanhToan = $soLuongThanhToan + $bill->sl_thanh_toan;
                    $soLuongDathang = $soLuongDathang + $bill->sl_dat_hang;
                }
                $dataTransform['soLuongThucXuat'] = $soLuongThucXuat;
                $dataTransform['soLuongThanhToan'] = $soLuongThanhToan;
                $dataTransform['soLuongDatHang'] = $soLuongDathang;
                $dataTransforms[] = $dataTransform;
            }
        }
        return $dataTransforms;
    }

    /**
     * @param $filter
     * @return array|\Illuminate\Database\Eloquent\Collection|static[]
     * lay danh sach tinh thanh co dat hang
     */
    public function baoCaoDanhSachTinhThanhCoDatHang($filter){
        $query = Bill::query();
        $startTime = strtotime("-30 day");
        $endTime = strtotime("now");
        if (!empty($filter['startTime']))
            $startTime = strtotime($filter['startTime']);

        if (!empty($filter['endTime']))
            $endTime = strtotime($filter['endTime']);

        if (!empty($filter['types'])) {
            $types =  StringHelper::stringToArray($filter['types'], ',');
            $query->whereIn('bills.nhom_hang', $types);
        }
        $query->whereBetween('bills.ngay_thang_nam', array(date('Y-m-d', $startTime), date('Y-m-d', $endTime)));
        $query->whereNotNull('bills.ma_buu_chinh');
        $query->leftJoin('provinces', 'provinces.postal_code', '=', 'bills.ma_buu_chinh');

        if (!empty($filter['postal_codes'])) {
            $postalCodes = StringHelper::stringToArray($filter['postal_codes'], ',');
            $query->whereIn('provinces.postal_code', $postalCodes);
        }

        $data =  $query
            ->distinct('bills.ma_buu_chinh', 'provinces.name','provinces.code')
            ->select('bills.ma_buu_chinh', 'provinces.name','provinces.code')
            ->get();
        return $data;
    }

    private function getProvinceByPostalCode($postalCode){
        $province = Province::where('postal_code', $postalCode)->first();
        return $province;
    }
}
