<?php 
namespace App\Http\Controllers;
use Mobile_Detect;
// use Browser;
use App\Models\Login;
use App\Models\Qrcode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Storage;
use Helper;
class AdminController extends Controller {
	public function dashboard(){
        if(session()->get('USER_ROLE') == 1){
            $data['users'] = DB::table('logins')->where(['role'=>2])->orderBy('id', 'desc')->get(); 
            $data['total_qr'] = Helper::get_totalsystemqrcode();

            //Report Chart
            $data['qrtraffic'] = DB::table('qr_traffic')->select(DB::raw('DATE(added_on_str) as created_at'), DB::raw('COUNT(*) as totaleacess'))->
              groupBy(DB::raw('DATE(added_on_str)'))->get();

              $data['total_device'] = DB::table('qr_traffic')->select(DB::raw('COUNT(*) as total_device, device'))->groupBy(DB::raw('qr_traffic.device'))->get();

              $data['osdevice'] = DB::table('qr_traffic')->select(DB::raw('COUNT(*) as total_os, OS'))->groupBy(DB::raw('qr_traffic.OS'))->get();

              $data['browserdetection'] = DB::table('qr_traffic')->select(DB::raw('COUNT(*) as total_browser_dt, browser'))->groupBy(DB::raw('qr_traffic.browser'))->get();

        }else{
            $data['users'] = DB::table('logins')->where(['added_by'=>session()->get('USER_ID')])->orderBy('id', 'desc')->get();
            $data['total_qr'] = Helper::get_totaluserqrcode(session()->get('USER_ID'));  
            
            //Report Chart
            $data['qrtraffic'] = DB::table('qr_traffic')->select(DB::raw('DATE(added_on_str) as created_at'), DB::raw('COUNT(*) as totaleacess'))->where(['qr_traffic.added_by' => session()->get('USER_ID')])->groupBy(DB::raw('DATE(added_on_str)'))->get();

            $data['total_device'] = DB::table('qr_traffic')->select(DB::raw('COUNT(*) as total_device, device'))->where(['qr_traffic.added_by' => session()->get('USER_ID')])->groupBy(DB::raw('qr_traffic.device'))->get();

            $data['osdevice'] = DB::table('qr_traffic')->select(DB::raw('COUNT(*) as total_os, OS'))->where(['qr_traffic.added_by' => session()->get('USER_ID')])->groupBy(DB::raw('qr_traffic.OS'))->get();

            $data['browserdetection'] = DB::table('qr_traffic')->select(DB::raw('COUNT(*) as total_browser_dt, browser'))->where(['qr_traffic.added_by' => session()->get('USER_ID')])->groupBy(DB::raw('qr_traffic.browser'))->get();
               
        }
		return view('Main.admin.dashboard', $data);
	}


   
	public function addusers(Request $request){
		return view('Main.admin.addusers');
	}

	public function uploadusers(Request $request){
		$request->validate([
            'image'        => 'mimes:jpeg,jpg,png',
            'name'         => 'required',
            'email'        => 'required|email|unique:logins,email',
        	'mobile'       => 'required|digits:10|numeric',
        	'totalqrcodes' => 'required',
        	'totalqrhits'  => 'required',
        	'password'     => 'required',
        	'State'        => 'required',
        	'city'         => 'required',
        	'address'      => 'required',
        ]);
        $model = new Login();
        if ($request->hasfile('profiles')) {
            $image = $request->file('profiles');
            $ext = $image->extension();
            $image_name = time().'.'.$ext;
            $image->storeAs('/public/users', $image_name); 
            $model->profiles =  $image_name;
        }
		$model->added_by   =  session()->get('USER_ID');
		$model->name       =  $request->post('name');
        $model->lname      =  $request->post('lname');
        $model->email      =  $request->post('email');
        $model->password   =  Hash::make($request->post('password'));
        $model->dummypass  =  $request->post('password');
        $model->mobile     =  $request->post('mobile');
        $model->total_qr   =  $request->post('totalqrcodes');
        $model->total_hits =  $request->post('totalqrhits');
        $model->pinocde    =  $request->post('pinocde');
        $model->State      =  $request->post('State');
        $model->city 	   =  $request->post('city');
        $model->address    =  $request->post('address');
        $model->status     = 'Active';
        $model->role       =  2;
        $model->save();
        $request->session()->flash('success', 'Users Created Successfully');
        return redirect('admin/manageusers');
	}


	public function changeuserstatus(Request $request, $id, $status){
		$model = Login::find($id);
        $model->status =  $status;
        $model->save();
        $request->session()->flash('success', 'User Status Changed');
        return redirect('admin/manageusers');
	}

	public function addqrcodes(Request $request){
        $data['sizes'] = DB::table('sizes')->where(['status'=>'Active'])->orderBy('id', 'desc')->get(); 
        $data['colors'] = DB::table('colors')->where(['status'=>'Active'])->orderBy('id', 'desc')->get(); 
		return view('Main.admin.qrcodes', $data);
	}

	public function manageusers(Request $request){
        if(session()->get('USER_ROLE') == '1'){
            $data['users'] = DB::table('logins')->where(['role'=>2])->orderBy('id', 'desc')->get(); 
        }else{
            $data['users'] = DB::table('logins')->where(['added_by'=>session()->get('USER_ID')])->orderBy('id', 'desc')->get();     
        }
		return view('Main.admin.manageusers', $data);
	}

    public function editusers(Request $request, $id){
        $data['users'] = DB::table('logins')->where(['id'=>$id])->get();
        return view('Main.admin.editusers', $data);
    }

    public function updateusers(Request $request){
        $id = $request->post('id');
        $request->validate([
            'image'        => 'mimes:jpeg,jpg,png',
            'name'         => 'required',
            'email'        => 'required|email|unique:logins,email,'.$id,
            'mobile'       => 'required|digits:10|numeric',
            'totalqrcodes' => 'required',
            'totalqrhits'  => 'required',
            'password'     => 'required',
            'State'        => 'required',
            'city'         => 'required',
            'address'      => 'required',
        ]);
        $model = Login::find($id);
        if ($request->hasfile('profiles')) {
            if ($request->post('id') > 0) {
                $arrImage = DB::table('logins')->where(['id' => $request->post('id')])->get();
                if (Storage::exists('/public/users/'.$arrImage[0]->profiles)) {
                   Storage::delete('/public/users/'.$arrImage[0]->profiles);
                }
            }
            $image = $request->file('profiles');
            $ext = $image->extension();
            $image_name = time().'.'.$ext;
            $image->storeAs('/public/users/', $image_name); 
            $model->profiles =  $image_name;
        }
        $model->added_by   =  session()->get('USER_ID');
        $model->name       =  $request->post('name');
        $model->lname      =  $request->post('lname');
        $model->email      =  $request->post('email');
        $model->password   =  Hash::make($request->post('password'));
        $model->dummypass  =  $request->post('password');
        $model->mobile     =  $request->post('mobile');
        $model->total_qr   =  $request->post('totalqrcodes');
        $model->total_hits =  $request->post('totalqrhits');
        $model->pinocde    =  $request->post('pinocde');
        $model->State      =  $request->post('State');
        $model->city       =  $request->post('city');
        $model->address    =  $request->post('address');
        $model->status     = 'Active';
        $model->role       =  2;
        $model->update();
        $request->session()->flash('success', 'Users Updated Successfully');
        return redirect('admin/manageusers');
    }

    public function deleteuser(Request $request, $id){
        DB::table('logins')->where(['id'=>$id])->delete();
        $request->session()->flash('success', 'User Deleted');
        return redirect('admin/manageusers');
    }


    public function uploadqrcodes(Request $request){
        $request->validate([
            'name'         => 'required',
            'link'        => 'required',
            'size'       => 'required',
            'color'       => 'required',
        ]);
        $model = new Qrcode();
        $model->added_by   =  session()->get('USER_ID');
        $model->name       =  $request->post('name');
        $model->link       =  $request->post('link');
        $model->color      =  $request->post('color');
        $model->size       =  $request->post('size');
        $model->status     = 'Active';
        $model->save();
        $request->session()->flash('success', 'QR Code Created Successfully');
        return redirect('admin/manageqrcodes');
    }

    public function manageqrcodes(Request $request){
        if(session()->get('USER_ROLE') == '1'){
            $data['qrcodes'] = DB::table('qrcodes')->orderBy('id', 'desc')->get();
        }else{
            $data['qrcodes'] = DB::table('qrcodes')->where(['added_by'=>session()->get('USER_ID')])->orderBy('id', 'desc')->get();
        }
        return view('Main.admin.manageqrcodes', $data);
    }

    public function editqrcode(Request $request, $id){
        $data['qrcodes'] = DB::table('qrcodes')->where(['id'=>$id])->orderBy('id', 'desc')->get();
        $data['sizes'] = DB::table('sizes')->where(['status'=>'Active'])->orderBy('id', 'desc')->get(); 
        $data['colors'] = DB::table('colors')->where(['status'=>'Active'])->orderBy('id', 'desc')->get(); 
        return view('Main.admin.editqrcode', $data);
    }


    public function updateqrcodes(Request $request){
        $id = $request->post('id');
        $request->validate([
            'name'         => 'required',
            'link'        => 'required',
            'size'       => 'required',
            'color'       => 'required',
        ]);
        $model = Qrcode::find($id);
        $model->added_by   =  session()->get('USER_ID');
        $model->name       =  $request->post('name');
        $model->link       =  $request->post('link');
        $model->color      =  $request->post('color');
        $model->size       =  $request->post('size');
        $model->status     = 'Active';
        $model->save();
        $request->session()->flash('success', 'QR Code Updated Successfully');
        return redirect('admin/manageqrcodes');
    }

    public function deleteqrcode(Request $request, $id){
        DB::table('qrcodes')->where(['id'=>$id])->delete();
        $request->session()->flash('success', 'QR CODE Deleted');
        return redirect('admin/manageqrcodes');
    }

    public function managesize(Request $request){
        if(session()->get('USER_ROLE') == '1'){
            $data['sizes'] = DB::table('sizes')->orderBy('id', 'desc')->get();
        }else{
            $data['sizes'] = DB::table('sizes')->where(['added_by'=>session()->get('USER_ID')])->orderBy('id', 'desc')->get();
        }
        return view('Main.admin.managesize', $data);
    }

    public function addsize(Request $request){
        $data = [
            'size'     => $request->post('size'),
            'added_by' => session()->get('USER_ID'),
            'status'   => 'Active',
            'added_on' => date('Y-m-d h:i:s')
        ];
        DB::table('sizes')->insert($data);
        $request->session()->flash('success', 'Size Added');
        return redirect('admin/managesize');
    }

    public function deletesize(Request $request, $id){
        DB::table('sizes')->where(['id'=>$id])->delete();
        $request->session()->flash('success', 'Size Deleted');
        return redirect('admin/managesize');
    }

    public function changesizestatus(Request $request, $id, $status){
        DB::table('sizes')->where(['id'=>$id])->update(['status' => $status]);
        $request->session()->flash('success', 'Size Status Changed');
        return redirect('admin/managesize');
    }
    
    public function changeqrstatus(Request $request, $id, $status){
        DB::table('qrcodes')->where(['id'=>$id])->update(['status' => $status]);
        $request->session()->flash('success', 'QR Status Changed');
        return redirect('admin/manageqrcodes');
    }

    
    public function managecolor(Request $request){
        if(session()->get('USER_ROLE') == '1'){
            $data['colors'] = DB::table('colors')->orderBy('id', 'desc')->get();
        }else{
            $data['colors'] = DB::table('colors')->where(['added_by'=>session()->get('USER_ID')])->orderBy('id', 'desc')->get();
        }
        return view('Main.admin.managecolor', $data);
    }

    public function addcolors(Request $request){
        $data = [
            'color'    => $request->post('colors'),
            'added_by' => session()->get('USER_ID'),
            'status'   => 'Active',
            'added_on' => date('Y-m-d h:i:s')
        ];
        DB::table('colors')->insert($data);
        $request->session()->flash('success', 'Color Added');
        return redirect('admin/managecolor');
    }

    public function changecolorstatus(Request $request, $id, $status){
        DB::table('colors')->where(['id'=>$id])->update(['status' => $status]);
        $request->session()->flash('success', 'QR Status Changed');
        return redirect('admin/managecolor');
    }

    public function deletecolors(Request $request, $id){
        DB::table('colors')->where(['id'=>$id])->delete();
        $request->session()->flash('success', 'Colors Deleted');
        return redirect('admin/managecolor');
    }

    public function edit_colors(Request $request, $id){
        $colordata = DB::table('colors')->where(['id'=>$id])->get();

        return response()->json([
            'status' => 200,
            'colordata' => $colordata,
        ]);
        //echo json_encode($colordata);
    }

    
    public function edit_size(Request $request, $id){
        $colordata = DB::table('sizes')->where(['id'=>$id])->get();
        return response()->json([
            'status' => 200,
            'sizesrdata' => $colordata,
        ]);
        //echo json_encode($colordata);
    }


    public function updatecolors(Request $request){
        $id = $request->post('id');
        $data = [
            'color'    => $request->post('color_name'),
            'added_by' => session()->get('USER_ID'),
            'status'   => 'Active',
            'added_on' => date('Y-m-d h:i:s')
        ];
        DB::table('colors')->where(['id' => $id])->update($data);
        $request->session()->flash('success', 'Color Updated');
        return redirect('admin/managecolor');
    }

    public function updatesizes(Request $request){
        $id = $request->post('id');
        $data = [
            'size'     => $request->post('size'),
            'added_by' => session()->get('USER_ID'),
            'status'   => 'Active',
            'added_on' => date('Y-m-d h:i:s')
        ];
        DB::table('sizes')->where(['id' => $id])->update($data);
        $request->session()->flash('success', 'Size Updated');
        return redirect('admin/managesize');
    }

    public function qrtraffic(Request $request, $id){
        if ($id > 0) {
           $args = [ 'id' => $id, 'status'  => 'Active' ];
            $qrdata =  DB::table('qrcodes')->where($args)->get();
            if (isset($qrdata[0])) {
                //Checktotalhits Available in user qrcode
                $user_total_hit_limit = Helper::get_user($qrdata[0]->added_by);
                $total_hits = Helper::get_user_qr_total_hits($qrdata[0]->added_by);
                if (isset($user_total_hit_limit[0])) {
                    if ($user_total_hit_limit[0]->role ==1) {
                         $detect     = new Mobile_Detect();
                            $browser = $this->getUserBrowser();
                            $device = "";
                            $os = "";
                            if ($detect->isMobile()) {
                                $device = "Mobile";
                            }else if ($detect->isTablet()) {
                                $device = "Tablet";
                            }else{
                                $device = "PC";
                            }
                            if ($detect->isiOS()) {
                                $os = "IOS";
                            }else if ($detect->isAndroidOS()) {
                                $os = "Android";
                            }else{
                                $os = "Window";
                            }
                            $ch = curl_init();
                            curl_setopt($ch, CURLOPT_URL, "http://ip-api.com/json");
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                            $result = curl_exec($ch);
                            curl_close($ch);
                            $result = json_decode($result, true);

                            $data = [
                                'qr_code_id'  => $id,
                                'added_by'    => $qrdata[0]->added_by,
                                'device'      => $device,
                                'OS'          => $os,
                                'browser'     => $browser,
                                'city'        => $result['city'],
                                'state'       => $result['regionName'],
                                'country'     => $result['country'],
                                'ip_address'  => $result['query'],
                                'added_on'    => date('Y-m-d h:i:s'),
                                'added_on_str' => date('Y-m-d')
                            ];
                            DB::table('qr_traffic')->insert($data);
                            return redirect($qrdata[0]->link);
                    }else{
                        if ($user_total_hit_limit[0]->total_hits > 0) {
                        if (isset($total_hits[0])) {
                            if ($user_total_hit_limit[0]->total_hits > $total_hits[0]->total_qr_hits) {
                               $detect     = new Mobile_Detect();
                                $browser = $this->getUserBrowser();
                                $device = "";
                                $os = "";
                                if ($detect->isMobile()) {
                                    $device = "Mobile";
                                }else if ($detect->isTablet()) {
                                    $device = "Tablet";
                                }else{
                                    $device = "PC";
                                }
                                if ($detect->isiOS()) {
                                    $os = "IOS";
                                }else if ($detect->isAndroidOS()) {
                                    $os = "Android";
                                }else{
                                    $os = "Window";
                                }
                                $ch = curl_init();
                                curl_setopt($ch, CURLOPT_URL, "http://ip-api.com/json");
                                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                                $result = curl_exec($ch);
                                curl_close($ch);
                                $result = json_decode($result, true);

                                $data = [
                                    'qr_code_id'  => $id,
                                    'added_by'    => $qrdata[0]->added_by,
                                    'device'      => $device,
                                    'OS'          => $os,
                                    'browser'     => $browser,
                                    'city'        => $result['city'],
                                    'state'       => $result['regionName'],
                                    'country'     => $result['country'],
                                    'ip_address'  => $result['query'],
                                    'added_on'    => date('Y-m-d h:i:s'),
                                    'added_on_str' => date('Y-m-d')
                                ];
                                DB::table('qr_traffic')->insert($data);
                                return redirect($qrdata[0]->link);
                            }else{
                               die("QR CODE LIMIT COMPLETED PLEASE CONTACT TO ADMIN"); 
                            }
                        }else{
                            //$this->redirect_qr_link($id, $qrdata[0]->added_by, $qrdata[0]->link); //Not working
                            $detect     = new Mobile_Detect();
                            $browser = $this->getUserBrowser();
                            $device = "";
                            $os = "";
                            if ($detect->isMobile()) {
                                $device = "Mobile";
                            }else if ($detect->isTablet()) {
                                $device = "Tablet";
                            }else{
                                $device = "PC";
                            }
                            if ($detect->isiOS()) {
                                $os = "IOS";
                            }else if ($detect->isAndroidOS()) {
                                $os = "Android";
                            }else{
                                $os = "Window";
                            }
                            $ch = curl_init();
                            curl_setopt($ch, CURLOPT_URL, "http://ip-api.com/json");
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                            $result = curl_exec($ch);
                            curl_close($ch);
                            $result = json_decode($result, true);

                            $data = [
                                'qr_code_id'  => $id,
                                'added_by'    => $qrdata[0]->added_by,
                                'device'      => $device,
                                'OS'          => $os,
                                'browser'     => $browser,
                                'city'        => $result['city'],
                                'state'       => $result['regionName'],
                                'country'     => $result['country'],
                                'ip_address'  => $result['query'],
                                'added_on'    => date('Y-m-d h:i:s'),
                                'added_on_str' => date('Y-m-d')
                            ];
                            DB::table('qr_traffic')->insert($data);
                            return redirect($qrdata[0]->link);
                        }
                    }else{
                        die("QR CODE LIMIT COMPLETED PLEASE CONTACT TO ADMIN");
                    }
                    }
                    
                    
                }else{
                    die('SOMETHING WENT WRONG');
                }
        
            }else{
                die('Something went wrong');
            }
        }
    }

 


    public function getUserBrowser(){
          $fullUserBrowser = (!empty($_SERVER['HTTP_USER_AGENT'])? 
          $_SERVER['HTTP_USER_AGENT']:getenv('HTTP_USER_AGENT'));
          $userBrowser = explode(')', $fullUserBrowser);
          $userBrowser = $userBrowser[count($userBrowser)-1];
          if((!$userBrowser || $userBrowser === '' || $userBrowser === ' ' || strpos($userBrowser, 'like Gecko') === 1) && strpos($fullUserBrowser, 'Windows') !== false){
            return 'Internet-Explorer';
          }else if((strpos($userBrowser, 'Edge/') !== false || strpos($userBrowser, 'Edg/') !== false) && strpos($fullUserBrowser, 'Windows') !== false){
            return 'Microsoft-Edge';
          }else if(strpos($userBrowser, 'Chrome/') === 1 || strpos($userBrowser, 'CriOS/') === 1){
            return 'Google-Chrome';
          }else if(strpos($userBrowser, 'Firefox/') !== false || strpos($userBrowser, 'FxiOS/') !== false){
            return 'Mozilla-Firefox';
          }else if(strpos($userBrowser, 'Safari/') !== false && strpos($fullUserBrowser, 'Mac') !== false){
            return 'Safari';
          }else if(strpos($userBrowser, 'OPR/') !== false && strpos($fullUserBrowser, 'Opera Mini') !== false){
            return 'Opera-Mini';
          }else if(strpos($userBrowser, 'OPR/') !== false){
            return 'Opera';
          }
          return false;
    }

    public function reports(Request $request, $id){
        if(session()->get('USER_ROLE') == '1'){
            $data['qrtraffic'] = DB::table('qr_traffic')->select(DB::raw('DATE(added_on_str) as created_at'), DB::raw('COUNT(*) as totaleacess'))->where(['qr_code_id'=>$id])->
              groupBy(DB::raw('DATE(added_on_str)'))->get();

              $data['total_device'] = DB::table('qr_traffic')->select(DB::raw('COUNT(*) as total_device, device'))->where(['qr_code_id'=>$id])->groupBy(DB::raw('qr_traffic.device'))->get();

              $data['osdevice'] = DB::table('qr_traffic')->select(DB::raw('COUNT(*) as total_os, OS'))->where(['qr_code_id'=>$id])->groupBy(DB::raw('qr_traffic.OS'))->get();

              $data['browserdetection'] = DB::table('qr_traffic')->select(DB::raw('COUNT(*) as total_browser_dt, browser'))->where(['qr_code_id'=>$id])->groupBy(DB::raw('qr_traffic.browser'))->get();
        }else{
            $data['qrtraffic'] = DB::table('qr_traffic')->select(DB::raw('DATE(added_on_str) as created_at'), DB::raw('COUNT(*) as totaleacess'))->where(['qr_code_id'=>$id, 'qr_traffic.added_by' => session()->get('USER_ID')])->groupBy(DB::raw('DATE(added_on_str)'))->get();

            $data['total_device'] = DB::table('qr_traffic')->select(DB::raw('COUNT(*) as total_device, device'))->where(['qr_code_id'=>$id, 'qr_traffic.added_by' => session()->get('USER_ID')])->groupBy(DB::raw('qr_traffic.device'))->get();

            $data['osdevice'] = DB::table('qr_traffic')->select(DB::raw('COUNT(*) as total_os, OS'))->where(['qr_code_id'=>$id, 'qr_traffic.added_by' => session()->get('USER_ID')])->groupBy(DB::raw('qr_traffic.OS'))->get();
        }
        $data['qrcode'] = DB::table('qrcodes')->where(['id' => $id])->get();
        return view('Main.admin.reports', $data);
    }

    public function detailsreports(Request $request, $id){
        $data['qrcode'] = DB::table('qr_traffic')->where(['qr_code_id' => $id])->get();
        return view('Main.admin.detailsqrreports', $data);
    }
    // Vide 4:01 min watched

    public function settings(Request $request){
       $id = session()->get('USER_ID');
       $data['profile'] = DB::table('logins')->where(['id'=> $id])->get();
       return view('Main.admin.settings', $data);
    }

    public function updateprofile(Request $request){
        $id = $request->post('id');
        $request->validate([
            'image'        => 'mimes:jpeg,jpg,png',
            'name'         => 'required',
            'State'        => 'required',
            'city'         => 'required',
            'address'      => 'required',
        ]);
        $model = Login::find($id);
        if ($request->hasfile('profiles')) {
            if ($request->post('id') > 0) {
                $arrImage = DB::table('logins')->where(['id' => $request->post('id')])->get();
                if (Storage::exists('/public/users/'.$arrImage[0]->profiles)) {
                   Storage::delete('/public/users/'.$arrImage[0]->profiles);
                }
            }
            $image = $request->file('profiles');
            $ext = $image->extension();
            $image_name = time().'.'.$ext;
            $image->storeAs('/public/users/', $image_name); 
            $model->profiles =  $image_name;


        }
        $model->name       =  $request->post('name');
        $model->lname      =  $request->post('lname');
        $model->pinocde    =  $request->post('pinocde');
        $model->State      =  $request->post('State');
        $model->city       =  $request->post('city');
        $model->address    =  $request->post('address');
        $model->role       =  2;
        $model->update();
        $request->session()->flash('success', 'Profile Updated Successfully');
        return redirect('profile/settings');
    }

    public  function changepassword(){
        return view('Main.admin.changepassword');
    }

    public function passwordchangeprocess(Request $request){
        $request->validate([
          'current_password' => 'required',
          'newpassword'     => 'required',
          'confirmpassword' => 'required',
        ]);
        $userpass = session()->get('USER_PASSWORD');
        if (!Hash::check($request->current_password, $userpass)) {
            $msg = 'Current password does not match!';
            $request->session()->flash('error', $msg);
        }else{
          $user_id = session()->get('USER_ID');
          $userdata = [ 
             'password' =>  Hash::make($request->newpassword),
             'dummypass' => $request->newpassword,
          ];

          DB::table('logins')->where(['id' => $user_id])->update($userdata);
          $request->session()->flash('success', 'Password Changed Successfully');
        }
       return view('Main.admin.changepassword');
    }


    




}


?>