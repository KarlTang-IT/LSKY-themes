<?php

namespace Themes\Karl;

use App\Contracts\ThemeAbstract;
use App\Support\Attribute;
use Filament\Forms\Components\CodeEditor;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

/**
 * 舟驿图床 - 
 * 
 * @author karl
 * @version 1.0.0
 */
class KarlTheme extends ThemeAbstract
{
    public string $id = 'karl';
    public string $name = '舟驿图床';
    public ?string $description = '';
    public string $author = 'karl';
    public string $version = '1.0.0';
    public ?string $url = '';

    public function routes(): void
    {
        // 示例直接访问视图
        // Route::get('/', fn () => view("{$this->id}::pages.index"));

        // 示例：定义一个首页路由
        // Route::get('/', [YourController::class, 'index']);
        
        // 如果你的主题是单页应用（SPA），可以这样配置：
        // Route::any('/{any}', [YourController::class, 'index'])->where('any', '^(?!api).*');
    }

    public function configurable(): array
    {
        return [
            Tabs::make()->schema([
                Tabs\Tab::make('基础设置')->schema([
                    Section::make('网站信息')->schema([
                        Grid::make()->columns(2)->schema([
                            $this->getSiteTitleField(),
                            $this->getSiteSubtitleField(),
                        ]),
                        $this->getSiteDescriptionField(),
                        $this->getSiteKeywordsField(),
                    ])->contained(false),
                    
                    Section::make('品牌设置')->schema([
                        $this->getLogoField(),
                        $this->getFaviconField(),
                    ])->contained(false),
                ]),
                
                Tabs\Tab::make('外观设置')->schema([
                    Section::make('颜色配置')->schema([
                        Grid::make()->columns(3)->schema([
                            $this->getPrimaryColorField(),
                            $this->getSecondaryColorField(),
                            $this->getAccentColorField(),
                        ]),
                    ])->contained(false),
                    
                    Section::make('布局设置')->schema([
                        Grid::make()->columns(2)->schema([
                            $this->getLayoutTypeField(),
                            $this->getSidebarPositionField(),
                        ]),
                        $this->getEnableFixedHeaderField(),
                    ])->contained(false),
                    
                    Section::make('背景设置')->schema([
                        $this->getBackgroundImageField(),
                        $this->getBackgroundColorField(),
                    ])->contained(false),
                ]),
                
                Tabs\Tab::make('功能设置')->schema([
                    Section::make('功能开关')->schema([
                        Grid::make()->columns(2)->schema([
                            $this->getEnableSearchField(),
                            $this->getEnableCommentsField(),
                            $this->getEnableDarkModeField(),
                            $this->getEnableAnimationsField(),
                        ]),
                    ])->contained(false),
                ]),
                
                Tabs\Tab::make('高级设置')->schema([
                    Section::make('自定义代码')->schema([
                        $this->getCustomCssField(),
                        $this->getCustomJsField(),
                        $this->getCustomHeaderField(),
                    ])->contained(false),
                ]),
            ])
        ];
    }

    public function casts(): array
    {
        return [
            'logo_url' => new Attribute(
                get: fn($value) => $value ? Storage::url($value) : ''
            ),
            'favicon_url' => new Attribute(
                get: fn($value) => $value ? Storage::url($value) : ''
            ),
            'background_image' => new Attribute(
                get: fn($value) => $value ? Storage::url($value) : ''
            ),
        ];
    }

    // 基础字段
    protected function getSiteTitleField(): TextInput
    {
        return TextInput::make('payload.site_title')
            ->label('网站标题')
            ->maxLength(100)
            ->required();
    }

    protected function getSiteSubtitleField(): TextInput
    {
        return TextInput::make('payload.site_subtitle')
            ->label('网站副标题')
            ->maxLength(100);
    }

    protected function getSiteDescriptionField(): Textarea
    {
        return Textarea::make('payload.site_description')
            ->label('网站描述')
            ->maxLength(500)
            ->rows(3);
    }

    protected function getSiteKeywordsField(): TextInput
    {
        return TextInput::make('payload.site_keywords')
            ->label('网站关键词')
            ->helperText('多个关键词用英文逗号分隔')
            ->maxLength(200);
    }

    // 品牌字段
    protected function getLogoField(): FileUpload
    {
        return FileUpload::make('payload.logo_url')
            ->label('网站Logo')
            ->image()
            ->maxSize(2048)
            ->helperText('建议尺寸：200x60px，支持PNG、JPG格式');
    }

    protected function getFaviconField(): FileUpload
    {
        return FileUpload::make('payload.favicon_url')
            ->label('网站图标')
            ->image()
            ->maxSize(512)
            ->helperText('建议尺寸：32x32px或16x16px');
    }

    // 颜色字段
    protected function getPrimaryColorField(): ColorPicker
    {
        return ColorPicker::make('payload.primary_color')
            ->label('主色调')
            ->default('#3b82f6');
    }

    protected function getSecondaryColorField(): ColorPicker
    {
        return ColorPicker::make('payload.secondary_color')
            ->label('辅色调')
            ->default('#64748b');
    }

    protected function getAccentColorField(): ColorPicker
    {
        return ColorPicker::make('payload.accent_color')
            ->label('强调色')
            ->default('#f59e0b');
    }

    // 布局字段
    protected function getLayoutTypeField(): Select
    {
        return Select::make('payload.layout_type')
            ->label('布局类型')
            ->options([
                'wide' => '宽屏布局',
                'container' => '容器布局',
                'full' => '全屏布局',
            ])
            ->default('container');
    }

    protected function getSidebarPositionField(): Select
    {
        return Select::make('payload.sidebar_position')
            ->label('侧边栏位置')
            ->options([
                'left' => '左侧',
                'right' => '右侧',
                'none' => '无侧边栏',
            ])
            ->default('right');
    }

    protected function getEnableFixedHeaderField(): Toggle
    {
        return Toggle::make('payload.enable_fixed_header')
            ->label('固定顶部导航')
            ->default(true);
    }

    // 背景字段
    protected function getBackgroundImageField(): FileUpload
    {
        return FileUpload::make('payload.background_image')
            ->label('背景图片')
            ->image()
            ->maxSize(5120);
    }

    protected function getBackgroundColorField(): ColorPicker
    {
        return ColorPicker::make('payload.background_color')
            ->label('背景颜色')
            ->default('#ffffff');
    }

    // 功能开关字段
    protected function getEnableSearchField(): Toggle
    {
        return Toggle::make('payload.enable_search')
            ->label('启用搜索功能')
            ->default(true);
    }

    protected function getEnableCommentsField(): Toggle
    {
        return Toggle::make('payload.enable_comments')
            ->label('启用评论功能')
            ->default(false);
    }

    protected function getEnableDarkModeField(): Toggle
    {
        return Toggle::make('payload.enable_dark_mode')
            ->label('启用暗色模式')
            ->default(false);
    }

    protected function getEnableAnimationsField(): Toggle
    {
        return Toggle::make('payload.enable_animations')
            ->label('启用动画效果')
            ->default(true);
    }

    // 自定义代码字段
    protected function getCustomCssField(): CodeEditor
    {
        return CodeEditor::make('payload.custom_css')
            ->label('自定义CSS')
            ->language(CodeEditor\Enums\Language::Css)
            ->helperText('在这里添加你的自定义CSS样式')
            ->columnSpanFull();
    }

    protected function getCustomJsField(): CodeEditor
    {
        return CodeEditor::make('payload.custom_js')
            ->label('自定义JavaScript')
            ->language(CodeEditor\Enums\Language::JavaScript)
            ->helperText('在这里添加你的自定义JavaScript代码')
            ->columnSpanFull();
    }

    protected function getCustomHeaderField(): Textarea
    {
        return Textarea::make('payload.custom_header')
            ->label('自定义头部代码')
            ->helperText('会插入到<head>标签中，可以添加统计代码等')
            ->rows(5)
            ->columnSpanFull();
    }

    // 辅助方法
    protected function getConfig(string $key, mixed $default = null): mixed
    {
        return $this->getSettings($key, $default);
    }

    protected function getRawConfig(string $key, mixed $default = null): mixed
    {
        return $this->getRawSettings($key, $default);
    }
}