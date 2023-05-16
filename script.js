var observer = new IntersectionObserver((entries) => {
  entries.map((entry) => {
    if (entry.isIntersecting) {
      entry.target.classList.add("show");
    } else {
      entry.target.classList.remove("show");
    }
  });
});

var confirm_password = () => {
  let password = document.getElementById("password");
  let re_password = document.getElementById("re-password");
  if (password.value != re_password.value) {
    password.classList.add("border-danger");
    re_password.classList.add("border-danger");
    alert("Password must be the same");
    return false;
  }
  return true;
};

var hiddenElements = document.querySelectorAll(".hidden");
hiddenElements.forEach((el) => observer.observe(el));

var toTop = document.getElementById("toTop");

// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function () {
  scrollFunction();
};

function scrollFunction() {
  if (toTop == null) {
    return;
  }
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    toTop.style.display = "block";
  } else {
    toTop.style.display = "none";
  }
}

// When the user clicks on the button, scroll to the top of the document
function topFunction() {
  document.body.scrollTop = 0; // For Safari
  document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
}

function displayInput() {
  document.getElementById();
}

$(document).ready(function () {
  // allowed maximum input fields
  var max_input = 5;

  // initialize the counter for textbox
  var x = 1;

  // handle click event on Add More button
  $(".add-btn").click(function (e) {
    e.preventDefault();
    if (x < max_input) {
      // validate the condition
      x++; // increment the counter
      $(".wrapper").append(`
          <div class="input-box">
            <input type="text" name="input_name[]"/>
            <a href="#" class="remove-lnk">Remove</a>
          </div>
        `); // add input field
    }
  });

  // handle click event of the remove link
  $(".wrapper").on("click", ".remove-lnk", function (e) {
    e.preventDefault();
    $(this).parent("div").remove(); // remove input field
    x--; // decrement the counter
  });
});
