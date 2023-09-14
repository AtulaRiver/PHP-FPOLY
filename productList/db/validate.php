<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $category_id = $_POST["category_id"];
    $name = $_POST["name"];
    $comment = $_POST["comment"];

    $errorName = $errorCategory = $errorComment = null;

    if (empty($name) || ctype_alpha(str_replace(' ', '', $name)) === false) {
        $errorName = 'Bắt buộc phải nhập !';
    }
    if (empty($category_id) || ctype_alpha(str_replace(' ', '', $category_id)) === false) {
        $errorCategory = 'Bắt buộc phải nhập !';
    }
    if (empty($comment) || ctype_alpha(str_replace(' ', '', $comment)) === false) {
        $errorComment = 'Bắt buộc phải nhập !';
    }
}
