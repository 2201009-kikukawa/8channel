
document.getElementById('addButton').addEventListener('click', function() {
    // テキストボックスを追加するためのdiv要素を取得
    var container = document.getElementById('container');

    // 新しいinput要素を作成
    var input = document.createElement('input');
    input.type = 'text';
    input.className = 'textbox';

    // コンテナに新しいinput要素を追加
    container.appendChild(input);
});


