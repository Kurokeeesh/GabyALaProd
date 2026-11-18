document.addEventListener("DOMContentLoaded", function () {
    const popup = document.getElementById("popup-warning");
    const closeBtn = document.getElementById("popup-close");
  
    // Affiche la popup uniquement si elle n'a pas été vue dans cette session
    if (!sessionStorage.getItem("popupSeen")) {
      popup.style.display = "flex";
    }
  
    closeBtn.addEventListener("click", function () {
      popup.style.display = "none";
      sessionStorage.setItem("popupSeen", "true"); // uniquement pour la session actuelle
    });
  });
  