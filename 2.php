<?php
mail('sergysh@gmail.com', 'My Subject', 'demo');

exit();
include_once '_top.php';

$r = $glObj['gDb'] -> getAll('SELECT w.*, w.title AS stake_title FROM inz_wards w
                              LEFT JOIN inz_wards w2 ON (w.id_parent = w.id) ORDER BY w.id');
foreach ($r as $v)
{
    $ri = $glObj['gDb'] -> getAll('SELECT w.*, w.title AS stake_title
                                   FROM inz_wards w
                                   LEFT JOIN inz_wards w2 ON (w.id_parent = w.id)
                                   WHERE w.id > ? AND w.title = ? AND
     w.country = ? AND w.city = ?
     ORDER BY id', array($v['id'], $v['title'], $v['country'], $v['city']));
    if (!empty($ri))
    {
        //echo $v['id'].' '.$v['title'].' '.$v['country'].' '.$v['city'].' | '.$v['region'].' | '.$v['stake_title'].' '.'<br />';
        foreach ($ri as $v2)
        {
            $glObj['gDb'] -> query('DELETE FROM inz_wards WHERE id = ?', array($v2['id']));
            echo $v2['id'].' '.$v2['title'].' '.$v2['country'].' '.$v2['city'].' | '.$v['region'].' | '.$v['stake_title'].' '.'<br />';
        }
        //echo '--------------------------- <br />';
    }
}
?>
