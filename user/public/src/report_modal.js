document.addEventListener('DOMContentLoaded', (event) => {
    const modal = document.getElementById('report-modal');
    const span = document.getElementsByClassName('close')[0];
    const reportButtons = document.querySelectorAll('.report-button');
    const reportForm = document.getElementById('report-form');
    const reportedUserNameHeader = document.getElementById('reported-user-name'); // ユーザー名を表示する要素を取得する

    span.onclick = function() {
        modal.style.display = 'none';
    }

    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = 'none';
        }
    }

    reportForm.addEventListener('submit', (event) => {
        event.preventDefault();
        const formData = new FormData(reportForm);
        fetch('report.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('報告が送信されました。');
            } else {
                alert('報告の送信に失敗しました: ' + data.message);
            }
            modal.style.display = 'none';
        })
        .catch(error => {
            console.error('Error:', error);
            alert('報告の送信に失敗しました。');
            modal.style.display = 'none';
        });
    });

    reportButtons.forEach(button => {
        button.addEventListener('click', (event) => {
            modal.style.display = 'block';
            const userId = event.target.getAttribute('data_user_id');
            const userName = event.target.getAttribute('data_user_name');
            const reportUserIdInput = document.getElementById('report_user_id');
            // ユーザー名を表示する要素にユーザー名を挿入する
            reportedUserNameHeader.textContent = `このアカウントを報告します: ${userName}`;
            
            reportUserIdInput.value = userId;
            
        });
    });
});