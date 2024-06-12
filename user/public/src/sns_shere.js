document.addEventListener('DOMContentLoaded', function() {
    const snsModal = document.getElementById('sns-share-modal');
    const closeBtn = snsModal.querySelector('.close');
    const copyBtn = document.getElementById('copy-link');
    const shareLinkInput = document.getElementById('share-link');
    const messageTextElement = document.getElementById('message-text');
    const threadId = document.getElementById('thread-id').value;
    let selectedMessageId = null;
    let selectedMessageText = null;

    document.querySelectorAll('.share-button').forEach(button => {
        button.addEventListener('click', function() {
            const messageElement = this.closest('.message');
            selectedMessageId = messageElement.getAttribute('data-message-id');
            selectedMessageText = messageElement.getAttribute('data-message-text');
            
            messageTextElement.textContent = selectedMessageText;
            const shareLink = `${window.location.origin}/8channel/user/public/thread_detail.php?thread_id=${threadId}`;
            shareLinkInput.value = shareLink;
            snsModal.style.display = 'block';

            document.getElementById('share-twitter').href = `https://twitter.com/intent/tweet?url=${encodeURIComponent(shareLink)}&text=${encodeURIComponent(selectedMessageText)}`;
            document.getElementById('share-line').href = `https://social-plugins.line.me/lineit/share?url=${encodeURIComponent(shareLink)}&text=${encodeURIComponent(selectedMessageText)}`;
            document.getElementById('share-discord').href = `https://discordapp.com/channels/@me?url=${encodeURIComponent(shareLink)}&text=${encodeURIComponent(selectedMessageText)}`;
        });
    });

    closeBtn.addEventListener('click', function() {
        snsModal.style.display = 'none';
    });

    window.addEventListener('click', function(event) {
        if (event.target == snsModal) {
            snsModal.style.display = 'none';
        }
    });

    copyBtn.addEventListener('click', function() {
        shareLinkInput.select();
        document.execCommand('copy');
        alert('リンクがコピーされました');
    });
});
