<?php
function h($val) {
    if (is_array($val)) {
        return array_map("h", $val);
    } else {
        return htmlspecialchars($val, ENT_QUOTES);
    }
}
?>