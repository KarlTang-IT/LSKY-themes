# 舟驿图床



## 主题信息

- **主题ID**: karl
- **版本**: 1.0.0
- **作者**: karl

## 目录结构

```
karl/
├── KarlTheme.php           # 主题核心类文件
├── README.md          # 说明文档
├── assets/            # 静态资源目录
│   ├── css/          # CSS样式文件
│   ├── js/           # JavaScript文件
│   ├── images/       # 图片资源
│   └── fonts/        # 字体文件
├── views/             # 视图模板目录
│   ├── layouts/      # 布局模板
│   ├── pages/        # 页面模板
│   └── components/   # 组件模板
└── controllers/       # 控制器目录
```

## 开发指南

### 1. 主题配置

在 `KarlTheme.php` 中的 `configurable()` 方法里定义主题配置项：

```php
public function configurable(): array
{
    return [
        Section::make('基础设置')->schema([
            TextInput::make('payload.site_title')->label('网站标题'),
            // 更多配置项...
        ]),
    ];
}
```

### 2. 路由定义

在 `routes()` 方法中定义主题路由：

```php
public function routes(): void
{
    Route::get('/', [IndexController::class, 'index']);
}
```

### 3. 数据转换

使用 `casts()` 方法处理配置数据：

```php
public function casts(): array
{
    return [
        'logo_url' => new Attribute(
            get: fn($value) => $value ? Storage::url($value) : ''
        ),
        'auth_page.logo_url' => new Attribute(
            get: fn($value) => $value ? Storage::url($value) : ''
        ),
    ];
}
```

### 4. 获取配置

在模板或控制器中获取配置：

```php
// 获取处理后的配置
$title = \App\Facades\ThemeService::getTheme('default')->getSettings('site_title', '默认标题');

// 获取原始配置
$rawTitle = \App\Facades\ThemeService::getTheme('default')->getRawSettings('site_title');
```

## 安装使用

1. 将主题文件夹放置在 `/themes` 目录下
2. 在后台「主题管理」中选择并配置主题
3. 保存设置即可生效

## 自定义开发

### CSS 样式
- 在 `assets/css/` 目录下创建样式文件
- 使用 `asset('assets/css/your-style.css')` 引用

### JavaScript 功能
- 在 `assets/js/` 目录下创建脚本文件
- 使用 `asset('assets/js/your-script.js')` 引用

### 视图模板
- 在 `views/` 目录下创建 Blade 模板
- 使用主题命名空间：`view('karl::your-view')`

## 注意事项

1. 主题ID必须唯一，建议使用小写字母和连字符
2. 配置字段名称必须以 `payload.` 开头
3. 静态资源会自动创建软链接到 `public/assets`
4. 遵循 Laravel 编码规范和最佳实践

---

有问题？请查看 [开发文档](https://docs.lsky.pro)
