<h1>Rezepte</h1>
<a href="rezepte/hinzufuegen">Neues Rezept hinzufügen</a>
<table>	
<tr>
	<th>User</th>
	<th>Rezept</th>
	<th>Beschreibung</th>
    <th>Zutaten</th>
</tr>
<?php
	if($data['recipes']){
		foreach($data['recipes'] as $row){
			echo "<tr>";
			echo "<td>".htmlspecialchars($row->user)."</td>";
			echo "<td>".htmlspecialchars($row->name)."</td>";
            echo "<td>".htmlspecialchars($row->beschreibung)."</td>";
            echo "<td>".htmlspecialchars($row->zutaten)."</td>";

			echo "</tr>";
		}
	}
?>
</table>