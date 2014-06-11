<h1>Rezepte</h1>
<a href="/hinzufuegen">Neues Rezept hinzufügen</a>
<table>	
<tr>
	<th class="bla_delete delete">User</th>
	<th>Rezept</th>
	<th>Beschreibung</th>
    <th>Zutaten</th>
</tr>
<?php
	if($data['recipes']){
		foreach($data['recipes'] as $row){
			echo "<tr>";
			echo "<td>$row->user</td>";
			echo "<td>$row->name</td>";
            echo "<td>$row->beschreibung</td>";
            echo "<td>$row->zutaten</td>";

			echo "</tr>";
		}
	}
?>
</table>