<?php

namespace App\Http\Controllers;

use Core\Http\Repositories\Eloquent\Village\Village;
use Illuminate\Http\Request;


class MapController extends Controller
{

    public function index(Request $request)
    {
//        $mapList = Village::where('status', 1)->get(['name', 'lng', 'lat'])->toArray();
//        $pathArr = [
//            [
//                [118.227606, 25.608439],
//                [118.228534, 25.608216],
//                [118.228191, 25.607404],
//                [118.227295, 25.607375],
//                [118.226941, 25.608255],
//                [118.227284, 25.608236]
//            ],
//            [
//                [99.305505, 39.807798],
//                [99.306357, 39.807588],
//                [99.306341, 39.806401],
//                [99.30411, 39.806496],
//                [99.304239, 39.808021]
//            ]
//        ];
        $map_arr = [];
//        if (!empty($mapList)) {
//            foreach ($mapList as $key => $item) {
//                $data['position'] = [$item['lng'], $item['lat']];
//                $data['content']  = $item['name'];
//                $data['path']     = $pathArr[$key];
//                $map_arr[]        = $data;
//            }
//        }
//        $map_arr = json_encode($map_arr);
//        dd($map_arr);
        return view('u3d/map', compact("map_arr"));
    }


    public function home()
    {
        $_t = \request()->input('token') ?? '';
        return view('u3d/home', compact("_t"));
    }

    public function register()
    {
        return view('u3d/register');
    }

    public function login()
    {
        return view('u3d/login');
    }

    public function pointShow()
    {
        $villageId = \request('vv') ?? 0;
        $info      = Village::where('id', $villageId)->first();
        return view('u3d/tc', compact("info"));
    }

}
