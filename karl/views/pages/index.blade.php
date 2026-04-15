@extends('karl::layouts.app')

@section('title', '首页')
@section('page-title', '欢迎访问')

@section('content')
<div class="welcome-section">
    <h2>欢迎使用主题</h2>
    <p>这是一个示例页面，你可以根据需要修改内容。</p>
</div>

<div class="features-section">
    <h3>主要功能</h3>
    <ul>
        <li>功能1</li>
        <li>功能2</li>
        <li>功能3</li>
    </ul>
</div>
@endsection

@push('styles')
<style>
.welcome-section {
    text-align: center;
    padding: 2rem 0;
}

.features-section {
    margin-top: 2rem;
}

.features-section ul {
    list-style-type: none;
    padding: 0;
}

.features-section li {
    padding: 0.5rem;
    margin: 0.5rem 0;
    background-color: #f8fafc;
    border-radius: 4px;
}
</style>
@endpush
