<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateBaiVietRequest;
use App\Http\Requests\DeleteBaiVietRequest;
use App\Http\Requests\UpdateBaiVietRequest;
use App\Models\baiViet;
use App\Models\Comment;
use App\Models\GiaGhe;
use App\Models\likeBaiViet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BaiVietController extends Controller
{
    public function viewPricing()
    {
        $gia_ghe_don = GiaGhe::where('loai_ghe', 0)->first()->gia_ghe;
        $gia_ghe_doi = GiaGhe::where('loai_ghe', 1)->first()->gia_ghe;
        return view('client.share.pricing', compact('gia_ghe_don', 'gia_ghe_doi'));
    }

    public function viewBlogDetail($slug)
    {
        $slug_parts = explode("-", $slug);
        $id = last($slug_parts);
        $blog_detail = baiViet::where('id', $id)->first();
        $newBlog = baiViet::select('*')
                          ->orderBy('id')
                          ->LIMIT(3)
                          ->get();
        $comment = Comment::where('id_binh_luan', '=', null)
                          ->where('id_bai_viet', $id)
                          ->get();
        $checkUserLogin = Auth::guard('customer')->check();

        return view('client.blog_detail', compact('blog_detail', 'newBlog', 'comment', 'checkUserLogin'));
    }

    public function index()
    {
        return view('AdminRocker.page.bai_viet.index');
    }

    public function store(CreateBaiVietRequest $request)
    {
        $data = $request->all();

        baiViet::create($data);

        return response()->json([
            'status' => true,
            'messages' => 'Đã thêm mới bài viết thành công!'
        ]);
    }

    public function getData() {
        $data = baiViet::all();
        return response()->json([
            'data' => $data
        ]);
    }

    public function getDataHomePage()
    {
        $data = baiViet::paginate(3);
        $recent_posts = baiViet::orderByDESC('id')
                               ->limit(3)
                               ->get();

        $user_login = Auth::guard('customer')->user();
        foreach ($data as $value) {
            $dem = likeBaiViet::where('id_bai_viet', $value->id)
                              ->where('tinh_trang', 1)
                              ->select(DB::raw('COUNT(id_bai_viet) as so_luong'))
                              ->first();
            $value->so_luong_like = $dem->so_luong;
            if($user_login) {
                $like = likeBaiViet::where('id_user_like', $user_login->id)
                                   ->where('id_bai_viet', $value->id)
                                   ->where('tinh_trang', 1)
                                   ->first();
                if($like) {
                    $value->check_like = true;
                } else {
                    $value->check_like = false;
                }
            } else {
                $value->check_like = false;
            }
        }
        $response = [
            'pagination' => [
                'total' => $data->total(),
                'per_page' => $data->perPage(),
                'current_page' => $data->currentPage(),
                'last_page' => $data->lastPage(),
                'from' => $data->firstItem(),
                'to' => $data->lastItem()
            ],
            'data'          => $data,
            'user_login'    => $user_login,
            'recent_posts'  => $recent_posts,
        ];
        return response()->json([
            'data' => $response
        ]);
    }

    public function changeStatus($id)
    {
        $data = baiViet::where('id', $id)->first();
        $data->trang_thai = !$data->trang_thai;
        $data->save();

        return response()->json([
            'status' => true,
            'messages' => 'Đã thay đổi trạng thái bài viết thành công!'
        ]);
    }

    public function drop(DeleteBaiVietRequest $request)
    {
        baiViet::where('id', $request->id)->delete();

        return response()->json([
            'status' => true,
            'messages' => 'Đã xoá bỏ bài viết thành công!'
        ]);
    }

    public function update(UpdateBaiVietRequest $request)
    {
        $data = $request->all();

        $bai_viet = baiViet::where('id', $request->id)->first();
        $bai_viet->update($data);

        return response()->json([
            'status' => true,
            'messages' => 'Đã cập nhật bài viết thành công!'
        ]);
    }
}
