<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menus;
use App\Models\Customers;
use App\Models\Tables;
use App\Models\BillS;
use App\Models\billdetail;
use App\Models\Receipts;
class PosoneController extends Controller
{   

    public function load_pos(Request $request){
         $id_table=$request->id_table;
         $bill=Bills::findbill($id_table);
         if($bill===null){
            // dd($bill);
            return view('Pos.cms_load_pos',['id_table'=>$id_table,'flag'=>0]);
         }else{ 
            $data=billdetail::findbill($bill->IdBill);
            // dd($data);
            return view('Pos.cms_load_pos',['data'=>$data,'id_table'=>$id_table,'flag'=>1,'cus'=>$bill->CustomerName]);
         }
    }

    public function append(Request $request){
        $id_menu=$request->id_menu;
        $data=Menus::findid($id_menu);
        // dd($data);
        return view('Pos.appendproduct',['data'=>$data]);
    }
    
    public function load_cate(Request $request){
        $id_cate=$request->id_cate;
         if($id_cate==0){
            $data=Menus::index();
         }else{
            $data=Menus::findidcate($id_cate);
         }
        return view('Pos.cms_load_cate',['data'=>$data]);
    }

   
    public function searchcus(Request $request){
        $name=$request->customer;
        $data=Customers::search('test');
        // dd($data);
        return view('Pos.searchcustomer',['data'=>$data]);
    }

    public function searchmenu(Request $request){
    $name=$request->menuname;
    $data=Menus::search($name);
    // dd($data);
    return view('Pos.searchmenu',['data'=>$data]);
    }

    public function table(Request $request){
         $idtable=$request->id_table;
         if($idtable==0){
            $data=Tables::index();
         }else{
            $data=Tables::findidarea($idtable);
         }
        return view('Pos.table',['data'=>$data]);
    }



    public function save(Request $request){
        
        $json=$request->data;
        $table_id= $json['table_id'];
        
        // $run=Tables::index();
        // dd($run);
        $run=Bills::join('tables','bill.IdTable','=','tables.IdTable')->where('bill.IdTable',$table_id)->where('tables.Status',1)->where('bill.StatusB',0)->first();
        
        if($run===null){
            $sql =Bills::count();
            $count = $sql+1;
            $idbill = 'DH00'.$count;
            $customer_id = '';
        if($json['customer_id'] == 0){
            $customer_id = 'KH0099';
        }else{
            $customer_id =$json['customer_id'];
        }
        $customer_pay = $json['customer_pay'];
        $note = $json['note'];
        $updatetable=Tables::where('IdTable',$table_id)->update(['Status' => 1]);
        $insertorder=Bills::create([
        'IdBill' => $idbill,
        'IdUser' => 'admin',
        'IdTable' => $table_id,
        'IdStore' =>1,
        'IdCustomer' =>$customer_id,
        'StatusB' =>0,
        'Totalprice' =>$customer_pay,
        'Note' =>'nhanh ạ',
        ]);
        }else{
            $idbill=$run->IdBill;
        }

        Receipts::create([
            'UserId'=>'admin',
            'IdStore'=>1,
            'Note'=>'tiền bán hàng',
            'Totalprice'=>$customer_pay,
            'Format'=>$idbill
        ]);

        echo "<h3>Thông báo !</h3><p>Lưu đơn hàng thành công</p>";
        foreach ($json['detai_oder'] as $value) {
            if($value['id'] != 0){
            $idproduct = $value['id'];
            $quantity = $value['quantity'];
            $price = $value['price'];
            $insertdetail=billdetail::insert([
            'IdBill' => $idbill,
            'IdMenu' => $idproduct,
            'Quantity' => $quantity,
            'Price' =>$price,
            ]);
            }
        }
     }


      public function pay(Request $request){
        $json =$request->data;
        $table_id= $json['table_id'];
        $customer_id = $json['customer_id'];
        $customer_pay = $json['customer_pay'];
        $note = $json['note'];
        $sql=Bills::findbill($table_id);
        
        if($sql ===null ){
            echo "HIỆN CHƯA CÓ GÌ CHƯA THỂ THANH TOÁN";
        }
        $id=$sql->IdBill;
          
        // echo $sql->IdBill;
        // dd($sql);
        // else{

            $updatebill=Bills::where('IdBill',$id)->update(['StatusB'=>1]);

              

            $updatetable=Tables::where('IdTable',$table_id)->update(['Status' => 0]);

            echo '
            <h2 style="text-align:center">HÓA ĐƠN BÁN HÀNG</h2>
            <table class="table" style="width:100%">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Tên sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Gía bán</th>
                </tr>
            </thead>
            <tbody>';
            ;
            $stt=1;
            $selectoder=billdetail::findbill($sql->IdBill);

            foreach($selectoder as $rows) {
               echo '<tr align="center">
                    <td>'. $stt++.'</td>
                    <td>'.$rows->NameMenu.'</td>
                    <td>'.$rows->Quantity.'</td>
                    <td>'.number_format($rows->Price,0).'</td>
                </tr>';
            } 
            // echo $id;
            // dd($selectoder);
            echo '<tr>
                    <td colspan="3">Tổng cộng:</td>
                    <td align="center">'.number_format($sql->Totalprice).'</td>
                </tr>
            </tbody></table>';
      }
    
}
