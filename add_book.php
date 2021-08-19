
<div>
    <h3>Add book info</h3>
    <form action="add_book_action.php" enctype="multipart/form-data" method="post">
        <div class="mb-3">
        <label class="form-label" for="name">Book name</label>
        <input type="text" class="form-control" id="name" name="name"></input>
        </div><div class="mb-3">
        <label class="form-label" for="isbn">Book isbn</label>
        <input type="text" class="form-control" id="isbn" name="isbn"></input>
        </div><div class="mb-3">
        <label class="form-label" for="author">Book author</label>
        <input type="text" class="form-control" id="author" name="author"></input>
        </div><div class="mb-3">
        <label class="form-label" for="file_to_upload">Book </label>
        <input type="file" class="form-control" id="file_to_upload" name="file_to_upload"></input>
        </div>
        <button class="btn btn-primary" type="submit">Add</button>
    </form>
</div>
