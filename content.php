<div id="form">
    <h2>CREATIVE SUITE SUPPORT</h2>
    <div class="push"></div>
    <form onsubmit="return false;" id="zFormer" method="POST" action="form.php" name="former" enctype="multipart/form-data">
        <div id="box_form" class="contact-form">
            <img class="first" src="img/email_icon.png">
            <div id="progress">
                <div class="loader">
                </div>
                 <p>loading...</p>
            </div>
            <div class="push"></div>
            <div id="input-wrap">
            <p>
                <label for="z_name">Name: </label>
                <input id="name" type="text" value="" name="z_name" maxlength="40" placeholder="Name" autocomplete="off" required autofocus>
            </p>
            <p>
                <label for="z_requester">Email: </label>
                <input id="email" type="email" value="" name="z_requester" placeholder="Email" autocomplete="off" required>
            </p>
            <p>
                <label for="z_subject">Subject: </label>
                <select id="subject" class="turnintodropdown" name="z_subject" autocomplete="off" required >
                  <option value="" selected disabled selected="selected">Choose an issue here</option>
                  <option value="Billing/Accounts">Billing/Accounts</option>
                  <option value="Getting Started">Getting Started</option>
                  <option value="Templates/Creative Library">Templates/Creative Library</option>
                  <option value="Ad Builder">Ad Builder</option>
                  <option value="Exporting">Exporting</option>
                  <option value="Other">Other</option>
                </select>
            </p>
            <p class="last">
                <label for="z_description">Description: </label>
                <textarea id="description" type="text" value="" name="z_description" autocomplete="off" placeholder="Please describe your issue here..." required></textarea>
            </p>
            <div class="push"></div>
            <p class="upload">
                <input type="file" name="z_file" id="file" title="zfile" class="inputfile" data-multiple-caption="{count} files selected" multiple />
                <label for="file" name="z_fname" id="upload" ><span class="info">Choose a file: <br><span class="disc">(files must be in .png format, such as screenshots)</span></span></label>
                <!-- <label for="z_attachment">Select images: </label>
                <input id="upload" type="file" name="img" multiple /> -->
            </p>
            <button type="submit" value="submit" id="submitter" >SUBMIT</button>
            </div>
        </div>
    </form>
    <div class="push"></div>
</div>
<!-- <div id="progress">
    <div class="loader">
    </div>
</div> -->
<div id="info" class="hide">
    <h2>Thank you!</h2>
    <p>Hit the back button to return to the guide.</p>
</div>