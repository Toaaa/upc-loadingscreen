// Mit jQuery
$(document).on({
    "contextmenu": function(e) {
        console.log("ctx menu button:", e.which);

        // Das Kontextmenü beenden
        e.preventDefault();
    },
    "mousedown": function(e) {
        console.log("normal mouse down:", e.which);
    },
    "mouseup": function(e) {
        console.log("normal mouse up:", e.which);
    }
});