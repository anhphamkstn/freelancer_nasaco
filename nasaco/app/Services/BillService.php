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
use Illuminate\Support\Facades\Validator;
use DB;

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

    public function getListCategoryProduct(){
        $categoryProducts= Bill::distinct('nhom_hang')
            ->pluck('nhom_hang');
        return $categoryProducts;
    }

    public function getListProduct(){
        $products= Bill::distinct('mat_hang')
            ->pluck('mat_hang');
        return $products;
    }

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

    public function getDataReportByCategoryProduct($filter)
    {
        $query = Bill::query();
        $data = array();
        $dataTransform = array();

        $startTime = strtotime("-30 day");
        $endTime = strtotime("now");

        if (!empty($filter['startTime']))
            $startTime = strtotime($filter['startTime']);

        if (!empty($filter['endTime']))
            $endTime = strtotime($filter['endTime']);
        $query->whereBetween('ngay_thang_nam', array(date('Y-m-d', $startTime), date('Y-m-d', $endTime)));
        $query->leftJoin('provinces', 'provinces.postal_code', '=', 'bills.postal_code');
        $data =  $query
            ->groupby('bills.postal_code', 'provinces.name')
            ->select(DB::raw('sum(bills.sl_dat_hang) as sl_dat_hang, bills.postal_code, provinces.name'))
            ->get();
        return $data;
    }

    public function baocaoTongSuatTheoNhom($filter)
    {
        $query = Bill::query();
        $data = array();
        $dataTransform = array();

        $startTime = strtotime("-30 day");
        $endTime = strtotime("now");
        if (!empty($filter['startTime']))
            $startTime = strtotime($filter['startTime']);

        if (!empty($filter['endTime']))
            $endTime = strtotime($filter['endTime']);

        if (!empty($filter['nhomHang'])) {
            if ($filter['nhomHang'] != 'all') {
                $inputTrimSpace = str_replace(' ', '', $filter['nhomHang']);
                $filterValueArray = explode(',', $inputTrimSpace);
                $query->whereIn('nhom_hang', $filterValueArray);
            }
        }
        else{
            $nhom_hang = ['F1','FA'];
            $query->whereIn('nhom_hang',$nhom_hang);
        }

        $query->whereBetween('ngay_thang_nam', array(date('Y-m-d', $startTime), date('Y-m-d', $endTime)));
        $data =  $query
            ->select(DB::raw('sum(bills.sl_thuc_xuat) as sl_thuc_xuat'))
            ->get();
        return $data;
    }


    public function baocaoTongsuatThanhToanTheoNhomHang($filter){
        $query = Bill::query();
        $data = array();
        $dataTransform = array();

        $startTime = strtotime("-30 day");
        $endTime = strtotime("now");
        $nhom_hang = array();
        if (!empty($filter['startTime']))
            $startTime = strtotime($filter['startTime']);

        if (!empty($filter['endTime']))
            $endTime = strtotime($filter['endTime']);

        if (!empty($filter['nhom_hang']))
            $nhom_hang = $filter['nhom_hang'];
        else{
            $nhom_hang = ['F1','F1','FA','E','G'];
        }

        $query->whereBetween('ngay_thang_nam', array(date('Y-m-d', $startTime), date('Y-m-d', $endTime)));
        $query->whereIn('nhom_hang',$nhom_hang);
        $data =  $query
            ->groupby('nhom_hang')
            ->select(DB::raw('sum(bills.sl_thuc_xuat) as sl_thuc_xuat, sum(bills.sl_thanh_toan) as sl_thanh_toan, bills.nhom_hang'))
            ->get();
        return $data;
    }

    public function baocaoXuatNhapTon($filter){
        $query = Bill::query();
        $data = array();
        $dataTransform = array();

        $startTime = strtotime("-30 day");
        $endTime = strtotime("now");
        $nhom_hang = array();
        if (!empty($filter['startTime']))
            $startTime = strtotime($filter['startTime']);

        if (!empty($filter['endTime']))
            $endTime = strtotime($filter['endTime']);

        if (!empty($filter['nhom_hang']))
            $nhom_hang = $filter['nhom_hang'];
        else{
            $nhom_hang = ['F1','F1','FA','E','G'];
        }

        $query->whereBetween('ngay_thang_nam', array(date('Y-m-d', $startTime), date('Y-m-d', $endTime)));
        $query->whereIn('nhom_hang',$nhom_hang);
        $data =  $query
            ->groupby('nhom_hang')
            ->select(DB::raw('sum(bills.sl_thuc_xuat) as sl_thuc_xuat, sum(bills.sl_dat_hang) as sl_dat_hang, bills.nhom_hang, (sum(bills.sl_dat_hang) - sum(bills.sl_thuc_xuat)) as sl_ton'))
            ->get();
        return $data;
    }

    public function baocaothongKeTheoTinh($filter){
        $query = Bill::query();
        $data = array();
        $dataTransform = array();

        $startTime = strtotime("-30 day");
        $endTime = strtotime("now");
        $nhom_hang = array();
        if (!empty($filter['startTime']))
            $startTime = strtotime($filter['startTime']);

        if (!empty($filter['endTime']))
            $endTime = strtotime($filter['endTime']);

        if (!empty($filter['nhom_hang']))
            $nhom_hang = $filter['nhom_hang'];
        else{
            $nhom_hang = ['F1','F1','FA','E','G'];
        }
        $query->whereBetween('ngay_thang_nam', array(date('Y-m-d', $startTime), date('Y-m-d', $endTime)));
        $query->whereIn('nhom_hang',$nhom_hang);
        $query->leftJoin('provinces', 'provinces.postal_code', '=', 'bills.postal_code');
        $data =  $query
            ->groupby('bills.postal_code','provinces.name','bills.nhom_hang')
            ->select(DB::raw('sum(bills.sl_thuc_xuat) as sl_thuc_xuat, sum(bills.sl_dat_hang) as sl_dat_hang, bills.postal_code, provinces.name,bills.nhom_hang'))
            ->get();
        return $data;
    }
    public function baocaoThongKeTheoNhomHang($filter){
        $query = Bill::query();
        $data = array();
        $dataTransform = array();

        $startTime = strtotime("-30 day");
        $endTime = strtotime("now");
        $nhom_hang = array();
        if (!empty($filter['startTime']))
            $startTime = strtotime($filter['startTime']);

        if (!empty($filter['endTime']))
            $endTime = strtotime($filter['endTime']);

        if (!empty($filter['nhom_hang']))
            $nhom_hang = $filter['nhom_hang'];
        else{
            $nhom_hang = ['F1','F1','FA','E','G'];
        }
        $query->whereBetween('ngay_thang_nam', array(date('Y-m-d', $startTime), date('Y-m-d', $endTime)));
        $query->whereIn('nhom_hang',$nhom_hang);
        $data =  $query
            ->groupby('bills.nhom_hang')
            ->select(DB::raw('sum(bills.sl_thuc_xuat) as sl_thuc_xuat, sum(bills.sl_dat_hang) as sl_dat_hang, sum(bills.sl_thanh_toan) as sl_thanh_toan, bills.nhom_hang'))
            ->get();
        return $data;
    }


    public function baocaoDanhSachTinhThanhCoDatHang($filter){
        $query = Bill::query();
        $data = array();
        $dataTransform = array();

        $startTime = strtotime("-30 day");
        $endTime = strtotime("now");
        $nhom_hang = array();
        if (!empty($filter['startTime']))
            $startTime = strtotime($filter['startTime']);

        if (!empty($filter['endTime']))
            $endTime = strtotime($filter['endTime']);

        $query->whereBetween('ngay_thang_nam', array(date('Y-m-d', $startTime), date('Y-m-d', $endTime)));
        $query->whereIn('nhom_hang',$nhom_hang);
        $query->leftJoin('provinces', 'provinces.postal_code', '=', 'bills.postal_code');
        $data =  $query
            ->distinct('bills.postal_code', 'provinces.name','provinces.code')
            ->where('bills.sl_dat_hang', '>', 0)
            ->get();
        return $data;
    }


    public function baocaoDanhSachTinhThanhCoXuatHang($filter){
        $query = Bill::query();
        $data = array();
        $dataTransform = array();

        $startTime = strtotime("-30 day");
        $endTime = strtotime("now");
        $nhom_hang = array();
        if (!empty($filter['startTime']))
            $startTime = strtotime($filter['startTime']);

        if (!empty($filter['endTime']))
            $endTime = strtotime($filter['endTime']);

        $query->whereBetween('ngay_thang_nam', array(date('Y-m-d', $startTime), date('Y-m-d', $endTime)));
        $query->whereIn('nhom_hang',$nhom_hang);
        $query->leftJoin('provinces', 'provinces.postal_code', '=', 'bills.postal_code');
        $data =  $query
            ->distinct('bills.postal_code', 'provinces.name','provinces.code')
            ->where('bills.sl_thuc_xuat', '>', 0)
            ->get();
        return $data;
    }
}