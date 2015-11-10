<table>
	<tr>
		<th>id</th>
		<td><?php echo($item['Item']['id']); ?></td>
	</tr>
	<tr>
		<th>name</th>
		<td><?php echo($item['Item']['name']); ?></td>
	</tr>
	<tr>
		<th>price</th>
		<td><?php echo($item['Item']['price']); ?></td>
	</tr>
</table>

<?php
echo($this->Html->link('[編集]', '/items/edit/'.$item['Item']['id']));
