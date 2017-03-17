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
        'thanh_tien_thanh_toan'];
    public function getListProvince(){
        $province = Bill::distinct('tinh','ma_buu_chinh')
            ->select('tinh','ma_buu_chinh')
            ->get();
        return $province;
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
        $instance = null;
        if(!empty($info['ma_buu_chinh'])){
            $province = Province::where('postal_code', $info['ma_buu_chinh'])->first();
            if(!empty($province)){
                $instance['province_id'] = $province->id;
            }
        }

        foreach ($this->fillable as $filterField) {
            if (isset($info[$filterField])) {
                $value = $info[$filterField];
                $instance[$filterField] = $value;
            }
        }
        $bill = Bill::create($instance);
        return $this->transform($bill);
    }

    public function getDataReportByCategoryProduct($billFilter)
    {
        $query = Bill::query();
        $data = array();
        $dataTransform = array();

        foreach ($this->fillAble as $filterField) {
            if (isset($filter[$filterField])) {
                $filterValue = $filter[$filterField];
                $query->where($filterField, '=', $filterValue);
            }
        }

        if(!empty($billFilter['nhom_hang'])){
            $query->whereIn('nhom_hang', $billFilter['nhom_hang']);
        }

        if(!empty($billFilter['tinh'])){
            $query->whereIn('tinh', $billFilter['tinh']);
        }
        $query->groupBy('tinh', 'ma_buu_chinh');
        $query->sum('sl_dat_hang');
        $query->sum('sl_thuc_xuat');
        $query->sum('sl_thanh_toan');

        $filter['sortBy'] = isset($filter['sortBy']) ? $filter['sortBy'] : 'tinh';
        $filter['orderDirection'] = isset($filter['orderDirection']) ? $filter['orderDirection'] : 'asc';

        $query->orderBy($filter['sortBy'], $filter['orderDirection']);

        $data =  $query->toSql();
        return $data;
    }

    private function transform($bill){
        if ($bill instanceof Bill) {
            $province = Province::where('id', $bill->id)->first();

            return [
                'id' => $bill->id,
                'ngay'=>$bill->ngay,
                'thang'=>$bill->thang,
                'nam'=>$bill->nam,
                "ngay_thang_nam"=>$bill->ngay_thang_nam,
                'mat_hang' => $bill->mat_hang,
                'nhom_hang' => $bill->nhom_hang,
                'dien_giai'=>$bill->dien_giai,
                'tinh'=>(empty($province)) ? '': $province->name,
                'ma_buu_chinh'=>(empty($province)) ? '': $province->postal_code,
                'dvt'=>$bill->dvt,
                'sl_dat_hang'=>$bill->sl_dat_hang,
                'sl_thuc_xuat'=>$bill->sl_thuc_xuat,
                'sl_thanh_toan'=>$bill->sl_thanh_toan,
                'con_lai'=>$bill->con_lai,
                'don_gia'=>$bill->don_gia,
                'thanh_tien_thanh_toan'=>$bill->thanh_tien_thanh_toan,
                'created_at' => $bill->created_at->format('Y-m-d H:i:s'),
                'updated_at' => $bill->updated_at->format('Y-m-d H:i:s')
            ];
        }
        else{
            return null;
        }
    }

}