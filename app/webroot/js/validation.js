document.addEventListener("DOMContentLoaded", function() {
    const form = document.querySelector("form");
    form.addEventListener("submit", function(event) {
        let hasErrors = false;
        const name = form.querySelector("[name='data[User][name]']").value;
        const email = form.querySelector("[name='data[User][email]']").value;
        console.log(email);
        // const password = form.querySelector("[name='data[User][password]']").value;

        if (!name || name.length < 5 || name.length > 20) {
            alert("Name must be between 5 and 20 characters.");
            hasErrors = true;
        }

        const emailRegex = /^[a-zA-Z0-9_+-]+(\.[a-zA-Z0-9_+-]+)*@([a-zA-Z0-9][a-zA-Z0-9-]*[a-zA-Z0-9]*\.)+[a-zA-Z]{2,}$/;
        if (!email || !email.match(emailRegex) {
            alert("Please provide a valid email address.");
            hasErrors = true;
        }


        if (hasErrors) event.preventDefault(); 
    });
});
