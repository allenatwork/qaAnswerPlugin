<?php

if (is_array($questionList)) {
    foreach ($questionList as $qt) {
        $qt->display_short();
    }
}
else
    echo "Question list is not a array";
?>
