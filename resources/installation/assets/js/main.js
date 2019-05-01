window.onload = function() {
  // disable default behavior for forms (reload once a buttun is clicked)
  const form = document.querySelector("#installForm");
  form.addEventListener("submit", function(event) {
    event.preventDefault();
  });
  // handle form switching
  let steps = document.getElementsByClassName("step-form");
  let stepOneForm = steps[0];
  let stepTwoForm = steps[1];
  document.getElementById("nextButton").addEventListener("click", function() {
    // stepOneForm.classList.add("animated", "fadeOutLeft");
    stepOneForm.style.display = "none";
    stepTwoForm.style.display = "initial";
    // stepTwoForm.classList.add("animated", "fadeInRight");
  });
  document
    .getElementById("previousButton")
    .addEventListener("click", function() {
      stepTwoForm.style.display = "none";
      stepOneForm.style.display = "initial";
    });

  // make sure accept terms and conditions is checked before enabling install button
  document.querySelector("#acceptTerms").addEventListener("change", function() {
    document.getElementById("installButton").toggleAttribute("disabled");
  });
};
