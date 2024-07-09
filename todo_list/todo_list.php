<?php
$username = $_SESSION['username'];
$userId = $_SESSION['userId'];

$todo = $pdo->prepare(file_get_contents("./sql/getTodo.sql"));
$todo->execute(array("user_id" => $userId));
$todo_list = $todo->fetchAll();
?>
<div class="container">
    <h1>Welcome back <?php echo $username ?></h1>
    <div>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#todoModal">Add To-do</button>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">To-do</th>
                <th scope="col">Comment</th>
                <th scope="col">Created at</th>
                <th scope="col">Updated at</th>
                <th scope="col">Update entry</th>
                <th scope="col">Delete entry</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($todo_list as $entry) { ?>
                <tr data-id="<?php echo $entry['id']; ?>">
                    <th scope="row"><?php echo $entry['id']; ?></th>
                    <td>
                        <p class="todoInput"><?php echo $entry['todo']; ?></p>
                    </td>
                    <td>
                        <p class="commentInput"><?php echo $entry['comment'] !== "" ? $entry["comment"] : "-"; ?></p>
                    </td>
                    <td><?php echo $entry['created_at']; ?></td>
                    <td><?php echo $entry['updated_at']; ?></td>
                    <td><input type="submit" class="btn btn-primary updateTodoBtn" name="updateTodoBtn" value="Update"></td>
                    <td><input type="submit" class="btn btn-danger deleteTodoBtn" name="deleteTodoBtn" value="Delete"></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<!-- To-do Modal -->
<div class="modal fade" id="todoModal" tabindex="-1" role="dialog" aria-labelledby="todoModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add new entry to To-do-List</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/" method="post" id="todoForm">
                    <label for="todo">To-do:</label>
                    <input type="text" name="todo" id="todo" required>
                    <label for="comment">Comment:</label>
                    <input type="text" name="comment" id="comment">
                    <div class="btn-container">
                        <input type="submit" class="btn btn-primary todoBtn" name="todoBtn" value="Add">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>