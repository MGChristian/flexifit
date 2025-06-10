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
        <form action="./includes/add-equipment.php" method="POST" enctype="multipart/form-data">
            <!-- The title of the modal goes here -->
            <div class="modal-title">
                <h3>Add New Instructor</h3>
                <div class="title-buttons">
                    <button type="submit" class="submit" style="background-color:var(--green); color:white;">Create</button>
                    <button type="button" class="filterOpen" data-target="view-instructor" style="background-color:var(--red); color:white;">Cancel</button>
                </div>
            </div>
            <!-- The title of the modal ends here -->

            <!-- The content of the modal goes here -->
            <div class="modal-contents">
                <!-- <div class="hidden-inputs hidden">
                        <div class="inputs">
                            <label for="category-id">Category ID</label>
                            <input type="number" name="category-id" id="category-id">
                        </div>
                    </div> -->
                <div class="input-full">
                    <label>PROFILE PICTURE</label>
                    <input name="profilePic" type="file" />
                </div>
                <div class="half">
                    <div class="input-half">
                        <label>First Name</label>
                        <input name="firstName" type="text" />
                    </div>
                    <div class="input-half">
                        <label>Last Name</label>
                        <input name="lastName" type="text" />
                    </div>
                </div>
                <div class="half">
                    <div class="input-half">
                        <label>Email</label>
                        <input name="email" type="text" />
                    </div>
                    <div class="input-half">
                        <label>Contact Number</label>
                        <input name="contactNumber" type="text" />
                    </div>
                </div>
                <div class="half">
                    <div class="input-half">
                        <label>Gender</label>
                        <select name="gender">
                            <option selected disabled>Gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>
                    <div class="input-half">
                        <label>Birthdate</label>
                        <input name="birthdate" type="date" />
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>