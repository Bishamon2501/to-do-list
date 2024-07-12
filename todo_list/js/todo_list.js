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
  $(document).on("submit", "#todoForm", function (e) {
    e.preventDefault();

    let todo = $("#todo");
    let comment = $("#comment");

    $.ajax({
      type: "POST",
      url: "../todo_list/actions/addTodo.php",
      data: {
        todo: todo.val(),
        comment: comment.val(),
      },
      success: function (response) {
        // Update table data after insert
        $(".table").load(location.href + " .table");
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
  $(document).on("click", ".updateTodoBtn", function () {
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
        $(".table").load(location.href + " .table");
      },
      error: function (xhr, status, error) {
        console.error("Error:", error);
      },
    });
  });

  // Function to delete to-do
  $(document).on("click", ".deleteTodoBtn", function () {
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
        setTimeout(() => {
          $(".table").load(location.href + " .table");
        }, 1000);
      },
      error: function (xhr, status, error) {
        console.error("Error:", error);
      },
    });
  });
});
