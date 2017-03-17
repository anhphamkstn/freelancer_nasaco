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
        'thanh_tien_thanh_toan',
        'postal_code'
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
                "ngay_thang_nam"=>$bill->ngay_thang_nam,
                'mat_hang' => $bill->mat_hang,
                'nhom_hang' => $bill->nhom_hang,
                'dien_giai'=>$bill->dien_giai,
                'ma_buu_chinh'=>$bill->postal_code,
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

    private function transformProvince($province){
        if ($province instanceof Province) {
            return [
                'id' => $province->id,
                "code"=>$province->code,
                'name' => $province->name,
                'postal_code' => $province->postal_code
            ];
        }
        else{
            return null;
        }
    }

    public function getDataReportByCategoryProduct($billFilter)
    {
        $query = Bill::query();
        $data = array();
        $dataTransform = array();

        $startTime = strtotime("-21 day");
        $endTime = strtotime("now");

        if (!empty($filter['startTime']))
            $startTime = strtotime($filter['startTime']);

        if (!empty($filter['endTime']))
            $endTime = strtotime($filter['endTime']);
        $query->whereBetween('created_at', array(date('Y-m-d', $startTime), date('Y-m-d', $endTime)));

        $data =  $query->get();
        return $data;
    }

}