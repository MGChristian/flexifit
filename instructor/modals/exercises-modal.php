<!-- ADD EXERCISE MODAL -->

<div class="modal-wrapper hidden" id="add-exercise">
    <div class="modal">
        <form action="./includes/add-exercise.php" method="POST" enctype="multipart/form-data">
            <!-- The title of the modal goes here -->
            <div class="modal-title">
                <h3>Add New Exercise</h3>
                <div class="title-buttons">
                    <button type="submit" class="submit" style="background-color:var(--green); color:white;">Create</button>
                    <button type="button" class="filterOpen" data-target="add-exercise" style="background-color:var(--red); color:white;">Cancel</button>
                </div>
            </div>
            <!-- The title of the modal ends here -->

            <!-- The content of the modal goes here -->
            <div class="modal-contents">
                <div class="input-full hidden">
                    <input name="createdBy" type="file" value="admin" />
                </div>
                <div class="input-full">
                    <label>EXERCISE PICTURE</label>
                    <input name="exercisePic" type="file" />
                </div>
                <div class="input-full">
                    <label>Exercise Name</label>
                    <input name="exerciseName" type="text" />
                </div>
                <div class="input-full">
                    <label>Exercise Description</label>
                    <textarea name="exerciseDescription"></textarea>
                </div>
            </div>
        </form>
    </div>
</div>