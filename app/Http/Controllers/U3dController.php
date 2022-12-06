<?php

namespace App\Http\Controllers;

use Core\Http\Components\GlobalConstant;
use Core\Http\Repositories\Services\U3d\U3dService;


class U3dController extends Controller
{
    protected $u3dService;

    public function __construct(U3dService $u3dService)
    {
        $this->u3dService = $u3dService;
    }

    public function index()
    {
        include app_path('Libs/Form.php');
        $init      = [
            //数据自增id
            [
                'title'       => '',
                'name'        => 'id',
                'description' => '',
                'enum'        => [],
                'type'        => 'hidden',
            ],
            [
                'title'       => '所属栏目',
                'name'        => 'category_id',
                'description' => '',
                'enum'        =>
                    [
                        1 => '开发',
                        2 => '互联网圈子',
                        3 => '关于',
                        4 => '其他',
                        6 => '简历',
                    ],

                'type' => 'select',
            ],
            [
                'title'       => '文档标题',
                'name'        => 'title',
                'description' => '',
                'value'       => '111',
//                    'disabled'          => 'disabled',
                'verify'      => 'required',
                'verify_msg'  => '文档标题不能为空',
                'enum'        => [],
                'type'        => 'text',
            ],
            [
                'title'       => '文档主图',
                'name'        => 'main_image',
                'description' => '',
                'enum'        => [],
                'type'        => 'file',
            ],
            [
                'title'       => '是否发布',
                'name'        => 'is_publish',
                'description' => '',
                'enum'        =>
                    [
                        0 => '未发布',
                        1 => '已发布',
                    ],
                'type'        => 'radio',
            ],
            [
                'title'       => '是否推荐',
                'name'        => 'is_recommed',
                'description' => '',
                'enum'        =>
                    [
                        1 => '一级推荐',
                        2 => '二级推荐',
                        3 => '三级推荐',
                        4 => '四级推荐',
                    ],
                'type'        => 'checkbox',
            ]
        ];
        $form_data = array(
//            'title'=>'',
            'model_id'    => '',
            'category_id' => 2,
            'post_id'     => '2216267480655467',
            'is_publish'  => 1,
            'is_recommed' => 0,
            'sort'        => 10000,
            'author'      => '管理员',
        );
        \Form::getInstance()->form_action('save')->form_schema($init)->form_data($form_data);
        return view('u3d/show');
    }

    public function saveData()
    {
        $data = $this->u3dService->saveData();
        return response()->json($data);
    }

    public function showHtml()
    {
        $action    = \request('action') ?? '';
        $u3dNumber = \request('u3d_str') ?? '';
        $token     = \request('token') ?? '';
        $configs   = GlobalConstant::EDIT_ENUM;
        $postUrl   = $configs[$action] ?? '';
        if (empty($postUrl)) {
            return view('u3d/show', ['error' => '当前模块不可编辑']);
        }
        $init = $this->u3dService->formInitData($action, $u3dNumber, $token);
        if ($init == 2) {
            return view('u3d/show', ['error' => '需要登录后才能访问']);
        }
        if ($init == 1) {
            return view('u3d/show', ['error' => '没有找到可编辑的信息']);
        }
        $form_data = [];
        $url       = 'api/' . $postUrl;
        include app_path('Libs/Form.php');
//        \Form::getInstance()->form_action('api/platform/save-u3d')->form_schema($init)->form_data($form_data);
        \Form::getInstance()->form_action($url)->form_schema($init)->form_data($form_data);
        return view('u3d/show', ['_tt' => $token]);
    }

    public function abilityIndex()
    {
        return view('u3d/ability');
    }

}
