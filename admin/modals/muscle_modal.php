<!-- ADD MUSCLE MODAL -->

<div class="modal-wrapper hidden" id="add-muscle">
    <div class="modal">
        <form action="./includes/add-muscle.php" method="POST" enctype="multipart/form-data">
            <!-- The title of the modal goes here -->
            <div class="modal-title">
                <h3>Add New Muscle</h3>
                <div class="title-buttons">
                    <button type="submit" class="submit" style="background-color:var(--green); color:white;">Create</button>
                    <button type="button" class="filterOpen" data-target="add-muscle" style="background-color:var(--red); color:white;">Cancel</button>
                </div>
            </div>
            <!-- The title of the modal ends here -->

            <!-- The content of the modal goes here -->
            <div class="modal-contents">
                <div class="input-full">
                    <label>Muscle Picture</label>
                    <input name="profilePic" type="file" />
                </div>
                <div class="input-full">
                    <label>Muscle Name</label>
                    <input name="muscleName" type="text" />
                </div>
                <div class="input-full">
                    <label>Muscle Description</label>
                    <textarea name="muscleDescription"></textarea>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- VIEW MUSCLE MODAL -->
<div class="modal-wrapper hidden" id="view-muscle">
    <div class="modal">
        <!-- The title of the modal goes here -->
        <div class="modal-title">
            <h3>muscle Details</h3>
            <div class="title-buttons">
                <button type="button" class="filterOpen" data-target="view-muscle" style="background-color:var(--red); color:white;">Close</button>
            </div>
        </div>
        <!-- The title of the modal ends here -->

        <!-- The content of the modal goes here -->
        <div class="modal-contents">
            <div class="input-full">
                <label>muscle Picture</label>
                <div class="modal-image-container">
                    <img id="view-muscle-image" src="" alt="muscle Image">
                </div>
            </div>
            <div class="input-full">
                <label>muscle Name</label>
                <div class="view-field" id="view-muscle-name"></div>
            </div>
            <div class="input-full">
                <label>muscle Description</label>
                <div class="view-field" id="view-muscle-description"></div>
            </div>
            <div class="input-full">
                <label>Date Created</label>
                <div class="view-field" id="view-muscle-date"></div>
            </div>
        </div>
    </div>
</div>