var observer = new IntersectionObserver((entries) => {
  entries.map((entry) => {
    if (entry.isIntersecting) {
      entry.target.classList.add("show");
    } else {
      entry.target.classList.remove("show");
    }
  });
});

var hiddenElements = document.querySelectorAll(".hidden");
hiddenElements.forEach((el) => observer.observe(el));

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
//modal
const editModal = document.getElementById("editModal");
if (editModal) {
  editModal.addEventListener("show.bs.modal", (event) => {
    // Button that triggered the modal
    const button = event.relatedTarget;
    // Extract info from data-bs-* attributes
    var recipient = button.getAttribute("data-don-values");
    // If necessary, you could initiate an Ajax request here
    // and then do the updating in a callback.
    [title, category, quantity, description] = recipient.split(",");

    // Update the modal's content.
    editModal.querySelector(".modal-body #item_name").value = title;

    const selections = editModal.querySelectorAll("select option");
    selections.forEach((option) => {
      if (category == option.value) {
        option.setAttribute("selected", "true");
      } else {
        option.removeAttribute("selected");
      }
    });

    editModal.querySelector("#quantity").value = quantity;
    editModal.querySelector("#description").value = description;
  });
}

// function read_more(fields) {
//   $(document).ready(function () {
//     $("#readMoreModal").modal("show");
//   });
// }

const readModal = document.getElementById("readMoreModal");
if (readModal) {
  readModal.addEventListener("show.bs.modal", (event) => {
    // Button that triggered the modal
    const button = event.relatedTarget;
    // Extract info from data-bs-* attributes
    var recipient = button.getAttribute("data-don-desc");
    // If necessary, you could initiate an Ajax request here
    // and then do the updating in a callback.
    [title, description] = recipient.split(",");

    // Update the modal's content.
    var title_tag = readModal.querySelector(".modal-header #exampleModalLabel");
    title_tag.textContent = title;

    var description_tag = readModal.querySelector(".modal-body .modal-text");
    description_tag.textContent = description;
  });
}
