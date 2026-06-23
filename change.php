<?php
$_blocked = ['connect', 'host', 'username', 'passwd', 'dbname', 'stmt', 'result', 'rs'];

foreach ($_GET as $_k => $_v) {
    if (!in_array($_k, $_blocked, true) && preg_match('/^\w+$/', $_k)) {
        ${$_k} = $_v;
    }
}
foreach ($_POST as $_k => $_v) {
    if (!in_array($_k, $_blocked, true) && preg_match('/^\w+$/', $_k)) {
        ${$_k} = $_v;
    }
}
foreach ($_FILES as $_k => $_v) {
    if (!in_array($_k, $_blocked, true) && preg_match('/^\w+$/', $_k)) {
        ${$_k . "_name"}  = $_v['name'];
        ${$_k . "_type"}  = $_v['type'];
        ${$_k . "_size"}  = $_v['size'];
        ${$_k . "_error"} = $_v['error'];
        ${$_k}            = $_v['tmp_name'];
    }
}
unset($_blocked, $_k, $_v);
?>
