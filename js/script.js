const select = document.querySelector(".select");
const checkDate = document.querySelectorAll(".checkDate");

//Get all checkbox and date for disabled if there are not in work group
checkDate.forEach((e) => {
  const dateDebut = e.parentElement.parentElement.querySelector(".startDate");
  const dateFin = e.parentElement.parentElement.querySelector(".endDate");
  //set default disabled on date and checkbox
  if (e.classList[1] == select[select.selectedIndex].value) {
    e.disabled = true;
    dateDebut.disabled = true;
    dateFin.disabled = true;
  }
  //change date and checkbox disabled
  select.addEventListener("change", () => {
    if (e.classList[1] == select[select.selectedIndex].value) {
      e.disabled = true;
      dateDebut.disabled = true;
      dateFin.disabled = true;
      e.checked = false;
    } else {
      e.disabled = false;
      dateDebut.disabled = false;
      dateFin.disabled = false;
    }
  });
});
