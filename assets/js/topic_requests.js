

function openChat() {
    document.getElementById('chatContainer').style.display = 'block';
}

function closeChat() {
    document.getElementById('chatContainer').style.display = 'none';
}

function sendMessage() {
    const input = document.getElementById('chatInput');
    const message = input.value;
    if (message.trim() === '') return;

    // Add user's message to chat body
    const chatBody = document.getElementById('chat-content');
    const userMessage = document.createElement('div');
    userMessage.className = 'media media-chat media-chat-reverse';
    userMessage.innerHTML = `
        <div class="media-body">
            <p>${message}</p>
            <p class="meta"><time datetime="2018">${new Date().toLocaleTimeString()}</time></p>
        </div>
    `;
    chatBody.appendChild(userMessage);

    // Clear the input field
    input.value = '';

    // Scroll to the bottom of the chat body
    chatBody.scrollTop = chatBody.scrollHeight;

    // Create the request payload in the specified format
    const payload = {
        query: message
    };

    // Make the API call
    fetch('https://dela-xw5ne3ehqq-uc.a.run.app/chat?Content-Type=application/json', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(payload)
    })
    .then(response => response.text())  // Get the response text
    .then(text => {
        console.log('Response text:', text);  // Log the response text
        const botMessage = document.createElement('div');
        botMessage.className = 'media media-chat';
        botMessage.innerHTML = `
            <div class="media-body">
                <p>${text}</p>
                <p class="meta"><time datetime="2018">${new Date().toLocaleTimeString()}</time></p>
            </div>
        `;
        chatBody.appendChild(botMessage);

        // Scroll to the bottom of the chat body
        chatBody.scrollTop = chatBody.scrollHeight;
    })
    .catch(error => {
        console.error('Error:', error);
        // Handle errors (optional)
        const errorMessage = document.createElement('div');
        errorMessage.className = 'media media-chat';
        errorMessage.innerHTML = `
            <div class="media-body">
                <p>Sorry, something went wrong. Please try again.</p>
                <p class="meta"><time datetime="2018">${new Date().toLocaleTimeString()}</time></p>
            </div>
        `;
        chatBody.appendChild(errorMessage);

        // Scroll to the bottom of the chat body
        chatBody.scrollTop = chatBody.scrollHeight;
    });
}






document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.list-group-item').forEach(function (item, index) {
        var link = item.querySelector('a');
        link.addEventListener('click', function (event) {
            // If the content is "quiz", do not prevent default action
            if (this.dataset.content.toLowerCase() === 'quiz') {
                return;
            }

            event.preventDefault();
            updateContent(this.dataset.sectionId, this.dataset.content, item);
        });

        if (index === 0) {
            link.click();
        }
    });
});