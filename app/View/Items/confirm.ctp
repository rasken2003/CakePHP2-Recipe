<table>
	<tr>
		<th>id</th>
		<td><?php echo($this->request->data['Item']['id']); ?></td>
	</tr>
	<tr>
		<th>name</th>
		<td><?php echo($this->request->data['Item']['name']); ?></td>
	</tr>
	<tr>
		<th>price</th>
		<td><?php echo($this->request->data['Item']['price']); ?></td>
	</tr>
</table>

<?php
echo($this->Form->create('Item'));
echo($this->Form->hidden('System.action', array('value' => 'save')));
echo($this->Form->hidden('id'));
echo($this->Form->hidden('name'));
echo($this->Form->hidden('price'));
echo($this->Form->end('保存'));
