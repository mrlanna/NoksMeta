
window.onload = function() {
    var saverOptions = { file: "file"};
    var saverButton = OneDrive.createSaveButton(saverOptions);
    document.getElementById("save").appendChild(saverButton);
}