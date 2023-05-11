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
