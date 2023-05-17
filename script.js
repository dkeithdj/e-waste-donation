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
//modal
const exampleModal = document.getElementById("exampleModal");
if (exampleModal) {
  exampleModal.addEventListener("show.bs.modal", (event) => {
    // Button that triggered the modal
    const button = event.relatedTarget;
    // Extract info from data-bs-* attributes
    var recipient = button.getAttribute("data-don-values");
    // If necessary, you could initiate an Ajax request here
    // and then do the updating in a callback.
    [title, category, quantity, description] = recipient.split(",");

    // Update the modal's content.
    exampleModal.querySelector(".modal-body #item_name").value = title;

    const selections = exampleModal.querySelectorAll("select option");
    selections.forEach((option) => {
      if (category == option.value) {
        option.setAttribute("selected", "true");
      } else {
        option.removeAttribute("selected");
      }
    });

    exampleModal.querySelector("#quantity").value = quantity;
    exampleModal.querySelector("#description").value = description;
  });
}
$(document).ready(function () {
  // $("#exampleModalToggle").modal("show");
});

// const modifyButtons = document.getElementById("modify-buttons");
// const val = modifyButtons.getAttribute("data-don-isEdit");
// // const aLink = document.querySelectorAll("#modify-buttons button");
// var [is_checked, button_id] = val.split(",");
// const aLink = document.querySelectorAll(`#modify-buttons button`);
// // console.log(val);
// // console.log(aLink);
// aLink.forEach((button) => {
//   if (is_checked == 1) {
//     console.log(button);
//     // modifyButtons.style.display = "none";

//     button.setAttribute("disabled", "");
//   } else {
//     button.removeAttribute("disabled");
//   }
// });

// const ed = document.getElementById(`${button_id}`);
// const del = document.getElementById(`del_${button_id}`);
// console.log(ed);
// console.log(del);

// console.log(aLink);
// aLink.forEach((button) => {
//   console.log(button);
// });
// if (is_checked == 1) {
//   aLink.forEach((a) => {
//     console.log(a);
//     // a.setAttribute("disabled", "");
//   });
// } else {
//   aLink.forEach((a) => {
//     console.log(a);
//     // a.removeAttribute("disabled");
//   });
// }
