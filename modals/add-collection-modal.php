<!-- ADD COLLECTION WORKOUT MODAL -->

<?php if ($isLoggedIn): ?>
    <div class="modal-wrapper hidden" id="add-workout-collection">
        <div class="modal">
            <form action="./includes/add-collection-workout.php" method="POST" enctype="multipart/form-data">
                <!-- The title of the modal goes here -->
                <div class="modal-title">
                    <h3>Add New Collection</h3>
                    <div class="title-buttons">
                        <button type="submit" class="submit" style="background-color:var(--green); color:white;">Create</button>
                        <button type="button" class="filterOpen" data-target="add-workout-collection" style="background-color:var(--red); color:white;">Cancel</button>
                    </div>
                </div>
                <!-- The title of the modal ends here -->

                <!-- The content of the modal goes here -->
                <div class="modal-contents">
                    <input type="text" name="workoutID" value="<?= $workoutID ?>" class="hidden" />
                    <div class="input-full">
                        <label>Collection Name</label>
                        <select name="collectionID">
                            <option disabled selected>CHOOSE COLLECTION</option>
                            <?php foreach ($collectionList as $collection): ?>
                                <option value="<?= $collection['ID'] ?>"> <?= $collection['collectionName'] ?> </option>
                            <?php endforeach ?>
                        </select>
                    </div>
                </div>
            </form>
        </div>
    </div>
<?php endif; ?>