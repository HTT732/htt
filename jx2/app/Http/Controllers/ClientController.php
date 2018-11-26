<?php

namespace App\Http\Controllers;

use App\Http\Requests\DangSanPhamRequest;
use App\Images;
use App\LikeView;
use App\LoaiTin;
use App\Message;
use App\SanPham;
use App\ServerGame;
use App\Services\ThumbnailService;
use App\Slide;
use App\User;
use App\test;
use Barryvdh\Debugbar\Facade as Debugbar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use Pusher\Pusher;

class ClientController extends Controller
{
    function getTrangChu () {
        $marquee = Message::where('idLoaiTin', 3)->orderBy('id', 'DESC')->first();
        $introduce = Message::where('idLoaiTin', 4)->orderBy('id', 'ASC')->first();
        $server_game = ServerGame::all();
    	return view('clients.index', compact('marquee', 'introduce', 'server_game'));
    }

    function postTrangChu (Request $request) {
        // dd($request);
    }

    function getTraDaoQuan () {
    	return view('clients.news');
    }

    function getRegister () {
    	return view('clients.register');
    }

    function postRegister(Request $request) {
    	$validator = Validator::make($request->all(), 
    		[
    			'username' => 'unique:users,username|min:6|regex:/^[a-zA-Z0-9]+$/',
    			'password' => 'min:6',
    			're_password' => 'same:password'
    		],
    		[
    			'username.unique' => 'Tên tài khoản đã tồn tại',
    			'username.min' => 'Tên tài khoản phải dài ít nhất 6 ký tự',
    			'username.regex' => 'Tài khoản không thể chứa ký tự đặc biệt',
    			'password.min' => 'Mật khẩu phải dài ít nhất 6 ký tự',
    			're_password.same' => 'Xác nhận mật khẩu không trùng khớp',
    		]
    	);
    	if ($validator->fails()){
    		return redirect('register')->withErrors($validator)->withInput();
    	}
    	else{
	    	$user = new User;
	    	$user->username = $request->username;
	    	$user->password = Hash::make($request->password);
	    	$user->level = 1;
	    	$user->save();
            if (!Auth::check() && Auth::attempt(['username'=>$request->username, 'password'=>$request->password])){
    	    	return redirect('/');
            }
            else {
                return redirect('/')->with('error_login');
            }
    	}
    }

    function checkUsername (Request $request) {
    	$checkUser = User::where('username', $request->username)->get();
    	return count($checkUser);
    }

    function getLogin () {
        return view('clients.login');
    }

    function postLogin (Request $request) {
        $validator = Validator::make($request->all(), 
            [
                'username' => 'required',
                'password' => 'required'
            ], 
            [
                'username.required' => 'Vui lòng nhập tài khoản',
                'password.required' => 'Vui lòng nhập mật khẩu',
            ]);
        if ($validator->fails()){
            return view('clients.login')->withErrors($validator);
        }
        else {
            $remember = true;
            $check_user_exists = User::where('username', $request->username)->count();
            if ($check_user_exists == 0)
                return redirect('login')->with('login_faild', 'Tài khoản không tồn tại');
            else {
                Auth::check() ? Auth::logout() : '';
                if (Auth::attempt(['username'=>$request->username, 'password'=>$request->password]))
                    return redirect('/');
                else
                    return redirect('login')->with('login_faild', 'Mật khẩu không đúng')->withInput();
            }
        }
    }

    function getLogout () {
        if (Auth::check()){
            Auth::logout();
            return redirect('/');
        }
    }

    function loadSanPham (Request $request) {
        $sanpham = SanPham::join('server_games', 'san_phams.idServer', 'server_games.id')->join('like_views', 'san_phams.idLikeView', 'like_views.id')->where('idUser', $request->idUser)->select('san_phams.id', 'san_phams.tieude','san_phams.thumb', 'san_phams.noidung', 'san_phams.kieugia', 'san_phams.gia', 'san_phams.created_at', 'server_games.servername', 'like_views.sum_like', 'like_views.sum_view')->get();
        
        return response()->json($sanpham);
    }

    function loadChiTietSanPham (Request $request) {
       $sanpham = SanPham::join('server_games', 'san_phams.idServer', 'server_games.id')->join('like_views', 'san_phams.idLikeView', 'like_views.id')->where('san_phams.id', $request->idsp)->select('san_phams.id', 'san_phams.tieude', 'san_phams.noidung', 'san_phams.kieugia', 'san_phams.gia', 'san_phams.created_at', 'server_games.servername', 'like_views.sum_like', 'like_views.sum_view')->get();
        $image = SanPham::join('images', 'san_phams.id', 'images.idSanPham')->where('san_phams.id', $request->idsp)->select('images.idSanPham', 'images.name', 'images.thumbnail')->get();

        return response()->json(['sanpham'=>$sanpham, 'image'=>$image]);
    }

    function dangBai (Request $request) {
        $rules = [];
        $rules['server'] = 'required';
        $rules['tieude'] = 'required|min:10|max:255';
        $rules['noidung'] = 'required|min:20|max:5000';
        $rules['kieugia'] = ['regex:/^vang|vnd|xu|khac$/i'];
        $rules['gia'] = ['required','regex:/^[1-9][0-9]{0,7}$|^Giao lưu$|^Thỏa thuận$/i'];

        $sdt = $request->sdt;
        $fb = $request->fb;

        if (!empty($sdt))
            $rules['sdt'] = ['regex:/^[0-9][1-9][0-9]{8,9}$/i'];
        if (!empty($fb))
            $rules['fb'] = 'required|min:6|max:255';


        for ($i = 0, $len = $request->length; $i < $len; $i++){
            $rules['image_'.$i] = 'mimes:jpeg,jpg,png,gif|max:2048';
        }

        $mess = [];
        $mess['server.required'] = 'Chưa chọn server';
        $mess['tieude.required'] = 'Chưa nhập tiêu đề';
        $mess['tieude.min'] = 'Tiêu đề quá ngắn';
        $mess['tieude.max'] = 'Tiêu đề vượt quá độ dài cho phép';
        $mess['noidung.required'] = 'Chưa nhập nội dung';
        $mess['noidung.min'] = 'Nội dung quá ngắn';
        $mess['noidung.max'] = 'Nội dung vượt quá độ dài cho phép';

        for ($i = 0, $len = $request->length; $i < $len; $i++){
            $mess['image_'.$i.'.mimes'] = 'Tệp <u>'.$request->file('image_'.$i)->getClientOriginalName().'</u>' .' có định dạng không hợp lệ';
            $mess['image_'.$i.'.max'] = 'Tệp <u>'.$request->file('image_'.$i)->getClientOriginalName().'</u>' .' vượt quá kích thước cho phép (tối đa 2MB)';
        }

        $mess['kieugia.regex'] = 'Kiểu giá mặc định: Vàng, Xu, VNĐ, ...';
        $mess['gia.required'] = 'Chưa định giá cho sản phẩm';
        $mess['gia.regex'] = 'Giá phải lớn hơn 0 và nhỏ hơn 99999999';
        if (!empty($sdt))
            $mess['sdt.regex'] = 'Số điện thoại không hợp lệ';
        if (!empty($fb)){
            $mess['fb.min'] = 'Độ dài link facebook không hợp lệ';
            $mess['fb.required'] = 'Chưa nhập link facebook';
            $mess['fb.max'] = 'Độ dài link facebook không hợp lệ';
        }

        
        $validate = Validator::make($request->all(), $rules, $mess);
        $mess_error = $validate->errors();
        if ($request->length == 0){
            $mess_error->add('not_image', 'Chưa chọn file');
        }

        if ($validate->fails()){
            return $mess_error;
        }
        else{
            if ($request->iduser != Auth::user()->id)
                return 'hack';
            else {

                $like_view = new Likeview;
                $like_view->sum_like = 0;
                $like_view->sum_view = 0;
                $like_view->save();
                $id_LikeView = $like_view->id;

                // Resize image
                $imageName = time().'-'.$request->file('image_0')->getClientOriginalName();
                $img = Image::make($request->file('image_0'))->resize(null, 218,function ($constraint) {
                    $constraint->aspectRatio();
                })->save('upload/dest_resize/' . $imageName);

                $thumbnail = 'upload/dest_resize/' .$imageName;

                $sp = new SanPham;
                $sp->idServer = $request->input('server');
                $sp->thumb = $thumbnail;
                $sp->tieude = $request->tieude;
                $sp->noidung = $request->noidung;
                $sp->kieugia = $request->kieugia;
                $sp->gia = $request->gia;
                $sp->idUser = $request->iduser;
                $sp->idLikeView = $id_LikeView;
                $sp->save();
                $idsp = $sp->id;

                for ($i = 0, $len = $request->length; $i < $len; $i++){
                    $img = new Images;

                    $image = $request->file('image_'.$i);
                    $imageName = time(). '.' . $image->getClientOriginalName();
                    $img->name = $imageName;
                    $img->idSanPham = $idsp;

                    $image->move('upload/source_resize', $imageName);
                    $img->save();
                }
                $us = User::find($request->iduser);
                if (!empty($sdt)){
                    if (empty($us->sdt)){
                        $us->sdt = $sdt;
                        $us->save();
                    }
                }
                if (!empty($fb)){
                    if (empty($us->fb)){
                        $us->fb = $fb;
                        $us->save();
                    }
                }
                return 'success';
            }
        }
    }

    function xoaSanPham(Request $request) {
        $sanpham = SanPham::find($request->idsp);
        $idLV = $sanpham->idLikeView;

        // Xóa thumb sản phẩm
        if (file_exists($sanpham['thumb']) && !empty($sanpham['thumb'])) {
                unlink($sanpham['thumb']);
        }

        // Xóa image sản phẩm
        $image = Images::where('idSanPham', $request->idsp)->get();
        foreach ($image as $img) {
            if (file_exists('upload/source_resize/'. $img['name']) && !empty($img['name'])) {
                unlink('upload/source_resize/'. $img['name']);
            }
        }

        $sanpham->delete();
        $likeview = LikeView::findOrFail($idLV)->delete();

        return 'success';
    }

    function test (){
        if (file_exists('upload/source_resize/1541301054.nhung_cau_stt_hay_ve_cuoc_song__status_hay_ve_cuoc_song_16-550.jpg'))
            unlink('upload/source_resize/1541301054.nhung_cau_stt_hay_ve_cuoc_song__status_hay_ve_cuoc_song_16-550.jpg');
        return 'ok';
    }

    function testtiny(){
        try {
        \Tinify\setKey("7Y9XxGRCL3tDmjv0qwLALxbyLwmmZXkV");
        $source = \Tinify\fromFile("sourcetiny/bg.jpg");
        for ($i = 0; $i < 10; $i++){
            $resized = $source->resize(array(
                "method" => "scale",
                "width" => 300
        ));
            $resized->toFile("desttiny/bg".$i.".jpg");
        }

        return 'ok';
        } catch(\Tinify\AccountException $e) {
            // Verify your API key and account limit.
            dd($e->getMessage());
        } catch(\Tinify\ClientException $e) {
            // Check your source image and request options.
            dd($e->getMessage());
        } catch(\Tinify\ServerException $e) {
            // Temporary issue with the Tinify API.
            dd($e->getMessage());
        } catch(\Tinify\ConnectionException $e) {
            // A network connection error occurred.
            dd($e->getMessage());
        } catch(Exception $e) {
            // Something else went wrong, unrelated to the Tinify API.
            dd($e->getMessage());
        }
    }
    function productStatus () {
        $options = array(
            'cluster' => 'ap1',
            'useTLS' => true
          );
          $pusher = new Pusher(
            '89d24c458f84fee2b970',
            'c7a6a712e9a4ac0463f1',
            '567170',
            $options
          );

          $data['message'] = true;
          $pusher->trigger('my-channel', 'my-event', $data);
          // return "ok";
    }
}

