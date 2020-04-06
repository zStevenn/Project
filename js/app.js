$(document).ready(function () {
    $('#tableMessages, #tableHighscores, #highscores').DataTable({
        "info": false
    });
    $('.dataTables_length').addClass('bs-select');
});