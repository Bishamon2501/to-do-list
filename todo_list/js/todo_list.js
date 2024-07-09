function switchInput(className, textareaClassName) {
  $(document).on("click", "." + className, function () {
    $(this).replaceWith(
      "<textarea class='" +
        textareaClassName +
        "'>" +
        $(this).text().trim() +
        "</textarea>"
    );

    $("." + textareaClassName).focus();
  });

  $(document).on("blur", "." + textareaClassName, function () {
    $(this).replaceWith(
      "<p class='" + className + "'>" + $(this).val().trim() + "</p>"
    );
  });
}

// Function to add to-do
$(document).ready(() => {
  $("#todoForm").on("submit", function (e) {
    e.preventDefault();

    let formData = $(this).serialize();

    $.ajax({
      type: "POST",
      url: "../todo_list/actions/addTodo.php",
      data: formData,
      success: function (response) {
        // Update table data after insert
        window.location.reload();
      },
      error: function (xhr, status, error) {
        console.error("Error:", error);
      },
    });
  });

  // To-do Input
  switchInput("todoInput", "todoTextarea");
  // Comment Input
  switchInput("commentInput", "commentTextarea");

  // Function to update to-do
  $(".updateTodoBtn").on("click", function () {
    let row = $(this).closest("tr");
    let id = row.data("id");
    let todoInput = row.find(".todoInput");
    let commentInput = row.find(".commentInput");

    $.ajax({
      type: "POST",
      url: "../todo_list/actions/updateTodo.php",
      data: {
        id: id,
        todo: todoInput.text(),
        comment: commentInput.text(),
      },
      success: function (response) {
        // Update table data after update
        // old version doesn't work properly after AJAX call
        // $(".table").load(location.href + " .table");
        window.location.reload();
      },
      error: function (xhr, status, error) {
        console.error("Error:", error);
      },
    });
  });

  // Function to delete to-do
  $(".deleteTodoBtn").on("click", function () {
    let row = $(this).closest("tr");
    let id = row.data("id");

    $.ajax({
      type: "POST",
      url: "../todo_list/actions/deleteTodo.php",
      data: {
        id: id,
      },
      success: function (response) {
        // Update table data after delete
        window.location.reload();
      },
      error: function (xhr, status, error) {
        console.error("Error:", error);
      },
    });
  });
});
