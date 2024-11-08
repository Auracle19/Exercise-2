document.addEventListener('DOMContentLoaded', () => {
    document.querySelector('.submit-global-comment').addEventListener('click', () => {
        const commentText = document.querySelector('.global-comments textarea').value.trim();
        if (commentText) {
            const globalCommentList = document.querySelector('.global-comment-list');
            const newComment = document.createElement('div');
            newComment.classList.add('global-comment');
            newComment.textContent = commentText;
            globalCommentList.appendChild(newComment);
            document.querySelector('.global-comments textarea').value = ''; 
        }
    });

    document.querySelectorAll('.card').forEach(card => {
        card.addEventListener('click', () => {
            document.querySelectorAll('.card').forEach(c => c.classList.remove('clicked'));
            card.classList.add('clicked');
        });
    });
});