  function togglePass(id, icon) {
        const p = document.getElementById(id);
        if (p.type === "password") {
            p.type = "text";
            icon.innerText = "🙈";
        } else {
            p.type = "password";
            icon.innerText = "👁️";
        }
    }

    function previewImage(event) {
        if(event.target.files && event.target.files[0]) {
            document.getElementById('preview').src = URL.createObjectURL(event.target.files[0]);
        }
    }

    function save() {
        const btn = document.getElementById('saveBtn');
        btn.innerText = "Saving...";
        btn.disabled = true;
        setTimeout(() => {
            btn.innerText = "Changes Saved!";
            btn.style.background = "#10B981";
            setTimeout(() => {
                btn.innerText = "Save Changes";
                btn.disabled = false;
                btn.style.background = "#E91E63";
            }, 2000);
        }, 1000);
    }

    function confirmDelete() {
        if(confirm("Are you sure you want to permanently delete your account?")) {
            alert("Account deleted.");
        }
    }

    function previewImage(event) {
    const preview = document.getElementById('preview');

    if (event.target.files.length > 0) {
        preview.src = URL.createObjectURL(event.target.files[0]);
    }
}


function togglePass(id) {
    const input = document.getElementById(id);

    if (input.type === "password") {
        input.type = "text";
    } else {
        input.type = "password";
    }
}


const password = document.getElementById("newPass");
const checker = document.getElementById("passwordChecker");

password.addEventListener("input", function () {

    const value = password.value;

    // Hide checker if password is empty
    if(value.trim() === ""){
        checker.style.display = "none";
        return;
    }

    // Show checker
    checker.style.display = "block";

    const length = value.length >= 8;
    const upper = /[A-Z]/.test(value);
    const lower = /[a-z]/.test(value);
    const number = /[0-9]/.test(value);
    const special = /[^A-Za-z0-9]/.test(value);

    updateRule("length", length);
    updateRule("uppercase", upper);
    updateRule("lowercase", lower);
    updateRule("number", number);
    updateRule("special", special);

    let score = 0;

    if(length) score++;
    if(upper) score++;
    if(lower) score++;
    if(number) score++;
    if(special) score++;

    const strength = document.getElementById("strengthText");

    if(score <= 2){
        strength.textContent = "Weak";
        strength.className = "weak";
    }
    else if(score <= 4){
        strength.textContent = "Medium";
        strength.className = "medium";
    }
    else{
        strength.textContent = "Strong";
        strength.className = "strong";
    }

});

function updateRule(id, valid){

    const item = document.getElementById(id);

    const text = {
        length:"At least 8 characters",
        uppercase:"One uppercase letter",
        lowercase:"One lowercase letter",
        number:"One number",
        special:"One special character"
    };

    item.innerHTML = (valid ? "✅ " : "❌ ") + text[id];
    item.className = valid ? "valid" : "invalid";
}


const newPass = document.getElementById("newPass");
const confPass = document.getElementById("confPass");
const confirmError = document.getElementById("confirmError");

function validateConfirmPassword() {

    if (confPass.value === "") {

        confirmError.style.display = "none";

        confPass.classList.remove("password-error");
        confPass.classList.remove("password-success");

        return;
    }

    if (newPass.value === confPass.value) {

        confirmError.style.display = "block";
        confirmError.style.color = "#16a34a";
        confirmError.innerHTML = "✔ Passwords match";

        confPass.classList.remove("password-error");
        confPass.classList.add("password-success");

    } else {

        confirmError.style.display = "block";
        confirmError.style.color = "#ef4444";
        confirmError.innerHTML = "✖ Passwords do not match";

        confPass.classList.remove("password-success");
        confPass.classList.add("password-error");
    }
}

newPass.addEventListener("input", validateConfirmPassword);
confPass.addEventListener("input", validateConfirmPassword);



function checkCurrentPassword(){

    const input = document.getElementById("currPass");
    const error = document.getElementById("currentPasswordError");

    const realPassword = "password123"; // DEMO ONLY

    if(input.value === ""){
        input.classList.remove("password-error","password-success");
        error.innerHTML = "";
        return;
    }

    if(input.value === realPassword){

        input.classList.remove("password-error");
        input.classList.add("password-success");

        error.style.color="#16a34a";
        error.innerHTML="✔ Current password is correct.";

    }else{

        input.classList.remove("password-success");
        input.classList.add("password-error");

        error.style.color="#ef4444";
        error.innerHTML="✖ Current password is incorrect.";
    }

}

function previewImage(event)
{
    const preview = document.getElementById('preview');

    preview.src = URL.createObjectURL(event.target.files[0]);
}
