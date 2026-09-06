

function loadContacts() {

    const list = document.getElementById('contactList');

    if (!list) return;

    list.innerHTML = '';

    contacts.forEach(contact => {

        const div = document.createElement('div');

        div.className =
            "flex items-center p-3 mx-2 rounded-lg hover:bg-pink-100 cursor-pointer transition";

        div.onclick = () => selectContact(contact);

        div.innerHTML = `
            <div class="relative">

                <img
                    src="https://ui-avatars.com/api/?name=${contact.img}&background=E91E63&color=fff"
                    class="w-12 h-12 rounded-full"
                >

                <span
                    class="absolute bottom-0 right-0 w-3 h-3 bg-green-500 border-2 border-white rounded-full">
                </span>

            </div>

            <div class="ml-3">

                <p class="font-semibold text-slate-800 text-sm">
                    ${contact.name}
                </p>

                <p class="text-[10px] text-slate-500">
                    ${contact.role}
                </p>

            </div>
        `;

        list.appendChild(div);

    });

}

function selectContact(contact) {

    const name =
        document.getElementById('chat-name');

    const avatar =
        document.getElementById('headerAvatar');

    if (name) {
        name.innerText = contact.name;
    }

    if (avatar) {
        avatar.src =
            `https://ui-avatars.com/api/?name=${contact.img}&background=E91E63&color=fff`;
    }

}

// ======================
// PAGE LOADED
// ======================

document.addEventListener('DOMContentLoaded', function () {

    loadContacts();

    // ======================
    // SEND MESSAGE
    // ======================

    const form =
        document.getElementById('message-form');

    // Do NOT use e.preventDefault()
    // Laravel will handle form submission

    // ======================
    // INFO SIDEBAR
    // ======================

    const infoBtn =
        document.getElementById('infoBtn');

    const infoPanel =
        document.getElementById('infoPanel');

    const closeBtn =
        document.getElementById('closeInfoPanel');

    if (infoBtn && infoPanel) {

        infoBtn.addEventListener('click', function () {

            infoPanel.style.right = "0";

        });

    }

    if (closeBtn && infoPanel) {

        closeBtn.addEventListener('click', function () {

            infoPanel.style.right = "-350px";

        });

    }

    // ======================
    // SEARCH MESSAGES
    // ======================

    const searchMessages =
        document.getElementById('searchMessages');

    if (searchMessages) {

        searchMessages.addEventListener('keyup', function () {

            const value =
                this.value.toLowerCase();

            document
                .querySelectorAll('.message-text')
                .forEach(message => {

                    const wrapper =
                        message.closest('.message-wrapper');

                    if (!wrapper) return;

                    const match =
                        message.innerText
                            .toLowerCase()
                            .includes(value);

                    wrapper.style.display =
                        match ? 'block' : 'none';

                });

        });

    }

});


document.addEventListener('DOMContentLoaded', function () {

    // ======================
    // EMOJI PICKER
    // ======================

    const emojiContainer =
        document.getElementById('emojiPickerContainer');

    const quickReactions =
        document.getElementById('quickReactions');

    const editReactionsBtn =
        document.getElementById('editReactionsBtn');

    const emojiModal =
        document.getElementById('emojiModal');

    const closeEmojiModal =
        document.getElementById('closeEmojiModal');

    const saveReactionsBtn =
        document.getElementById('saveReactions');

    let selectedReactions = [];
    let editingReactionIndex = null;

    // ======================
    // RENDER REACTIONS
    // ======================

    function renderReactions() {

        if (!quickReactions) return;

        quickReactions.innerHTML = '';

        selectedReactions.forEach((emoji, index) => {

            quickReactions.innerHTML += `
                <button
                    class="reaction-btn text-2xl hover:scale-125 transition"
                    data-index="${index}">
                    ${emoji}
                </button>
            `;

        });

        document
            .querySelectorAll('.reaction-btn')
            .forEach(btn => {

                btn.addEventListener('click', function () {

                    editingReactionIndex =
                        Number(this.dataset.index);

                    emojiModal.classList.remove('hidden');

                });

            });

    }

    // ======================
    // LOAD SAVED REACTIONS
    // ======================

    const saved =
        localStorage.getItem('quickReactions');

    if (saved) {

        selectedReactions =
            JSON.parse(saved);

        renderReactions();

    }

    // ======================
    // CREATE EMOJI PICKER
    // ======================

    if (
        typeof EmojiMart !== 'undefined' &&
        emojiContainer
    ) {

        const picker = new EmojiMart.Picker({

            theme: 'light',

            previewPosition: 'none',

            onEmojiSelect: function (emoji) {

                // Edit existing emoji

                if (
                    editingReactionIndex !== null
                ) {

                    selectedReactions[
                        editingReactionIndex
                    ] = emoji.native;

                    editingReactionIndex = null;

                    return;

                }

                // Add new emoji

                if (
                    selectedReactions.length >= 5
                ) {

                    alert(
                        'Maximum of 5 quick reactions'
                    );

                    return;

                }

                selectedReactions.push(
                    emoji.native
                );

            }

        });

        emojiContainer.appendChild(
            picker
        );

    }

    // ======================
    // OPEN MODAL
    // ======================

    if (
        editReactionsBtn &&
        emojiModal
    ) {

        editReactionsBtn.addEventListener(
            'click',
            function () {

                editingReactionIndex = null;

                emojiModal.classList.remove(
                    'hidden'
                );

            }
        );

    }

    // ======================
    // CLOSE MODAL
    // ======================

    if (
        closeEmojiModal &&
        emojiModal
    ) {

        closeEmojiModal.addEventListener(
            'click',
            function () {

                emojiModal.classList.add(
                    'hidden'
                );

            }
        );

    }

    // ======================
    // SAVE REACTIONS
    // ======================

    if (
        saveReactionsBtn &&
        quickReactions
    ) {

        saveReactionsBtn.addEventListener(
            'click',
            function () {

                renderReactions();

                localStorage.setItem(
                    'quickReactions',
                    JSON.stringify(
                        selectedReactions
                    )
                );

                emojiModal.classList.add(
                    'hidden'
                );

            }
        );

    }

});



//// ======================
// ATTACHMENT MENU
// ======================

document.addEventListener('DOMContentLoaded', function () {

    const attachmentBtn =
        document.getElementById('attachmentBtn');

    const attachmentMenu =
        document.getElementById('attachmentMenu');

    const uploadImageBtn =
        document.getElementById('uploadImageBtn');

    const uploadFileBtn =
        document.getElementById('uploadFileBtn');

    const imageUpload =
        document.getElementById('imageUpload');

    const fileUpload =
        document.getElementById('fileUpload');

    const messagesContainer =
        document.getElementById('messages-container');

    // Open / Close Attachment Menu

    if (
        attachmentBtn &&
        attachmentMenu
    ) {

        attachmentBtn.addEventListener(
            'click',
            function (e) {

                e.stopPropagation();

                attachmentMenu.classList.toggle(
                    'hidden'
                );

            }
        );

    }

    // Close menu when clicking outside

    document.addEventListener(
        'click',
        function () {

            if (attachmentMenu) {

                attachmentMenu.classList.add(
                    'hidden'
                );

            }

        }
    );

    // ======================
    // IMAGE UPLOAD
    // ======================

    if (
        uploadImageBtn &&
        imageUpload
    ) {

        uploadImageBtn.addEventListener(
            'click',
            function () {

                imageUpload.click();

            }
        );

    }

    if (
        imageUpload &&
        messagesContainer
    ) {

        imageUpload.addEventListener(
            'change',
            function () {

                const file =
                    this.files[0];

                if (!file) return;

                const reader =
                    new FileReader();

                reader.onload =
                    function (e) {

                        messagesContainer.innerHTML += `
                            <div class="flex justify-end mb-4">
                                <img
                                    src="${e.target.result}"
                                    class="max-w-[250px] rounded-2xl shadow-md">
                            </div>
                        `;

                        messagesContainer.scrollTop =
                            messagesContainer.scrollHeight;

                    };

                reader.readAsDataURL(file);

            }
        );

    }

    // ======================
    // FILE UPLOAD
    // ======================

    if (
        uploadFileBtn &&
        fileUpload
    ) {

        uploadFileBtn.addEventListener(
            'click',
            function () {

                fileUpload.click();

            }
        );

    }

    if (
        fileUpload &&
        messagesContainer
    ) {

        fileUpload.addEventListener(
            'change',
            function () {

                const file =
                    this.files[0];

                if (!file) return;

                messagesContainer.innerHTML += `
                    <div class="flex justify-end mb-4">
                        <div class="bg-white border border-gray-200 rounded-xl px-4 py-3 shadow flex items-center gap-3">
                            <i class="fa-regular fa-file text-pink-500"></i>
                            <span>${file.name}</span>
                        </div>
                    </div>
                `;

                messagesContainer.scrollTop =
                    messagesContainer.scrollHeight;

            }
        );

    }

});

// ======================
// PROFILE & NOTIFICATIONS
// ======================

document.addEventListener('DOMContentLoaded', function () {

    const profileBtn =
        document.getElementById("profileBtn");

    const profileMenu =
        document.getElementById("profileMenu");

    const notificationBtn =
        document.getElementById("notificationBtn");

    const notificationDropdown =
        document.getElementById("notificationDropdown");

    // ======================
    // PROFILE DROPDOWN
    // ======================

    if (profileBtn && profileMenu) {

        profileBtn.addEventListener(
            "click",
            function (e) {

                e.stopPropagation();

                profileMenu.classList.toggle(
                    "hidden"
                );

            }
        );

    }

    // ======================
    // NOTIFICATION DROPDOWN
    // ======================

    if (
        notificationBtn &&
        notificationDropdown
    ) {

        notificationBtn.addEventListener(
            "click",
            function (e) {

                e.preventDefault();

                e.stopPropagation();

                notificationDropdown
                    .classList.toggle(
                        "hidden"
                    );

                const token =
                    document.querySelector(
                        'meta[name="csrf-token"]'
                    );

                if (token) {

                    fetch(
                        '/notifications/read-all',
                        {
                            method: 'POST',

                            headers: {

                                'X-CSRF-TOKEN':
                                    token.content,

                                'Accept':
                                    'application/json'

                            }

                        }
                    )
                    .catch(error => {

                        console.error(
                            error
                        );

                    });

                }

            }
        );

    }

    // ======================
    // CLOSE DROPDOWNS
    // ======================

    document.addEventListener(
        "click",
        function (e) {

            if (
                profileBtn &&
                profileMenu &&
                !profileBtn.contains(
                    e.target
                ) &&
                !profileMenu.contains(
                    e.target
                )
            ) {

                profileMenu.classList.add(
                    "hidden"
                );

            }

            if (
                notificationBtn &&
                notificationDropdown &&
                !notificationBtn.contains(
                    e.target
                ) &&
                !notificationDropdown.contains(
                    e.target
                )
            ) {

                notificationDropdown
                    .classList.add(
                        "hidden"
                    );

            }

        }
    );

});

function toggleMenu(id)
{
    // Close all menus first
    document
        .querySelectorAll('[id^="menu-"]')
        .forEach(menu => {

            if (menu.id !== 'menu-' + id)
            {
                menu.classList.add('hidden');
            }

        });

    // Open/close clicked menu
    const currentMenu =
        document.getElementById(
            'menu-' + id
        );

    if (currentMenu)
    {
        currentMenu.classList.toggle(
            'hidden'
        );
    }
}

function toggleReactionMenu(id)
{
    document
        .getElementById(
            'reaction-menu-' + id
        )
        .classList
        .toggle('hidden');
}

//emojie Marked
function testReaction(emoji)
{
    const reactionArea =
        document.getElementById(
            'message-reaction-' +
            currentMessageId
        );

    if (!reactionArea) return;

    // If same emoji clicked, remove it
    if (reactionArea.innerHTML === emoji)
    {
        reactionArea.innerHTML = '';
    }
    else
    {
        reactionArea.innerHTML = emoji;
    }
}



function toggleReactionMenu(id)
{
    currentMessageId = id;

    const menu =
        document.getElementById(
            'reaction-menu-' + id
        );

    menu.classList.toggle('hidden');

    menu.innerHTML = '';

    document
        .querySelectorAll('.reaction-btn')
        .forEach(button => {

            const clone =
                button.cloneNode(true);

            clone.onclick = function ()
            {
                testReaction(
                    this.innerText
                );
            };

            menu.appendChild(clone);

        });
}

function replyToMessage(messageId, messageText)
{
    document
        .getElementById('reply_to')
        .value = messageId;

    document
        .getElementById('reply-text')
        .innerText = messageText;

    document
        .getElementById('reply-preview')
        .classList
        .remove('hidden');

    document
        .getElementById('msg-input')
        .focus();
}

function cancelReply()
{
    document.getElementById('reply_to').value = '';

    document.getElementById('reply-text').innerText = '';

    document.getElementById('reply-preview')
        .classList.add('hidden');
}


//Edit button
function editMessage(id, message)
{
    document.getElementById(
        'msg-input'
    ).value = message;

    document.getElementById(
        'edit_message_id'
    ).value = id;

    document.getElementById(
        'msg-input'
    ).focus();

    document.getElementById(
        'menu-' + id
    ).classList.add('hidden');
}


//Customize Theme

function changeThemeColor(color)
{
    document
        .querySelectorAll('.chat-bubble')
        .forEach(bubble => {

            bubble.style.backgroundColor =
                color;
        });
}


//Background assigning color
function changeBackground(theme)
{
    const container =
        document.getElementById(
            'messages-container'
        );

    container.style.backgroundImage =
        `url('/images/chat-themes/${theme}.jpg')`;

    if(theme === 'beach')
    {
        changeTheme('blue');
    }

    if(theme === 'forest')
    {
        changeTheme('green');
    }

    if(theme === 'hearts')
    {
        changeTheme('pink');
    }

    if(theme === 'sunset')
    {
        changeTheme('red');
    }
}
//Remember Theme

window.addEventListener(
    'load',
    function ()
    {
        const theme =
            localStorage.getItem(
                'chatTheme'
            );

        if (theme)
        {
            changeTheme(theme);
        }
    }
);


//Image Upload Background
document
.getElementById('backgroundUpload')
.addEventListener('change', function(e)
{
    const file = e.target.files[0];

    if (!file) return;

    const reader = new FileReader();

    reader.onload = function(event)
    {
        const imageData =
            event.target.result;

        const container =
            document.getElementById(
                'messages-container'
            );

        container.style.backgroundImage =
            `url('${imageData}')`;

        container.style.backgroundSize =
            'cover';

        container.style.backgroundPosition =
            'center';

        localStorage.setItem(
            'customBackground',
            imageData
        );

        autoThemeFromImage(
            imageData
        );
    };

    reader.readAsDataURL(file);

});

//Background After refresh
window.addEventListener('load', function()
{
    const savedBackground =
        localStorage.getItem(
            'customBackground'
        );

    if (savedBackground)
    {
        const container =
            document.getElementById(
                'messages-container'
            );

        container.style.backgroundImage =
            `url('${savedBackground}')`;

        container.style.backgroundSize =
            'cover';

        container.style.backgroundPosition =
            'center';
    }
});




function autoThemeFromImage(imageSrc)
{
    const img = new Image();

    img.onload = function()
    {
        const canvas =
            document.createElement('canvas');

        const ctx =
            canvas.getContext('2d');

        canvas.width = img.width;
        canvas.height = img.height;

        ctx.drawImage(
            img,
            0,
            0
        );

        let totalR = 0;
        let totalG = 0;
        let totalB = 0;

        let count = 0;

        for(let x = 0; x < img.width; x += 50)
        {
            for(let y = 0; y < img.height; y += 50)
            {
                const pixel =
                    ctx.getImageData(
                        x,
                        y,
                        1,
                        1
                    ).data;

                totalR += pixel[0];
                totalG += pixel[1];
                totalB += pixel[2];

                count++;
            }
        }

        const r =
            Math.floor(totalR / count);

        const g =
            Math.floor(totalG / count);

        const b =
            Math.floor(totalB / count);

        const color =
            `rgb(${r}, ${g}, ${b})`;

        localStorage.setItem(
        'chatThemeColor',
        color
    );
        changeThemeColor(
            color
        );
    };

    img.src = imageSrc;
}


window.addEventListener(
    'load',
    function ()
    {
        const savedColor =
            localStorage.getItem(
                'chatThemeColor'
            );

        if(savedColor)
        {
            changeThemeColor(
                savedColor
            );
        }
    }
);


//Unsend code
let currentMessageId = null;

function openUnsendModal(messageId)
{
    currentMessageId = messageId;

    document
        .getElementById('unsendModal')
        .classList.remove('hidden');
}

function closeUnsendModal()
{
    document
        .getElementById('unsendModal')
        .classList.add('hidden');
}

function submitUnsend()
{
    console.log('SUBMIT UNSEND RUNNING');

    const option =
        document.querySelector(
            'input[name="delete_option"]:checked'
        ).value;

    console.log('OPTION:', option);

    const form =
        document.getElementById(
            'unsendForm'
        );

    console.log('FORM:', form);

    document.getElementById(
        'unsendType'
    ).value = option;

    form.action =
        `/messages/${currentMessageId}/unsend`;

    console.log('ACTION:', form.action);

    form.submit();

    return false;
}
