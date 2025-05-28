const languageTrigger = document.querySelector(".switch-language-container");
const languageSelect = document.querySelector(".switch-language-bg");
const languageOptions = document.querySelector(".language-select");

languageTrigger.addEventListener("click", (e) =>{
  e.stopPropagation();
  languageSelect.classList.toggle("visible-language-select");

  document.addEventListener("click", (event) =>{
    if (event.target !== languageOptions){
      languageSelect.classList.toggle("visible-language-select");
    }
  }, {once: true});
});