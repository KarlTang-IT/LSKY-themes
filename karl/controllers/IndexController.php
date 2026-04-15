<?php

namespace Themes\Karl\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

/**
 * 首页控制器
 */
class IndexController extends Controller
{
    /**
     * 显示首页
     */
    public function __invoke(Request $request)
    {
        // 如果是API请求，返回JSON响应
        if ($request->expectsJson() || $request->is('api/*')) {
            return response()->json([
                'message' => 'Theme API endpoint',
                'data' => []
            ]);
        }

        // 返回主题视图
        return view('karl::pages.index');
    }

    /**
     * 示例：处理表单提交
     */
    public function store(Request $request)
    {
        // 验证请求数据
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string|max:1000',
        ]);

        // 处理数据（保存到数据库、发送邮件等）
        // ...

        return response()->json([
            'success' => true,
            'message' => '提交成功'
        ]);
    }
}
