<!-- ADD CATEGORY MODAL -->

<div class="modal-wrapper hidden" id="add-collection">
    <div class="modal">
        <form action="./includes/add-collection.php" method="POST" enctype="multipart/form-data">
            <!-- The title of the modal goes here -->
            <div class="modal-title">
                <h3>Add New Collection</h3>
                <div class="title-buttons">
                    <button type="submit" class="submit" style="background-color:var(--green); color:white;">Create</button>
                    <button type="button" class="filterOpen" data-target="add-collection" style="background-color:var(--red); color:white;">Cancel</button>
                </div>
            </div>
            <!-- The title of the modal ends here -->

            <!-- The content of the modal goes here -->
            <div class="modal-contents">
                <div class="input-full">
                    <label>Collection Name</label>
                    <input name="collectionName" type="text" />
                </div>
                <div class="input-full">
                    <label>Collection Description</label>
                    <textarea name="collectionDescription"></textarea>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- VIEW equipment MODAL -->
<div class="modal-wrapper hidden" id="view-category">
    <div class="modal">
        <!-- The title of the modal goes here -->
        <div class="modal-title">
            <h3>Category Details</h3>
            <div class="title-buttons">
                <button type="button" class="filterOpen" data-target="view-category" style="background-color:var(--red); color:white;">Close</button>
            </div>
        </div>
        <!-- The title of the modal ends here -->

        <!-- The content of the modal goes here -->
        <div class="modal-contents">
            <div class="input-full">
                <label>Category Picture</label>
                <div class="modal-image-container">
                    <img id="view-category-image" src="" alt="category Image">
                </div>
            </div>
            <div class="input-full">
                <label>Category Name</label>
                <div class="view-field" id="view-category-name"></div>
            </div>
            <div class="input-full">
                <label>Category Description</label>
                <div class="view-field" id="view-category-description"></div>
            </div>
            <div class="input-full">
                <label>Date Created</label>
                <div class="view-field" id="view-category-date"></div>
            </div>
        </div>
    </div>
</div>