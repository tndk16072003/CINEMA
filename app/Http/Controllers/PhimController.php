<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePhimRequest;
use App\Http\Requests\DeletePhimRequest;
use App\Http\Requests\UpdatePhimRequest;
use App\Models\Phim;
use Illuminate\Http\Request;

class PhimController extends Controller
{
    public function index()
    {
        return view('AdminRocker.page.phim.index');
    }

    public function store(CreatePhimRequest $request)
    {
        // dd($request->all());
        $data = $request->all();
        Phim::create($data);

        return response()->json([
            'status'    => true,
            'messages'  => 'Đã thêm mới phim thành công!'
        ]);
    }

    public function getData()
    {
        $data = Phim::get();

        return response()->json([
            'data' => $data
        ]);
    }

    public function drop(DeletePhimRequest $request)
    {
        Phim::where('id', $request->id)->delete();

        return response()->json([
            'status'    => true,
            'messages'  => 'Đã xoá phim thành công!'
        ]);
    }

    public function update(UpdatePhimRequest $request)
    {
        $data = $request->all();
        $phim = Phim::where('id', $request->id)->first();
        $phim->update($data);

        return response()->json([
            'status'    => true,
            'messages'  => 'Đã cập nhật phim thành công!'
        ]);
    }

    public function changeStatus($id)
    {
        $data = Phim::where('id', $id)->first();
        if($data->tinh_trang == 1){
            $data->tinh_trang = 0;
        } else{
            $data->tinh_trang = 1;
        }
        $data->save();
        // dd($data->toArray());

        return response()->json([
            'status'    => true,
            'messages'  => 'Đã thay đổi trạng thái thành công!'
        ]);
    }
}
