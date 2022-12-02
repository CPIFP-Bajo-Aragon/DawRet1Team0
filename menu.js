
function validacion() {
  valor = document.getElementById("nameuser").value;
  email = document.getElementById("mail").value
  const alerta = document.getElementById("alert1");
  const alerta2 = document.getElementById("alert2");
  const alerta3 = document.getElementById("alert3");
    
  if( valor == null || valor.length == 0 || /^\s+$/.test(valor) ) {
    alerta.classList.add("show");
    return false;
  }

  if( email == null || email.length == 0 || /^\s+$/.test(email) ) {
    alerta2.classList.add("show");
    return false; 
  }

  if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3,4})+$/.test(email)){
    alerta3.classList.add("show");
    return false;
  }
}

const openEls = document.querySelectorAll("[data-open]");
const closeEls = document.querySelectorAll("[data-close]");
const isVisible = "is-visible";

for (const el of openEls) {
  el.addEventListener("click", function() {
    const modalId = this.dataset.open;
    document.getElementById(modalId).classList.add(isVisible);
  });
}

for (const el of closeEls) {
  el.addEventListener("click", function() {
    this.parentElement.parentElement.parentElement.classList.remove(isVisible);
  });
}

document.addEventListener("click", e => {
  if (e.target == document.querySelector(".modal.is-visible")) {
    document.querySelector(".modal.is-visible").classList.remove(isVisible);
  }
});

document.addEventListener("keyup", e => {
  // If press the ESC
  if (e.key == "Escape" && document.querySelector(".modal.is-visible")) {
    document.querySelector(".modal.is-visible").classList.remove(isVisible);
  }
});