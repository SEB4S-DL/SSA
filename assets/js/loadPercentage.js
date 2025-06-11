document.addEventListener("DOMContentLoaded", loadPercentages)

function loadPercentages(){
  let percentageContainers = document.querySelectorAll(".percentage-container");
  
  percentageContainers.forEach((item) => {
    let percentage = `${item.dataset.percentage}%`
    item.style.width = percentage;
  });
}
