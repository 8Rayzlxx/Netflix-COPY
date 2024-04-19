let accordian = document.getElementsByClassName("FAQ__title");

for (let i = 0; i < accordian.length; i++) {
  accordian[i].addEventListener("click", function () {
    if (this.childNodes[1].classList.contains("fa-plus")) {
      this.childNodes[1].classList.remove("fa-plus");
      this.childNodes[1].classList.add("fa-times");
    } else {
      this.childNodes[1].classList.remove("fa-times");
      this.childNodes[1].classList.add("fa-plus");
    }

    let content = this.nextElementSibling;
    if (content.style.maxHeight) {
      content.style.maxHeight = null;
    } else {
      content.style.maxHeight = content.scrollHeight + "px";
    }
  });
}

// the javascript code that grabs the email inputted in index.php
          document.getElementById("signinButton").addEventListener("click", function(event) {
            var email = document.getElementById("emailInput").value;
            if (email) {
              var href = this.getAttribute("href");
              const url = window.location.href + "pages/signin.php?email=" + encodeURIComponent(email)
              window.location = url
              event.preventDefault(); // Prevent the default action if email is empty
            } else {
              event.preventDefault(); // Prevent the default action if email is empty
            }
          });
// ends here

// Code for checking email if it has @
document.getElementById("signinButton").addEventListener("click", function(event) {
  var email = document.getElementById("emailInput").value;
  
  // Check if email contains "@"
  if (!email.includes("@")) {
      alert("Please enter a valid email address."); // Display an alert message
      window.location.reload(); // Refresh the page after the alert is dismissed
      event.preventDefault(); // Prevent the default action (i.e., navigating to the link)
  }
});
// Email checking code ends here


  // Get the navbar element
  var navbar = document.getElementById("navbar");

  // Listen for the scroll event
  window.addEventListener("scroll", function() {
    // Check if the user has scrolled down more than 100px
    if (window.scrollY > 100) {
      // Add the "scrolled" class to the navbar
      navbar.classList.add("scrolled");
    } else {
      // Remove the "scrolled" class from the navbar
      navbar.classList.remove("scrolled");
    }
  });
