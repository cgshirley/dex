<table id='signups' class='display'>
<thead>
    <tr>
        <th>Name</th>
        <th>Email Address</th>
    </tr>
</thead>
<tbody>

<?php
foreach ($signups as $entry) {
    echo "<tr>\n\t<td>" . $entry['name'] . "</td>\n\t<td>" . $entry['email'] . "</td>\n</tr>";
}
?>

</tbody>
</table>

<script type="text/javascript" charset="utf8">
$(document).ready(function() {
    $('#signups').dataTable();
});
</script>
