<?php
function slot($viewfile, $props = [])
{
    extract($props);

    ob_start();
    include "views/$viewfile.view.php";
    return ob_get_clean();
}

function template($title, $stylefile, $content)
{
    return slot('template', [
        'title' => $title,
        'stylefile' => $stylefile,
        'content' => $content,
    ]);
}