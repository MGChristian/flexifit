<!-- ADD WORKOUT MODAL -->

<div class="modal-wrapper hidden" id="add-workout">
    <div class="modal">
        <form action="./includes/add-workout.php" method="POST" enctype="multipart/form-data">
            <!-- The title of the modal goes here -->
            <div class="modal-title">
                <h3>Add New Workout</h3>
                <div class="title-buttons">
                    <button type="submit" class="submit" style="background-color:var(--green); color:white;">Create</button>
                    <button type="button" class="filterOpen" data-target="add-workout" style="background-color:var(--red); color:white;">Cancel</button>
                </div>
            </div>
            <!-- The title of the modal ends here -->

            <!-- The content of the modal goes here -->
            <div class="modal-contents">
                <div class="input-full">
                    <label>Workout Picture</label>
                    <input name="workoutPic" type="file" required />
                </div>
                <div class="input-full">
                    <label>Workout Name</label>
                    <input name="workoutName" type="text" required />
                </div>
                <div class="input-full">
                    <label>Workout Description</label>
                    <textarea name="workoutDescription" required></textarea>
                </div>
                <div class="input-full">
                    <label>Workout Difficulty</label>
                    <select name="difficulty" required>
                        <option selected disabled>Select Difficulty</option>
                        <option value="easy">Easy</option>
                        <option value="medium">Medium</option>
                        <option value="hard">Hard</option>
                    </select>
                </div>
            </div>
        </form>
    </div>
</div>