<?php
// +----------------------------------------------------------------------
// | 柚枝集 [资讯小程序]
// +----------------------------------------------------------------------
// | Copyright (c) 2021 https://www.pipyou.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: 爱喝啤酒的友 <luckyoupan@163.com>
// +----------------------------------------------------------------------
namespace Dengje\Cms\Api;

use Dengje\Cms\Models\CmsCategory;
use Dengje\Cms\Models\CmsPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class PostController extends BaseController
{
    /**
     * 获取文章列表
     * @params field
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request){
        $field = $request->input('field','');
        $page = $request->input('page',1);


        if($field){
            $field = explode(',',$field);
        }else{
            $field = ['*'];
        }
        $data = CmsPost::where('state',1)->with('category')->orderBy('is_top','desc')->orderBy('sort','asc')->paginate(6,$field,$pageName = 'page', $page);

        return $this->result($data);
    }

    /**
     * 根据分类获取列表
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getPostByCategory(Request $request){
        $field = $request->input('field','');
        $page = $request->input('page',1);
        $category_id = $request->input('category_id',0);


        if($field){
            $field = explode(',',$field);
        }else{
            $field = ['*'];
        }
        $data = CmsPost::where('state',1)->where('category_id',$category_id)->with('category')->orderBy('is_top','desc')->orderBy('sort','asc')->paginate(6,$field,$pageName = 'page', $page);

        return $this->result($data);
    }

    /**
     * 推荐文章
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function recommend(Request $request){
        $data = CmsPost::where('state',1)->where('recommended',1)->orderBy('sort','asc')->get();
        return $this->result($data);
    }

    /**
     * 猜你喜欢
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function youlike(Request $request){
        $data = CmsPost::where('state',1)->orderBy(DB::raw('RAND()'))->limit(18)->get(['id','title','thumb']);
        return $this->result($data);
    }


    /**
     * 获取详情
     * @return \Illuminate\Http\JsonResponse
     */
    public function detail(){

        $id = request()->get('id','');


        // 添加访问量
        DB::table((new CmsPost())->getTable())->where('id',$id)->increment('post_hits');
        $data = CmsPost::where('state',1)->where('id',$id)->with('category')->first();

        return $this->result($data);
    }


    /**
     * 收藏
     */
    public function collect(Request $request){
        $id = $request->post('id');
        // 添加访问量
        DB::table((new CmsPost())->getTable())->where('id',$id)->increment('post_favorites');
    }

    /**
     * 点赞
     */
    public function like(Request $request){
        $id = $request->post('id');
        // 添加访问量
        DB::table((new CmsPost())->getTable())->where('id',$id)->increment('post_like');
    }


}
