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
/**
 * Created by manue on 27-09-15.
 */

tinymce.init({
    selector: "textarea#text_editor",
    theme: "modern",
    width: 900,
    height: 600,
    plugins: [
        "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
        "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
        "save table contextmenu directionality emoticons template paste textcolor bloknot"
    ],
    file_browser_callback: BlokNotTInyMCEBrowser,
    /*images_upload_handler: function (blobInfo, success, failure) {
        var xhr, formData;

        xhr = new XMLHttpRequest();
        xhr.withCredentials = false;
        xhr.open('POST', "/post_images");

        xhr.onload = function () {
            var json;

            if (xhr.status != 200) {
                failure("HTTP Error: " + xhr.status);
                return;
            }

            json = JSON.parse(xhr.responseText);

            if (!json || typeof json.location != "string") {
                failure("Invalid JSON: " + xhr.responseText);
                return;
            }

            success(json.location);
        };

        formData = new FormData();
        formData.append('file', blobInfo.blob(), fileName(blobInfo));

        xhr.send(formData);
     },*/
    //content_css: "js/tinymce/css/content.css",
    toolbar: "addFile insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | bloknot |print preview media fullpage | forecolor backcolor emoticons",
    style_formats: [
        {title: 'Bold text', inline: 'b'},
        {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
        {title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
        {title: 'Example 1', inline: 'span', classes: 'example1'},
        {title: 'Example 2', inline: 'span', classes: 'example2'},
        {title: 'Table styles'},
        {title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
    ],
    extended_valid_elements: "iframe[src|width|height|name|align|frameborder|allowfullscreen]"
    /*images_upload_url: "/file/upload"*/
});

function insertIntoEditor(id) {
    var src = "http://ibiteria.com/file/view/" + id;
    this.file_select.url.value = src;
    var ed = tinymce.get("text_editor");
    if (ed == null) alert("Cannot find text editor");
    var range = ed.selection.getRng();                  // get range
    var newNode = ed.getDoc().createElement("img");  // create img node
    newNode.src = src;                           // add src attribute
    range.insertNode(newNode);
}