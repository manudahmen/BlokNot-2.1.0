/**
 * Created by manue on 30-09-15.
 */
function BlokNotTInyMCEBrowser(field_name, url, type, win) {

    // alert("Field_Name: " + field_name + "nURL: " + url + "nType: " + type + "nWin: " + win); // debug/testing

    /* If you work with sessions in PHP and your client doesn't accept cookies you might need to carry
     the session name and session ID in the request string (can look like this: "?PHPSESSID=88p0n70s9dsknra96qhuk6etm5").
     These lines of code extract the necessary parameters and add them back to the filebrowser URL again. */

    var cmsURL = "/note/ed_browser";    // script URL - use an absolute path!

    tinyMCE.activeEditor.windowManager.open({
        file: cmsURL,
        title: 'My File Browser',
        width: 420,  // Your dimensions may differ - toy around with them!
        height: 400,
        resizable: "yes",
        inline: "yes",  // This parameter only has an effect if you use the inlinepopups plugin!
        close_previous: "no"
    }, {
        window: win,
        input: field_name
    });
    return false;
}

var FileBrowserDialogue = {
    init: function () {
        // Here goes your code for setting your custom things onLoad.
    },
    mySubmit: function () {
        var URL = document.editor_form.filename.value;
        var win = tinyMCEPopup.getWindowArg("window");

        // insert information now
        win.document.getElementById(tinyMCEPopup.getWindowArg("input")).value = URL;

        // are we an image browser
        if (typeof(win.ImageDialog) != "undefined") {
            // we are, so update image dimensions...
            if (win.ImageDialog.getImageData)
                win.ImageDialog.getImageData();

            // ... and preview if necessary
            if (win.ImageDialog.showPreviewImage)
                win.ImageDialog.showPreviewImage(URL);
        }
        var inst = tinyMCE.selectedInstance;

        // close popup window
        tinyMCEPopup.close();
    }
}


tinyMCEPopup.onInit.add(FileBrowserDialogue.init, FileBrowserDialogue);
