$(document).ready(() => {
  if ($(".alert").length > 0) {
    $(".alert").fadeOut(3000, "swing");
  }

  $("#logoutBtn").on("click", () => {
    $.ajax({
      type: "POST",
      url: "../todo_list/functions.php",
      data: { action: "logout" },
      success: function (response) {
        setTimeout(() => {
          window.location.reload();
        }, 1500);
      },
      error: function (xhr, status, error) {
        console.error("Error:", error);
      }
    });
  });
});
