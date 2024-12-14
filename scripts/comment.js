//Function Dropdown Profil
function toggleDropdown() {
    document.getElementById("dropdown").classList.toggle("show");
    }

    window.onclick = function(event) {
        if (!event.target.matches('.profile-pic-small')) {
            var dropdowns = document.getElementsByClassName("dropdown-content");
            for (var i = 0; i < dropdowns.length; i++) {
                var openDropdown = dropdowns[i];
                if (openDropdown.classList.contains('show')) {
                    openDropdown.classList.remove('show');
                    }
            }
        }
    }



document.addEventListener("DOMContentLoaded", () => {
    // Getting references to necessary elements
    const commentsSection = document.querySelector('.comments-section');
    const commentInput = document.getElementById('commentInput');
    const submitCommentBtn = document.getElementById('submitCommentBtn');

    // Function to create a new comment box
    function createCommentBox(content) {
        const commentBox = document.createElement('div');
        commentBox.classList.add('comment-box');

        const commentHeader = document.createElement('div');
        commentHeader.classList.add('comment-header');

        const userImg = document.createElement('img');
        userImg.src = 'https://via.placeholder.com/40';
        userImg.alt = 'User Icon';

        const userName = document.createElement('span');
        userName.textContent = 'Anonymous';

        commentHeader.appendChild(userImg);
        commentHeader.appendChild(userName);

        const commentContent = document.createElement('div');
        commentContent.classList.add('comment-content');
        commentContent.textContent = content;

        const commentFooter = document.createElement('div');
        commentFooter.classList.add('comment-footer');
        const likeCount = document.createElement('span');
        likeCount.classList.add('like-count');
        likeCount.innerHTML = '0 <button class="thumb-up">👍</button>';

        commentFooter.appendChild(likeCount);

        commentBox.appendChild(commentHeader);
        commentBox.appendChild(commentContent);
        commentBox.appendChild(commentFooter);

        // Append new comment to comments section
        commentsSection.appendChild(commentBox);
    }

    // Add event listener for the submit button
    submitCommentBtn.addEventListener('click', () => {
        const commentText = commentInput.value.trim();

        if (commentText) {
            createCommentBox(commentText);
            commentInput.value = '';  // Clear the textarea after posting
        } else {
            console.log("Comment field is empty.");
        }
    });
});
