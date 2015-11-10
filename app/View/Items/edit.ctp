<?php echo($this->Form->create('Item')); ?>
<table>
	<tr>
		<th>id</th>
		<td><?php echo($this->request->data['Item']['id']); ?></td>
	</tr>
	<tr>
		<th>name</th>
		<td>
			<?php
			echo($this->Form->text('name'));
			echo($this->Form->error('name'));
			?>
		</td>
	</tr>
	<tr>
		<th>price</th>
		<td>
			<?php
			echo($this->Form->text('price'));
			echo($this->Form->error('price'));
			?>
		</td>
	</tr>
</table>
<?php
echo($this->Form->hidden('System.action', array('value' => 'confirm')));
echo($this->Form->end('確認'));
