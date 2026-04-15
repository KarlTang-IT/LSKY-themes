// 主题JavaScript文件
console.log('主题已加载');

// 示例：暗色模式切换
function toggleDarkMode() {
    document.body.classList.toggle('dark-mode');
    localStorage.setItem('darkMode', document.body.classList.contains('dark-mode'));
}

// 页面加载完成后执行
document.addEventListener('DOMContentLoaded', function() {
    // 恢复暗色模式设置
    if (localStorage.getItem('darkMode') === 'true') {
        document.body.classList.add('dark-mode');
    }
});
