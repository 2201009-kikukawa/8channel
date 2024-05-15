// server.js

const express = require('express');
const app = express();
const port = 3000;

// データベースの代わりに配列を使用しますが、実際にはデータベースに接続してください。
const users = [
    {
        id: 1,
        name: '鈴木太郎',
        email: 'suzukitaro@example.com'
    },
    {
        id: 2,
        name: '佐藤二郎',
        email: 'satoujiro@example.com'
    },
    {
        id: 3,
        name: '田中三郎',
        email: 'tanakasaburo@example.com'
    },
    {
        id: 4,
        name: '山本四郎',
        email: 'yamamotoshiro@example.com'
    },
    {
        id: 5,
        name: '高橋五郎',
        email: 'takahashigoro@example.com'
    },
];

// 全てのユーザー情報を返すエンドポイント
app.get('/api/users', (req, res) => {
    res.json(users);
});

app.listen(port, () => {
    console.log(`Server is running on port ${port}`);
});
