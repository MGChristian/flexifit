<!-- ADD equipment MODAL -->

<div class="modal-wrapper hidden" id="add-equipment">
    <div class="modal">
        <form action="./includes/add-equipment.php" method="POST" enctype="multipart/form-data">
            <!-- The title of the modal goes here -->
            <div class="modal-title">
                <h3>Add New Equipment</h3>
                <div class="title-buttons">
                    <button type="submit" class="submit" style="background-color:var(--green); color:white;">Create</button>
                    <button type="button" class="filterOpen" data-target="add-equipment" style="background-color:var(--red); color:white;">Cancel</button>
                </div>
            </div>
            <!-- The title of the modal ends here -->

            <!-- The content of the modal goes here -->
            <div class="modal-contents">
                <div class="input-full">
                    <label>Equipment Picture</label>
                    <input name="profilePic" type="file" />
                </div>
                <div class="input-full">
                    <label>Equipment Name</label>
                    <input name="equipmentName" type="text" />
                </div>
                <div class="input-full">
                    <label>Equipment Description</label>
                    <textarea name="equipmentDescription"></textarea>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- VIEW equipment MODAL -->
<div class="modal-wrapper hidden" id="view-equipment">
    <div class="modal">
        <!-- The title of the modal goes here -->
        <div class="modal-title">
            <h3>Equipment Details</h3>
            <div class="title-buttons">
                <button type="button" class="filterOpen" data-target="view-equipment" style="background-color:var(--red); color:white;">Close</button>
            </div>
        </div>
        <!-- The title of the modal ends here -->

        <!-- The content of the modal goes here -->
        <div class="modal-contents">
            <div class="input-full">
                <label>Equipment Picture</label>
                <div class="modal-image-container">
                    <img id="view-equipment-image" src="" alt="Equipment Image">
                </div>
            </div>
            <div class="input-full">
                <label>Equipment Name</label>
                <div class="view-field" id="view-equipment-name"></div>
            </div>
            <div class="input-full">
                <label>Equipment Description</label>
                <div class="view-field" id="view-equipment-description"></div>
            </div>
            <div class="input-full">
                <label>Date Created</label>
                <div class="view-field" id="view-equipment-date"></div>
            </div>
        </div>
    </div>
</div>